<?php

namespace App\Notifications;

use App\Channels\Msg91Sms;
use App\Services\SmsService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendTenderOpeningOtp extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(private $otpNumber, private $tenderNumber)
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
        return SmsService::make('63749128ed5e82760666890a')
            ->addVariables([
                'number' => $this->otpNumber,
                'tendernumber' => $this->tenderNumber
            ]);
    }

}
