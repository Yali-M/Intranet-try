namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kanboard extends Model
{
    protected $table = 'kanboards';

    protected $fillable = [
        'name',
        'description',
        'owner_id'
    ];

    // Relations
    public function colonnes(): HasMany
    {
        return $this->hasMany(KanboardColonne::class, 'kanboard_id');
    }

    public function taches(): HasMany
    {
        return $this->hasManyThrough(KanboardTache::class, KanboardColonne::class, 'kanboard_id', 'colonne_id');
    }
}
