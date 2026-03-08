namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ValorisDeclaration extends Model
{
    protected $table = 'valoris_declarations';

    protected $fillable = [
        'title', 'description', 'user_id', 'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function membres(): HasMany
    {
        return $this->hasMany(ValorisDeclarationMembre::class, 'declaration_id');
    }
}
