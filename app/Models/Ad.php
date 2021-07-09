<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ad extends Model
{
    use SoftDeletes;

    public const STATUS_ONLINE = 1; //状态：上线
    public const STATUS_OFFLINE = 2; //状态：下线

}
