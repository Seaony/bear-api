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

        return [
            'id'            => (int) $egg->id,
            'male_name'     => (string) $egg->male_name,
            'female_name'   => (string) $egg->female_name,
            'female_avatar' => (string) $egg->female_avatar,
            'is_break'      => (boolean) $egg->is_break,
            'during'        => (int) Carbon::parse($egg->breeding_at)->diffInDays($egg->cracked_at),
            'countdown'     => $countdown,
            'cracked_at'    => (string) Carbon::parse($egg->cracked_at)->format('m月d日'),
            'breeding_at'   => (string) Carbon::parse($egg->breeding_at)->format('m月d日'),
            'tips'          => $this->getTips($countdown),
            'user_id'       => (int) $egg->user_id,
            'created_at'    => (string) $egg->created_at,
        ];
    }

    public function getTips($countdown)
    {
        return '胚胎免疫系统正在发育，别让母猫乱跳乱跑流产，补充维生素 A，帮助母猫孕育生出大眼，不容易有眼疾。';
    }
}
