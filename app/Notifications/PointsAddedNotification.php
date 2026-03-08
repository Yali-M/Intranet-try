<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class PointsAddedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected User $user;
    protected int $points;
    protected ?string $reason;

    /**
     * Crée une nouvelle notification de points Valoris.
     *
     * @param User $user L'utilisateur concerné
     * @param int $points Le nombre de points ajoutés
     * @param string|null $reason Raison de l'ajout des points
     */
    public function __construct(User $user, int $points, ?string $reason = null)
    {
        $this->user = $user;
        $this->points = $points;
        $this->reason = $reason;
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
        // Ajouter 'broadcast' ou 'teams' si nécessaire
    }

    /**
     * Contenu de l'email.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $mail = (new MailMessage)
                    ->subject('Des points Valoris ont été ajoutés')
                    ->greeting("Bonjour {$this->user->name},")
                    ->line("Vous avez reçu {$this->points} points Valoris.");

        if ($this->reason) {
            $mail->line("Raison : {$this->reason}");
        }

        $mail->line('Merci pour votre engagement !');
        return $mail;
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
            'user_id' => $this->user->id,
            'points' => $this->points,
            'reason' => $this->reason,
            'message' => "Vous avez reçu {$this->points} points Valoris" . ($this->reason ? " pour {$this->reason}" : "") . "."
        ];
    }

    /**
     * Pour la diffusion en broadcast (optionnel)
     */
    // public function toBroadcast($notifiable)
    // {
    //     return new BroadcastMessage([
    //         'points' => $this->points,
    //         'reason' => $this->reason,
    //         'user_id' => $this->user->id,
    //     ]);
    // }
}
