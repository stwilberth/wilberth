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
                <p class="text-gray-600 leading-relaxed mb-4">
                    Soy desarrollador web autodidacta. Aprendí haciendo, resolviendo problemas reales y trabajando con clientes de verdad. Cada proyecto que tomo lo trato como si fuera propio, poniendo atención al detalle y buscando siempre la mejor solución para cada cliente.
                </p>
                <a href="{{ route('customizer.react') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                    <span>Diseñador de Camisetas (Customizer)</span>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
