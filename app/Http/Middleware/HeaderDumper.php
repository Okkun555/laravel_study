<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;

class HeaderDumper
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(Request $request, Closure $next)
    {
        // リクエストヘッダのログ出力
        $this->logger->info(
            'request',
            [
                'header' =>　strval($request->headers)
            ]
        );

        // レスポンスヘッダのログ出力
        $response = $next($request);
        $this->logger->info(
            'response',
            [
                'header' => strval($response->headers)
            ]
        );
        return $response;
    }
}
