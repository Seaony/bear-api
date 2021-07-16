<?php
namespace App\Services;
use App\Models\Egg;
use Hhxsv5\LaravelS\Swoole\WebSocketHandlerInterface;
use Illuminate\Support\Facades\Log;
use Swoole\Http\Request;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;
/**
 * @see https://www.swoole.co.uk/docs/modules/swoole-websocket-server
 */
class WebSocketService implements WebSocketHandlerInterface
{
    // Declare constructor without parameters
    public function __construct()
    {
        Log::channel('websocket')->info('websocket server start');
    }
    // public function onHandShake(Request $request, Response $response)
    // {
    // Custom handshake: https://www.swoole.co.uk/docs/modules/swoole-websocket-server-on-handshake
    // The onOpen event will be triggered automatically after a successful handshake
    // }
    public function onOpen(Server $server, Request $request)
    {
        // Before the onOpen event is triggered, the HTTP request to establish the WebSocket has passed the Laravel route,
        // so Laravel's Request, Auth information are readable, Session is readable and writable, but only in the onOpen event.
        // \Log::info('New WebSocket connection', [$request->fd, request()->all(), session()->getId(), session('xxx'), session(['yyy' => time()])]);
        // The exceptions thrown here will be caught by the upper layer and recorded in the Swoole log. Developers need to try/catch manually.
        Log::debug('open');
    }

    public function onMessage(Server $server, Frame $frame)
    {
        Log::channel('websocket')->info('Received message', [$frame->fd, $frame->data, $frame->opcode, $frame->finish]);
        $data = json_decode($frame->data, true);
        // Todo: 工厂模式
        switch ($data['event']) {
            case 'heartBeat':
                break;
            case 'getNoticeList':
                $noticeMessagesList = [];
                // Todo: 热数据，Cache
                $eggCreckedList = Egg::where('is_break', true)->orderBy('cracked_at')->limit(10)->get();
                foreach ($eggCreckedList as $egg) {
                    $num = $egg->cat_number ? $egg->cat_number.'只' : '新的';
                    $message = "恭喜喵妈「{$egg->female_name}」&喵爸「{$egg->male_name}」诞生了{$num}宝贝";
                    $noticeMessagesList[] = $message;
                }
                $data = array(
                    'notice_messages_list' => $noticeMessagesList
                );
                $server->push($frame->fd, json_encode($data, JSON_UNESCAPED_UNICODE));
                break;
            default:
                $server->push($frame->fd, date('Y-m-d H:i:s') . '|' . $frame->data);
        }
    }

    public function onClose(Server $server, $fd, $reactorId)
    {
        // The exceptions thrown here will be caught by the upper layer and recorded in the Swoole log. Developers need to try/catch manually.
    }
}
