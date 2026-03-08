<?php

namespace App\Services\Notifications;

use App\Services\Notifications\MattermostService;
use App\Services\Notifications\TeamsService;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    protected MattermostService $mattermost;
    protected TeamsService $teams;

    /**
     * Constructeur du service central de notifications
     */
    public function __construct(MattermostService $mattermost, TeamsService $teams)
    {
        $this->mattermost = $mattermost;
        $this->teams = $teams;
    }

    /**
     * Envoie une notification vers tous les canaux configurés
     *
     * @param string $message
     * @param array $options ['channel' => '...', 'username' => '...']
     * @return array
     */
    public function send(string $message, array $options = []): array
    {
        $results = [];

        // Envoi vers Mattermost
        try {
            $results['mattermost'] = $this->mattermost->sendMessage(
                $message,
                $options['mattermost_channel'] ?? null,
                $options['mattermost_username'] ?? null
            );
        } catch (\Exception $e) {
            Log::error('Erreur NotificationService Mattermost: ' . $e->getMessage());
            $results['mattermost'] = false;
        }

        // Envoi vers Teams
        try {
            $results['teams'] = $this->teams->sendMessage(
                $message,
                $options['teams_channel'] ?? null
            );
        } catch (\Exception $e) {
            Log::error('Erreur NotificationService Teams: ' . $e->getMessage());
            $results['teams'] = false;
        }

        return $results;
    }

    /**
     * Envoie une notification uniquement sur Mattermost
     *
     * @param string $message
     * @param string|null $channel
     * @param string|null $username
     * @return bool
     */
    public function sendMattermost(string $message, ?string $channel = null, ?string $username = null): bool
    {
        return $this->mattermost->sendMessage($message, $channel, $username);
    }

    /**
     * Envoie une notification uniquement sur Teams
     *
     * @param string $message
     * @param string|null $channel
     * @return bool
     */
    public function sendTeams(string $message, ?string $channel = null): bool
    {
        return $this->teams->sendMessage($message, $channel);
    }
}
