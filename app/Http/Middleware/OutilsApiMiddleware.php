namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OutilsApiMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('X-API-TOKEN');

        if (!$token || $token !== config('intranet.outils_api_token')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
