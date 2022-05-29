<?php

namespace App\Listeners;

use App\Events\EggCracked;
use App\Models\Egg;
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
        $message = self::generateMessage($event->egg);
        Log::info('broadcastCracked|message:'.$message);
        $client = new Client();
        try {
            $client->post(env('SOCKET_HTTP_BROADCAST', 'http://127.0.0.1:5293'), [
                'form_params' => [
                    'message' => $message
                ]
            ])->getBody()->getContents();
        }catch (\Exception $e) {
            Log::error('BroadcastCracked err:'.$e->getMessage());
        }
    }


    public static function generateMessage(Egg $egg)
    {
        $num = $egg->cat_number ? $egg->cat_number.'只' : '新的';
        $femaleName = htmlspecialchars($egg->female_name);
        $maleName = htmlspecialchars($egg->male_name);
        $message = "<p>恭喜喵妈<span style='color:#0880D5'>{$femaleName}</span>&喵爸<span style='color:#0880D5'>{$maleName}</span>诞生了{$num}宝贝</p>";
        return $message;
    }
}
