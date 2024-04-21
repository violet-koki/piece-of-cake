<?php

namespace App\Services\User;

use Illuminate\Support\Facades\Auth;


class UserService
{
    /**
     * ログイン処理、アクセストークンを生成して保存する
     *
     * @param string $mail
     * @param string $password
     * @return string|null
     */
    public function login(string $mail, string $password): string|null
    {
        $credentials = [
            'mail' => $mail,
            'password' => $password,
            'registration_flag' => true,
            'deleted_at' => null
        ];
        if (!Auth::attempt($credentials)) {
            return null;
        }
        $token = Auth::user()->createToken('AccessToken');

        return $token->plainTextToken;
    }

    /**
     * ログアウト処理
     *
     * @return bool|null
     */
    public function logout(): ?bool
    {
        return Auth::user()->currentAccessToken()->delete();
    }
}