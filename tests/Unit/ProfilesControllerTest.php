<?php

namespace Tests\Unit;

use App\Http\Controllers\ProfilesController;
use Tests\TestCase;

class ProfilesControllerTest extends TestCase
{
    /**
     * Restoring a deleted account must not silently fall back to a shared key.
     *
     * @return void
     */
    public function testGetRestoreKeyThrowsWhenNotConfigured()
    {
        config(['settings.restoreKey' => null]);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('USER_RESTORE_ENCRYPTION_KEY is not set.');

        (new ProfilesController())->getRestoreKey();
    }

    /**
     * @return void
     */
    public function testGetRestoreKeyReturnsConfiguredValue()
    {
        config(['settings.restoreKey' => 'a-real-secret-key']);

        $this->assertSame('a-real-secret-key', (new ProfilesController())->getRestoreKey());
    }
}
