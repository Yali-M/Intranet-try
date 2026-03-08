public function handle($request, Closure $next)
{
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    return $next($request);
}
