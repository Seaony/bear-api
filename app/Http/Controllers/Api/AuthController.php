<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $parsed = mina()->auth->session($request->get('code'));

        $open_id = Arr::get($parsed, 'openid');

        $user = User::firstOrCreate(['open_id' => $open_id]);

        return $this->response->array([
            'token'      => 'Bearer ' . Auth::fromUser($user),
            'expires_in' => Auth::factory()->getTTL(),
        ]);
    }
}
