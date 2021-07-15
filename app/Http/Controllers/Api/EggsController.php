<?php

namespace App\Http\Controllers\Api;

use App\Events\EggCracked;
use App\Models\Egg;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Transformers\UnionTransformer;
use App\Http\Requests\Api\Eggs\StoreRequest;
use App\Http\Requests\Api\Eggs\CrackedRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
            'male_avatar',
            'female_avatar',
            'male_avatar',
        ]);

        $data['pregnancy'] = $request->get('pregnancy', 64);

        $data['user_id'] = Auth::id();
        $data['female_avatar'] = $request->get('female_avatar', url(Arr::random($this->avatars)));
        $data['male_avatar'] = $request->get('male_avatar', url(Arr::random($this->avatars)));
        $data['cracked_at'] = Carbon::parse($data['breeding_at'])->addDay($data['pregnancy'] + 1)->toDateString();

        Egg::create($data);

        return $this->response->noContent();
    }

    /**
     * 兼容原有 API
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Egg $egg
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
            'is_break' => true,
            'cracked_at' => Carbon::now()->toDateString(),
        ]);

        return $this->response->noContent();
    }

    /**
     * @param \App\Http\Requests\Api\Eggs\CrackedRequest $request
     * @param \App\Models\Egg $egg
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

        $catNumber = $request->get('cat_number');
        if (empty($catNumber)) {
            $catNumber = null;
        }

        $egg->update([
            'is_break' => true,
            'cracked_at' => $request->get('cracked_at'),
            'cat_number' => $catNumber,
        ]);
        event(new EggCracked($egg));
        return $this->response->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Egg $egg
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

    /**
     * 上传猫咪头像
     * @param Request $request
     * @return \Dingo\Api\Http\Response|void
     */
    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        $avatar = $request->file('image');

        // 记录用户上传图片，由于数据分析
        $avatar->store('avatar');

        $client = new Client();
        try {
            $response = $client->post(env('IDENTIFY_API', 'http://127.0.0.1:8080/identify'), [
                'multipart' => [
                    [
                        'name' => 'image',
                        'contents' => fopen($avatar->getRealPath(), 'r')
                    ],
                ]
            ])->getBody()->getContents();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->response->errorInternal('图片服务异常，请稍后再试');
        }
        $data = json_decode($response, true);

        //必须是猫图片，且置信度在30%以上（laybel能区分为cat基本可视为识别到猫咪，否则会归属到其他种类。增加score限制为了舍弃全标签整体很低，被迫归属为猫咪的极端情况）
        if ($data['laybel'] == 'cat' && $data['score'] >= 0.3) { // TODO 增加模型准确度
            $url = $avatar->store('images', 'osbridge');
            return $this->response->array(['url' => Storage::disk('osbridge')->url($url)]);
        }
        return $this->response->errorBadRequest('未识别到猫咪，请上传有效图片');
    }

    /**
     * @param Request $request
     * @param \App\Models\Egg $egg
     *
     * @return \Dingo\Api\Http\Response|void
     */
    public function update(Request $request, Egg $egg)
    {
        $request->validate([
            'cat_number' => 'numeric|min:1|max:100'
        ]);

        if ($egg->user_id != Auth::id()) {
            return $this->response->errorBadRequest('无权操作');
        }

        $egg->update([
            'cat_number' => $request->get('cat_number'),
        ]);

        return $this->response->noContent();
    }
}
