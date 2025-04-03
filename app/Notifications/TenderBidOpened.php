<?php

namespace App\Notifications;

use App\Channels\Msg91Sms;
use App\Services\SmsService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TenderBidOpened extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(private string $tenderNumber, private string $date)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [Msg91Sms::class];
    }

    public function toMsg91Sms($notifiable)
    {
        return SmsService::make('63748eada4b9c65f0f3d0324')
            ->addVariables([
                'tendernumber' => $this->tenderNumber,
                'date' => $this->date
            ]);
    }
}
