<?php

namespace App\Http\Controllers\Auth;

use App\Enums\RolesEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Exception;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @throws \Exception
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $data = $this->authService->login($request);
            return response()->json($data);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(),401);
        }
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $this->authService->register($request);
        return response()->json($data);
    }

    public function logout(): JsonResponse
    {
        try {
            $this->authService->logout();
            return response()->json([
                'status' => 'success',
                'message' => 'Logged out successfully.',
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(),401);
        }
    }
}
