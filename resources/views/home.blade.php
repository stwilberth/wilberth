@extends('layouts.app')

@section('title', $title)

@section('content')
<section class="bg-gradient-to-r from-indigo-600 to-indigo-800 text-white py-16 mb-12">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Páginas Web para Emprendedores</h1>
        <p class="text-xl text-indigo-100 mb-4 max-w-2xl mx-auto">Llevá tu negocio al mundo digital.</p>
        <p class="text-2xl font-bold text-white mb-8">Páginas web desde <span class="text-yellow-300">₡99,000</span> · Hosting desde <span class="text-yellow-300">₡5,000/mes</span></p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/paginas-web" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition-colors shadow-lg inline-block">Explorar Servicios</a>
            <a href="/proyectos" class="bg-white/10 text-white px-8 py-3 rounded-lg font-semibold hover:bg-white/20 transition-colors border border-white/20 inline-block">Ver Proyectos</a>
        </div>
    </div>
</section>

<section class="max-w-4xl mx-auto mb-16 px-4">
    <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12">
        <div class="flex flex-col md:flex-row gap-8 items-center">
            <div class="flex-shrink-0">
                <img src="/assets/images/logo_wilberth.png" alt="Wilberth" class="w-32 h-32 rounded-3xl shadow-xl object-cover" />
            </div>
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Sobre Mí</h2>
                <p class="text-indigo-600 font-medium mb-4">Desarrollador Web · Especialista en Laravel y Astro</p>
                <p class="text-gray-600 leading-relaxed mb-3">
                    Tengo más de 7 años de experiencia en desarrollo web con PHP, trabajando con empresas y clientes para crear páginas y aplicaciones web. Me especializo en <strong>Laravel</strong> y <strong>Astro</strong>, tecnologías modernas que garantizan sitios rápidos, seguros y fáciles de mantener.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    Soy desarrollador web autodidacta. Aprendí haciendo, resolviendo problemas reales y trabajando con clientes de verdad. Cada proyecto que tomo lo trato como si fuera propio, poniendo atención al detalle y buscando siempre la mejor solución para cada cliente.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
