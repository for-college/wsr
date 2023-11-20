<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class UserController extends Controller
{
  /** Метод авторизации пользователя **/
  public function login(LoginRequest $request)
  {
    $user = User::where($request->all())->first();

    if (!$user) {
      throw new ApiException(401, 'User not found');
    }

    return [
      'data' => [
        'user_token' => $user->generateToken()
      ]
    ];
  }
}
