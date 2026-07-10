<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $seller = (object) [
            'name' => 'Wilberth',
            'whatsapp' => '+506 85008393',
        ];

        $title = 'Wilberth - Desarrollo Web para Emprendedores y Pequeñas Empresas en Costa Rica';

        return view('home', compact('seller', 'title'));
    }
}
