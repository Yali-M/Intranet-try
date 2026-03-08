namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ValorisDeclarationMembre extends Model
{
    protected $table = 'valoris_declaration_membres';

    protected $fillable = [
        'declaration_id', 'user_id', 'points_awarded'
    ];

    public function declaration(): BelongsTo
    {
        return $this->belongsTo(ValorisDeclaration::class, 'declaration_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
