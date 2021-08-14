<?php

namespace App\Listeners;

use App\Events\PublishProcessor;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class MessageQueueSubscriber implements shouldQueue
{
    use InteractsWithQueue;

    // 非同期イベント
    public function handle(PublishProcessor $event)
    {
        Log::info($event->getInt());
    }
}
