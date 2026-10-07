<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Le token de réinitialisation.
     */
    public function __construct(
        protected string $token
    ) {
    }

    /**
     * Les canaux utilisés pour la notification.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Contenu de l'e-mail.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Réinitialisation de votre mot de passe - CRSN Tasks')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Vous recevez cet e-mail parce qu’une demande de réinitialisation de votre mot de passe a été effectuée pour votre compte CRSN Tasks.')
            ->action('Réinitialiser mon mot de passe', $url)
            ->line('Ce lien de réinitialisation expirera après un certain délai.')
            ->line('Si vous n’êtes pas à l’origine de cette demande, aucune action n’est nécessaire.')
            ->salutation("Cordialement,\nL'équipe CRSN Tasks");
    }
}