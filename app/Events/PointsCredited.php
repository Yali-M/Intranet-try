namespace App\Events;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;

class PointsCredited
{
    use Dispatchable;

    public User $user;
    public int $points;
    public string $reason;

    public function __construct(User $user, int $points, string $reason)
    {
        $this->user = $user;
        $this->points = $points;
        $this->reason = $reason;
    }
}
