<?php

namespace Dreamr\OneSignalChannel;

use GuzzleHttp\Client;
use Http\Client\Common\HttpMethodsClient;
use Http\Message\MessageFactory\GuzzleMessageFactory;
use Illuminate\Support\ServiceProvider;
use OneSignal\Config;
use OneSignal\OneSignal;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

class OneSignalChannelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app
            ->when(OneSignalChannel::class)
            ->needs(OneSignal::class)
            ->give(function () {
                $credentials = config('services.onesignal');

                if (!isset($credentials['app_id'], $credentials['app_key'])) {
                    throw new Exception('Missing OneSignal app ID or key.');
                }

                $config = new Config();
                $config->setApplicationId($credentials['app_id']);
                $config->setApplicationAuthKey($credentials['app_key']);

                $guzzle = new Client();
                $client = new HttpMethodsClient(new GuzzleAdapter($guzzle), new GuzzleMessageFactory());

                return new OneSignal($config, $client);
            });
    }
}
