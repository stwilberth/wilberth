@extends('layouts.app')

@section('title', 'Formulario de Proyecto - Cuéntame Sobre Tu Negocio - Wilberth')

@section('content')
<section class="bg-gradient-to-r from-indigo-600 to-indigo-800 text-white py-16 mb-12">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Cuéntame Sobre Tu Negocio</h1>
        <p class="text-xl text-indigo-100 max-w-2xl mx-auto">Con esta información puedo empezar a crear tu página web. No te preocupes por los detalles técnicos, yo me encargo de eso.</p>
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

    <form action="{{ route('brief.store') }}" method="POST" class="space-y-10" id="brief-form">
        @csrf
        <input type="hidden" name="brief_link_token" value="{{ $link->token ?? '' }}">

        {{-- Sección 1: Sobre tu negocio --}}
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center font-bold">1</div>
                <h2 class="text-2xl font-bold text-gray-900">Sobre Tu Negocio</h2>
            </div>

            <div class="space-y-5">
                <div>
                    <label for="business_name" class="block text-sm font-semibold text-gray-700 mb-2">¿Cómo se llama tu negocio o empresa?</label>
                    <input type="text" name="business_name" id="business_name" required
                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors text-gray-900"
                        placeholder="Ejemplo: Cafetería El Buen Sabor" value="{{ old('business_name') }}">
                    @error('business_name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="business_type" class="block text-sm font-semibold text-gray-700 mb-2">¿Qué tipo de negocio es?</label>
                    <input type="text" name="business_type" id="business_type" required
                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors text-gray-900"
                        placeholder="Ejemplo: Restaurante, tienda de ropa, consultoría, salón de belleza..." value="{{ old('business_type') }}">
                    @error('business_type')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="business_description" class="block text-sm font-semibold text-gray-700 mb-2">¿Qué vendés o qué servicio ofrecés? (Describilo con tus propias palabras)</label>
                    <textarea name="business_description" id="business_description" rows="4" required
                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors text-gray-900 resize-none"
                        placeholder="Ejemplo: Vendemos café de especialidad y postres artesanales. Abrimos de lunes a sábado de 7am a 5pm. Nos destacamos por usar granos de Costa Rica...">{{ old('business_description') }}</textarea>
                    @error('business_description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="location" class="block text-sm font-semibold text-gray-700 mb-2">¿Dónde está ubicado tu negocio?</label>
                    <input type="text" name="location" id="location"
                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors text-gray-900"
                        placeholder="Ejemplo: San José, Costa Rica o un link de Google Maps" value="{{ old('location') }}">
                    @error('location')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        {{-- Sección 2: Datos de contacto --}}
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center font-bold">2</div>
                <h2 class="text-2xl font-bold text-gray-900">Tus Datos de Contacto</h2>
            </div>

            <div class="space-y-5">
                <div>
                    <label for="contact_name" class="block text-sm font-semibold text-gray-700 mb-2">¿Cómo te llamas?</label>
                    <input type="text" name="contact_name" id="contact_name" required
                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors text-gray-900"
                        placeholder="Tu nombre completo" value="{{ old('contact_name') }}">
                    @error('contact_name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Correo electrónico</label>
                        <input type="email" name="email" id="email" required
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors text-gray-900"
                            placeholder="tu@email.com" value="{{ old('email') }}">
                        @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Teléfono o WhatsApp</label>
                        <input type="text" name="phone" id="phone" required
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors text-gray-900"
                            placeholder="Ejemplo: 85008393" value="{{ old('phone') }}">
                        @error('phone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Sección 3: Tu página web --}}
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center font-bold">3</div>
                <h2 class="text-2xl font-bold text-gray-900">Tu Página Web</h2>
            </div>

            <div class="space-y-5">
                <div>
                    <label for="pages_needed" class="block text-sm font-semibold text-gray-700 mb-2">¿Qué información querés que aparezca en tu página? (Seleccioná todo lo que aplique)</label>
                    <div class="grid sm:grid-cols-2 gap-3 mt-3">
                        @php
                            $pages = [
                                'Inicio (la página principal)',
                                'Qué hacemos / Nuestros servicios',
                                'Sobre nosotros / Nuestra historia',
                                'Galería de fotos',
                                'Lista de precios o menú',
                                'Testimonios de clientes',
                                'Formulario de contacto',
                                'Ubicación con mapa',
                                'Blog o noticias',
                                'Tienda en línea / Catálogo',
                                'Reservaciones en línea',
                                'Redes sociales',
                            ];
                        @endphp
                        @foreach ($pages as $page)
                            <label class="flex items-center gap-3 p-3 border-2 border-slate-200 rounded-xl hover:border-indigo-300 hover:bg-indigo-50/50 cursor-pointer transition-all has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50">
                                <input type="checkbox" name="pages_needed[]" value="{{ $page }}"
                                    class="w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500"
                                    {{ in_array($page, old('pages_needed', [])) ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700">{{ $page }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('pages_needed')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="extra_features" class="block text-sm font-semibold text-gray-700 mb-2">¿Hay algo más que quieras en tu página que no esté en la lista?</label>
                    <textarea name="extra_features" id="extra_features" rows="3"
                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors text-gray-900 resize-none"
                        placeholder="Ejemplo: Quiero un botón de WhatsApp, quiero que se vea bien en el celular, quiero poder actualizar los precios yo mismo...">{{ old('extra_features') }}</textarea>
                    @error('extra_features')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        {{-- Sección 4: Contenido --}}
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center font-bold">4</div>
                <h2 class="text-2xl font-bold text-gray-900">Tus Contenido (Textos e Imágenes)</h2>
            </div>

            <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-amber-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm text-amber-800"><strong>No tenés que tener todo listo ahora.</strong> Si ya tenés textos e imágenes, perfecto. Si no, podemos trabajar juntos para crearlos.</p>
                </div>
            </div>

            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">¿Qué tenés disponible ahora?</label>
                    <div class="space-y-3">
                        @php
                            $content = [
                                'Logo de mi negocio',
                                'Fotos de mis productos o servicios',
                                'Textos ya escritos para la página',
                                'Colores que quiero usar en la página',
                                'Ninguno de estos, necesito ayuda',
                            ];
                        @endphp
                        @foreach ($content as $item)
                            <label class="flex items-center gap-3 p-3 border-2 border-slate-200 rounded-xl hover:border-indigo-300 hover:bg-indigo-50/50 cursor-pointer transition-all has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50">
                                <input type="checkbox" name="content_available[]" value="{{ $item }}"
                                    class="w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500"
                                    {{ in_array($item, old('content_available', [])) ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700">{{ $item }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('content_available')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="brand_colors" class="block text-sm font-semibold text-gray-700 mb-2">¿Tenés colores en mente para tu página? (Opcional)</label>
                    <input type="text" name="brand_colors" id="brand_colors"
                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors text-gray-900"
                        placeholder="Ejemplo: Verde y blanco, o los colores de mi logo, o no sé" value="{{ old('brand_colors') }}">
                    @error('brand_colors')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="website_examples" class="block text-sm font-semibold text-gray-700 mb-2">¿Hay páginas web que te gusten? (Opcional)</label>
                    <textarea name="website_examples" id="website_examples" rows="2"
                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors text-gray-900 resize-none"
                        placeholder="Si conoces alguna página que te guste el diseño, pegá el link aquí. Si no, no pasa nada.">{{ old('website_examples') }}</textarea>
                    @error('website_examples')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        {{-- Sección 5: Presupuesto y Tiempo --}}
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center font-bold">5</div>
                <h2 class="text-2xl font-bold text-gray-900">Presupuesto y Tiempo</h2>
            </div>

            <div class="space-y-5">
                <div>
                    <label for="budget" class="block text-sm font-semibold text-gray-700 mb-2">¿Cuánto pensás invertir en tu página web?</label>
                    <select name="budget" id="budget"
                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors text-gray-900 bg-white">
                        <option value="">Seleccioná un rango</option>
                        <option value="Menos de ₡100,000" {{ old('budget') === 'Menos de ₡100,000' ? 'selected' : '' }}>Menos de ₡100,000</option>
                        <option value="₡100,000 - ₡200,000" {{ old('budget') === '₡100,000 - ₡200,000' ? 'selected' : '' }}>₡100,000 - ₡200,000</option>
                        <option value="₡200,000 - ₡500,000" {{ old('budget') === '₡200,000 - ₡500,000' ? 'selected' : '' }}>₡200,000 - ₡500,000</option>
                        <option value="Más de ₡500,000" {{ old('budget') === 'Más de ₡500,000' ? 'selected' : '' }}>Más de ₡500,000</option>
                        <option value="No sé, quiero información" {{ old('budget') === 'No sé, quiero información' ? 'selected' : '' }}>No sé, quiero información</option>
                    </select>
                    @error('budget')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="timeline" class="block text-sm font-semibold text-gray-700 mb-2">¿Para cuándo la necesitás?</label>
                    <select name="timeline" id="timeline"
                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors text-gray-900 bg-white">
                        <option value="">Seleccioná un plazo</option>
                        <option value="Lo antes posible" {{ old('timeline') === 'Lo antes posible' ? 'selected' : '' }}>Lo antes posible</option>
                        <option value="En 2-3 semanas" {{ old('timeline') === 'En 2-3 semanas' ? 'selected' : '' }}>En 2-3 semanas</option>
                        <option value="En 1-2 meses" {{ old('timeline') === 'En 1-2 meses' ? 'selected' : '' }}>En 1-2 meses</option>
                        <option value="No tengo prisa" {{ old('timeline') === 'No tengo prisa' ? 'selected' : '' }}>No tengo prisa</option>
                    </select>
                    @error('timeline')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        {{-- Sección 6: Información adicional --}}
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center font-bold">6</div>
                <h2 class="text-2xl font-bold text-gray-900">Información Adicional</h2>
            </div>

            <div class="space-y-5">
                <div>
                    <label for="competitors" class="block text-sm font-semibold text-gray-700 mb-2">¿Tenés competidores? Si es así, ¿cuáles? (Opcional)</label>
                    <textarea name="competitors" id="competitors" rows="2"
                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors text-gray-900 resize-none"
                        placeholder="Ejemplo: La cafetería de al lado, o negocios similares en Instagram...">{{ old('competitors') }}</textarea>
                    @error('competitors')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="special_notes" class="block text-sm font-semibold text-gray-700 mb-2">¿Hay algo más que quieras contarme sobre tu negocio o tu página web?</label>
                    <textarea name="special_notes" id="special_notes" rows="4"
                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors text-gray-900 resize-none"
                        placeholder="Contame lo que sea, aquí podés escribir libremente.">{{ old('special_notes') }}</textarea>
                    @error('special_notes')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        {{-- Botón de envío --}}
        <div class="text-center">
            <button type="submit"
                class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-12 py-4 rounded-xl font-bold text-lg transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:scale-95 inline-flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
                Enviar Mi Información
            </button>
            <p class="text-sm text-gray-500 mt-4">Con esta información puedo preparar una cotización para tu proyecto</p>
        </div>
    </form>
</section>
@endsection
