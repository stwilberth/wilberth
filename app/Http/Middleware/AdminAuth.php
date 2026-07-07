<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $password = env('ADMIN_PASSWORD', 'admin123');

        if ($request->session()->get('admin_authenticated') !== hash('sha256', $password)) {
            return redirect('/admin/login');
        }

        return $next($request);
    }
}
