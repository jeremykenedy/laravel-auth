<?php

use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Facades\Notification;

it('renders the forgot password page', function () {
    $this->get('/forgot-password')
        ->assertOk();
});

it('can request a password reset link', function () {
    Notification::fake();

    $user = User::factory()->create();

    $this->post('/forgot-password', [
        'email' => $user->email,
    ])->assertRedirect();

    Notification::assertSentTo($user, ResetPasswordNotification::class);
});

it('renders the reset password page with valid token', function () {
    Notification::fake();

    $user = User::factory()->create();

    $this->post('/forgot-password', [
        'email' => $user->email,
    ]);

    Notification::assertSentTo($user, ResetPasswordNotification::class, function ($notification) {
        $this->get('/reset-password/'.$notification->token)
            ->assertOk();

        return true;
    });
});

it('can reset password with valid token', function () {
    Notification::fake();

    $user = User::factory()->create();

    $this->post('/forgot-password', [
        'email' => $user->email,
    ]);

    Notification::assertSentTo($user, ResetPasswordNotification::class, function ($notification) use ($user) {
        $this->post('/reset-password', [
            'token' => $notification->token,
            'email' => $user->email,
            'password' => 'NewPassword123',
            'password_confirmation' => 'NewPassword123',
        ])->assertRedirect('/login');

        return true;
    });
});
