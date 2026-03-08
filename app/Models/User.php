namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'points'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    // Relations
    public function achats(): HasMany
    {
        return $this->hasMany(ValorisAchat::class, 'user_id');
    }

    public function declarations(): HasMany
    {
        return $this->hasMany(ValorisDeclaration::class, 'user_id');
    }

    public function history(): HasMany
    {
        return $this->hasMany(ValorisHistory::class, 'user_id');
    }
    
    // Vérifications rôles
    public function isAdmin(): bool
    {
        return $this->role_id === 1;
    }

    public function isManager(): bool
    {
        return $this->role_id === 2;
    }
}
