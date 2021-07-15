<?php

namespace App\Listeners;

use App\Events\EggCracked;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

/*
 * TODO 有了redis资源就可以直接换广播系统了
 */
class BroadcastCracked
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EggCracked  $event
     * @return void
     */
    public function handle(EggCracked $event)
    {
        $num = $event->egg->cat_number ? $event->egg->cat_number.'只' : '新的';
        $message = "恭喜喵妈{$event->egg->female_name}&喵爸{$event->egg->male_name}诞生了{$num}宝贝";
        Log::info('broadcastCracked|message:'.$message);
        $client = new Client();
        $client->post(env('SOCKET_HTTP_BROADCAST', 'http://127.0.0.1:5293'), [
            'form_params' => [
                'message' => $message
            ]
        ])->getBody()->getContents();
    }
}
