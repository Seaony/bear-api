<?php

namespace App\Http\Controllers\Api;

use App\Models\Egg;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Transformers\UnionTransformer;
use App\Http\Requests\Api\Eggs\StoreRequest;
use App\Http\Requests\Api\Eggs\CrackedRequest;

class EggsController extends Controller
{
    /**
     * @var array
     */
    protected $avatars = [
        'avatars/1.png',
        'avatars/2.png',
        'avatars/3.png',
        'avatars/4.png',
        'avatars/5.svg',
        'avatars/6.svg',
        'avatars/7.svg',
        'avatars/8.svg',
        'avatars/9.svg',
    ];

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Dingo\Api\Http\Response
     */
    public function index(Request $request)
    {
        return $this->response->item(new \stdClass(), new UnionTransformer());
    }

    /**
     * @param \App\Http\Requests\Api\Eggs\StoreRequest $request
     *
     * @return \Dingo\Api\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->only([
            'male_name',
            'female_name',
            'breeding_at',
        ]);

        $data['pregnancy'] = $request->get('pregnancy', 64);

        $data['user_id'] = Auth::id();
        $data['female_avatar'] = url(Arr::random($this->avatars));
        $data['cracked_at'] = Carbon::parse($data['breeding_at'])->addDay($data['pregnancy']+1)->toDateString();

        Egg::create($data);

        return $this->response->noContent();
    }

    /**
     * 兼容原有 API
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Egg          $egg
     *
     * @return \Dingo\Api\Http\Response|void
     */
    public function done(Request $request, Egg $egg)
    {
        if ($egg->user_id != Auth::id()) {
            return $this->response->errorBadRequest('无权操作');
        }

        if ($egg->is_break) {
            return $this->response->noContent();
        }

        $egg->update([
            'is_break'   => true,
            'cracked_at' => Carbon::now()->toDateString(),
        ]);

        return $this->response->noContent();
    }

    /**
     * @param \App\Http\Requests\Api\Eggs\CrackedRequest $request
     * @param \App\Models\Egg                            $egg
     *
     * @return \Dingo\Api\Http\Response|void
     */
    public function cracked(CrackedRequest $request, Egg $egg)
    {
        if ($egg->user_id != Auth::id()) {
            return $this->response->errorBadRequest('无权操作');
        }

        if ($egg->is_break) {
            return $this->response->noContent();
        }

        $egg->update([
            'is_break'   => true,
            'cracked_at' => $request->get('cracked_at'),
            'cat_number' => $request->get('cat_number'),
        ]);

        return $this->response->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Egg          $egg
     *
     * @return \Dingo\Api\Http\Response|void
     * @throws \Exception
     */
    public function destroy(Request $request, Egg $egg)
    {
        if ($egg->user_id != Auth::id()) {
            return $this->response->errorBadRequest('无权操作');
        }

        $egg->delete();

        return $this->response->noContent();
    }
}
