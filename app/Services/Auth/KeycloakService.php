<?php

namespace App\Services\Auth;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class KeycloakService
{
    protected string $baseUrl;
    protected string $realm;
    protected string $clientId;
    protected string $clientSecret;
    protected Client $http;

    /**
     * Constructeur du service Keycloak.
     */
    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.keycloak.base_url'), '/'); // ex: https://auth.example.com
        $this->realm = config('services.keycloak.realm');
        $this->clientId = config('services.keycloak.client_id');
        $this->clientSecret = config('services.keycloak.client_secret');
        $this->http = new Client();
    }

    /**
     * Récupère un token d'accès pour Keycloak via client credentials.
     *
     * @return string|null
     */
    public function getAccessToken(): ?string
    {
        try {
            $response = $this->http->post("{$this->baseUrl}/realms/{$this->realm}/protocol/openid-connect/token", [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                ],
            ]);

            $data = json_decode((string) $response->getBody(), true);
            return $data['access_token'] ?? null;
        } catch (\Exception $e) {
            Log::error('Erreur KeycloakService getAccessToken : ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Récupère tous les utilisateurs du realm.
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
            $response = $this->http->get("{$this->baseUrl}/admin/realms/{$this->realm}/users", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                    'Accept' => 'application/json',
                ],
            ]);

            $data = json_decode((string) $response->getBody(), true);
            return $data ?? [];
        } catch (\Exception $e) {
            Log::error('Erreur KeycloakService getUsers : ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Récupère un utilisateur par son email.
     *
     * @param string $email
     * @return array|null
     */
    public function getUserByEmail(string $email): ?array
    {
        $users = $this->getUsers();
        foreach ($users as $user) {
            if (strtolower($user['email'] ?? '') === strtolower($email)) {
                return $user;
            }
        }
        return null;
    }

    /**
     * Crée un nouvel utilisateur dans Keycloak.
     *
     * @param array $userData
     * @return bool
     */
    public function createUser(array $userData): bool
    {
        $token = $this->getAccessToken();
        if (!$token) {
            return false;
        }

        try {
            $this->http->post("{$this->baseUrl}/admin/realms/{$this->realm}/users", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                    'Content-Type' => 'application/json',
                ],
                'json' => $userData,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Erreur KeycloakService createUser : ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Met à jour un utilisateur existant dans Keycloak.
     *
     * @param string $userId
     * @param array $userData
     * @return bool
     */
    public function updateUser(string $userId, array $userData): bool
    {
        $token = $this->getAccessToken();
        if (!$token) {
            return false;
        }

        try {
            $this->http->put("{$this->baseUrl}/admin/realms/{$this->realm}/users/{$userId}", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                    'Content-Type' => 'application/json',
                ],
                'json' => $userData,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Erreur KeycloakService updateUser : ' . $e->getMessage());
            return false;
        }
    }
}
