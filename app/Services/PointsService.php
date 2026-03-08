<?php

namespace App\Services;

use App\Models\User;
use App\Models\ValorisHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PointsService
{
    /**
     * Ajouter des points à un utilisateur
     *
     * @param User $user
     * @param int $points
     * @param string|null $reason
     * @return User
     */
    public function addPoints(User $user, int $points, ?string $reason = null): User
    {
        return DB::transaction(function () use ($user, $points, $reason) {
            $user->valoris += $points;
            $user->save();

            ValorisHistory::create([
                'user_id' => $user->id,
                'points' => $points,
                'reason' => $reason ?? 'Ajout manuel',
                'created_by' => Auth::id() ?? $user->id,
            ]);

            return $user;
        });
    }

    /**
     * Retirer des points à un utilisateur
     *
     * @param User $user
     * @param int $points
     * @param string|null $reason
     * @return User
     */
    public function removePoints(User $user, int $points, ?string $reason = null): User
    {
        return DB::transaction(function () use ($user, $points, $reason) {
            $user->valoris -= $points;
            if ($user->valoris < 0) {
                $user->valoris = 0;
            }
            $user->save();

            ValorisHistory::create([
                'user_id' => $user->id,
                'points' => -$points,
                'reason' => $reason ?? 'Retrait manuel',
                'created_by' => Auth::id() ?? $user->id,
            ]);

            return $user;
        });
    }

    /**
     * Récupérer l'historique des points d'un utilisateur
     *
     * @param User|null $user
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPointsHistory(?User $user = null)
    {
        $user = $user ?? Auth::user();

        return ValorisHistory::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Obtenir le solde de points actuel d'un utilisateur
     *
     * @param User|null $user
     * @return int
     */
    public function getBalance(?User $user = null): int
    {
        $user = $user ?? Auth::user();
        return $user->valoris;
    }
}
