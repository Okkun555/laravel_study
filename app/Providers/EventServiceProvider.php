<?php

namespace App\Providers;

use App\Events\PublishProcessor;
use App\Listeners\MessageQueueSubscriber;
use App\Listeners\MessageSubscriber;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            'App\Listeners\RegisterListener',
        ],
        // イベントクラスとリスナークラスを登録 NOTE:一つのイベントに対して複数のリスナーを紐づける事が可能
        PublishProcessor::class => [
            MessageSubscriber::class,
            MessageQueueSubscriber::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
