<?php

return [

    'api_url' => env('ENQUIRY_SMS_API_URL'),

    'credentials' => [
        'user_id' => env('ENQUIRY_SMS_USER_ID'),

        'password' => env('ENQUIRY_SMS_PASSWORD'),

        'gsm_id' => env('ENQUIRY_SMS_GSMID_ID'),

        'pe_id' => env('ENQUIRY_SMS_PEID_ID'),
    ],

    'enquiry_sms_dlt_temp_id' => env('ENQUIRY_SMS_DLT_TEMP_ID'),
    'enquiry_sms_template' => 'Dear Customer,Thank you for registering on Nayara Energy Ltd Website! One of our Retail Customer Care executive will get back to you within 4 working days.Nayara Energy',
];
