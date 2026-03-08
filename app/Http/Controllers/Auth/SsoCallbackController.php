namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Auth\AzureService;
use App\Services\Auth\KeycloakService;

class SsoCallbackController extends Controller
{
    protected AzureService $azureService;
    protected KeycloakService $keycloakService;

    public function __construct(AzureService $azureService, KeycloakService $keycloakService)
    {
        $this->azureService = $azureService;
        $this->keycloakService = $keycloakService;
    }

    public function handleAzure(Request $request)
    {
        $user = $this->azureService->handleCallback($request->code);
        auth()->login($user);
        return redirect()->intended('/');
    }

    public function handleKeycloak(Request $request)
    {
        $user = $this->keycloakService->handleCallback($request->code);
        auth()->login($user);
        return redirect()->intended('/');
    }
}
