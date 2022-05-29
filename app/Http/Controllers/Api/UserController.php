<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function getUserInfo(Request $request)
    {
        $user = $request->user();
        return $this->response->array($this->userInfoFormat($user));
    }

    public function updateUserInfo(Request $request)
    {
        $request->validate([
            'nickname' => 'required|string|max:20',
            'avatar' => 'required',
            'sex' => 'required|int|in:'.User::SEX_MAN.','.User::SEX_WOMAN,
            'province' => 'string',
            'city' => 'string',
            'county' => 'string',
        ]);
        $user = $request->user();
        $user->nickname = $request->post('nickname');
        $user->avatar = $request->post('avatar');
        $user->sex = $request->post('sex');
        $user->province = $request->post('province');
        $user->city = $request->post('city');
        $user->county = $request->post('county');
        $user->save();
        return $this->response->array($this->userInfoFormat($user));
    }

    private function userInfoFormat(User $user)
    {
        $eggs = $user->eggs;
        return [
            'id' => $user->id,
            'has_use_days' => (int)Carbon::now()->diffInDays($user->created_at),
            'nickname' => $user->nickname,
            'sex' => $user->sex,
            'avatar' => $user->avatar,
            'cat_avatars' => $eggs ? $eggs->pluck('female_avatar')->unique()->values() : [],
            'orders_num' => $eggs ? $eggs->count() : 0,
        ];
    }
}
