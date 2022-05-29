<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Egg extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 获取图片集合.
     *
     * @param  string  $value
     * @return string
     */
    public function getImagesAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true);
        }
        return $value;
    }

    /**
     * 设置图片集合.
     *
     * @param  string  $value
     * @return void
     */
    public function setImagesAttribute($value)
    {
        $this->attributes['images'] = is_array($value) ? json_encode($value) : null;
    }

    /**
     * 设置小猫数量.
     *
     * @param  string  $value
     * @return void
     */
    public function setCatNumberAttribute($value)
    {
        // 空字符串、0都按null存储
        $this->attributes['cat_number'] = empty($value) ? null : $value;
    }
}
