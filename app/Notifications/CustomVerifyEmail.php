<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends VerifyEmail
{
    public function toMail($notifiable)
    {
        $url = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('تأكيد البريد الإلكتروني')
            ->view('emails.verify', [
                'url' => $url,
                'user' => $notifiable,
            ]);
    }
}