@extends('layouts.storefront')

@php
    \Artesaos\SEOTools\Facades\SEOMeta::setTitle('Privacy Policy');
    \Artesaos\SEOTools\Facades\SEOMeta::setDescription('Read the Privacy Policy for Shahid Brothers. Learn how we collect, use, and protect your personal information.');
    \Artesaos\SEOTools\Facades\OpenGraph::setTitle('Privacy Policy — Shahid Brothers');
    \Artesaos\SEOTools\Facades\OpenGraph::setUrl(route('privacy'));
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
            <span class="text-white">{{ __('Privacy Policy') }}</span>
        </nav>
        <h1 class="text-3xl font-bold">{{ __('Privacy Policy') }}</h1>
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
                At <strong>Shahid Brothers</strong>, your privacy is important to us. This Privacy Policy explains
                what information we collect, how we use it, and your rights regarding that information.
            </p>

            {{-- 1. Information We Collect --}}
            <h2>1. Information We Collect</h2>
            <p>We collect the following types of information when you use our website:</p>
            <ul>
                <li><strong>Personal Information:</strong> Name, email address, phone number, and shipping address — provided when you register, place an order, or contact us.</li>
                <li><strong>B2B Information:</strong> Company name and NTN number — provided during B2B registration.</li>
                <li><strong>Order Information:</strong> Products purchased, order amounts, payment method, and delivery details.</li>
                <li><strong>Technical Data:</strong> IP address, browser type, device type, and pages visited — collected automatically via server logs.</li>
                <li><strong>Cookies:</strong> Session cookies for cart functionality and authentication. We do not use tracking cookies without consent.</li>
            </ul>

            {{-- 2. How We Use Your Information --}}
            <h2>2. How We Use Your Information</h2>
            <ul>
                <li>To process and fulfill your orders.</li>
                <li>To communicate order status, shipping updates, and confirmations.</li>
                <li>To respond to your inquiries and support requests.</li>
                <li>To verify B2B accounts and manage business relationships.</li>
                <li>To improve our website and product offerings based on usage patterns.</li>
                <li>To comply with legal obligations.</li>
            </ul>
            <p>We do <strong>not</strong> sell, rent, or trade your personal information to third parties for marketing purposes.</p>

            {{-- 3. Payment Data --}}
            <h2>3. Payment Data</h2>
            <p>
                Shahid Brothers does not store your payment card details. Payments via JazzCash and EasyPaisa
                are processed through their respective secure gateways. Please review their privacy policies for details:
            </p>
            <ul>
                <li>JazzCash: jazz.com.pk</li>
                <li>EasyPaisa: easypaisa.com.pk</li>
            </ul>
            <p>COD orders require no payment data at the time of ordering.</p>

            {{-- 4. Data Sharing --}}
            <h2>4. Data Sharing</h2>
            <p>We share your information only in these limited circumstances:</p>
            <ul>
                <li><strong>Courier/Logistics Partners:</strong> Your name, phone number, and delivery address are shared with our delivery partners to fulfill your order.</li>
                <li><strong>Payment Gateways:</strong> Order amount and reference data is shared with JazzCash / EasyPaisa for transaction processing.</li>
                <li><strong>Legal Requirements:</strong> We may disclose information if required by law or government authority.</li>
            </ul>

            {{-- 5. Data Security --}}
            <h2>5. Data Security</h2>
            <ul>
                <li>All data is transmitted over HTTPS (SSL encrypted).</li>
                <li>Passwords are hashed using bcrypt — never stored in plain text.</li>
                <li>Access to customer data is restricted to authorized staff only.</li>
                <li>We take reasonable precautions, but no internet transmission is 100% secure.</li>
            </ul>

            {{-- 6. Cookies --}}
            <h2>6. Cookies</h2>
            <p>
                We use essential session cookies to maintain your login state and shopping cart.
                These cookies are deleted when you close your browser or log out.
                We do not use advertising or cross-site tracking cookies.
            </p>

            {{-- 7. Your Rights --}}
            <h2>7. Your Rights</h2>
            <p>You have the right to:</p>
            <ul>
                <li>Access the personal data we hold about you.</li>
                <li>Request correction of inaccurate data.</li>
                <li>Request deletion of your account and associated data.</li>
                <li>Opt out of marketing communications (if any).</li>
            </ul>
            <p>
                To exercise these rights, contact us via the details below.
                We will respond within 14 business days.
            </p>

            {{-- 8. Data Retention --}}
            <h2>8. Data Retention</h2>
            <p>
                We retain order and account data for up to <strong>5 years</strong> for accounting and legal compliance purposes.
                Inactive accounts may be deleted after 2 years of inactivity upon request.
            </p>

            {{-- 9. Children's Privacy --}}
            <h2>9. Children's Privacy</h2>
            <p>
                Our website is not directed at children under the age of 13.
                We do not knowingly collect personal information from minors.
            </p>

            {{-- 10. Changes --}}
            <h2>10. Changes to This Policy</h2>
            <p>
                We may update this Privacy Policy from time to time. Changes will be posted on this page
                with an updated date. Continued use of the website after changes constitutes acceptance.
            </p>

            {{-- Contact --}}
            <h2>11. Contact Us</h2>
            <p>For privacy-related queries, please contact:</p>
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
