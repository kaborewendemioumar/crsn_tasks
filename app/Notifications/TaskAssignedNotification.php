<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskAssignedNotification extends Notification
{
    use Queueable;

    public function __construct(public Task $task)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Une nouvelle tâche vous a été attribuée - CRSN Tasks')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Une nouvelle tâche vous a été attribuée dans CRSN Tasks.')
            ->line('Titre de la tâche : ' . $this->task->titre)
            ->line('Nous vous invitons à vous connecter à votre compte afin de consulter les détails de cette tâche et d’effectuer le travail demandé.')
            ->action('Accéder à CRSN Tasks', url('/login'))
            ->line('Merci de prendre connaissance de cette nouvelle tâche.')
            ->salutation("Cordialement,\nL'équipe CRSN Tasks");
    }
}