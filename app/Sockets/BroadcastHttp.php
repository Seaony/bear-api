<?php

namespace App\Sockets;
use Hhxsv5\LaravelS\Swoole\Socket\Http;
use Swoole\Http\Request;
use Swoole\Http\Response;
class BroadcastHttp extends Http
{
    public function onRequest(Request $request, Response $response)
    {
        $params = $request->post;
        $data = [
            'notice_message' => $params['message']
        ];
        $swoole = app('swoole');
        // 会阻塞。前期数量不多，问题不大。等有了redis可以换成redis发布订阅+process结构
        foreach ($swoole->connections as $fd) {
            if ($swoole->isEstablished($fd)) {
                $swoole->push($fd, json_encode($data, JSON_UNESCAPED_UNICODE));
            }
        }
        $response->end('success');
        return $response;
    }
}
