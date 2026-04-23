<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;

class ContactController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        SEOMeta::setTitle('Contact Us');
        SEOMeta::setDescription('Get in touch with Shahid Brothers. Order promotional and corporate gift items in bulk. WhatsApp, phone, or email — we respond fast.');

        OpenGraph::setTitle('Contact Us — Shahid Brothers');
        OpenGraph::setDescription('Get in touch with Shahid Brothers for bulk promotional gift orders in Pakistan.');
        OpenGraph::setUrl(route('contact'));

        return view('pages.contact');
    }
}
