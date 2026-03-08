namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AzureLoginRequest;

class LoginController extends Controller
{
    public function azureLogin(AzureLoginRequest $request)
    {
        $token = $request->token;
        // Appel service Azure pour authentification
    }
}
