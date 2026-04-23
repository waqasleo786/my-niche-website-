<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\PaymentMethod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $validProvinces  = array_keys(config('locations', []));
        $requiresSlip    = $this->input('payment_method') !== PaymentMethod::COD->value;

        return [
            'shipping_name'     => ['required', 'string', 'max:100'],
            'shipping_phone'    => ['required', 'string', 'regex:/^03[0-9]{9}$/'],
            'shipping_province' => ['required', 'string', Rule::in($validProvinces)],
            'shipping_city'     => ['required', 'string', 'max:100'],
            'shipping_area'     => ['required', 'string', 'max:150'],
            'shipping_address'  => ['required', 'string', 'max:255'],
            'payment_method'    => ['required', Rule::in(PaymentMethod::values())],
            'notes'             => ['nullable', 'string', 'max:500'],
            'payment_slip'      => [
                $requiresSlip ? 'required' : 'nullable',
                'file',
                'mimes:jpg,jpeg,png,webp,pdf',
                'max:5120',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'shipping_phone.regex' => __('Phone must be in Pakistani format: 03XXXXXXXXX (11 digits).'),
            'payment_slip.required' => __('Please attach your payment receipt / slip.'),
            'payment_slip.mimes'    => __('Slip must be an image (JPG, PNG, WebP) or PDF.'),
            'payment_slip.max'      => __('Slip file size must not exceed 5MB.'),
        ];
    }
}
