<?php

namespace App\Transformers;

use App\Models\Egg;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class EggTransformer extends TransformerAbstract
{
    protected $availableIncludes = [];

    protected $defaultIncludes = [];

    /**
     * @param \App\Models\BetterTagInSkinAlgorithm $algorithm
     *
     * @return array
     */
    public function transform(Egg $egg)
    {
        $countdown = (int) Carbon::now()->diffInDays($egg->cracked_at, false);
        $passday = (int)Carbon::now()->diffInDays($egg->cracked_at);

        return [
            'id'            => (int) $egg->id,
            'male_name'     => (string) $egg->male_name,
            'female_name'   => (string) $egg->female_name,
            'female_avatar' => (string) $egg->female_avatar,
            'male_avatar'   => (string) $egg->male_avatar ?? '',
            'is_break'      => (boolean) $egg->is_break,
            'during'        => (int) Carbon::parse($egg->breeding_at)->diffInDays($egg->cracked_at),
            'countdown'     => $countdown,
            'passday'       => $passday,
            'cracked_at'    => (string) Carbon::parse($egg->cracked_at)->format('m月d日'),
            'breeding_at'   => (string) Carbon::parse($egg->breeding_at)->format('m月d日'),
            'tips'          => $this->getTips($countdown, $egg->is_break),
            'user_id'       => (int) $egg->user_id,
            'created_at'    => (string) $egg->created_at,
            'cat_number'    => (int) $egg->cat_number ?? 0
        ];
    }

    public function getTips($countdown, $is_break = false)
    {
        if ($is_break) {
            return '小猫出生后请注意保暖，刚出生的新生小猫是通过哺乳来获取营养的，所以请保证母猫有获得足够的营养与食物。';
        }

        if ($countdown >= 50) {
            return '怀孕成功后2-3周后乳头会有明显的肿胀和变粉。此阶段不要过度补充营养，预防营养过剩和胎儿发育过大。';
        }

        if ($countdown >= 22) {
            return '胚胎免疫系统正在发育，别让母猫乱跳乱跑流产，补充维生素 A，帮助母猫孕育生出大眼，不容易有眼疾。';
        }

        if ($countdown >= 7) {
            return '胚胎基本发育完整，母猫和胎儿需要大量的营养，要补充钙质和蛋白含量较高的食物，有宠物专用的钙片或钙粉之类。';
        }

        return '待产阶段请提前给猫咪准备好产房，最好陪伴在它们身边，一来可以舒缓它们紧张的情绪，二来在特殊情况发生时可以及时帮助';
    }
}
