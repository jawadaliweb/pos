<?php

namespace App\Http\Requests\Auth;
use App\Models\User;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        // Ensure the user is not rate-limited
        $this->ensureIsNotRateLimited();

        // Find the user by email, name, or phone
        $user = User::where('email', $this->login)
            ->orWhere('name', $this->login)
            ->orWhere('phone', $this->login)
            ->first();

        // Check if the user doesn't exist or the password is incorrect
        if (!$user || !Hash::check($this->password, $user->password)) {
            // Increment the rate limiter and display an error message
            RateLimiter::hit($this->throttleKey());

            toastr()->error('Email or password is wrong');

            // Throw a validation exception with a failed login message
            throw ValidationException::withMessages([
                'login' => trans('auth.failed'),
            ]);
        }

        // If the user exists and the password is correct, log in the user
        toastr()->success('Login Successful');
        Auth::login($user, $this->boolean('remember'));

        // Clear the rate limiter for successful login
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
    }
}
