<?php

namespace App\Services\Auth;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class AzureService
{
    protected string $tenantId;
    protected string $clientId;
    protected string $clientSecret;
    protected string $scope;
    protected string $baseUrl;
    protected Client $http;

    /**
     * Constructeur du service Azure.
     *
     * @return void
     */
    public function __construct()
    {
        $this->tenantId = config('services.azure.tenant_id');
        $this->clientId = config('services.azure.client_id');
        $this->clientSecret = config('services.azure.client_secret');
        $this->scope = config('services.azure.scope', 'https://graph.microsoft.com/.default');
        $this->baseUrl = 'https://graph.microsoft.com/v1.0';
        $this->http = new Client();
    }

    /**
     * Récupère le token d'accès OAuth2 pour Microsoft Graph.
     *
     * @return string|null
     */
    public function getAccessToken(): ?string
    {
        try {
            $response = $this->http->post("https://login.microsoftonline.com/{$this->tenantId}/oauth2/v2.0/token", [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'scope' => $this->scope,
                ],
            ]);

            $data = json_decode((string) $response->getBody(), true);
            return $data['access_token'] ?? null;

        } catch (\Exception $e) {
            Log::error('Erreur AzureService getAccessToken : ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Récupère tous les utilisateurs depuis Azure AD.
     *
     * @return array
     */
    public function getUsers(): array
    {
        $token = $this->getAccessToken();
        if (!$token) {
            return [];
        }

        try {
            $response = $this->http->get("{$this->baseUrl}/users", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                    'Accept' => 'application/json',
                ],
            ]);

            $data = json_decode((string) $response->getBody(), true);
            return $data['value'] ?? [];

        } catch (\Exception $e) {
            Log::error('Erreur AzureService getUsers : ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Récupère un utilisateur spécifique par son email.
     *
     * @param string $email
     * @return array|null
     */
    public function getUserByEmail(string $email): ?array
    {
        $users = $this->getUsers();
        foreach ($users as $user) {
            if (strtolower($user['mail'] ?? '') === strtolower($email)) {
                return $user;
            }
        }
        return null;
    }
}
