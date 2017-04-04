<?php

return [

    /*
     * Is email activation required
     */
    'activation' => env('ACTIVATION', false),

   /*
     * Is email activation required
     */
    'timePeriod' => env('ACTIVATION_LIMIT_TIME_PERIOD', 24),

   /*
     * Is email activation required
     */
    'maxAttempts' => env('ACTIVATION_LIMIT_MAX_ATTEMPTS', 3),

   /*
     * NULL Ip to enter to match database schema
     */
    'nullIpAddess' => env('NULL_IP_ADDRESS', '0.0.0.0'),

];