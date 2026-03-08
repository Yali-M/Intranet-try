<?php

namespace App\Services\Notifications;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class TeamsService
{
    protected string $webhookUrl;
    protected Client $http;

    /**
     * Constructeur du service Teams
     */
    public function __construct()
    {
        $this->webhookUrl = config('services.teams.webhook_url');
        $this->http = new Client();
    }

    /**
     * Envoie un message vers Microsoft Teams
     *
     * @param string $message
     * @param string|null $title
     * @return bool
     */
    public function sendMessage(string $message, ?string $title = null): bool
    {
        $payload = [
            '@type' => 'MessageCard',
            '@context' => 'https://schema.org/extensions',
            'summary' => $title ?? 'Notification Intranet',
            'themeColor' => '0076D7',
            'title' => $title ?? 'Notification',
            'text' => $message,
        ];

        try {
            $response = $this->http->post($this->webhookUrl, [
                'json' => $payload,
            ]);

            return $response->getStatusCode() === 200;
        } catch (\Exception $e) {
            Log::error('Erreur TeamsService sendMessage: ' . $e->getMessage());
            return false;
        }
    }
}
