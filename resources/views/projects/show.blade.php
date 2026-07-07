@php
    $colorMap = [
        'leiva-tours' => ['badge' => 'bg-emerald-500/10 text-emerald-300 border-emerald-400/20', 'text' => 'text-emerald-400', 'ring' => 'ring-emerald-500/30', 'btn' => 'bg-emerald-600 hover:bg-emerald-700'],
        'rancho-raices' => ['badge' => 'bg-amber-500/10 text-amber-300 border-amber-400/20', 'text' => 'text-amber-400', 'ring' => 'ring-amber-500/30', 'btn' => 'bg-amber-600 hover:bg-amber-700'],
        'invicta-costa-rica' => ['badge' => 'bg-indigo-500/10 text-indigo-300 border-indigo-400/20', 'text' => 'text-indigo-400', 'ring' => 'ring-indigo-500/30', 'btn' => 'bg-indigo-600 hover:bg-indigo-700'],
        'variedades-cr' => ['badge' => 'bg-pink-500/10 text-pink-300 border-pink-400/20', 'text' => 'text-pink-400', 'ring' => 'ring-pink-500/30', 'btn' => 'bg-pink-600 hover:bg-pink-700'],
        'osa-fishing-pro-cr' => ['badge' => 'bg-sky-500/10 text-sky-300 border-sky-400/20', 'text' => 'text-sky-400', 'ring' => 'ring-sky-500/30', 'btn' => 'bg-sky-600 hover:bg-sky-700'],
        'osa-tours-and-travel' => ['badge' => 'bg-violet-500/10 text-violet-300 border-violet-400/20', 'text' => 'text-violet-400', 'ring' => 'ring-violet-500/30', 'btn' => 'bg-violet-600 hover:bg-violet-700'],
    ];
    $c = $colorMap[$project->slug] ?? $colorMap['leiva-tours'];
@endphp

@extends('layouts.app')

@section('title', $title)

@section('content')
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-32">
    <section class="relative mt-8 mb-16 rounded-[3rem] overflow-hidden shadow-[0_20px_50px_rgba(30,41,59,0.15)]">
        <div class="h-[50vh] min-h-[400px] w-full bg-slate-900"
             style="background-image: url('{{ $project->cover_path }}'); background-size: cover; background-position: top;">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/60 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/40 to-transparent"></div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 z-10 p-8 md:p-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <span class="inline-block px-4 py-1.5 mb-4 text-xs font-bold tracking-[0.2em] uppercase rounded-full border {{ $c['badge'] }}">
                        {{ $project->category }}
                    </span>
                    <h1 class="text-4xl md:text-6xl font-black text-white tracking-tight leading-tight">{{ $project->name }}</h1>
                </div>
                <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 px-8 py-4 bg-white text-slate-900 rounded-2xl font-bold hover:bg-indigo-500 hover:text-white transition-all shadow-xl active:scale-95 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Visitar sitio web
                </a>
            </div>
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 px-4">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-[2rem] p-8 md:p-12 shadow-[0_10px_30px_rgba(0,0,0,0.02)] border border-slate-100">
                <h2 class="text-3xl font-black text-slate-900 mb-6 tracking-tight">Acerca de este proyecto</h2>
                <p class="text-slate-600 text-lg leading-relaxed">{{ $project->description }}</p>
                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-white transition-all hover:shadow-xl active:scale-95 {{ $c['btn'] }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        Abrir {{ $project->name }}
                    </a>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-slate-900 rounded-[2rem] p-8 text-center shadow-xl relative overflow-hidden group">
                <div class="absolute -top-12 -right-12 w-48 h-48 bg-emerald-500/10 rounded-full blur-2xl group-hover:bg-emerald-500/20 transition-all"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-emerald-500 text-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">¿Quieres un sitio así?</h3>
                    <p class="text-slate-400 text-sm mb-6">Contáctame y creemos tu proyecto web</p>
                    <a href="https://wa.me/50685008393?text=Hola! Me gustaría un sitio web como {{ $project->name }}" target="_blank" rel="noopener noreferrer"
                       class="inline-block w-full py-4 bg-white text-slate-900 rounded-2xl font-bold hover:bg-indigo-500 hover:text-white transition-all shadow-xl active:scale-95">
                        Consultar por WhatsApp
                    </a>
                </div>
            </div>
            <a href="/proyectos" class="flex items-center justify-center gap-2 w-full py-4 bg-white border border-slate-200 rounded-2xl font-bold text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-all active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Volver al portafolio
            </a>
        </div>
    </div>
</main>
@endsection
