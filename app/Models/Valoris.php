<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valoris extends Model
{
    use HasFactory;

    // Table associée (optionnel si Laravel suit la convention)
    protected $table = 'valoris';

    // Champs pouvant être remplis en masse
    protected $fillable = [
        'title',        // titre de l’action ou récompense
        'description',  // description détaillée
        'points',       // nombre de points Valoris associés
        'user_id',      // optionnel : utilisateur lié
        'date',         // date de l’action
    ];

    // Définir les types des colonnes (optionnel mais recommandé)
    protected $casts = [
        'points' => 'integer',
        'date' => 'datetime',
    ];

    /**
     * Relation : un Valoris peut appartenir à un utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation : un Valoris peut avoir plusieurs achats ou historiques
     */
    public function histories()
    {
        return $this->hasMany(ValorisHistory::class);
    }

    public function achats()
    {
        return $this->hasMany(ValorisAchat::class);
    }
}
