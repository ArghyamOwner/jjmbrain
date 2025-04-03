<?php

namespace App\Notifications;

use App\Channels\Msg91Sms;
use App\Services\SmsService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Notifications\Messages\MailMessage;

class CompanySuccessfullRegistration extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // return (new MailMessage)
        //             ->line('The introduction to the notification.')
        //             ->action('Notification Action', url('/'))
        //             ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function toMsg91Sms($notifiable)
    {
        return SmsService::make('63748cc2b12a50210d58f752');
    }
}
