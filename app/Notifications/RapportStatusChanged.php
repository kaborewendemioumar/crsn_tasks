<?php

namespace App\Notifications;

use App\Models\Rapport;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RapportStatusChanged extends Notification
{
    use Queueable;

    public function __construct(public Rapport $rapport)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        if ($this->rapport->statut === 'Validé') {
            return (new MailMessage)
                ->subject('Votre rapport a été validé - CRSN Tasks')
                ->greeting('Bonjour ' . $notifiable->name . ',')
                ->line('Votre rapport a été examiné par le gestionnaire ou l’administrateur.')
                ->line('Titre du rapport : ' . $this->rapport->titre)
                ->line('Statut : VALIDÉ')
                ->line('Commentaire : ' . $this->rapport->commentaire_validation)
                ->action('Accéder à CRSN Tasks', url('/login'))
                ->line('Merci pour votre travail.')
                ->salutation("Cordialement,\nL'équipe CRSN Tasks");
        }

        return (new MailMessage)
            ->subject('Votre rapport a été rejeté - CRSN Tasks')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Votre rapport a été examiné par le gestionnaire ou l’administrateur.')
            ->line('Titre du rapport : ' . $this->rapport->titre)
            ->line('Statut : REJETÉ')
            ->line('Motif du rejet : ' . $this->rapport->Motif_rejet)
            ->line('Veuillez prendre en compte les remarques et effectuer les corrections nécessaires.')
            ->action('Accéder à CRSN Tasks', url('/login'))
            ->salutation("Cordialement,\nL'équipe CRSN Tasks");
    }
}