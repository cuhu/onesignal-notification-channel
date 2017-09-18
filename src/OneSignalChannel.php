<?php

namespace Dreamr\OneSignalChannel;

use Illuminate\Notifications\Notification;
use OneSignal\OneSignal;

class OneSignalChannel
{
    private $client;

    public function __construct(OneSignal $client)
    {
        $this->client = $client;
    }

    public function send($notifiable, Notification $notification)
    {
        $userId = $notifiable->routeNotificationFor('OneSignal');

        if (!$userId) {
            return;
        }

        $message = $notification->toOneSignal($notifiable);

        $this->client->notifications->add([
            'contents' => [
                'en' => $message->getBody(),
            ],
            'data' => $message->getData(),
            'filters' => [
                [
                    'field' => 'tag',
                    'key' => 'user_id',
                    'relation' => '=',
                    'value' => $userId,
                ]
            ],
        ]);
    }
}
