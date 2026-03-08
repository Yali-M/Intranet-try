namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        auth()->logout();               // Déconnexion Laravel
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');      // Redirection vers login
    }
}
