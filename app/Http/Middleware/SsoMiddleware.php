namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SsoMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('sso_authenticated')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
