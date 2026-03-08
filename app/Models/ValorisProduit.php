namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ValorisProduit extends Model
{
    protected $table = 'valoris_produits';

    protected $fillable = [
        'name', 'description', 'points_cost', 'stock'
    ];

    public function achats(): HasMany
    {
        return $this->hasMany(ValorisAchat::class, 'reward_id');
    }
}
