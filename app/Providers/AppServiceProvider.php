<?php

namespace App\Providers;

use App\BlowfishEncrypter;
use Illuminate\Encryption\MissingAppKeyException;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Knp\Snappy\Pdf;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            'encrypter',
            function ($app) {
                $config = $app->make('config')->get('app');

                return new BlowfishEncrypter($this->parseKey($config));
            }
        );

        $this->app->bind(
            \App\DataProvider\PublisherRepositoryInterface::class,
            \App\Domain\Repository\PublisherRepository::class,
        );

        $this->app->bind(Pdf::class, function () {
            return new Pdf('/usr/bin/wkhtmltopdf');
        });
    }

    protected function parseKey(array $config)
    {
        if (Str::startsWith($key = $this->key($config), $prefix = 'base64:')) {
            $key = base64_decode(Str::after($key, $prefix));
        }
    }

    protected function key(array $config)
    {
        return tap(
            $config['key'],
            function ($key) {
                if (empty($key)) {
                    throw new MissingAppKeyException();
                }
            }
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
