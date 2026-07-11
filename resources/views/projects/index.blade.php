@php
    $colorMap = [
        'leiva-tours' => ['from' => 'from-emerald-950', 'via' => 'via-emerald-950/40', 'to' => 'to-transparent', 'hover' => 'bg-emerald-600', 'icon' => 'text-emerald-300', 'text' => 'text-emerald-200'],
        'rancho-raices' => ['from' => 'from-amber-950', 'via' => 'via-amber-950/40', 'to' => 'to-transparent', 'hover' => 'bg-amber-600', 'icon' => 'text-amber-300', 'text' => 'text-amber-200'],
        'invicta-costa-rica' => ['from' => 'from-indigo-950', 'via' => 'via-indigo-950/40', 'to' => 'to-transparent', 'hover' => 'bg-indigo-600', 'icon' => 'text-indigo-300', 'text' => 'text-indigo-200'],
        'variedades-cr' => ['from' => 'from-pink-950', 'via' => 'via-pink-950/40', 'to' => 'to-transparent', 'hover' => 'bg-pink-600', 'icon' => 'text-pink-300', 'text' => 'text-pink-200'],
        'osa-fishing-pro-cr' => ['from' => 'from-sky-950', 'via' => 'via-sky-950/40', 'to' => 'to-transparent', 'hover' => 'bg-sky-600', 'icon' => 'text-sky-300', 'text' => 'text-sky-200'],
        'osa-tours-and-travel' => ['from' => 'from-violet-950', 'via' => 'via-violet-950/40', 'to' => 'to-transparent', 'hover' => 'bg-violet-600', 'icon' => 'text-violet-300', 'text' => 'text-violet-200'],
    ];
@endphp

@extends('layouts.app')

@section('title', $title)

@section('content')
<section class="bg-gradient-to-r from-indigo-600 to-indigo-800 text-white py-16 mb-12">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Proyectos Realizados</h1>
        <p class="text-xl text-indigo-100 max-w-2xl mx-auto">Sitios web que he creado para emprendedores y negocios en Costa Rica.</p>
    </div>
</section>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-32">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 px-4">
        @foreach ($projects as $project)
            @php $c = $colorMap[$project->slug] ?? $colorMap['leiva-tours']; @endphp
            <a href="/portafolio/{{ $project->slug }}" class="group relative h-72 rounded-[2.5rem] overflow-hidden bg-slate-900 shadow-2xl transition-all duration-500 hover:-translate-y-2"
               style="background-image: url('{{ $project->cover_path }}'); background-size: cover; background-position: top;">
                <div class="absolute inset-0 bg-gradient-to-t {{ $c['from'] }} {{ $c['via'] }} {{ $c['to'] }} z-10"></div>
                <div class="absolute inset-0 {{ $c['hover'] }} opacity-0 group-hover:opacity-20 transition-opacity duration-500 z-10"></div>
                <div class="absolute inset-0 flex items-center justify-center opacity-30 group-hover:scale-110 transition-transform duration-700">
                    <svg class="w-48 h-48 {{ $c['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5" d="{{ $project->svg_path }}"/>
                    </svg>
                </div>
                <div class="absolute inset-0 z-20 p-8 flex flex-col justify-end">
                    <h3 class="text-2xl font-black text-white tracking-tight mb-1">{{ $project->name }}</h3>
                    <p class="text-sm font-medium {{ $c['text'] }}">{{ $project->category }}</p>
                </div>
            </a>
        @endforeach
    </div>
</main>
@endsection
