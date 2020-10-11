<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $role = Auth::user()->role;
                switch ($role) {
                    case 'admin':
                        return redirect('/admin/dashboard');
                        break;
                    case 'guru':
                        return redirect('/guru/dashboard');
                        break;
                    case 'siswa':
                        return redirect('/siswa/dashboard');
                        break;
                    default:
                        # code...
                        break;
                }
            }
        }

        return $next($request);
    }
}
