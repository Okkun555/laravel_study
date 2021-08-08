<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StreamAction extends Controller
{
    public function __invoke(): StreamedResponse
    {
        /**
         * SSE(Server Sent Events)はサーバー側からのプッシュ型データ通信を利用する方法
         * HTTPプロトコルを利用している
         */
        return response()->stream(
            function () {
                while (true) {
                    echo 'data: ' . rand(1, 100) . "\n\n";
                    ob_flush();
                    flush();
                    usleep(20000);
                }
            },
            Response::HTTP_OK,
            [
                'content-type' => 'text/event-stream',
                'X-Accel-Buffering' => 'no',
                'Cache-Control' => 'no-cache',
            ],
        );
    }
}
