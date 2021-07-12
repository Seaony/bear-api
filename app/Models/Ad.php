<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Ad extends Model
{
    use SoftDeletes;

    public const STATUS_ONLINE = 1; //状态：上线
    public const STATUS_OFFLINE = 2; //状态：下线

    /**
     * 图片转完整地址
     * @param $value
     * @return mixed
     */
    public function getImageAttribute($value)
    {
        if (preg_match('/^https?:\/\//', $value)) {
            return $value;
        }
        return Storage::disk('osbridge')->url($value);
    }
}
