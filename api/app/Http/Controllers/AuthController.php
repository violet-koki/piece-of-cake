<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as IlluminateResponse;


class AuthController extends Controller
{
    private UserService $userService;
    /**
     * コンストラクタ
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * メールアドレスとパスワードでログインする
     *
     * @param  LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $token = $this->userService->login($request->mail, $request->password);
        if ($token) {
            return Response::json(['token' => $token], 200);
        }

        return response()->json([
            'message' => ['error' => ['認証に失敗しました。']]
        ], 400);

    }
    /**
     * ログアウトする
     *
     * @param Request $request
     * @return IlluminateResponse
     */
    public function logout(Request $request): IlluminateResponse
    {
        if ($this->userService->logout()) {
            return response('', 204);
        }
        return response('', 500);
    }
}
