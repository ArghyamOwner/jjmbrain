<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;

class Msg91Sms
{
    public function send($notifiable, Notification $notification)
    {
        if (! $to = $notifiable->routeNotificationFor('sms', $notification)) {
            return;
        }

        $message = $notification->toMsg91Sms($notifiable);
        $message->to($to);

        return $message->send();
    }
}