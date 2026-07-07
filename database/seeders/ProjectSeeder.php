<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'slug' => 'leiva-tours',
                'name' => 'Leiva Tours',
                'description' => 'Sitio web completo para agencia de turismo y excursiones en Costa Rica. Incluye galería de destinos, paquetes turísticos, formulario de reservas y diseño responsivo.',
                'category' => 'Turismo y excursiones',
                'url' => 'https://www.leivatours.com',
                'cover_path' => '/assets/covers/www.leivatours.com_.png',
                'svg_path' => 'M3 21h18M3 10h18M3 7l9-4 9 4M4 10v11m16-11v11M8 14v.01M12 14v.01M16 14v.01M8 18v.01M12 18v.01M16 18v.01',
            ],
            [
                'slug' => 'rancho-raices',
                'name' => 'Rancho Raíces',
                'description' => 'Página web para restaurante y salón de eventos. Menú digital, galería de platillos, información de contacto y reservaciones para eventos especiales.',
                'category' => 'Restaurante y eventos',
                'url' => 'https://ranchoraices.com',
                'cover_path' => '/assets/covers/ranchoraices.com_.png',
                'svg_path' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
            ],
            [
                'slug' => 'invicta-costa-rica',
                'name' => 'Invicta Costa Rica',
                'description' => 'Tienda en línea especializada en relojes de la marca Invicta. Catálogo de productos, carrito de compras y proceso de pago integrado.',
                'category' => 'Tienda de relojes',
                'url' => 'https://invictacostarica.com',
                'cover_path' => '/assets/covers/invictacostarica.com_.png',
                'svg_path' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
            ],
            [
                'slug' => 'variedades-cr',
                'name' => 'Variedades CR',
                'description' => 'Tienda en línea con amplia variedad de productos. Navegación por categorías, carrito de compras y diseño moderno y atractivo.',
                'category' => 'Tienda en línea',
                'url' => 'https://variedadescr.com',
                'cover_path' => '/assets/covers/variedadescr.com_.png',
                'svg_path' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z',
            ],
            [
                'slug' => 'osa-fishing-pro-cr',
                'name' => 'Osa Fishing Pro CR',
                'description' => 'Tienda especializada en artículos de pesca deportiva. Catálogo de productos, equipos y accesorios con diseño atractivo para pescadores.',
                'category' => 'Tienda de pesca',
                'url' => 'https://osafishingprocr.com',
                'cover_path' => '/assets/covers/osafishingprocr.com_.png',
                'svg_path' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z',
            ],
            [
                'slug' => 'osa-tours-and-travel',
                'name' => 'Osa Tours & Travel',
                'description' => 'Agencia de viajes y turismo en Costa Rica. Ofrece paquetes turísticos, excursiones, transporte y experiencias personalizadas para explorar la peninsula de Osa.',
                'category' => 'Turismo y viajes',
                'url' => 'https://osatoursandtravel.com',
                'cover_path' => '/assets/covers/osatoursandtravel.com_.png',
                'svg_path' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
