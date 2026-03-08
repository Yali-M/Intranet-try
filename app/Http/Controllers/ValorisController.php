namespace App\Http\Controllers;

use App\Models\ValorisProduit;
use App\Http\Requests\Valoris\PurchaseRewardRequest;
use App\Services\ShopService;
use Illuminate\Http\Request;

class ValorisController extends Controller
{
    protected ShopService $shopService;

    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }

    public function catalog()
    {
        $products = ValorisProduit::all();
        return view('valoris.catalog', compact('products'));
    }

    public function purchase(PurchaseRewardRequest $request)
    {
        $order = $this->shopService->purchase(auth()->user(), $request->reward_id);
        return redirect()->back()->with('success', 'Récompense achetée !');
    }

    public function pointsBalance()
    {
        $points = auth()->user()->pointsBalance();
        return view('valoris.balance', compact('points'));
    }
}
