<?php

namespace App\Http\Middleware;

use App\Models\credentials;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AttendanceChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $credential = credentials::with(['permission'])->findOrFail(session('user_id'));
        if (!in_array('ATTENDENCE', json_decode($credential->permission->permissions))) {
            return redirect('/');
        }
        return $next($request);
    }
}
