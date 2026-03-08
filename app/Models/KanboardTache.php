namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KanboardTache extends Model
{
    protected $table = 'kanboard_taches';

    protected $fillable = [
        'title',
        'description',
        'colonne_id',
        'assigned_to',
        'due_date',
        'position',
        'status'
    ];

    // Relations
    public function colonne(): BelongsTo
    {
        return $this->belongsTo(KanboardColonne::class, 'colonne_id');
    }

    public function commentaires(): HasMany
    {
        return $this->hasMany(KanboardComment::class, 'tache_id')->orderBy('created_at');
    }
}
