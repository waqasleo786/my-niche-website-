@extends('layouts.storefront')

@section('title', __('Terms & Conditions'))
@section('description', 'Read the Terms & Conditions for Shahid Brothers. Understand our order, payment, return, and B2B policies.')

@section('content')

{{-- Page Header --}}
<div class="bg-[#1e3a5f] py-10 text-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <nav class="mb-2 flex items-center gap-x-2 text-sm text-blue-200" aria-label="Breadcrumb">
            <a href="{{ url('/') }}" class="hover:text-white">{{ __('Home') }}</a>
            <svg class="h-4 w-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-white">{{ __('Terms & Conditions') }}</span>
        </nav>
        <h1 class="text-3xl font-bold">{{ __('Terms & Conditions') }}</h1>
        <p class="mt-1 text-blue-200">{{ __('Last updated: April 2026') }}</p>
    </div>
</div>

{{-- Content --}}
<section class="py-12">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <div class="rounded-2xl bg-white p-8 shadow-sm ring-1 ring-gray-100 prose prose-gray max-w-none
                    prose-headings:text-[#1e3a5f] prose-headings:font-bold
                    prose-h2:text-xl prose-h2:mt-8 prose-h2:mb-3
                    prose-p:text-gray-600 prose-p:leading-relaxed
                    prose-li:text-gray-600 prose-a:text-[#1e3a5f]">

            <p class="text-gray-500 text-sm">
                By placing an order on <strong>shahidbrothers.pk</strong>, you agree to the following terms and conditions.
                Please read them carefully before making a purchase.
            </p>

            {{-- 1. General --}}
            <h2>1. General</h2>
            <p>
                These Terms & Conditions govern your use of the Shahid Brothers website and the purchase of products from us.
                Shahid Brothers reserves the right to update these terms at any time. Continued use of the website
                after changes constitutes acceptance of the revised terms.
            </p>

            {{-- 2. Orders --}}
            <h2>2. Orders & Order Confirmation</h2>
            <ul>
                <li>All orders are subject to product availability and stock confirmation.</li>
                <li>You will receive an order confirmation via WhatsApp or email after placing your order.</li>
                <li>Shahid Brothers reserves the right to cancel or refuse any order at its sole discretion
                    (e.g., pricing errors, fraud suspicion, or unavailable stock).</li>
                <li>Order numbers are unique identifiers — please quote them in all communications.</li>
            </ul>

            {{-- 3. Pricing --}}
            <h2>3. Pricing & Currency</h2>
            <ul>
                <li>All prices are listed in <strong>Pakistani Rupees (PKR)</strong> and include applicable taxes.</li>
                <li>Prices are subject to change without notice. The price at the time of order confirmation is final.</li>
                <li>B2B (bulk) pricing is available for verified business accounts. Minimum order quantities apply.</li>
            </ul>

            {{-- 4. Payment --}}
            <h2>4. Payment Methods</h2>
            <ul>
                <li><strong>Cash on Delivery (COD):</strong> Payment is collected by the courier at the time of delivery.</li>
                <li><strong>JazzCash:</strong> Payments are processed via the JazzCash secure gateway.</li>
                <li><strong>EasyPaisa:</strong> Payments are processed via the EasyPaisa secure gateway.</li>
            </ul>
            <p>
                For COD orders, please ensure the exact amount is available at the time of delivery.
                Shahid Brothers is not responsible for failed digital payments due to network issues on third-party gateways.
            </p>

            {{-- 5. Shipping --}}
            <h2>5. Shipping & Delivery</h2>
            <ul>
                <li>We deliver across Pakistan. Delivery times and charges are detailed on our
                    <a href="{{ route('shipping') }}">Shipping Info</a> page.</li>
                <li>Delivery times are estimates and may vary due to courier delays or public holidays.</li>
                <li>Risk of loss transfers to you upon delivery to the shipping address provided.</li>
            </ul>

            {{-- 6. Returns --}}
            <h2>6. Returns & Exchanges</h2>
            <ul>
                <li>Returns are accepted within <strong>7 days</strong> of delivery for defective or incorrect items only.</li>
                <li>Items must be unused, in original packaging, with all accessories intact.</li>
                <li>Custom-printed or personalized items are <strong>non-returnable</strong> unless defective.</li>
                <li>To initiate a return, contact us via WhatsApp at
                    <a href="https://wa.me/923084570786" target="_blank" rel="noopener noreferrer">0308-4570786</a>
                    with your order number and photos of the issue.</li>
            </ul>

            {{-- 7. B2B --}}
            <h2>7. B2B / Bulk Orders</h2>
            <ul>
                <li>B2B accounts require admin verification before B2B pricing is activated.</li>
                <li>Minimum order quantities (MOQ) must be met for B2B pricing to apply.</li>
                <li>B2B orders may require advance payment or a deposit for custom/branded items.</li>
                <li>Bulk order lead times may be longer — confirm delivery timelines at the time of order.</li>
            </ul>

            {{-- 8. Intellectual Property --}}
            <h2>8. Intellectual Property</h2>
            <p>
                All content on this website — including images, text, logos, and product descriptions — is the
                property of Shahid Brothers. Reproduction or commercial use without written permission is prohibited.
            </p>

            {{-- 9. Limitation of Liability --}}
            <h2>9. Limitation of Liability</h2>
            <p>
                Shahid Brothers shall not be liable for any indirect, incidental, or consequential damages
                arising from the use of our products or services. Our maximum liability is limited to the
                order value of the product in question.
            </p>

            {{-- 10. Governing Law --}}
            <h2>10. Governing Law</h2>
            <p>
                These terms are governed by the laws of the Islamic Republic of Pakistan.
                Any disputes shall be resolved in the courts of Lahore, Punjab.
            </p>

            {{-- Contact --}}
            <h2>11. Contact Us</h2>
            <p>
                For questions about these terms, contact us at:
            </p>
            <ul>
                <li>Address: Masha Allah Plaza, 33 Nisbat Road, Anarkali Bazar, Lahore</li>
                <li>Phone / WhatsApp: <a href="tel:+923084570786">0308-4570786</a></li>
                <li>Email: <a href="mailto:info@shahidbrothers.pk">info@shahidbrothers.pk</a></li>
                <li>Or use our <a href="{{ route('contact') }}">Contact Form</a></li>
            </ul>

        </div>
    </div>
</section>

@endsection
