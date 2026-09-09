@extends('layouts.app')

@section('title', 'Formulario de Marketing - Cuéntame Sobre Tu Negocio - Wilberth')

@section('content')
<section class="bg-gradient-to-r from-pink-600 to-purple-700 text-white py-16 mb-12">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Cuéntame Sobre Tu Negocio</h1>
        <p class="text-xl text-pink-100 max-w-2xl mx-auto">Para poder crear una página que realmente ayude a tu negocio, quiero conocer un poco mejor lo que haces. Respondeme estas preguntas y te ayudo a diseñar la estrategia perfecta.</p>
    </div>
</section>

<section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
    @if (session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl p-6 mb-8">
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 bg-pink-100 text-pink-600 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900 mb-2">No hay respuestas correctas o incorrectas</h2>
                <p class="text-gray-600">Respondé con honestidad y con tus propias palabras. Cuanto más claro esté para mí, mejor te puedo ayudar a crear una página que funcione para tu negocio.</p>
            </div>
        </div>
    </div>

    <form action="{{ route('marketing-brief.store') }}" method="POST" class="space-y-8" id="marketing-brief-form">
        @csrf
        <input type="hidden" name="marketing_brief_link_token" value="{{ $link->token ?? '' }}">

        {{-- Sección 1: Datos de contacto --}}
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-pink-100 text-pink-600 rounded-xl flex items-center justify-center font-bold">1</div>
                <h2 class="text-2xl font-bold text-gray-900">Tus Datos de Contacto</h2>
            </div>

            <div class="space-y-5">
                <div>
                    <label for="contact_name" class="block text-sm font-semibold text-gray-700 mb-2">¿Cómo te llamás?</label>
                    <input type="text" name="contact_name" id="contact_name" required
                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-pink-500 focus:ring-0 transition-colors text-gray-900"
                        placeholder="Tu nombre completo" value="{{ old('contact_name') }}">
                    @error('contact_name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Correo electrónico</label>
                        <input type="email" name="email" id="email" required
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-pink-500 focus:ring-0 transition-colors text-gray-900"
                            placeholder="tu@email.com" value="{{ old('email') }}">
                        @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Teléfono o WhatsApp</label>
                        <input type="text" name="phone" id="phone" required
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-pink-500 focus:ring-0 transition-colors text-gray-900"
                            placeholder="Ejemplo: 85008393" value="{{ old('phone') }}">
                        @error('phone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Sección 2: ¿Qué vendés? --}}
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-pink-100 text-pink-600 rounded-xl flex items-center justify-center font-bold">2</div>
                <h2 class="text-2xl font-bold text-gray-900">Sobre Tu Negocio</h2>
            </div>

            <div class="space-y-6">
                <div>
                    <label for="offer" class="block text-sm font-semibold text-gray-700 mb-2">¿Qué vendés o qué servicio ofrecés?</label>
                    <textarea name="offer" id="offer" rows="3" required
                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-pink-500 focus:ring-0 transition-colors text-gray-900 resize-none"
                        placeholder="Ejemplo: Vendo café de especialidad y repostería artesanal. También ofrezco servicio de catering para eventos.">{{ old('offer') }}</textarea>
                    @error('offer')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="target_audience" class="block text-sm font-semibold text-gray-700 mb-2">¿Qué tipo de personas son tus principales clientes?</label>
                    <textarea name="target_audience" id="target_audience" rows="3" required
                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-pink-500 focus:ring-0 transition-colors text-gray-900 resize-none"
                        placeholder="Ejemplo: Personas entre 25 y 40 años que trabajan en oficinas cerca de mi local. También atiendo a familias los fines de semana.">{{ old('target_audience') }}</textarea>
                    @error('target_audience')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        {{-- Sección 3: Diferenciación --}}
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-pink-100 text-pink-600 rounded-xl flex items-center justify-center font-bold">3</div>
                <h2 class="text-2xl font-bold text-gray-900">Qué Te Hace Especial</h2>
            </div>

            <div class="space-y-6">
                <div>
                    <label for="differentiator" class="block text-sm font-semibold text-gray-700 mb-2">¿Por qué tus clientes te eligen a ti y no a otro negocio?</label>
                    <textarea name="differentiator" id="differentiator" rows="3" required
                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-pink-500 focus:ring-0 transition-colors text-gray-900 resize-none"
                        placeholder="Ejemplo: Mis clientes me eligen porque preparo todo a mano, uso ingredientes frescos de la zona y siempre me aseguro de que queden satisfechos. Precio y calidad son mis mayores ventajas.">{{ old('differentiator') }}</textarea>
                    @error('differentiator')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-amber-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-amber-800">Puede ser por precio, calidad, experiencia, atención, ubicación, rapidez, confianza, etc. Contame qué te hace diferente.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sección 4: Objetivos --}}
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-pink-100 text-pink-600 rounded-xl flex items-center justify-center font-bold">4</div>
                <h2 class="text-2xl font-bold text-gray-900">Tus Objetivos</h2>
            </div>

            <div class="space-y-6">
                <div>
                    <label for="main_goal" class="block text-sm font-semibold text-gray-700 mb-2">¿Qué es lo que más te interesa conseguir con la página?</label>
                    <div class="space-y-3 mt-3">
                        @php
                            $goals = [
                                'Conseguir más clientes',
                                'Hacer más ventas',
                                'Recibir consultas por WhatsApp',
                                'Reservaciones en línea',
                                'Mostrar mis servicios o productos',
                                'Dar confianza a mis clientes',
                                'Ganar presencia en internet',
                            ];
                        @endphp
                        <div class="grid sm:grid-cols-2 gap-2">
                            @foreach ($goals as $goal)
                                <label class="flex items-center gap-2 p-3 border-2 border-slate-200 rounded-xl hover:border-pink-300 hover:bg-pink-50/50 cursor-pointer transition-all has-[:checked]:border-pink-500 has-[:checked]:bg-pink-50">
                                    <input type="radio" name="main_goal" value="{{ $goal }}"
                                        class="w-5 h-5 text-pink-600 border-slate-300 focus:ring-pink-500"
                                        {{ old('main_goal') === $goal ? 'checked' : '' }}>
                                    <span class="text-sm text-gray-700">{{ $goal }}</span>
                                </label>
                            @endforeach
                        </div>
                        <p class="text-xs text-slate-500 mt-2">¿Hay otro objetivo? Escribilo en el campo de abajo.</p>
                        <input type="text" name="main_goal_other" placeholder="Otro objetivo..."
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-pink-500 focus:ring-0 transition-colors text-gray-900 mt-2"
                            value="{{ old('main_goal_other') }}">
                    </div>
                    @error('main_goal')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="first_impression" class="block text-sm font-semibold text-gray-700 mb-2">¿Qué es lo primero que te gustaría que una persona entendiera al entrar a tu página?</label>
                    <textarea name="first_impression" id="first_impression" rows="3" required
                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-pink-500 focus:ring-0 transition-colors text-gray-900 resize-none"
                        placeholder="Ejemplo: Que soy un negocio familiar de confianza que lleva 15 años en la comunidad, y que mis productos son de alta calidad.">{{ old('first_impression') }}</textarea>
                    @error('first_impression')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        {{-- Sección 5: Servicio a promocionar --}}
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-pink-100 text-pink-600 rounded-xl flex items-center justify-center font-bold">5</div>
                <h2 class="text-2xl font-bold text-gray-900">Producto o Servicio Destacado</h2>
            </div>

            <div>
                <label for="promoted_service" class="block text-sm font-semibold text-gray-700 mb-2">¿Hay algún producto o servicio que te interese promocionar especialmente?</label>
                <textarea name="promoted_service" id="promoted_service" rows="3" required
                    class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-pink-500 focus:ring-0 transition-colors text-gray-900 resize-none"
                    placeholder="Ejemplo: Promocionar mi menú de desayunos, que tiene los precios más accesibles de mi zona y es lo que más me genera ingresos.">{{ old('promoted_service') }}</textarea>
                @error('promoted_service')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                <p class="text-xs text-slate-500 mt-2">Si hay un producto o servicio que sea más importante o rentable para tu negocio, contame cuál.</p>
            </div>
        </div>

        {{-- Botón de envío --}}
        <div class="text-center">
            <button type="submit"
                class="bg-gradient-to-r from-pink-600 to-purple-600 hover:from-pink-700 hover:to-purple-700 text-white px-12 py-4 rounded-xl font-bold text-lg transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:scale-95 inline-flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
                Enviar Mi Información
            </button>
            <p class="text-sm text-gray-500 mt-4">Con esta información puedo preparar una estrategia de marketing para tu negocio</p>
        </div>
    </form>
</section>
@endsection
