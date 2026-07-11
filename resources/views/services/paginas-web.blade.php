@extends('layouts.app')

@section('title', $title)

@section('content')
<section class="bg-gradient-to-r from-indigo-600 to-indigo-800 text-white py-16 mb-12">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Páginas Web, Apps Web y Tiendas en Línea</h1>
        <p class="text-xl text-indigo-100 mb-8 max-w-2xl mx-auto">
            Tu negocio merece un sitio web profesional. Creo páginas web, aplicaciones y tiendas en línea para emprendedores en Costa Rica — sin complicaciones, a un precio justo.
        </p>
        <a href="https://wa.me/50685008393?text=Hola! Estoy interesado en crear una página web, app web o tienda en línea" target="_blank" rel="noopener noreferrer" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition-colors shadow-lg inline-block">
            Solicitar Cotización
        </a>
    </div>
</section>

<section class="mb-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">¿Qué Ofrecemos?</h2>
        <p class="text-gray-600 text-lg leading-relaxed mb-4">
            Te ayudo a tener presencia en internet con un sitio web profesional, rápido y bonito. Trabajo con tecnologías modernas para que tu página cargue al instante, se vea bien en celulares y sea fácil de encontrar en Google.
        </p>
        <p class="text-gray-600 text-lg leading-relaxed">
            No importa si estás empezando o ya tienes un negocio funcionando — te ofrezco una solución web hecha a tu medida, optimizada para que tus clientes te encuentren en Google y puedan comprar o contactarte fácilmente desde cualquier dispositivo.
        </p>
    </div>
</section>

<section class="mb-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-900 mb-3">Soluciones para Emprendedores</h2>
        <p class="text-gray-600 text-lg">Elige lo que tu negocio necesita para crecer en internet</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all hover:shadow-2xl hover:-translate-y-2 duration-300 border-t-4 border-blue-500">
            <div class="p-6">
                <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1 text-center">Landing Page</h3>
                <p class="text-gray-500 text-xs text-center mb-3">Tu tarjeta de presentación digital. Perfecta para que tus clientes te encuentren, te conozcan y te contacten.</p>
                <div class="text-center pt-2 border-t border-blue-100 space-y-1">
                    <div>
                        <span class="text-sm text-gray-500">Desde </span><span class="text-xl font-bold text-blue-600">₡99,000</span>
                    </div>
                    <div>
                        <span class="text-xs text-gray-400">+ ₡5,000/mes de hosting</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all hover:shadow-2xl hover:-translate-y-2 duration-300 border-t-4 border-green-500">
            <div class="p-6">
                <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1 text-center">Web CMS</h3>
                <p class="text-gray-500 text-xs text-center mb-3">Actualizás tu página vos mismo, cuando quieras. Agregá fotos, texto o promociones sin saber de programación.</p>
                <div class="text-center pt-2 border-t border-green-100 space-y-1">
                    <div>
                        <span class="text-sm text-gray-500">Desde </span><span class="text-xl font-bold text-green-600">₡119,000</span>
                    </div>
                    <div>
                        <span class="text-xs text-gray-400">+ ₡10,000/mes de hosting</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all hover:shadow-2xl hover:-translate-y-2 duration-300 border-t-4 border-purple-500">
            <div class="p-6">
                <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1 text-center">App Web</h3>
                <p class="text-gray-500 text-xs text-center mb-3">Herramientas web a la medida de tu negocio: reservas, catálogos, clientes, pagos. Todo en línea.</p>
                <div class="text-center pt-2 border-t border-purple-100 space-y-1">
                    <div>
                        <span class="text-sm text-gray-500">Desde </span><span class="text-xl font-bold text-purple-600">₡149,000</span>
                    </div>
                    <div>
                        <span class="text-xs text-gray-400">+ ₡15,000/mes de hosting</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="mb-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-900 mb-3">Lo Que Dicen Mis Clientes</h2>
        <p class="text-gray-600 text-lg">Pronto compartiré las experiencias de quienes ya confiaron en mí</p>
    </div>
    <div class="bg-white rounded-xl shadow-lg p-12 text-center border-2 border-dashed border-gray-200">
        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
        </div>
    </div>
</section>



<section class="bg-gradient-to-r from-indigo-600 to-indigo-800 text-white rounded-2xl shadow-2xl p-8 md:p-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
    <div class="text-center mb-8">
        <h2 class="text-3xl md:text-4xl font-bold mb-3">¿Listo para tener tu presencia digital?</h2>
        <p class="text-indigo-100 text-lg">Hablemos de tu proyecto y creemos juntos la solución web que necesitas</p>
    </div>
    <div class="flex flex-col items-center space-y-6">
        <div class="text-center">
            <div class="w-20 h-20 bg-white text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            </div>
            <h3 class="font-bold text-2xl mb-2">Contacto Directo</h3>
            <a href="tel:+506 85008393" class="text-3xl font-bold hover:text-indigo-200 transition-colors">{{ $seller->whatsapp }}</a>
        </div>
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="https://wa.me/50685008393?text=Hola! Quiero crear una página web, app web o tienda en línea" target="_blank" rel="noopener noreferrer" class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-lg font-semibold transition-colors shadow-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                WhatsApp
            </a>
        </div>
    </div>
</section>
@endsection
