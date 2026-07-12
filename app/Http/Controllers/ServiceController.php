<?php

namespace App\Http\Controllers;

class ServiceController extends Controller
{
    public function paginasWeb()
    {
        $seller = (object) [
            'name' => 'Wilberth',
            'whatsapp' => '+506 85008393',
        ];
        $title = 'Páginas Web para Emprendedores en Costa Rica | Precios desde ₡99,000';

        return view('services.paginas-web', compact('seller', 'title'));
    }

    public function proceso()
    {
        $seller = (object) [
            'name' => 'Wilberth',
            'whatsapp' => '+506 85008393',
        ];

        return view('proceso', compact('seller'));
    }

    public function hosting()
    {
        $seller = (object) [
            'name' => 'Wilberth',
            'whatsapp' => '+506 85008393',
        ];

        return view('hosting', compact('seller'));
    }

    public function demo()
    {
        $seller = (object) [
            'name' => 'Wilberth',
            'whatsapp' => '+506 85008393',
        ];

        return view('demo', compact('seller'));
    }
}
