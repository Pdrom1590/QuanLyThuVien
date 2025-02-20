<?php
// Trong file app/Http/Middleware/AuthenticateStaff.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticateStaff
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if (!$user->is_staff) {
            return redirect('/');
        }
        return $next($request);
    }
}