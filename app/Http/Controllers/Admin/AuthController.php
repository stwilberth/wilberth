<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $password = env('ADMIN_PASSWORD', 'admin123');
        $valid = $request->password === $password;

        if (!$valid) {
            return redirect('/admin/login')->with('error', 'Contraseña incorrecta');
        }

        $request->session()->put('admin_authenticated', hash('sha256', $password));
        return redirect('/admin/dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_authenticated');
        return redirect('/admin/login');
    }
}
