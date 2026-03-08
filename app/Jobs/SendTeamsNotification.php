<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\Notifications\MattermostService;

class SendMattermostNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $message;
    protected string $channel;

    /**
     * Crée une nouvelle instance du job.
     *
     * @param string $message Le texte de la notification
     * @param string $channel L’ID ou nom du canal Mattermost
     */
    public function __construct(string $message, string $channel)
    {
        $this->message = $message;
        $this->channel = $channel;
    }

    /**
     * Exécute le job.
     */
    public function handle(MattermostService $mattermostService)
    {
        try {
            // Appel du service pour envoyer la notification
            $mattermostService->sendMessage($this->channel, $this->message);
        } catch (\Exception $e) {
            // On peut logger l'erreur pour debug ou relancer le job
            \Log::error("Erreur en envoyant la notification Mattermost : " . $e->getMessage());
            // Optionnel : relancer le job
            // $this->release(60); // reessayer dans 60 secondes
        }
    }
}
