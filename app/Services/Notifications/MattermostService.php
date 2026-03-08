<?php

namespace App\Services\Notifications;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class MattermostService
{
    protected string $webhookUrl;
    protected Client $http;

    /**
     * Constructeur du service Mattermost
     */
    public function __construct()
    {
        $this->webhookUrl = config('services.mattermost.webhook_url');
        $this->http = new Client();
    }

    /**
     * Envoie un message vers Mattermost
     *
     * @param string $message
     * @param string|null $channel
     * @param string|null $username
     * @return bool
     */
    public function sendMessage(string $message, ?string $channel = null, ?string $username = null): bool
    {
        $payload = [
            'text' => $message,
        ];

        if ($channel) {
            $payload['channel'] = $channel;
        }

        if ($username) {
            $payload['username'] = $username;
        }

        try {
            $response = $this->http->post($this->webhookUrl, [
                'json' => $payload,
            ]);

            return $response->getStatusCode() === 200;
        } catch (\Exception $e) {
            Log::error('Erreur MattermostService sendMessage: ' . $e->getMessage());
            return false;
        }
    }
}
