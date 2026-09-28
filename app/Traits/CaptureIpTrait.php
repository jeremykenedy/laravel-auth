<?php

namespace App\Traits;

class CaptureIpTrait
{
    private $ipAddress = null;

    /**
     * Get the Ip Address of the user.
     *
     * @return string
     */
    public function getClientIp()
    {
        $envKeys = [
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR',
        ];

        foreach ($envKeys as $envKey) {
            $ipAddress = getenv($envKey);

            if ($ipAddress) {
                return $ipAddress;
            }
        }

        return config('settings.nullIpAddress');
    }
}
