<?php

namespace Tests\Unit;

use App\Traits\CaptureIpTrait;
use Tests\TestCase;

class CaptureIpTraitTest extends TestCase
{
    private $envKeys = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'REMOTE_ADDR',
    ];

    protected function tearDown(): void
    {
        foreach ($this->envKeys as $envKey) {
            putenv($envKey);
        }

        parent::tearDown();
    }

    /**
     * @return void
     */
    public function test_falls_back_to_configured_null_ip_when_no_env_vars_are_set()
    {
        config(['settings.nullIpAddress' => '0.0.0.0']);

        $this->assertSame('0.0.0.0', (new CaptureIpTrait)->getClientIp());
    }

    /**
     * @return void
     */
    public function test_http_client_ip_takes_priority_over_remote_addr()
    {
        putenv('HTTP_CLIENT_IP=203.0.113.1');
        putenv('REMOTE_ADDR=198.51.100.1');

        $this->assertSame('203.0.113.1', (new CaptureIpTrait)->getClientIp());
    }

    /**
     * @return void
     */
    public function test_falls_back_to_remote_addr_when_nothing_else_is_set()
    {
        putenv('REMOTE_ADDR=198.51.100.1');

        $this->assertSame('198.51.100.1', (new CaptureIpTrait)->getClientIp());
    }
}
