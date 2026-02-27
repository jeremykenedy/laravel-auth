<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

/**
 * Form Request for user registration.
 *
 * Enforces strong password policy, unique email/username,
 * RFC-compliant email validation, and input sanitisation.
 */
class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Guest access is enforced by the guest middleware on the route.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name'                  => ['required', 'string', 'max:255', 'unique:users', 'alpha_dash'],
            'first_name'            => ['nullable', 'string', 'max:255', 'alpha_dash'],
            'last_name'             => ['nullable', 'string', 'max:255', 'alpha_dash'],
            'email'                 => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
            'password'              => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
            'password_confirmation' => ['required', 'same:password'],
        ];
    }

    /**
     * Custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required'      => __('A username is required.'),
            'name.unique'        => __('This username is already taken. Please choose another.'),
            'name.alpha_dash'    => __('Username may only contain letters, numbers, dashes, and underscores.'),
            'email.required'     => __('An email address is required.'),
            'email.email'        => __('Please enter a valid email address.'),
            'email.unique'       => __('This email address is already registered. Please login or use a different email.'),
            'password.required'  => __('A password is required.'),
            'password.confirmed' => __('The password confirmation does not match.'),
        ];
    }

    /**
     * Prepare the data for validation — trim and normalise inputs.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name'       => trim($this->name ?? ''),
            'first_name' => trim($this->first_name ?? ''),
            'last_name'  => trim($this->last_name ?? ''),
            'email'      => strtolower(trim($this->email ?? '')),
        ]);
    }
}
