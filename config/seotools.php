<?php

return [
    'inertia' => env('SEO_TOOLS_INERTIA', false),
    'meta' => [
        'defaults' => [
            'title'       => 'Shahid Brothers',
            'titleBefore' => false,
            'description' => 'Buy premium promotional and corporate gift items in Pakistan. Keychains, pens, power banks, USBs, bottles, tumblers, clocks. Bulk B2B orders welcome.',
            'separator'   => ' | ',
            'keywords'    => ['promotional items pakistan', 'corporate gifts pakistan', 'bulk gift items', 'customized gifts', 'shahid brothers'],
            'canonical'   => 'full',
            'robots'      => 'all',
        ],
        'webmaster_tags' => [
            'google'    => env('GOOGLE_SITE_VERIFICATION', null),
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],
        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        'defaults' => [
            'title'       => 'Shahid Brothers — Promotional & Corporate Gift Items',
            'description' => 'Premium promotional and corporate gift items in Pakistan. Keychains, pens, power banks, USBs, bottles, tumblers, clocks. Bulk orders welcome.',
            'url'         => null,
            'type'        => 'website',
            'site_name'   => 'Shahid Brothers',
            'images'      => [],
        ],
    ],
    'twitter' => [
        'defaults' => [
            // 'card' => 'summary_large_image',
            // 'site' => '@shahidbrothers',
        ],
    ],
    'json-ld' => [
        'defaults' => [
            'title'       => 'Shahid Brothers',
            'description' => 'Premium promotional and corporate gift items in Pakistan. Keychains, pens, power banks, USBs, bottles, tumblers, clocks. Bulk orders welcome.',
            'url'         => null,
            'type'        => 'WebPage',
            'images'      => [],
        ],
    ],
];
