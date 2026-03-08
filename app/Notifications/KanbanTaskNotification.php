<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\KanboardTache;

class KanbanTaskNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected KanboardTache $task;
    protected string $action;

    /**
     * Crée une nouvelle notification de tâche Kanban.
     *
     * @param KanboardTache $task La tâche concernée
     * @param string $action L'action effectuée (créée, mise à jour, complétée)
     */
    public function __construct(KanboardTache $task, string $action = 'créée')
    {
        $this->task = $task;
        $this->action = $action;
    }

    /**
     * Détermine les canaux de notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
        // Ajouter 'broadcast', 'slack', 'teams', etc. si besoin
    }

    /**
     * Contenu de l'email.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject("Tâche Kanban {$this->action} : {$this->task->titre}")
                    ->greeting("Bonjour {$notifiable->name},")
                    ->line("La tâche '{$this->task->titre}' a été {$this->action}.")
                    ->line("Description : {$this->task->description}")
                    ->line("Projet : {$this->task->colonne->kanboard->name}")
                    ->action('Voir la tâche', url("/kanban/{$this->task->id}"))
                    ->line("Merci d’utiliser l’outil Kanban.");
    }

    /**
     * Contenu stocké en base pour la notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'task_id' => $this->task->id,
            'titre' => $this->task->titre,
            'action' => $this->action,
            'description' => $this->task->description,
            'project' => $this->task->colonne->kanboard->name,
            'url' => url("/kanban/{$this->task->id}"),
        ];
    }

    /**
     * Pour la diffusion en broadcast (optionnel)
     */
    // public function toBroadcast($notifiable)
    // {
    //     return new BroadcastMessage([
    //         'task_id' => $this->task->id,
    //         'titre' => $this->task->titre,
    //         'action' => $this->action,
    //     ]);
    // }
}
