namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ValorisAchat extends Model
{
    protected $table = 'valoris_achats';

    protected $fillable = [
        'user_id', 'reward_id', 'quantity', 'total_points', 'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function produit(): BelongsTo
    {
        return $this->belongsTo(ValorisProduit::class, 'reward_id');
    }
}
