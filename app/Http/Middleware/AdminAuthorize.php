<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuthorize
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->user()->role !== 'admin') {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
