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

        return view('home', compact('seller'));
    }
}
