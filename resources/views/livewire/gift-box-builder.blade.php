<div>
    {{-- ================================================================
         SUBMITTED CONFIRMATION
    ================================================================ --}}
    @if($submitted)
        <div class="text-center py-16 px-4">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-6">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ __('Quote Request Submitted!') }}</h2>
            <p class="text-gray-600 mb-8 max-w-md mx-auto">
                {{ __('We\'ve received your gift box configuration. Our team will review it and get back to you shortly.') }}
            </p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="https://wa.me/923001234567"
                   target="_blank"
                   class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-3 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    {{ __('Follow up on WhatsApp') }}
                </a>
                <button wire:click="$set('submitted', false)"
                        class="inline-flex items-center gap-2 border border-gray-300 text-gray-700 font-semibold px-6 py-3 rounded-lg hover:bg-gray-50 transition-colors">
                    {{ __('Configure Another Box') }}
                </button>
            </div>
        </div>

    {{-- ================================================================
         BUILDER UI
    ================================================================ --}}
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ============================================================
                 LEFT PANEL — Product Selection
            ============================================================ --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Quantity Input --}}
                <div class="bg-white rounded-xl border border-gray-200 p-5">
                    <h3 class="font-semibold text-gray-800 mb-3">
                        {{ __('How many gift boxes do you need?') }}
                        <span class="text-sm font-normal text-gray-500 ml-1">({{ __('minimum 50') }})</span>
                    </h3>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                            <button wire:click="$set('totalBoxes', {{ max(50, $totalBoxes - 50) }})"
                                    class="px-4 py-2 bg-gray-50 hover:bg-gray-100 text-gray-600 font-bold text-lg transition-colors"
                                    @if($totalBoxes <= 50) disabled @endif>
                                −
                            </button>
                            <input type="number"
                                   wire:model.live.debounce.500ms="totalBoxes"
                                   min="50"
                                   step="50"
                                   class="w-24 text-center border-0 focus:ring-0 font-semibold text-lg py-2">
                            <button wire:click="$set('totalBoxes', {{ $totalBoxes + 50 }})"
                                    class="px-4 py-2 bg-gray-50 hover:bg-gray-100 text-gray-600 font-bold text-lg transition-colors">
                                +
                            </button>
                        </div>
                        <span class="text-gray-500 text-sm">{{ __('pcs') }}</span>

                        {{-- MOQ tier badge --}}
                        @if($totalBoxes >= 500)
                            <span class="ml-auto text-xs font-semibold bg-purple-100 text-purple-700 px-3 py-1 rounded-full">500+ pcs tier</span>
                        @elseif($totalBoxes >= 200)
                            <span class="ml-auto text-xs font-semibold bg-blue-100 text-blue-700 px-3 py-1 rounded-full">200-499 pcs tier</span>
                        @elseif($totalBoxes >= 100)
                            <span class="ml-auto text-xs font-semibold bg-green-100 text-green-700 px-3 py-1 rounded-full">100-199 pcs tier</span>
                        @else
                            <span class="ml-auto text-xs font-semibold bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">50-99 pcs tier</span>
                        @endif
                    </div>
                </div>

                {{-- Product Grid --}}
                <div class="bg-white rounded-xl border border-gray-200 p-5">
                    <h3 class="font-semibold text-gray-800 mb-4">{{ __('Select Products for Each Box') }}</h3>

                    @if($this->products->isEmpty())
                        <p class="text-gray-500 text-center py-8">{{ __('No products available.') }}</p>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($this->products as $product)
                                @php
                                    $isSelected = isset($selectedItems[$product->id]);
                                    $qty = $selectedItems[$product->id] ?? 0;
                                @endphp

                                <div class="relative border-2 rounded-xl p-4 cursor-pointer transition-all
                                    {{ $isSelected
                                        ? 'border-[#1e3a5f] bg-blue-50'
                                        : 'border-gray-200 hover:border-gray-300 bg-white' }}"
                                     wire:click="toggleProduct({{ $product->id }})">

                                    {{-- Selected checkmark --}}
                                    @if($isSelected)
                                        <div class="absolute top-3 right-3 w-5 h-5 bg-[#1e3a5f] rounded-full flex items-center justify-center">
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </div>
                                    @endif

                                    <div class="flex items-center gap-3">
                                        {{-- Product image / icon --}}
                                        <div class="w-12 h-12 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                            @if($product->hasMedia('images'))
                                                <img src="{{ $product->getFirstMediaUrl('images', 'thumb') }}"
                                                     alt="{{ $product->name }}"
                                                     class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="flex-1 min-w-0">
                                            <p class="font-medium text-gray-900 text-sm truncate">{{ $product->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $product->getFormattedPrice() }} / pc</p>
                                            <p class="text-xs text-gray-400">{{ $product->size_units }} size unit(s)</p>
                                        </div>
                                    </div>

                                    {{-- Qty per box (only shown when selected) --}}
                                    @if($isSelected)
                                        <div class="mt-3 flex items-center gap-2" wire:click.stop>
                                            <span class="text-xs text-gray-600">Qty per box:</span>
                                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                                <button wire:click="$set('selectedItems.{{ $product->id }}', {{ max(1, $qty - 1) }})"
                                                        class="px-2 py-1 bg-gray-50 hover:bg-gray-100 text-sm font-bold">−</button>
                                                <input type="number"
                                                       wire:model.live="selectedItems.{{ $product->id }}"
                                                       min="1"
                                                       class="w-12 text-center border-0 focus:ring-0 text-sm py-1"
                                                       wire:click.stop>
                                                <button wire:click="$set('selectedItems.{{ $product->id }}', {{ $qty + 1 }})"
                                                        class="px-2 py-1 bg-gray-50 hover:bg-gray-100 text-sm font-bold">+</button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- ============================================================
                 RIGHT PANEL — Summary
            ============================================================ --}}
            <div class="lg:col-span-1">
                <div class="sticky top-6 space-y-4">

                    {{-- Box Preview --}}
                    <div class="bg-white rounded-xl border border-gray-200 p-5 text-center">
                        @if($this->recommendedBox)
                            <div class="mb-3">
                                @if($this->recommendedBox->hasMedia('box_images'))
                                    <img src="{{ $this->recommendedBox->getFirstMediaUrl('box_images', 'preview') }}"
                                         alt="{{ $this->recommendedBox->name }}"
                                         class="w-36 h-36 object-contain mx-auto rounded-lg">
                                @else
                                    <div class="w-36 h-36 mx-auto bg-gray-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <h4 class="font-bold text-gray-900">{{ $this->recommendedBox->name }}</h4>
                            <p class="text-xs text-gray-500 mt-1">{{ __('Recommended for your selection') }}</p>
                            <p class="text-xs text-gray-400 mt-1">
                                {{ __('Capacity:') }} {{ $this->recommendedBox->capacity_units }} {{ __('units') }}
                                · {{ __('Used:') }} {{ number_format($this->totalUnits, 1) }}
                            </p>
                        @elseif(!empty($selectedItems))
                            <div class="py-4 text-center">
                                <svg class="w-12 h-12 text-red-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                <p class="text-sm text-red-500 font-medium">{{ __('No suitable box available') }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ __('Total size units:') }} {{ number_format($this->totalUnits, 1) }}</p>
                            </div>
                        @else
                            <div class="py-6 text-center">
                                <svg class="w-16 h-16 text-gray-200 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                                <p class="text-sm text-gray-400">{{ __('Select products to see your box') }}</p>
                            </div>
                        @endif
                    </div>

                    {{-- Price Breakdown --}}
                    @if(!empty($selectedItems))
                        <div class="bg-white rounded-xl border border-gray-200 p-5">
                            <h4 class="font-semibold text-gray-800 mb-3">{{ __('Price Breakdown') }}</h4>

                            {{-- Selected items --}}
                            <div class="space-y-2 mb-3">
                                @foreach($selectedItems as $productId => $qty)
                                    @php $product = $this->products->firstWhere('id', (int)$productId); @endphp
                                    @if($product)
                                        <div class="flex justify-between text-sm text-gray-600">
                                            <span class="truncate pr-2">{{ $product->name }} ×{{ $qty }}</span>
                                            <span class="flex-shrink-0">Rs. {{ number_format((float)$product->getPriceForUser(auth()->user()) * (int)$qty, 2) }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="border-t border-gray-100 pt-3 space-y-2">
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>{{ __('Items / box') }}</span>
                                    <span>Rs. {{ number_format($this->itemsTotalPerBox, 2) }}</span>
                                </div>

                                @if($this->recommendedBox)
                                    <div class="flex justify-between text-sm text-gray-600">
                                        <span>{{ __('Box / box') }}
                                            <span class="text-xs text-gray-400">({{ $this->recommendedBox->getTierLabel($totalBoxes) }})</span>
                                        </span>
                                        <span>Rs. {{ number_format($this->boxPricePerBox, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm font-medium text-gray-700 border-t border-gray-100 pt-2">
                                        <span>{{ __('Cost / box') }}</span>
                                        <span>Rs. {{ number_format($this->itemsTotalPerBox + $this->boxPricePerBox, 2) }}</span>
                                    </div>
                                @endif
                            </div>

                            <div class="border-t-2 border-gray-900 mt-3 pt-3">
                                <div class="flex justify-between font-bold text-gray-900">
                                    <span>{{ __('Grand Total') }}
                                        <span class="font-normal text-xs text-gray-500 ml-1">({{ $totalBoxes }} pcs)</span>
                                    </span>
                                    <span>Rs. {{ number_format($this->grandTotal, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Submit Button --}}
                    <button wire:click="requestQuote"
                            wire:loading.attr="disabled"
                            @if(!$this->canSubmit) disabled @endif
                            class="w-full py-3 px-6 rounded-xl font-semibold text-base transition-all
                                {{ $this->canSubmit
                                    ? 'bg-[#1e3a5f] hover:bg-[#162d4a] text-white shadow-md hover:shadow-lg'
                                    : 'bg-gray-200 text-gray-400 cursor-not-allowed' }}">
                        <span wire:loading.remove wire:target="requestQuote">
                            {{ __('Request Quote') }}
                        </span>
                        <span wire:loading wire:target="requestQuote" class="inline-flex items-center gap-2">
                            <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                            </svg>
                            {{ __('Submitting...') }}
                        </span>
                    </button>

                    @if(!$this->canSubmit && !empty($selectedItems) && !$this->recommendedBox)
                        <p class="text-xs text-red-500 text-center">{{ __('No box available for this combination. Please reduce items.') }}</p>
                    @elseif(empty($selectedItems))
                        <p class="text-xs text-gray-400 text-center">{{ __('Select at least one product to continue.') }}</p>
                    @endif

                </div>
            </div>

        </div>
    @endif

</div>
