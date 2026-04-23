@extends('layouts.storefront')

@php
    \Artesaos\SEOTools\Facades\SEOMeta::setTitle('FAQ');
    \Artesaos\SEOTools\Facades\SEOMeta::setDescription('Answers to common questions about ordering, payment, shipping, returns, and B2B accounts at Shahid Brothers.');
    \Artesaos\SEOTools\Facades\OpenGraph::setTitle('FAQ — Shahid Brothers');
    \Artesaos\SEOTools\Facades\OpenGraph::setUrl(route('faq'));
@endphp

@section('content')

{{-- Page Header --}}
<div class="bg-[#1e3a5f] py-10 text-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <nav class="mb-2 flex items-center gap-x-2 text-sm text-blue-200" aria-label="Breadcrumb">
            <a href="{{ url('/') }}" class="hover:text-white">{{ __('Home') }}</a>
            <svg class="h-4 w-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-white">{{ __('FAQ') }}</span>
        </nav>
        <h1 class="text-3xl font-bold">{{ __('Frequently Asked Questions') }}</h1>
        <p class="mt-1 text-blue-200">{{ __('Find quick answers to common queries') }}</p>
    </div>
</div>

{{-- Content --}}
<section class="py-12" x-data="{ open: null }">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 space-y-10">

        {{-- ============================================================
             CATEGORY: Ordering
        ============================================================ --}}
        <div>
            <h2 class="mb-4 flex items-center gap-x-2 text-lg font-bold text-[#1e3a5f]">
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 text-[#1e3a5f]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </span>
                {{ __('Ordering') }}
            </h2>
            <div class="space-y-3">

                @php
                $orderingFaqs = [
                    ['q' => 'How do I place an order?', 'a' => 'Browse our Shop, add products to your cart, then proceed to checkout. Fill in your shipping details and choose a payment method. You will receive a confirmation on WhatsApp once your order is placed.'],
                    ['q' => 'Can I place an order without creating an account?', 'a' => 'You can browse and add items to your cart as a guest, but you need to create an account to complete checkout. Registration is quick and free.'],
                    ['q' => 'Can I modify or cancel my order after placing it?', 'a' => 'You can request changes within 1 hour of placing your order by contacting us via WhatsApp at 0308-4570786. Once the order is dispatched, it cannot be modified.'],
                    ['q' => 'How will I know my order is confirmed?', 'a' => 'You will see a confirmation page immediately after checkout. We will also send a confirmation message on WhatsApp within a few hours.'],
                ];
                @endphp

                @foreach($orderingFaqs as $index => $faq)
                <div class="rounded-xl border border-gray-200 bg-white overflow-hidden"
                     x-data="{ id: 'ordering-{{ $index }}' }">
                    <button
                        @click="open === id ? open = null : open = id"
                        class="flex w-full items-center justify-between px-6 py-4 text-left text-sm font-medium text-gray-800 hover:bg-gray-50 transition"
                        :aria-expanded="open === id">
                        <span>{{ $faq['q'] }}</span>
                        <svg class="h-5 w-5 shrink-0 text-gray-400 transition-transform duration-200"
                             :class="{ 'rotate-180': open === id }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open === id"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-cloak
                         class="border-t border-gray-100 px-6 py-5 text-sm text-gray-600 leading-relaxed">
                        {{ $faq['a'] }}
                    </div>
                </div>
                @endforeach

            </div>
        </div>

        {{-- ============================================================
             CATEGORY: Payment
        ============================================================ --}}
        <div>
            <h2 class="mb-4 flex items-center gap-x-2 text-lg font-bold text-[#1e3a5f]">
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 text-[#1e3a5f]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </span>
                {{ __('Payment') }}
            </h2>
            <div class="space-y-3">

                @php
                $paymentFaqs = [
                    ['q' => 'What payment methods do you accept?', 'a' => 'We accept Cash on Delivery (COD), JazzCash, and EasyPaisa. All three options are available at checkout.'],
                    ['q' => 'Is COD available everywhere in Pakistan?', 'a' => 'Yes, Cash on Delivery is available across Pakistan. Please have the exact amount ready when the courier arrives.'],
                    ['q' => 'Is online payment safe on your website?', 'a' => 'Yes. JazzCash and EasyPaisa payments are processed through their own secure, encrypted gateways. We do not store your payment credentials.'],
                    ['q' => 'What happens if my online payment fails?', 'a' => 'If your payment fails, your order will not be confirmed. You can try again or choose COD instead. Contact us if the amount was deducted but order was not placed.'],
                    ['q' => 'Are there any extra charges for COD?', 'a' => 'No. There are no additional charges for choosing Cash on Delivery.'],
                ];
                @endphp

                @foreach($paymentFaqs as $index => $faq)
                <div class="rounded-xl border border-gray-200 bg-white overflow-hidden"
                     x-data="{ id: 'payment-{{ $index }}' }">
                    <button
                        @click="open === id ? open = null : open = id"
                        class="flex w-full items-center justify-between px-6 py-4 text-left text-sm font-medium text-gray-800 hover:bg-gray-50 transition"
                        :aria-expanded="open === id">
                        <span>{{ $faq['q'] }}</span>
                        <svg class="h-5 w-5 shrink-0 text-gray-400 transition-transform duration-200"
                             :class="{ 'rotate-180': open === id }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open === id"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-cloak
                         class="border-t border-gray-100 px-6 py-5 text-sm text-gray-600 leading-relaxed">
                        {{ $faq['a'] }}
                    </div>
                </div>
                @endforeach

            </div>
        </div>

        {{-- ============================================================
             CATEGORY: Shipping & Delivery
        ============================================================ --}}
        <div>
            <h2 class="mb-4 flex items-center gap-x-2 text-lg font-bold text-[#1e3a5f]">
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 text-[#1e3a5f]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                </span>
                {{ __('Shipping & Delivery') }}
            </h2>
            <div class="space-y-3">

                @php
                $shippingFaqs = [
                    ['q' => 'How long does delivery take?', 'a' => 'Standard delivery takes 2–5 business days depending on your location. Lahore orders are usually delivered in 1–2 days. See our Shipping Info page for a full breakdown.'],
                    ['q' => 'Do you deliver outside Pakistan?', 'a' => 'Currently we only deliver within Pakistan. International shipping is not available at this time.'],
                    ['q' => 'How can I track my order?', 'a' => 'Once your order is dispatched, you will receive a tracking number via WhatsApp. You can use this to track your parcel on the courier\'s website.'],
                    ['q' => 'Is free shipping available?', 'a' => 'Yes! Orders above Rs. 5,000 qualify for free shipping anywhere in Pakistan.'],
                    ['q' => 'What if my order is delayed?', 'a' => 'Delays can occur during peak seasons or due to courier issues. Contact us via WhatsApp at 0308-4570786 and we will follow up with the courier on your behalf.'],
                ];
                @endphp

                @foreach($shippingFaqs as $index => $faq)
                <div class="rounded-xl border border-gray-200 bg-white overflow-hidden"
                     x-data="{ id: 'shipping-{{ $index }}' }">
                    <button
                        @click="open === id ? open = null : open = id"
                        class="flex w-full items-center justify-between px-6 py-4 text-left text-sm font-medium text-gray-800 hover:bg-gray-50 transition"
                        :aria-expanded="open === id">
                        <span>{{ $faq['q'] }}</span>
                        <svg class="h-5 w-5 shrink-0 text-gray-400 transition-transform duration-200"
                             :class="{ 'rotate-180': open === id }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open === id"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-cloak
                         class="border-t border-gray-100 px-6 py-5 text-sm text-gray-600 leading-relaxed">
                        {{ $faq['a'] }}
                    </div>
                </div>
                @endforeach

            </div>
        </div>

        {{-- ============================================================
             CATEGORY: Returns & Refunds
        ============================================================ --}}
        <div>
            <h2 class="mb-4 flex items-center gap-x-2 text-lg font-bold text-[#1e3a5f]">
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 text-[#1e3a5f]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 10h10a8 8 0 018 8v2M3 10l4-4m-4 4l4 4"/>
                    </svg>
                </span>
                {{ __('Returns & Refunds') }}
            </h2>
            <div class="space-y-3">

                @php
                $returnFaqs = [
                    ['q' => 'What is your return policy?', 'a' => 'We accept returns within 7 days of delivery for defective or incorrect items only. Items must be unused and in original packaging. Custom or branded items are non-returnable unless defective.'],
                    ['q' => 'How do I return a product?', 'a' => 'Contact us via WhatsApp at 0308-4570786 with your order number and photos of the issue. Our team will guide you through the return process.'],
                    ['q' => 'When will I get my refund?', 'a' => 'Once the returned item is received and inspected (3–5 business days), a refund will be processed within 5–7 business days via the original payment method.'],
                    ['q' => 'Can I exchange a product instead of returning it?', 'a' => 'Yes, exchanges are available for defective or incorrect items, subject to stock availability. Contact us to arrange an exchange.'],
                ];
                @endphp

                @foreach($returnFaqs as $index => $faq)
                <div class="rounded-xl border border-gray-200 bg-white overflow-hidden"
                     x-data="{ id: 'returns-{{ $index }}' }">
                    <button
                        @click="open === id ? open = null : open = id"
                        class="flex w-full items-center justify-between px-6 py-4 text-left text-sm font-medium text-gray-800 hover:bg-gray-50 transition"
                        :aria-expanded="open === id">
                        <span>{{ $faq['q'] }}</span>
                        <svg class="h-5 w-5 shrink-0 text-gray-400 transition-transform duration-200"
                             :class="{ 'rotate-180': open === id }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open === id"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-cloak
                         class="border-t border-gray-100 px-6 py-5 text-sm text-gray-600 leading-relaxed">
                        {{ $faq['a'] }}
                    </div>
                </div>
                @endforeach

            </div>
        </div>

        {{-- ============================================================
             CATEGORY: B2B / Bulk Orders
        ============================================================ --}}
        <div>
            <h2 class="mb-4 flex items-center gap-x-2 text-lg font-bold text-[#1e3a5f]">
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 text-[#1e3a5f]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </span>
                {{ __('B2B / Bulk Orders') }}
            </h2>
            <div class="space-y-3">

                @php
                $b2bFaqs = [
                    ['q' => 'How do I register as a B2B customer?', 'a' => 'During registration, select "Business Account" and provide your company name and NTN number. Your account will be reviewed and approved by our team within 24 hours.'],
                    ['q' => 'What are the minimum order quantities for B2B?', 'a' => 'Minimum order quantities vary by product. Each product page shows the minimum B2B quantity. Contact us for custom quotes on large orders.'],
                    ['q' => 'Can I get custom branding on products?', 'a' => 'Yes! We offer logo printing, engraving, and custom packaging on most products. Contact us via WhatsApp or our Contact form for custom branding quotes.'],
                    ['q' => 'Do B2B customers get special pricing?', 'a' => 'Yes. Verified B2B accounts see special bulk pricing on product pages when logged in. Pricing is lower than retail for qualifying order quantities.'],
                    ['q' => 'How long does B2B order delivery take?', 'a' => 'Standard B2B orders take 3–7 business days. Custom/branded orders may take 7–14 business days depending on the complexity and quantity.'],
                ];
                @endphp

                @foreach($b2bFaqs as $index => $faq)
                <div class="rounded-xl border border-gray-200 bg-white overflow-hidden"
                     x-data="{ id: 'b2b-{{ $index }}' }">
                    <button
                        @click="open === id ? open = null : open = id"
                        class="flex w-full items-center justify-between px-6 py-4 text-left text-sm font-medium text-gray-800 hover:bg-gray-50 transition"
                        :aria-expanded="open === id">
                        <span>{{ $faq['q'] }}</span>
                        <svg class="h-5 w-5 shrink-0 text-gray-400 transition-transform duration-200"
                             :class="{ 'rotate-180': open === id }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open === id"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-cloak
                         class="border-t border-gray-100 px-6 py-5 text-sm text-gray-600 leading-relaxed">
                        {{ $faq['a'] }}
                    </div>
                </div>
                @endforeach

            </div>
        </div>

        {{-- Still have questions CTA --}}
        <div class="rounded-2xl bg-[#1e3a5f] p-8 text-center text-white">
            <h2 class="text-xl font-bold">{{ __("Still have questions?") }}</h2>
            <p class="mt-2 text-blue-200 text-sm">
                {{ __("Our team is available Mon–Sat, 9 AM to 7 PM.") }}
            </p>
            <div class="mt-5 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center gap-x-2 rounded-lg bg-white px-6 py-3 text-sm font-semibold text-[#1e3a5f] hover:bg-blue-50 transition whitespace-nowrap">
                    {{-- Mail icon --}}
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <rect x="2" y="4" width="20" height="16" rx="2"/>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                    </svg>
                    {{ __('Send Us a Message') }}
                </a>
                <a href="https://wa.me/923084570786" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-x-2 rounded-lg bg-green-500 px-6 py-3 text-sm font-semibold text-white hover:bg-green-600 transition whitespace-nowrap">
                    {{-- Full WhatsApp icon --}}
                    <svg class="h-4 w-4 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/>
                    </svg>
                    {{ __('Chat on WhatsApp') }}
                </a>
            </div>
        </div>

    </div>
</section>

@endsection
