<?php

namespace App\Notifications;

use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EmailVerfyNotify extends Notification
{
    use Queueable;
    public $message;
    public $subject;
    public $fromemail;
    public $mailler;
    private $otp;
    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->message="use the below code for verfication process";
        $this->subject="verfication needed";
        $this->fromemail="zoroloffy95@gmail.com";
        $this->mailler='smtp';
        $this->otp=new Otp;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $otp=$this->otp->generate($notifiable->email,6,60);
        return (new MailMessage)
        ->mailer('smtp')
        ->subject($this->subject)
        ->greeting('welcome',$notifiable->first_name)
        ->line($this->message)
        ->line('code : '.$otp->token)
        ;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
