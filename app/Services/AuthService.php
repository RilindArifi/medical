<?php

namespace App\Services;

use App\Enums\RolesEnum;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class AuthService
{
    /**
     * Handle user login
     *
     * @param LoginRequest $request
     * @return array
     * @throws Exception
     */
    public function login(LoginRequest $request): array
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->input('remember');

        if (! Auth::attempt($credentials)) {
            throw new Exception('Incorrect username or password.');
        }

        $ttl = $remember ? config('jwt.ttl') : 1440;

        $token = Auth::setTTL($ttl)->attempt($credentials);

        return [
            'user' => UserResource::make(Auth::user()),
            'token' => $token,
            'remember' => $remember
        ];
    }

    /**
     * Handle user registration
     *
     * @param RegisterRequest $request
     * @return array
     */
    public function register(RegisterRequest $request): array
    {
        $user = User::create($request->validated())->assignRole(RolesEnum::PATIENT->value);
        $token = Auth::login($user);

        return [
            'user' => UserResource::make($user),
            'token' => $token,
        ];
    }

    /**
     * Handle user logout
     *
     * @throws Exception
     */
    public function logout(): void
    {
        if (!auth()->check()) {
            throw new Exception('User is not authenticated.');
        }

        auth()->logout();
    }
}
