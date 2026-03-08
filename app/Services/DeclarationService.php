<?php

namespace App\Services;

use App\Models\ValorisDeclaration;
use App\Models\ValorisDeclarationMembre;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeclarationService
{
    /**
     * Crée une nouvelle déclaration pour un utilisateur
     *
     * @param User $user
     * @param array $data
     * @return ValorisDeclaration
     */
    public function createDeclaration(User $user, array $data): ValorisDeclaration
    {
        return DB::transaction(function () use ($user, $data) {
            $declaration = ValorisDeclaration::create([
                'user_id' => $user->id,
                'title' => $data['title'] ?? 'Déclaration sans titre',
                'description' => $data['description'] ?? null,
                'status' => 'pending', // pending, validated, rejected
                'date_debut' => $data['date_debut'] ?? now(),
                'date_fin' => $data['date_fin'] ?? now(),
                'points' => $data['points'] ?? 0,
            ]);

            // Si membres associés
            if (!empty($data['members'])) {
                foreach ($data['members'] as $memberId) {
                    ValorisDeclarationMembre::create([
                        'declaration_id' => $declaration->id,
                        'user_id' => $memberId
                    ]);
                }
            }

            return $declaration;
        });
    }

    /**
     * Valide une déclaration (changement de statut)
     *
     * @param ValorisDeclaration $declaration
     * @param string $status
     * @return ValorisDeclaration
     */
    public function validateDeclaration(ValorisDeclaration $declaration, string $status): ValorisDeclaration
    {
        $declaration->status = $status;
        $declaration->validated_by = Auth::id();
        $declaration->validated_at = now();
        $declaration->save();

        return $declaration;
    }

    /**
     * Récupère toutes les déclarations d'un utilisateur
     *
     * @param User|null $user
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUserDeclarations(?User $user = null)
    {
        $user = $user ?? Auth::user();
        return ValorisDeclaration::where('user_id', $user->id)
            ->with('members')
            ->orderBy('date_debut', 'desc')
            ->get();
    }

    /**
     * Calcul des points totaux validés d'un utilisateur
     *
     * @param User|null $user
     * @return int
     */
    public function getTotalValidatedPoints(?User $user = null): int
    {
        $user = $user ?? Auth::user();
        return ValorisDeclaration::where('user_id', $user->id)
            ->where('status', 'validated')
            ->sum('points');
    }
}
