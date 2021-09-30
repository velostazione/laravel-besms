<?php

return [
    'username' => env('BESMS_USERNAME'),
    'password' => env('BESMS_PASSWORD'),
    'id_api' => env('BESMS_API_ID'),
    'report_type' => env('BESMS_REPORT_TYPE', 'C'),
    'sender' => env('BESMS_SENDER')
];
