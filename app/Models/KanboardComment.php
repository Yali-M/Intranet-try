namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KanboardComment extends Model
{
    protected $table = 'kanboard_comments';

    protected $fillable = [
        'tache_id',
        'user_id',
        'content'
    ];

    // Relations
    public function tache(): BelongsTo
    {
        return $this->belongsTo(KanboardTache::class, 'tache_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
