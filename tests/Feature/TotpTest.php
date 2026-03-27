<?php

use App\Models\User;
use jeremykenedy\laravel2step\App\Services\TotpService;

it('can generate a TOTP secret', function () {
    $service = new TotpService;
    $secret = $service->generateSecret();

    expect($secret)->toHaveLength(32);
    expect(preg_match('/^[A-Z2-7]+$/', $secret))->toBe(1);
});

it('can generate a QR code URI', function () {
    $service = new TotpService;
    $secret = $service->generateSecret();
    $uri = $service->generateQrCodeUri($secret, 'test@example.com', 'TestApp');

    expect($uri)->toStartWith('otpauth://totp/');
    expect($uri)->toContain('secret='.$secret);
    expect($uri)->toContain('issuer=TestApp');
});

it('can verify a valid TOTP code', function () {
    $service = new TotpService;
    $secret = $service->generateSecret();

    // Generate the current code using the same algorithm
    $reflection = new ReflectionMethod($service, 'generateCode');
    $timeSlice = floor(time() / 30);
    $code = $reflection->invoke($service, $secret, $timeSlice);

    expect($service->verify($secret, $code))->toBeTrue();
});

it('rejects an invalid TOTP code', function () {
    $service = new TotpService;
    $secret = $service->generateSecret();

    expect($service->verify($secret, '000000'))->toBeFalse();
});

it('can generate recovery codes', function () {
    $service = new TotpService;
    $codes = $service->generateRecoveryCodes(8);

    expect($codes)->toHaveCount(8);
    expect($codes[0])->toMatch('/^[a-zA-Z0-9]{5}-[a-zA-Z0-9]{5}$/');
});

it('renders the TOTP setup page for authenticated users', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/two-factor/setup')
        ->assertOk()
        ->assertSee('Two-Factor Authentication');
});

it('denies TOTP setup for guests', function () {
    $this->get('/two-factor/setup')
        ->assertRedirect('/login');
});

it('can enable TOTP with valid code', function () {
    $user = User::factory()->create();
    $service = new TotpService;
    $secret = $service->generateSecret();

    $reflection = new ReflectionMethod($service, 'generateCode');
    $code = $reflection->invoke($service, $secret, floor(time() / 30));

    $this->actingAs($user)
        ->withSession(['totp_setup_secret' => $secret])
        ->post('/two-factor/enable', ['code' => $code])
        ->assertRedirect();

    expect($user->fresh()->two_factor_secret)->not->toBeNull();
    expect($user->fresh()->two_factor_recovery_codes)->not->toBeNull();
});

it('rejects enable with invalid code', function () {
    $user = User::factory()->create();
    $service = new TotpService;
    $secret = $service->generateSecret();

    $this->actingAs($user)
        ->withSession(['totp_setup_secret' => $secret])
        ->post('/two-factor/enable', ['code' => '000000'])
        ->assertRedirect()
        ->assertSessionHasErrors('code');
});

it('can disable TOTP with correct password', function () {
    $user = User::factory()->create();
    $user->forceFill([
        'two_factor_secret' => encrypt('TESTSECRET'),
        'two_factor_recovery_codes' => encrypt(json_encode(['code1', 'code2'])),
    ])->save();

    $this->actingAs($user)
        ->post('/two-factor/disable', ['password' => 'password'])
        ->assertRedirect();

    expect($user->fresh()->two_factor_secret)->toBeNull();
});

it('renders challenge page for users with TOTP', function () {
    $user = User::factory()->create();
    $user->forceFill(['two_factor_secret' => encrypt('TESTSECRET')])->save();

    $this->actingAs($user)
        ->get('/two-factor/challenge')
        ->assertOk()
        ->assertSee('Authentication Code');
});
