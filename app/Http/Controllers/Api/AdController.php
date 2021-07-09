<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function ad()
    {
        $ad = Ad::where('status', Ad::STATUS_ONLINE)->orderBy('created_at', 'desc')->first();
        return $this->response->array($ad);
    }
}
