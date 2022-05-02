<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword;

 /*　パスワード再発行の時にメールが送られる */
  class CustomResetPassword extends ResetPassword
{
    use Queueable;
    /* パスワード再発行時に日本語化される */
    public $token;
 
    /**
     * Create a new notification instance.
     *
     * @return void
     */
     
     /* パスワード再発行時に日本語化される */
     public function __construct($token)
    {
         $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        /* パスワード再発行時に日本語化される */
                     ->subject(__('Reset Password'))
                     ->line(__('Click button below and reset password.'))
                     ->action(__('Reset password'), url(route('password.reset', $this->token, false)))
                     ->line(__('If you did not request a password reset, no further action is required.'));
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
}
