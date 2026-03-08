namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KanboardColonne extends Model
{
    protected $table = 'kanboard_colonnes';

    protected $fillable = [
        'name',
        'kanboard_id',
        'position'
    ];

    // Relations
    public function kanboard(): BelongsTo
    {
        return $this->belongsTo(Kanboard::class, 'kanboard_id');
    }

    public function taches(): HasMany
    {
        return $this->hasMany(KanboardTache::class, 'colonne_id')->orderBy('position');
    }
}
