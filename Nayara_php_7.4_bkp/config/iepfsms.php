<?php

return [

    'api_url' => env('IEPF_SMS_API_URL'),

    'credentials' => [
        'user_id' => env('IEPF_SMS_USER_ID'),

        'password' => env('IEPF_SMS_PASSWORD'),

        'gsm_id' => env('IEPF_SMS_GSMID_ID'),

        'pe_id' => env('IEPF_SMS_PEID_ID'),
    ],

    'otp_sms_dlt_temp_id' => env('IEPF_SMS_DLT_TEMP_ID'),
    'otp_sms_template' => "Thank You for visiting the Nayara Website.Here's your OTP {#OTP#} for authentication. Nayara Energy",
    
];
