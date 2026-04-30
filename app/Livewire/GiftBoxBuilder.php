<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\GiftBox;
use App\Models\Product;
use App\Models\QuoteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class GiftBoxBuilder extends Component
{
    // [product_id => qty_per_box]
    public array $selectedItems = [];

    // Total boxes to order (minimum 50)
    public int $totalBoxes = 50;

    // Quote submitted flag
    public bool $submitted = false;

    // -------------------------------------------------------------------
    // Lifecycle
    // -------------------------------------------------------------------

    public function updatedSelectedItems(): void
    {
        // Remove items with 0 or empty qty
        $this->selectedItems = array_filter(
            $this->selectedItems,
            fn ($qty) => (int) $qty > 0
        );

        $this->unsetComputedProperties();
    }

    public function updatedTotalBoxes(): void
    {
        if ($this->totalBoxes < 50) {
            $this->totalBoxes = 50;
        }

        $this->unsetComputedProperties();
    }

    // -------------------------------------------------------------------
    // Computed Properties
    // -------------------------------------------------------------------

    #[Computed]
    public function products(): \Illuminate\Database\Eloquent\Collection
    {
        return Product::active()
            ->with('media', 'category')
            ->orderBy('name')
            ->get();
    }

    #[Computed]
    public function boxes(): \Illuminate\Database\Eloquent\Collection
    {
        return GiftBox::active()
            ->with('media')
            ->orderBy('capacity_units')
            ->get();
    }

    #[Computed]
    public function totalUnits(): float
    {
        if (empty($this->selectedItems)) {
            return 0.0;
        }

        $products = $this->products->keyBy('id');
        $total = 0.0;

        foreach ($this->selectedItems as $productId => $qty) {
            $product = $products->get((int) $productId);
            if ($product) {
                $total += (float) $product->size_units * (int) $qty;
            }
        }

        return $total;
    }

    #[Computed]
    public function recommendedBox(): ?GiftBox
    {
        if ($this->totalUnits <= 0) {
            return null;
        }

        return $this->boxes
            ->where('capacity_units', '>=', $this->totalUnits)
            ->sortBy('capacity_units')
            ->first();
    }

    #[Computed]
    public function itemsTotalPerBox(): float
    {
        if (empty($this->selectedItems)) {
            return 0.0;
        }

        $products = $this->products->keyBy('id');
        $total = 0.0;

        foreach ($this->selectedItems as $productId => $qty) {
            $product = $products->get((int) $productId);
            if ($product) {
                $unitPrice = (float) $product->getPriceForUser(Auth::user());
                $total += $unitPrice * (int) $qty;
            }
        }

        return $total;
    }

    #[Computed]
    public function boxPricePerBox(): float
    {
        if (! $this->recommendedBox) {
            return 0.0;
        }

        return $this->recommendedBox->getPriceForQuantity($this->totalBoxes);
    }

    #[Computed]
    public function grandTotal(): float
    {
        return ($this->itemsTotalPerBox + $this->boxPricePerBox) * $this->totalBoxes;
    }

    #[Computed]
    public function canSubmit(): bool
    {
        return ! empty($this->selectedItems)
            && $this->recommendedBox !== null
            && $this->totalBoxes >= 50;
    }

    // -------------------------------------------------------------------
    // Actions
    // -------------------------------------------------------------------

    public function toggleProduct(int $productId): void
    {
        if (isset($this->selectedItems[$productId])) {
            unset($this->selectedItems[$productId]);
        } else {
            $this->selectedItems[$productId] = 1;
        }

        $this->unsetComputedProperties();
    }

    public function requestQuote(): void
    {
        if (! $this->canSubmit) {
            return;
        }

        $products = $this->products->keyBy('id');
        $items = [];

        foreach ($this->selectedItems as $productId => $qty) {
            $product = $products->get((int) $productId);
            if (! $product) {
                continue;
            }

            $unitPrice = (float) $product->getPriceForUser(Auth::user());
            $items[] = [
                'product_id'   => $product->id,
                'product_name' => $product->name,
                'qty_per_box'  => (int) $qty,
                'unit_price'   => $unitPrice,
                'line_total'   => $unitPrice * (int) $qty,
            ];
        }

        QuoteRequest::create([
            'user_id'              => Auth::id(),
            'gift_box_id'          => $this->recommendedBox->id,
            'gift_box_name'        => $this->recommendedBox->name,
            'total_boxes'          => $this->totalBoxes,
            'items'                => $items,
            'items_total_per_box'  => $this->itemsTotalPerBox,
            'box_price_per_box'    => $this->boxPricePerBox,
            'grand_total'          => $this->grandTotal,
        ]);

        $this->submitted = true;
        $this->selectedItems = [];
        $this->totalBoxes = 50;
        $this->unsetComputedProperties();
    }

    private function unsetComputedProperties(): void
    {
        unset(
            $this->computedPropertyCache['totalUnits'],
            $this->computedPropertyCache['recommendedBox'],
            $this->computedPropertyCache['itemsTotalPerBox'],
            $this->computedPropertyCache['boxPricePerBox'],
            $this->computedPropertyCache['grandTotal'],
            $this->computedPropertyCache['canSubmit'],
        );
    }

    // -------------------------------------------------------------------
    // Render
    // -------------------------------------------------------------------

    public function render(): View
    {
        return view('livewire.gift-box-builder');
    }
}
