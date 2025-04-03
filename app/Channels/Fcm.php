<?php

namespace App\Channels;

use Exception;
use Illuminate\Notifications\Notification;

class Fcm
{
    public function send($notifiable, Notification $notification)
    {
        if (! $to = $notifiable->routeNotificationFor('fcm', $notification)) {
            return;
        }

        try {
            $message = $notification->toFcm($notifiable);
            $message->to($to);
    
            // $message->to($notification->name);
            return $message->send();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}