@extends('layouts.app')

@section('title', 'Hosting para Páginas Web en Costa Rica | Planes desde ₡5,000 - Wilberth')

@section('content')
<section class="bg-gradient-to-r from-indigo-600 to-indigo-800 text-white py-16 mb-12">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Hospedaje de Sitios Web</h1>
        <p class="text-xl text-indigo-100 mb-8 max-w-2xl mx-auto">
            Tu web va a cargar rápido, va a tener HTTPS y no se va a caer. Yo lo configuro y lo mantengo.
        </p>
        <a href="https://wa.me/50685008393?text=Hola! Quiero contratar un plan de hosting" target="_blank" rel="noopener noreferrer" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition-colors shadow-lg inline-block">
            Contratar Hosting
        </a>
    </div>
</section>

<section class="mb-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-xl shadow-lg p-8 mb-10">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">¿Qué es el Hospedaje Web?</h2>
        <p class="text-gray-600 text-lg leading-relaxed mb-4">
            El hospedaje web (o hosting) es el servicio que mantiene tu página web en internet 24/7. Es como el "terreno" donde se construye tu sitio: sin hosting, tu web no existe en línea.
        </p>
        <p class="text-gray-600 text-lg leading-relaxed">
            Yo me encargo de todo: configuro el servidor, instalo lo necesario, activo la seguridad (HTTPS), hago respaldos y me aseguro de que tu sitio siempre esté disponible y cargue rápido. Vos solo te preocupás por tu negocio.
        </p>
    </div>

    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-900 mb-3">Planes de Hospedaje</h2>
        <p class="text-gray-600 text-lg">Solo pagás por el hospedaje. Yo lo configuro y lo mantengo.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all hover:shadow-2xl hover:-translate-y-2 duration-300 border-t-4 border-indigo-500">
            <div class="p-6">
                <div class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1 text-center">Hosting Estático</h3>
                <p class="text-gray-500 text-xs text-center mb-3">Ideal para landing pages y portafolios</p>
                <div class="text-center mb-3">
                    <span class="text-2xl font-bold text-indigo-600">₡5,000</span>
                    <span class="text-gray-500 text-sm">/mes</span>
                </div>
                <ul class="space-y-1.5 text-sm text-gray-600">
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> CDN global</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> SSL / HTTPS incluido</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> 99.9% disponibilidad</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Sin límite de visitas</li>
                </ul>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all hover:shadow-2xl hover:-translate-y-2 duration-300 border-t-4 border-green-500">
            <div class="p-6">
                <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1 text-center">Hosting CMS</h3>
                <p class="text-gray-500 text-xs text-center mb-3">Ideal para sitios web con panel administrable</p>
                <div class="text-center mb-3">
                    <span class="text-2xl font-bold text-green-600">₡10,000</span>
                    <span class="text-gray-500 text-sm">/mes</span>
                </div>
                <ul class="space-y-1.5 text-sm text-gray-600">
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Hosting para Web CMS</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> SSL / HTTPS incluido</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Backups automáticos</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Base de datos incluida</li>
                </ul>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all hover:shadow-2xl hover:-translate-y-2 duration-300 border-t-4 border-purple-500">
            <div class="p-6">
                <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1 text-center">Hosting App</h3>
                <p class="text-gray-500 text-xs text-center mb-3">Ideal para apps web y tiendas en línea</p>
                <div class="text-center mb-3">
                    <span class="text-2xl font-bold text-purple-600">₡15,000</span>
                    <span class="text-gray-500 text-sm">/mes</span>
                </div>
                <ul class="space-y-1.5 text-sm text-gray-600">
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Hosting para App Web</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> SSL / HTTPS incluido</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Backups automáticos</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Mayor capacidad y recursos</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="bg-gradient-to-r from-indigo-600 to-indigo-800 text-white rounded-2xl shadow-2xl p-8 md:p-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
    <div class="text-center mb-8">
        <h2 class="text-3xl md:text-4xl font-bold mb-3">¿Necesitas hosting para tu sitio?</h2>
        <p class="text-indigo-100 text-lg">Contáctame y en minutos tenés tu sitio en línea</p>
    </div>
    <div class="flex flex-col items-center space-y-6">
        <div class="text-center">
            <div class="w-20 h-20 bg-white text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            </div>
            <h3 class="font-bold text-2xl mb-2">Contacto Directo</h3>
            <a href="tel:+506 85008393" class="text-3xl font-bold hover:text-indigo-200 transition-colors">+506 85008393</a>
        </div>
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="https://wa.me/50685008393?text=Hola! Quiero contratar un plan de hosting" target="_blank" rel="noopener noreferrer" class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-lg font-semibold transition-colors shadow-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                Contratar por WhatsApp
            </a>
        </div>
    </div>
</section>
@endsection
