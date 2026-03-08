<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\ValorisAchat;

class GoodieOrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected ValorisAchat $order;

    /**
     * Crée une nouvelle instance de notification.
     *
     * @param ValorisAchat $order La commande passée
     */
    public function __construct(ValorisAchat $order)
    {
        $this->order = $order;
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
        // On peut ajouter 'broadcast', 'slack', 'teams', etc.
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
                    ->subject('Votre commande Valoris a été reçue')
                    ->greeting("Bonjour {$notifiable->name},")
                    ->line("Votre commande (#{$this->order->id}) a bien été enregistrée.")
                    ->line("Produit : {$this->order->produit->name}")
                    ->line("Quantité : {$this->order->quantite}")
                    ->line("Merci de votre fidélité au programme Valoris !");
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
            'order_id' => $this->order->id,
            'produit' => $this->order->produit->name,
            'quantite' => $this->order->quantite,
            'message' => "Votre commande Valoris (#{$this->order->id}) a été reçue."
        ];
    }

    /**
     * Pour la diffusion en broadcast (optionnel)
     */
    // public function toBroadcast($notifiable)
    // {
    //     return new BroadcastMessage([
    //         'order_id' => $this->order->id,
    //         'message' => "Nouvelle commande Valoris reçue."
    //     ]);
    // }
}
