<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Telegram\TelegramMessage;
use App\Notifications\SendNotification;

class SendNotificationTelegram extends Notification
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
        return ['telegram'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
        ->to('-828164687')
        // ->content('test Your invoice has been *PAID*');
        ->content('Telah terjadi transaksi baru dengan nominal transaksi sebanyak *Rp. ' . $notifiable . '* Pada ' . date('Y-m-d H:i:s') );
    }

    // return (new MailMessage)                    
    //         ->name($this->offerData['name'])
    //         ->line($this->offerData['body'])
    //         ->action($this->offerData['offerText'], $this->offerData['offerUrl'])
    //         ->line($this->offerData['thanks']);

    // public function toTelegram($notifiable)
    // {
    //     $url = url('/invoice/' . $this->invoice->id);

    //     return TelegramMessage::create()
    //         // Optional recipient user id.
    //         ->to($notifiable->telegram_user_id)
    //         // Markdown supported.
    //         ->content("Hello there!")
    //         ->line("Your invoice has been *PAID*")
    //         ->line("Thank you!")

    //         // (Optional) Blade template for the content.
    //         // ->view('notification', ['url' => $url])

    //         // (Optional) Inline Buttons
    //         ->button('View Invoice', $url)
    //         ->button('Download Invoice', $url)
    //         // (Optional) Inline Button with callback. You can handle callback in your bot instance
    //         ->buttonWithCallback('Confirm', 'confirm_invoice ' . $this->invoice->id);
    // }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        // return [
            
        // ];
    }
}
