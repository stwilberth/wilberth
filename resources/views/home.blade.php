@extends('layouts.app')

@section('title', 'Wilberth - Desarrollo Web para Emprendedores')

@section('content')
<style>
    .slider-container {
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(30, 41, 59, 0.15);
        max-width: 64rem;
        margin-left: auto;
        margin-right: auto;
        height: calc(100vh - 80px);
        min-height: 400px;
    }
    .slider-track {
        display: flex;
        transition: transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        height: 100%;
    }
    .slider-slide {
        min-width: 100%;
        position: relative;
        height: 100%;
        display: flex;
        align-items: center;
    }
    .slider-dot.active {
        background: white;
        width: 2rem;
        border-radius: 9999px;
    }
</style>

<div class="slider-container mx-auto" id="hero-slider">
    <div class="slider-track" id="slider-track">
        <div class="slider-slide">
            <div class="absolute inset-0">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-950 via-slate-900 to-indigo-900 z-10"></div>
                <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-30 mix-blend-overlay z-10"></div>
            </div>
            <div class="absolute -top-16 md:-top-24 -right-16 md:-right-24 w-48 md:w-64 h-48 md:h-64 bg-indigo-500/20 rounded-full blur-2xl md:blur-3xl animate-pulse"></div>
            <div class="absolute -bottom-16 md:-bottom-24 -left-16 md:-left-24 w-48 md:w-64 h-48 md:h-64 bg-blue-500/10 rounded-full blur-2xl md:blur-3xl animate-pulse"></div>
            <div class="relative z-20 py-12 md:py-16 px-6 text-center max-w-4xl mx-auto">
                <span class="inline-block px-4 py-1.5 mb-6 text-xs font-bold tracking-[0.2em] uppercase text-indigo-300 bg-indigo-500/10 backdrop-blur-sm border border-indigo-400/20 rounded-full">Presencia Digital</span>
                <h2 class="text-4xl md:text-7xl font-black mb-4 md:mb-8 tracking-tighter text-white leading-[1.1]">
                    Páginas Web & <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-blue-300">Apps Web</span>
                    para Emprendedores
                </h2>
                <p class="text-lg md:text-2xl text-slate-300 mb-8 md:mb-12 max-w-2xl mx-auto font-light leading-relaxed">
                    Creación de sitios web, aplicaciones web y tiendas en línea modernas para emprendedores. Lleva tu negocio al mundo digital.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="/paginas-web" class="group bg-indigo-500 text-white px-8 md:px-10 py-3 md:py-4 rounded-2xl font-bold transition-all hover:bg-indigo-400 hover:shadow-[0_0_30px_rgba(99,102,241,0.4)] hover:-translate-y-1 flex items-center gap-2 text-sm md:text-base">
                        Explorar Servicios
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="/proyectos" class="px-8 md:px-10 py-3 md:py-4 text-white font-bold bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl hover:bg-white/10 transition-all hover:border-white/20 text-sm md:text-base">
                        Ver Proyectos
                    </a>
                </div>
            </div>
        </div>

        <div class="slider-slide">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-950 via-slate-950 to-indigo-900"></div>
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 mix-blend-overlay"></div>
            <div class="absolute -top-16 md:-top-24 -right-16 md:-right-24 w-48 md:w-64 h-48 md:h-64 bg-emerald-500/10 rounded-full blur-2xl md:blur-3xl animate-pulse"></div>
            <div class="absolute -bottom-16 md:-bottom-24 -left-16 md:-left-24 w-48 md:w-64 h-48 md:h-64 bg-indigo-500/10 rounded-full blur-2xl md:blur-3xl animate-pulse"></div>
            <div class="relative z-10 py-12 md:py-16 px-6 max-w-5xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-8 md:gap-16 items-center">
                    <div>
                        <span class="inline-block px-4 py-1.5 mb-6 text-xs font-bold tracking-[0.2em] uppercase text-emerald-300 bg-emerald-500/10 backdrop-blur-sm border border-emerald-400/20 rounded-full">Contacto</span>
                        <h2 class="text-3xl md:text-6xl font-black text-white mb-4 md:mb-6 tracking-tighter leading-tight">
                            ¿Hablamos de su <span class="text-indigo-400">próximo</span> proyecto?
                        </h2>
                        <p class="text-base md:text-xl text-slate-300 mb-6 md:mb-8 font-light leading-relaxed">
                            Le responderemos en menos de 24 horas. Estamos listos para llevar su negocio o propiedad al siguiente nivel.
                        </p>
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-14 h-14 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-center shadow-xl">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-white font-bold">Vendedor Principal</h4>
                                <p class="text-slate-400 text-sm">{{ $seller->name }}</p>
                            </div>
                        </div>
                        <a href="https://wa.me/50685008393" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-3 bg-emerald-500 hover:bg-emerald-600 text-white px-6 md:px-8 py-3 md:py-4 rounded-2xl font-bold transition-all shadow-xl hover:shadow-emerald-500/30 hover:-translate-y-1 active:scale-95">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            Abrir Chat Ahora
                        </a>
                    </div>
                    <div class="hidden lg:block">
                        <div class="bg-white/5 backdrop-blur-xl border border-white/10 p-10 rounded-[2.5rem] text-center shadow-2xl relative overflow-hidden group">
                            <div class="absolute -top-12 -right-12 w-48 h-48 bg-emerald-500/10 rounded-full blur-2xl group-hover:bg-emerald-500/20 transition-all"></div>
                            <div class="w-20 h-20 bg-emerald-500 text-white rounded-[2rem] flex items-center justify-center mx-auto mb-6 shadow-2xl shadow-emerald-500/30 transform group-hover:scale-110 transition-transform duration-500">
                                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            </div>
                            <h3 class="text-2xl font-black text-white mb-2">Respuesta Rápida</h3>
                            <p class="text-slate-400 text-sm">Le respondemos en menos de 24 horas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-30 flex gap-3">
        <button class="slider-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white/80 transition-all cursor-pointer" data-slide="0" aria-label="Slide 1"></button>
        <button class="slider-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white/80 transition-all cursor-pointer" data-slide="1" aria-label="Slide 2"></button>
    </div>
</div>

@push('scripts')
<script>
    const track = document.getElementById("slider-track");
    const dots = document.querySelectorAll(".slider-dot");
    let current = 0;
    const total = dots.length;

    function goToSlide(index) {
        if (index < 0 || index >= total) return;
        current = index;
        track.style.transform = `translateX(-${current * 100}%)`;
        dots.forEach((dot, i) => {
            dot.classList.toggle("active", i === current);
        });
    }

    dots.forEach((dot) => {
        dot.addEventListener("click", () => {
            goToSlide(parseInt(dot.dataset.slide));
        });
    });

    setInterval(() => {
        goToSlide((current + 1) % total);
    }, 6000);

    goToSlide(0);
</script>
@endpush
@endsection
