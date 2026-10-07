<?php

namespace App\Notifications;

use App\Models\Livrable;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LivrableStatusChanged extends Notification
{
    use Queueable;

    public function __construct(public Livrable $livrable)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        if ($this->livrable->statut === 'Validé') {
            return (new MailMessage)
                ->subject('Votre livrable a été validé - CRSN Tasks')
                ->greeting('Bonjour ' . $notifiable->name . ',')
                ->line('Votre livrable a été examiné.')
                ->line('Tâche : ' . $this->livrable->task->titre)
                ->line('Statut : VALIDÉ')
                ->line('Commentaire : ' . $this->livrable->commentaire_validation)
                ->action('Accéder à CRSN Tasks', url('/login'))
                ->line('Merci pour votre travail.')
                ->salutation("Cordialement,\nL'équipe CRSN Tasks");
        }

        return (new MailMessage)
            ->subject('Votre livrable a été rejeté - CRSN Tasks')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Votre livrable a été examiné.')
            ->line('Tâche : ' . $this->livrable->task->titre)
            ->line('Statut : REJETÉ')
            ->line('Motif du rejet : ' . $this->livrable->commentaire_rejet)
            ->line('Veuillez prendre en compte les remarques et effectuer les corrections nécessaires.')
            ->action('Accéder à CRSN Tasks', url('/login'))
            ->salutation("Cordialement,\nL'équipe CRSN Tasks");
    }
}