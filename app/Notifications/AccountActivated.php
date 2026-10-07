<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountActivated extends Notification
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Votre compte CRSN_Tasks est activé')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line("Votre compte sur la plateforme CRSN_Tasks vient d'être activé par l'administrateur.")
            ->line('Vous pouvez maintenant vous connecter à la plateforme avec vos identifiants.')
            ->action('Se connecter à CRSN_Tasks', url('/login'))
            ->line('Merci de conserver vos identifiants de connexion de manière confidentielle.')
            ->salutation("Cordialement,\nL'équipe CRSN_Tasks");
    }
}
