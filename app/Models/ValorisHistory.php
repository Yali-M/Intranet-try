namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ValorisHistory extends Model
{
    protected $table = 'valoris_history';

    protected $fillable = [
        'user_id', 'points', 'type', 'reason', 'related_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
