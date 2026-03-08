namespace App\Events;

use App\Models\ValorisAchat;
use Illuminate\Foundation\Events\Dispatchable;

class GoodiePurchased
{
    use Dispatchable;

    public ValorisAchat $achat;

    public function __construct(ValorisAchat $achat)
    {
        $this->achat = $achat;
    }
}
