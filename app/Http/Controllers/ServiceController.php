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
        $title = 'Páginas Web, Apps Web y Tiendas en Línea - Wilberth';

        return view('services.paginas-web', compact('seller', 'title'));
    }
}
