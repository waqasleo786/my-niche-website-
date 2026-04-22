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
        $validProvinces = array_keys(config('locations', []));

        return [
            'shipping_name'     => ['required', 'string', 'max:100'],
            'shipping_phone'    => ['required', 'string', 'regex:/^03[0-9]{9}$/'],
            'shipping_province' => ['required', 'string', Rule::in($validProvinces)],
            'shipping_city'     => ['required', 'string', 'max:100'],
            'shipping_area'     => ['required', 'string', 'max:150'],
            'shipping_address'  => ['required', 'string', 'max:255'],
            'payment_method'    => ['required', Rule::in([PaymentMethod::COD->value])],
            'notes'             => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'shipping_phone.regex' => __('Phone must be in Pakistani format: 03XXXXXXXXX (11 digits).'),
        ];
    }
}
