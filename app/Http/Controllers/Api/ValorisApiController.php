namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Valoris\PurchaseRewardRequest;
use App\Services\ShopService;

class ValorisApiController extends Controller
{
    protected ShopService $shopService;

    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }

    public function purchase(PurchaseRewardRequest $request)
    {
        $order = $this->shopService->purchase($request->user(), $request->reward_id);
        return response()->json($order, 200);
    }
}
