<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends VerifyEmail
{
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        $user = auth()->user();
        $username = $user ? $user->username : 'User';
        $url = $this->verificationUrl($notifiable);

        return (new MailMessage())
            ->subject('Active Account')
            ->markdown('emails.custom-email-layout', ['username' => $username, 'url' => $url]);
    }

    /**
     * Get the expiration time for the notification.
     *
     * @return \DateTimeInterface
     */
    public function expiration(): \DateTimeInterface
    {
        $expiredTime =  config('auth.verification.expire', 60);
        return Carbon::now()->addMinutes($expiredTime);
    }
}
