namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\AzureLoginRequest;
use App\Http\Requests\Auth\KeycloakLoginRequest;
use App\Services\Auth\AzureService;
use App\Services\Auth\KeycloakService;

class LoginController extends Controller
{
    protected AzureService $azureService;
    protected KeycloakService $keycloakService;

    public function __construct(AzureService $azureService, KeycloakService $keycloakService)
    {
        $this->azureService = $azureService;
        $this->keycloakService = $keycloakService;
    }

    // Connexion via formulaire ou SSO Azure
    public function azureLogin(AzureLoginRequest $request)
    {
        $user = $this->azureService->authenticate($request->token);
        auth()->login($user);
        return redirect()->intended('/');
    }

    // Connexion via Keycloak
    public function keycloakLogin(KeycloakLoginRequest $request)
    {
        $user = $this->keycloakService->authenticate($request->access_token);
        auth()->login($user);
        return redirect()->intended('/');
    }
}
