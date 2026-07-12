@extends('layouts.app')

@section('title', 'Demos Interactivas - Prueba Apps Web Funcionales - Wilberth')

@section('content')
<section class="bg-gradient-to-r from-indigo-600 to-indigo-800 text-white py-16 mb-12">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Demos Interactivas</h1>
        <p class="text-xl text-indigo-100 max-w-2xl mx-auto">Probá aplicaciones web funcionales que puedo crear para tu negocio.</p>
    </div>
</section>

<section class="mb-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid md:grid-cols-2 gap-6 max-w-3xl mx-auto">
        <a href="/demo/camiseta" class="bg-white rounded-xl shadow-lg overflow-hidden transition-all hover:shadow-2xl hover:-translate-y-2 duration-300 border-t-4 border-indigo-500 block">
            <div class="p-6">
                <div class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <span class="block text-[10px] font-bold text-indigo-500 uppercase tracking-wider text-center mb-1">Básica</span>
                <h3 class="text-lg font-bold text-gray-900 mb-1 text-center">Diseñador de Camisetas</h3>
                <p class="text-gray-500 text-xs text-center">Subí tu imagen, elegí color y posición. Velo al instante.</p>
            </div>
        </a>
        <a href="{{ route('customizer.react') }}" class="bg-white rounded-xl shadow-lg overflow-hidden transition-all hover:shadow-2xl hover:-translate-y-2 duration-300 border-t-4 border-purple-500 block">
            <div class="p-6">
                <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 00-2-2H7a2 2 0 00-2 2zm12-9V5a2 2 0 00-2-2H9a2 2 0 00-2 2v3"/></svg>
                </div>
                <span class="block text-[10px] font-bold text-purple-500 uppercase tracking-wider text-center mb-1">Avanzada</span>
                <h3 class="text-lg font-bold text-gray-900 mb-1 text-center">Estudio de Personalización</h3>
                <p class="text-gray-500 text-xs text-center">Editor profesional con capas, múltiples productos y guardado de diseños.</p>
            </div>
        </a>
    </div>
</section>
@endsection
