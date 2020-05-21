<?php

namespace App\Transformers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use League\Fractal\TransformerAbstract;

class UnionTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'week',
        'other',
        'history',
    ];

    protected $defaultIncludes = [
        'week',
        'other',
        'history',
    ];

    /**
     * @param \App\Models\BetterTagInSkinAlgorithm $algorithm
     *
     * @return array
     */
    public function transform()
    {
        return [
            'portals' => true
        ];
    }

    /**
     * @return \League\Fractal\Resource\Collection
     */
    public function includeWeek()
    {
        $eggs = Auth::user()
            ->eggs()
            ->where('is_break', false)
            ->where('cracked_at', '<=', Carbon::now()->addDay(7)->toDateString())
            ->orderBy('cracked_at')
            ->get();

        return $this->collection($eggs, new EggTransformer());
    }

    /**
     * @return \League\Fractal\Resource\Collection
     */
    public function includeOther()
    {
        $eggs = Auth::user()
            ->eggs()
            ->where('is_break', false)
            ->where('cracked_at', '>=', Carbon::now()->addDay(8)->toDateString())
            ->orderBy('cracked_at')
            ->get();

        return $this->collection($eggs, new EggTransformer());
    }

    /**
     * @return \League\Fractal\Resource\Collection
     */
    public function includeHistory()
    {
        $eggs = Auth::user()
            ->eggs()
            ->where('is_break', true)
            ->orderByDesc('cracked_at')
            ->get();

        return $this->collection($eggs, new EggTransformer());
    }
}
