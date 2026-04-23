<?php

declare(strict_types=1);

return [

    'jazzcash' => [
        'account_name'   => env('JAZZCASH_ACCOUNT_NAME', 'Shahid Brothers'),
        'account_number' => env('JAZZCASH_ACCOUNT_NUMBER', '03XX-XXXXXXX'),
    ],

    'easypaisa' => [
        'account_name'   => env('EASYPAISA_ACCOUNT_NAME', 'Shahid Brothers'),
        'account_number' => env('EASYPAISA_ACCOUNT_NUMBER', '03XX-XXXXXXX'),
    ],

    'bank' => [
        'bank_name'      => env('BANK_NAME', 'MCB Bank'),
        'account_name'   => env('BANK_ACCOUNT_NAME', 'Shahid Brothers'),
        'account_number' => env('BANK_ACCOUNT_NUMBER', 'XXXX-XXXX-XXXX-XXXX'),
        'iban'           => env('BANK_IBAN', 'PK00MCB0000000000000000'),
        'branch_code'    => env('BANK_BRANCH_CODE', '0000'),
    ],

    'admin_email'            => env('PAYMENT_ADMIN_EMAIL', 'waqasleo@gmail.com'),
    'payment_deadline_hours' => (int) env('PAYMENT_DEADLINE_HOURS', 24),

];
