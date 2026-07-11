@extends('layouts.app')

@section('title', 'Diseñá tu Camiseta Online - Wilberth')

@section('content')
<!-- Google Fonts Import for customization fonts -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&family=Pacifico&family=Playfair+Display:ital,wght@0,600;1,400&family=Bebas+Neue&family=Outfit:wght@400;600;800&display=swap" rel="stylesheet">

<section class="bg-gradient-to-r from-indigo-700 via-indigo-800 to-slate-900 text-white py-16 mb-12 relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(99,102,241,0.15),transparent_40%)]"></div>
    <div class="max-w-7xl mx-auto text-center px-4 relative z-10">
        <span class="bg-indigo-500/20 text-indigo-300 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest border border-indigo-500/30">Demo Interactiva Premium</span>
        <h1 class="text-4xl md:text-6xl font-black mb-4 tracking-tight mt-3">Estudio de Diseño de Camisetas</h1>
        <p class="text-lg md:text-xl text-indigo-200 max-w-2xl mx-auto font-light">Subí tu arte, añadí texto, elegí colores y texturas de tela realistas. Arrastrá y personalizá libremente en tiempo real.</p>
    </div>
</section>

<section class="mb-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid lg:grid-cols-12 gap-8 items-start">
        
        <!-- COLUMNA IZQUIERDA: PREVIEW DE LA CAMISETA -->
        <div class="lg:col-span-7 flex flex-col gap-4">
            
            <!-- CONTENEDOR DEL ESTUDIO / T-SHIRT -->
            <div class="relative bg-slate-950 overflow-hidden rounded-2xl flex items-center justify-center border border-slate-800 shadow-2xl p-6 select-none" style="min-height: 560px;" id="studio-backdrop">
                <!-- Ambient light effect behind the shirt -->
                <div class="absolute w-[350px] h-[350px] rounded-full transition-colors duration-500 blur-[80px]" id="ambient-glow" style="background-color: rgba(99, 102, 241, 0.12)"></div>
                
                <!-- Studio Grid Pattern -->
                <div class="absolute inset-0 bg-[radial-gradient(#ffffff05_1px,transparent_1px)] [background-size:20px_20px] pointer-events-none"></div>
                
                <!-- Floating Studio Badge -->
                <div class="absolute top-4 left-4 bg-slate-900/90 backdrop-blur-md px-3.5 py-2 rounded-full border border-white/5 flex items-center gap-2 shadow-xl pointer-events-none">
                    <span class="w-2.5 h-2.5 rounded-full bg-indigo-500 animate-pulse"></span>
                    <span class="text-[10px] tracking-wider text-slate-300 font-bold uppercase">Estudio en Vivo</span>
                </div>

                <!-- Active View/Layer Indicator -->
                <div class="absolute top-4 right-4 bg-slate-900/90 backdrop-blur-md px-3.5 py-2 rounded-full border border-white/5 shadow-xl pointer-events-none">
                    <span class="text-[10px] tracking-wider text-indigo-400 font-bold uppercase" id="view-indicator">Vista: Frente</span>
                </div>

                <!-- Bounding Help Label (only visible when element selected) -->
                <div id="selection-help" class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-indigo-600/95 text-white px-4 py-1.5 rounded-full text-xs font-semibold shadow-lg backdrop-blur-sm pointer-events-none opacity-0 transition-opacity duration-300">
                    Arrastrá para mover · Usá <span class="bg-indigo-800 px-1.5 py-0.5 rounded font-bold">↵</span> para escalar y rotar
                </div>
                
                <!-- T-SHIRT CARD WITH 3D TILT EFFECT -->
                <div id="preview-container" class="relative w-[400px] h-[500px] select-none" style="transform-style: preserve-3d; perspective: 1000px; transform: perspective(1000px) rotateX(0deg) rotateY(0deg);">
                    
                    <!-- BASE LAYER SVG: T-shirt Shape & Fabric Weave (z-0) -->
                    <div class="absolute inset-0 z-0">
                        <svg id="tshirt-base-svg" viewBox="0 0 500 500" class="w-full h-full">
                          <defs>
                            <pattern id="pat-cotton" width="6" height="6" patternUnits="userSpaceOnUse">
                              <path d="M 0 3 L 6 3 M 3 0 L 3 6" stroke="rgba(0,0,0,0.06)" stroke-width="0.8" />
                            </pattern>
                            <pattern id="pat-polyester" width="4" height="4" patternTransform="rotate(30)" patternUnits="userSpaceOnUse">
                              <line x1="0" y1="0" x2="0" y2="4" stroke="rgba(0,0,0,0.08)" stroke-width="0.8" />
                            </pattern>
                            <filter id="filt-heather">
                              <feTurbulence type="fractalNoise" baseFrequency="0.65" numOctaves="3" result="noise" />
                              <feColorMatrix type="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 0.12 0" />
                              <feComposite operator="in" in2="SourceGraphic" />
                            </filter>
                          </defs>

                          <!-- Front Short Sleeve Base -->
                          
  <!-- FRONT SHORT SLEEVE REGULAR BASE -->
  <g id="base-front-short-regular" class="base-group">
    <path class="tshirt-fill" d="M 180 60 C 215 85, 285 85, 320 60 L 390 90 L 415 155 L 365 175 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 135 175 L 85 155 L 110 90 Z" fill="#ffffff" />
    <path class="tshirt-texture cotton" d="M 180 60 C 215 85, 285 85, 320 60 L 390 90 L 415 155 L 365 175 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 135 175 L 85 155 L 110 90 Z" fill="url(#pat-cotton)" />
    <path class="tshirt-texture polyester hidden" d="M 180 60 C 215 85, 285 85, 320 60 L 390 90 L 415 155 L 365 175 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 135 175 L 85 155 L 110 90 Z" fill="url(#pat-polyester)" />
    <path class="tshirt-texture heather hidden" d="M 180 60 C 215 85, 285 85, 320 60 L 390 90 L 415 155 L 365 175 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 135 175 L 85 155 L 110 90 Z" fill="#6b7280" filter="url(#filt-heather)" style="mix-blend-mode: overlay;" />
    <!-- Inside collar area -->
    <path d="M 180 60 C 215 85, 285 85, 320 60 C 285 52, 215 52, 180 60 Z" fill="rgba(0,0,0,0.18)" />
  </g>

  <!-- FRONT LONG SLEEVE REGULAR BASE -->
  <g id="base-front-long-regular" class="base-group hidden">
    <path class="tshirt-fill" d="M 180 60 C 215 85, 285 85, 320 60 L 390 90 L 415 155 L 385 360 L 350 360 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 150 360 L 115 360 L 85 155 L 110 90 Z" fill="#ffffff" />
    <path class="tshirt-texture cotton" d="M 180 60 C 215 85, 285 85, 320 60 L 390 90 L 415 155 L 385 360 L 350 360 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 150 360 L 115 360 L 85 155 L 110 90 Z" fill="url(#pat-cotton)" />
    <path class="tshirt-texture polyester hidden" d="M 180 60 C 215 85, 285 85, 320 60 L 390 90 L 415 155 L 385 360 L 350 360 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 150 360 L 115 360 L 85 155 L 110 90 Z" fill="url(#pat-polyester)" />
    <path class="tshirt-texture heather hidden" d="M 180 60 C 215 85, 285 85, 320 60 L 390 90 L 415 155 L 385 360 L 350 360 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 150 360 L 115 360 L 85 155 L 110 90 Z" fill="#6b7280" filter="url(#filt-heather)" style="mix-blend-mode: overlay;" />
    <!-- Inside collar area -->
    <path d="M 180 60 C 215 85, 285 85, 320 60 C 285 52, 215 52, 180 60 Z" fill="rgba(0,0,0,0.18)" />
  </g>

  <!-- BACK SHORT SLEEVE REGULAR BASE -->
  <g id="base-back-short-regular" class="base-group hidden">
    <path class="tshirt-fill" d="M 180 60 C 215 50, 285 50, 320 60 L 390 90 L 415 155 L 365 175 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 135 175 L 85 155 L 110 90 Z" fill="#ffffff" />
    <path class="tshirt-texture cotton" d="M 180 60 C 215 50, 285 50, 320 60 L 390 90 L 415 155 L 365 175 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 135 175 L 85 155 L 110 90 Z" fill="url(#pat-cotton)" />
    <path class="tshirt-texture polyester hidden" d="M 180 60 C 215 50, 285 50, 320 60 L 390 90 L 415 155 L 365 175 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 135 175 L 85 155 L 110 90 Z" fill="url(#pat-polyester)" />
    <path class="tshirt-texture heather hidden" d="M 180 60 C 215 50, 285 50, 320 60 L 390 90 L 415 155 L 365 175 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 135 175 L 85 155 L 110 90 Z" fill="#6b7280" filter="url(#filt-heather)" style="mix-blend-mode: overlay;" />
  </g>

  <!-- BACK LONG SLEEVE REGULAR BASE -->
  <g id="base-back-long-regular" class="base-group hidden">
    <path class="tshirt-fill" d="M 180 60 C 215 50, 285 50, 320 60 L 390 90 L 415 155 L 385 360 L 350 360 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 150 360 L 115 360 L 85 155 L 110 90 Z" fill="#ffffff" />
    <path class="tshirt-texture cotton" d="M 180 60 C 215 50, 285 50, 320 60 L 390 90 L 415 155 L 385 360 L 350 360 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 150 360 L 115 360 L 85 155 L 110 90 Z" fill="url(#pat-cotton)" />
    <path class="tshirt-texture polyester hidden" d="M 180 60 C 215 50, 285 50, 320 60 L 390 90 L 415 155 L 385 360 L 350 360 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 150 360 L 115 360 L 85 155 L 110 90 Z" fill="url(#pat-polyester)" />
    <path class="tshirt-texture heather hidden" d="M 180 60 C 215 50, 285 50, 320 60 L 390 90 L 415 155 L 385 360 L 350 360 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 150 360 L 115 360 L 85 155 L 110 90 Z" fill="#6b7280" filter="url(#filt-heather)" style="mix-blend-mode: overlay;" />
  </g>

  <!-- FRONT SHORT SLEEVE MUJER BASE -->
  <g id="base-front-short-mujer" class="base-group hidden">
    <path class="tshirt-fill" d="M 175 65 C 210 90, 290 90, 325 65 L 380 90 L 395 135 L 355 155 L 350 160 C 335 240, 335 340, 345 440 C 345 450, 335 460, 315 460 L 185 460 C 165 460, 155 450, 155 440 C 165 340, 165 240, 150 160 L 145 155 L 105 135 L 120 90 Z" fill="#ffffff" />
    <path class="tshirt-texture cotton" d="M 175 65 C 210 90, 290 90, 325 65 L 380 90 L 395 135 L 355 155 L 350 160 C 335 240, 335 340, 345 440 C 345 450, 335 460, 315 460 L 185 460 C 165 460, 155 450, 155 440 C 165 340, 165 240, 150 160 L 145 155 L 105 135 L 120 90 Z" fill="url(#pat-cotton)" />
    <path class="tshirt-texture polyester hidden" d="M 175 65 C 210 90, 290 90, 325 65 L 380 90 L 395 135 L 355 155 L 350 160 C 335 240, 335 340, 345 440 C 345 450, 335 460, 315 460 L 185 460 C 165 460, 155 450, 155 440 C 165 340, 165 240, 150 160 L 145 155 L 105 135 L 120 90 Z" fill="url(#pat-polyester)" />
    <path class="tshirt-texture heather hidden" d="M 175 65 C 210 90, 290 90, 325 65 L 380 90 L 395 135 L 355 155 L 350 160 C 335 240, 335 340, 345 440 C 345 450, 335 460, 315 460 L 185 460 C 165 460, 155 450, 155 440 C 165 340, 165 240, 150 160 L 145 155 L 105 135 L 120 90 Z" fill="#6b7280" filter="url(#filt-heather)" style="mix-blend-mode: overlay;" />
    <!-- Inside collar area -->
    <path d="M 175 65 C 210 90, 290 90, 325 65 C 290 55, 210 55, 175 65 Z" fill="rgba(0,0,0,0.18)" />
  </g>

  <!-- BACK SHORT SLEEVE MUJER BASE -->
  <g id="base-back-short-mujer" class="base-group hidden">
    <path class="tshirt-fill" d="M 175 65 C 210 55, 290 55, 325 65 L 380 90 L 395 135 L 355 155 L 350 160 C 335 240, 335 340, 345 440 C 345 450, 335 460, 315 460 L 185 460 C 165 460, 155 450, 155 440 C 165 340, 165 240, 150 160 L 145 155 L 105 135 L 120 90 Z" fill="#ffffff" />
    <path class="tshirt-texture cotton" d="M 175 65 C 210 55, 290 55, 325 65 L 380 90 L 395 135 L 355 155 L 350 160 C 335 240, 335 340, 345 440 C 345 450, 335 460, 315 460 L 185 460 C 165 460, 155 450, 155 440 C 165 340, 165 240, 150 160 L 145 155 L 105 135 L 120 90 Z" fill="url(#pat-cotton)" />
    <path class="tshirt-texture polyester hidden" d="M 175 65 C 210 55, 290 55, 325 65 L 380 90 L 395 135 L 355 155 L 350 160 C 335 240, 335 340, 345 440 C 345 450, 335 460, 315 460 L 185 460 C 165 460, 155 450, 155 440 C 165 340, 165 240, 150 160 L 145 155 L 105 135 L 120 90 Z" fill="url(#pat-polyester)" />
    <path class="tshirt-texture heather hidden" d="M 175 65 C 210 55, 290 55, 325 65 L 380 90 L 395 135 L 355 155 L 350 160 C 335 240, 335 340, 345 440 C 345 450, 335 460, 315 460 L 185 460 C 165 460, 155 450, 155 440 C 165 340, 165 240, 150 160 L 145 155 L 105 135 L 120 90 Z" fill="#6b7280" filter="url(#filt-heather)" style="mix-blend-mode: overlay;" />
  </g>

  <!-- FRONT SHORT SLEEVE POLO BASE -->
  <g id="base-front-short-polo" class="base-group hidden">
    <!-- Body and sleeves (similar to regular short sleeve) -->
    <path class="tshirt-fill" d="M 180 60 C 215 50, 285 50, 320 60 L 390 90 L 415 155 L 365 175 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 135 175 L 85 155 L 110 90 Z" fill="#ffffff" />
    <path class="tshirt-texture cotton" d="M 180 60 C 215 50, 285 50, 320 60 L 390 90 L 415 155 L 365 175 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 135 175 L 85 155 L 110 90 Z" fill="url(#pat-cotton)" />
    <path class="tshirt-texture polyester hidden" d="M 180 60 C 215 50, 285 50, 320 60 L 390 90 L 415 155 L 365 175 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 135 175 L 85 155 L 110 90 Z" fill="url(#pat-polyester)" />
    <path class="tshirt-texture heather hidden" d="M 180 60 C 215 50, 285 50, 320 60 L 390 90 L 415 155 L 365 175 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 135 175 L 85 155 L 110 90 Z" fill="#6b7280" filter="url(#filt-heather)" style="mix-blend-mode: overlay;" />
    
    <!-- Placket backdrop -->
    <path d="M 238 60 L 262 60 L 262 170 L 238 170 Z" fill="rgba(0,0,0,0.08)" />
    <path class="tshirt-fill" d="M 240 60 L 260 60 L 260 168 L 240 168 Z" fill="#ffffff" stroke="rgba(0,0,0,0.15)" stroke-width="1.5" />
    
    <!-- Collar Left Flap -->
    <path class="tshirt-fill" d="M 180 60 C 200 68, 235 85, 248 85 L 230 135 L 195 105 Z" fill="#ffffff" stroke="rgba(0,0,0,0.15)" stroke-width="1.5" />
    <!-- Collar Right Flap -->
    <path class="tshirt-fill" d="M 320 60 C 300 68, 265 85, 252 85 L 270 135 L 305 105 Z" fill="#ffffff" stroke="rgba(0,0,0,0.15)" stroke-width="1.5" />
    
    <!-- Buttons -->
    <circle cx="250" cy="100" r="3.5" fill="#f1f5f9" stroke="rgba(0,0,0,0.25)" stroke-width="1" />
    <circle cx="250" cy="135" r="3.5" fill="#f1f5f9" stroke="rgba(0,0,0,0.25)" stroke-width="1" />
  </g>

  <!-- BACK SHORT SLEEVE POLO BASE -->
  <g id="base-back-short-polo" class="base-group hidden">
    <!-- Similar to normal back short sleeve -->
    <path class="tshirt-fill" d="M 180 60 C 215 50, 285 50, 320 60 L 390 90 L 415 155 L 365 175 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 135 175 L 85 155 L 110 90 Z" fill="#ffffff" />
    <path class="tshirt-texture cotton" d="M 180 60 C 215 50, 285 50, 320 60 L 390 90 L 415 155 L 365 175 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 135 175 L 85 155 L 110 90 Z" fill="url(#pat-cotton)" />
    <path class="tshirt-texture polyester hidden" d="M 180 60 C 215 50, 285 50, 320 60 L 390 90 L 415 155 L 365 175 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 135 175 L 85 155 L 110 90 Z" fill="url(#pat-polyester)" />
    <path class="tshirt-texture heather hidden" d="M 180 60 C 215 50, 285 50, 320 60 L 390 90 L 415 155 L 365 175 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 135 175 L 85 155 L 110 90 Z" fill="#6b7280" filter="url(#filt-heather)" style="mix-blend-mode: overlay;" />
    <!-- Back of the Collar -->
    <path class="tshirt-fill" d="M 180 60 C 200 48, 300 48, 320 60 C 300 55, 200 55, 180 60 Z" fill="#ffffff" stroke="rgba(0,0,0,0.15)" stroke-width="1.5" />
  </g>

</svg>
                    </div>

                    <!-- DESIGN INTERACTIVE CANVAS (z-10) -->
                    <!-- Absolute coordinates matching torso chest/back area -->
                    <div id="printable-zone" class="absolute left-[29%] top-[22%] w-[42%] h-[56%] z-10 overflow-hidden rounded border border-dashed border-white/20 hover:border-indigo-500/50 transition-colors">
                        <!-- Custom layers (image/text) will be dynamically loaded here by JS -->
                    </div>

                    <!-- SHADING & CREASES OVERLAY SVG: Renders realistic fold shadows on top of the design (z-20) -->
                    <!-- Uses mix-blend-mode multiply to shade designs underneath -->
                    <div class="absolute inset-0 z-20 pointer-events-none">
                        <svg id="tshirt-overlay-svg" viewBox="0 0 500 500" class="w-full h-full">
                          <defs>
                            <filter id="blur-soft" x="-10%" y="-10%" width="120%" height="120%">
                              <feGaussianBlur stdDeviation="3.5" />
                            </filter>
                            <filter id="blur-wide" x="-20%" y="-20%" width="140%" height="140%">
                              <feGaussianBlur stdDeviation="7" />
                            </filter>
                          </defs>

                          <!-- Front Short Sleeve Overlay -->
                          
  <!-- FRONT SHORT SLEEVE REGULAR OVERLAY -->
  <g id="overlay-front-short-regular" class="overlay-group">
      <path d="M 180 60 C 215 85, 285 85, 320 60" fill="none" stroke="rgba(0,0,0,0.12)" stroke-width="4.5" />
      <path d="M 180 60 C 215 85, 285 85, 320 60" fill="none" stroke="rgba(255,255,255,0.15)" stroke-width="1" stroke-dasharray="1.5,1" />
      <path d="M 178 60 C 215 50, 285 50, 322 60" fill="none" stroke="rgba(0,0,0,0.15)" stroke-width="2.5" />
      <path d="M 110 90 L 145 160" fill="none" stroke="rgba(0,0,0,0.08)" stroke-width="1.8" />
      <path d="M 390 90 L 355 160" fill="none" stroke="rgba(0,0,0,0.08)" stroke-width="1.8" />
      <g class="shading" opacity="0.45" style="mix-blend-mode: multiply;">
          <path d="M 145 160 C 158 240, 160 380, 150 450" fill="none" stroke="rgba(0,0,0,0.25)" stroke-width="10" filter="url(#blur-soft)" />
          <path d="M 355 160 C 342 240, 340 380, 350 450" fill="none" stroke="rgba(0,0,0,0.25)" stroke-width="10" filter="url(#blur-soft)" />
          <path d="M 145 170 Q 185 190, 220 180" fill="none" stroke="rgba(0,0,0,0.3)" stroke-width="6" filter="url(#blur-soft)" />
          <path d="M 355 170 Q 315 190, 280 180" fill="none" stroke="rgba(0,0,0,0.3)" stroke-width="6" filter="url(#blur-soft)" />
          <path d="M 195 200 Q 170 300, 185 450" fill="none" stroke="rgba(0,0,0,0.16)" stroke-width="8" filter="url(#blur-soft)" />
          <path d="M 305 200 Q 330 300, 315 450" fill="none" stroke="rgba(0,0,0,0.16)" stroke-width="8" filter="url(#blur-soft)" />
          <path d="M 180 62 C 215 89, 285 89, 320 62" fill="none" stroke="rgba(0,0,0,0.32)" stroke-width="7" filter="url(#blur-soft)" />
      </g>
      <path d="M 180 60 C 215 85, 285 85, 320 60 L 390 90 L 415 155 L 365 175 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 135 175 L 85 155 L 110 90 Z" fill="none" stroke="rgba(0,0,0,0.15)" stroke-width="2.5" />
  </g>

  <!-- FRONT LONG SLEEVE REGULAR OVERLAY -->
  <g id="overlay-front-long-regular" class="overlay-group hidden">
      <path d="M 180 60 C 215 85, 285 85, 320 60" fill="none" stroke="rgba(0,0,0,0.12)" stroke-width="4.5" />
      <path d="M 178 60 C 215 50, 285 50, 322 60" fill="none" stroke="rgba(0,0,0,0.15)" stroke-width="2.5" />
      <path d="M 110 90 L 145 160" fill="none" stroke="rgba(0,0,0,0.08)" stroke-width="1.8" />
      <path d="M 390 90 L 355 160" fill="none" stroke="rgba(0,0,0,0.08)" stroke-width="1.8" />
      <g class="shading" opacity="0.45" style="mix-blend-mode: multiply;">
          <path d="M 145 160 C 158 240, 160 380, 150 450" fill="none" stroke="rgba(0,0,0,0.25)" stroke-width="10" filter="url(#blur-soft)" />
          <path d="M 355 160 C 342 240, 340 380, 350 450" fill="none" stroke="rgba(0,0,0,0.25)" stroke-width="10" filter="url(#blur-soft)" />
          <path d="M 145 170 Q 185 190, 220 180" fill="none" stroke="rgba(0,0,0,0.3)" stroke-width="6" filter="url(#blur-soft)" />
          <path d="M 355 170 Q 315 190, 280 180" fill="none" stroke="rgba(0,0,0,0.3)" stroke-width="6" filter="url(#blur-soft)" />
          <path d="M 110 90 Q 90 200 120 350" fill="none" stroke="rgba(0,0,0,0.22)" stroke-width="8" filter="url(#blur-soft)" />
          <path d="M 145 160 Q 130 250 145 350" fill="none" stroke="rgba(0,0,0,0.22)" stroke-width="8" filter="url(#blur-soft)" />
          <path d="M 390 90 Q 410 200 380 350" fill="none" stroke="rgba(0,0,0,0.22)" stroke-width="8" filter="url(#blur-soft)" />
          <path d="M 355 160 Q 370 250 355 350" fill="none" stroke="rgba(0,0,0,0.22)" stroke-width="8" filter="url(#blur-soft)" />
          <path d="M 180 62 C 215 89, 285 89, 320 62" fill="none" stroke="rgba(0,0,0,0.32)" stroke-width="7" filter="url(#blur-soft)" />
      </g>
      <path d="M 180 60 C 215 85, 285 85, 320 60 L 390 90 L 415 155 L 385 360 L 350 360 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 150 360 L 115 360 L 85 155 L 110 90 Z" fill="none" stroke="rgba(0,0,0,0.15)" stroke-width="2.5" />
  </g>

  <!-- BACK SHORT SLEEVE REGULAR OVERLAY -->
  <g id="overlay-back-short-regular" class="overlay-group hidden">
      <path d="M 180 60 C 215 50, 285 50, 320 60" fill="none" stroke="rgba(0,0,0,0.15)" stroke-width="4.5" />
      <path d="M 110 90 L 145 160" fill="none" stroke="rgba(0,0,0,0.08)" stroke-width="1.8" />
      <path d="M 390 90 L 355 160" fill="none" stroke="rgba(0,0,0,0.08)" stroke-width="1.8" />
      <g class="shading" opacity="0.45" style="mix-blend-mode: multiply;">
          <path d="M 145 160 C 158 240, 160 380, 150 450" fill="none" stroke="rgba(0,0,0,0.25)" stroke-width="10" filter="url(#blur-soft)" />
          <path d="M 355 160 C 342 240, 340 380, 350 450" fill="none" stroke="rgba(0,0,0,0.25)" stroke-width="10" filter="url(#blur-soft)" />
          <path d="M 195 200 Q 170 300, 185 450" fill="none" stroke="rgba(0,0,0,0.16)" stroke-width="8" filter="url(#blur-soft)" />
          <path d="M 305 200 Q 330 300, 315 450" fill="none" stroke="rgba(0,0,0,0.16)" stroke-width="8" filter="url(#blur-soft)" />
          <path d="M 180 62 C 215 52, 285 52, 320 62" fill="none" stroke="rgba(0,0,0,0.22)" stroke-width="6" filter="url(#blur-soft)" />
      </g>
      <path d="M 180 60 C 215 50, 285 50, 320 60 L 390 90 L 415 155 L 365 175 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 135 175 L 85 155 L 110 90 Z" fill="none" stroke="rgba(0,0,0,0.15)" stroke-width="2.5" />
  </g>

  <!-- BACK LONG SLEEVE REGULAR OVERLAY -->
  <g id="overlay-back-long-regular" class="overlay-group hidden">
      <path d="M 180 60 C 215 50, 285 50, 320 60" fill="none" stroke="rgba(0,0,0,0.15)" stroke-width="4.5" />
      <path d="M 110 90 L 145 160" fill="none" stroke="rgba(0,0,0,0.08)" stroke-width="1.8" />
      <path d="M 390 90 L 355 160" fill="none" stroke="rgba(0,0,0,0.08)" stroke-width="1.8" />
      <g class="shading" opacity="0.45" style="mix-blend-mode: multiply;">
          <path d="M 145 160 C 158 240, 160 380, 150 450" fill="none" stroke="rgba(0,0,0,0.25)" stroke-width="10" filter="url(#blur-soft)" />
          <path d="M 355 160 C 342 240, 340 380, 350 450" fill="none" stroke="rgba(0,0,0,0.25)" stroke-width="10" filter="url(#blur-soft)" />
          <path d="M 110 90 Q 90 200 120 350" fill="none" stroke="rgba(0,0,0,0.22)" stroke-width="8" filter="url(#blur-soft)" />
          <path d="M 145 160 Q 130 250 145 350" fill="none" stroke="rgba(0,0,0,0.22)" stroke-width="8" filter="url(#blur-soft)" />
          <path d="M 390 90 Q 410 200 380 350" fill="none" stroke="rgba(0,0,0,0.22)" stroke-width="8" filter="url(#blur-soft)" />
          <path d="M 355 160 Q 370 250 355 350" fill="none" stroke="rgba(0,0,0,0.22)" stroke-width="8" filter="url(#blur-soft)" />
          <path d="M 180 62 C 215 52, 285 52, 320 62" fill="none" stroke="rgba(0,0,0,0.22)" stroke-width="6" filter="url(#blur-soft)" />
      </g>
      <path d="M 180 60 C 215 50, 285 50, 320 60 L 390 90 L 415 155 L 385 360 L 350 360 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 150 360 L 115 360 L 85 155 L 110 90 Z" fill="none" stroke="rgba(0,0,0,0.15)" stroke-width="2.5" />
  </g>

  <!-- FRONT SHORT SLEEVE MUJER OVERLAY -->
  <g id="overlay-front-short-mujer" class="overlay-group hidden">
      <path d="M 175 65 C 210 90, 290 90, 325 65" fill="none" stroke="rgba(0,0,0,0.12)" stroke-width="3.5" />
      <path d="M 175 65 C 210 90, 290 90, 325 65" fill="none" stroke="rgba(255,255,255,0.15)" stroke-width="1" stroke-dasharray="1.5,1" />
      <path d="M 173 65 C 210 55, 290 55, 327 65" fill="none" stroke="rgba(0,0,0,0.15)" stroke-width="2" />
      
      <!-- Short sleeve seams -->
      <path d="M 120 90 L 145 155" fill="none" stroke="rgba(0,0,0,0.08)" stroke-width="1.5" />
      <path d="M 380 90 L 355 155" fill="none" stroke="rgba(0,0,0,0.08)" stroke-width="1.5" />
      
      <!-- Fitted side shading -->
      <g class="shading" opacity="0.45" style="mix-blend-mode: multiply;">
          <path d="M 145 155 C 160 240, 160 340, 155 440" fill="none" stroke="rgba(0,0,0,0.22)" stroke-width="10" filter="url(#blur-soft)" />
          <path d="M 355 155 C 340 240, 340 340, 345 440" fill="none" stroke="rgba(0,0,0,0.22)" stroke-width="10" filter="url(#blur-soft)" />
          <!-- Chest folds -->
          <path d="M 145 165 Q 185 180, 220 175" fill="none" stroke="rgba(0,0,0,0.25)" stroke-width="5" filter="url(#blur-soft)" />
          <path d="M 355 165 Q 315 180, 280 175" fill="none" stroke="rgba(0,0,0,0.25)" stroke-width="5" filter="url(#blur-soft)" />
          <path d="M 175 67 C 210 92, 290 92, 325 67" fill="none" stroke="rgba(0,0,0,0.28)" stroke-width="6" filter="url(#blur-soft)" />
      </g>
      
      <path d="M 175 65 C 210 90, 290 90, 325 65 L 380 90 L 395 135 L 355 155 L 350 160 C 335 240, 335 340, 345 440 C 345 450, 335 460, 315 460 L 185 460 C 165 460, 155 450, 155 440 C 165 340, 165 240, 150 160 L 145 155 L 105 135 L 120 90 Z" fill="none" stroke="rgba(0,0,0,0.15)" stroke-width="2" />
  </g>

  <!-- BACK SHORT SLEEVE MUJER OVERLAY -->
  <g id="overlay-back-short-mujer" class="overlay-group hidden">
      <path d="M 175 65 C 210 55, 290 55, 325 65" fill="none" stroke="rgba(0,0,0,0.15)" stroke-width="3.5" />
      <path d="M 120 90 L 145 155" fill="none" stroke="rgba(0,0,0,0.08)" stroke-width="1.5" />
      <path d="M 380 90 L 355 155" fill="none" stroke="rgba(0,0,0,0.08)" stroke-width="1.5" />
      
      <g class="shading" opacity="0.45" style="mix-blend-mode: multiply;">
          <path d="M 145 155 C 160 240, 160 340, 155 440" fill="none" stroke="rgba(0,0,0,0.22)" stroke-width="10" filter="url(#blur-soft)" />
          <path d="M 355 155 C 340 240, 340 340, 345 440" fill="none" stroke="rgba(0,0,0,0.22)" stroke-width="10" filter="url(#blur-soft)" />
          <path d="M 175 67 C 210 57, 290 57, 325 67" fill="none" stroke="rgba(0,0,0,0.2)" stroke-width="6" filter="url(#blur-soft)" />
      </g>
      <path d="M 175 65 C 210 55, 290 55, 325 65 L 380 90 L 395 135 L 355 155 L 350 160 C 335 240, 335 340, 345 440 C 345 450, 335 460, 315 460 L 185 460 C 165 460, 155 450, 155 440 C 165 340, 165 240, 150 160 L 145 155 L 105 135 L 120 90 Z" fill="none" stroke="rgba(0,0,0,0.15)" stroke-width="2" />
  </g>

  <!-- FRONT SHORT SLEEVE POLO OVERLAY -->
  <g id="overlay-front-short-polo" class="overlay-group hidden">
      <!-- Seam lines -->
      <path d="M 110 90 L 145 160" fill="none" stroke="rgba(0,0,0,0.08)" stroke-width="1.8" />
      <path d="M 390 90 L 355 160" fill="none" stroke="rgba(0,0,0,0.08)" stroke-width="1.8" />
      <!-- Ribbing cuffs -->
      <path d="M 85 155 L 135 175" fill="none" stroke="rgba(0,0,0,0.1)" stroke-width="3" />
      <path d="M 365 175 L 415 155" fill="none" stroke="rgba(0,0,0,0.1)" stroke-width="3" />
      
      <!-- Folds & Shading -->
      <g class="shading" opacity="0.45" style="mix-blend-mode: multiply;">
          <path d="M 145 160 C 158 240, 160 380, 150 450" fill="none" stroke="rgba(0,0,0,0.25)" stroke-width="10" filter="url(#blur-soft)" />
          <path d="M 355 160 C 342 240, 340 380, 350 450" fill="none" stroke="rgba(0,0,0,0.25)" stroke-width="10" filter="url(#blur-soft)" />
          <!-- Placket shadow -->
          <path d="M 238 60 L 238 170" fill="none" stroke="rgba(0,0,0,0.3)" stroke-width="3" filter="url(#blur-soft)" />
          <path d="M 262 60 L 262 170" fill="none" stroke="rgba(0,0,0,0.3)" stroke-width="3" filter="url(#blur-soft)" />
          <path d="M 240 168 L 260 168" fill="none" stroke="rgba(0,0,0,0.25)" stroke-width="4" filter="url(#blur-soft)" />
          <!-- Collar shadow on chest -->
          <path d="M 180 62 C 200 70, 235 88, 250 88 C 265 88, 300 70, 320 62" fill="none" stroke="rgba(0,0,0,0.4)" stroke-width="8" filter="url(#blur-soft)" />
      </g>
      <path d="M 180 60 C 215 50, 285 50, 320 60 L 390 90 L 415 155 L 365 175 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 135 175 L 85 155 L 110 90 Z" fill="none" stroke="rgba(0,0,0,0.15)" stroke-width="2.5" />
  </g>

  <!-- BACK SHORT SLEEVE POLO OVERLAY -->
  <g id="overlay-back-short-polo" class="overlay-group hidden">
      <path d="M 110 90 L 145 160" fill="none" stroke="rgba(0,0,0,0.08)" stroke-width="1.8" />
      <path d="M 390 90 L 355 160" fill="none" stroke="rgba(0,0,0,0.08)" stroke-width="1.8" />
      <g class="shading" opacity="0.45" style="mix-blend-mode: multiply;">
          <path d="M 145 160 C 158 240, 160 380, 150 450" fill="none" stroke="rgba(0,0,0,0.25)" stroke-width="10" filter="url(#blur-soft)" />
          <path d="M 355 160 C 342 240, 340 380, 350 450" fill="none" stroke="rgba(0,0,0,0.25)" stroke-width="10" filter="url(#blur-soft)" />
          <!-- Under collar shadow -->
          <path d="M 180 62 C 200 50, 300 50, 320 62" fill="none" stroke="rgba(0,0,0,0.3)" stroke-width="6" filter="url(#blur-soft)" />
      </g>
      <path d="M 180 60 C 215 50, 285 50, 320 60 L 390 90 L 415 155 L 365 175 L 355 160 L 355 450 C 355 465, 340 475, 320 475 L 180 475 C 160 475, 145 465, 145 450 L 145 160 L 135 175 L 85 155 L 110 90 Z" fill="none" stroke="rgba(0,0,0,0.15)" stroke-width="2.5" />
  </g>

</svg>
                    </div>
                </div>
            </div>

            <!-- TOOLBAR ABAJO DEL PREVIEW -->
            <div class="flex flex-wrap gap-3 items-center justify-between bg-slate-900/60 border border-slate-800 rounded-xl p-3.5 backdrop-blur-md">
                <div class="flex gap-2">
                    <button onclick="centerActiveElement()" class="text-xs font-semibold px-3.5 py-2 text-slate-300 hover:text-white bg-slate-800 hover:bg-slate-700 rounded-lg transition-all flex items-center gap-1.5 active:scale-95" title="Centrar elemento seleccionado">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        Centrar
                    </button>
                    <button onclick="clearCanvas()" class="text-xs font-semibold px-3.5 py-2 text-red-400 hover:text-red-300 bg-red-950/40 hover:bg-red-900/40 border border-red-900/50 rounded-lg transition-all flex items-center gap-1.5 active:scale-95" title="Limpiar diseño de esta vista">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Limpiar Vista
                    </button>
                </div>

                <div class="flex items-center gap-3">
                    <!-- SEGMENTED CONTROL: FRENTE / ESPALDA -->
                    <div class="bg-slate-950 p-1 rounded-xl flex border border-slate-800">
                        <label class="flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-bold cursor-pointer transition-all has-[:checked]:bg-indigo-600 has-[:checked]:text-white text-slate-400 hover:text-slate-200">
                            <input type="radio" name="view" value="front" checked class="hidden" onchange="toggleView('front')">
                            Frente
                        </label>
                        <label class="flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-bold cursor-pointer transition-all has-[:checked]:bg-indigo-600 has-[:checked]:text-white text-slate-400 hover:text-slate-200">
                            <input type="radio" name="view" value="back" class="hidden" onchange="toggleView('back')">
                            Espalda
                        </label>
                    </div>

                    <!-- EXPORT DESIGN BUTTON -->
                    <button id="export-btn" onclick="exportDesign()" class="text-xs font-bold px-4 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white rounded-lg transition-all flex items-center gap-1.5 shadow-lg shadow-emerald-500/25 active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Descargar PNG
                    </button>
                </div>
            </div>
        </div>

        <!-- COLUMNA DERECHA: PANELES DE CONTROL (DASHBOARD CONTROLS) -->
        <div class="lg:col-span-5 space-y-6">
            
                        <!-- PANEL DE CONTROL CON TABS (MENÚ) -->
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden flex flex-col" style="min-height: 480px;">
                <!-- Cabecera de Navegación de Tabs -->
                <div class="flex border-b border-slate-100 bg-slate-50/50 p-1.5 gap-1 select-none">
                    <button onclick="switchTab('tab-prenda')" id="btn-tab-prenda" class="flex-1 py-2.5 px-1 rounded-xl text-xs font-bold transition-all flex flex-col sm:flex-row items-center justify-center gap-1.5 text-indigo-600 bg-white shadow-sm border border-slate-200/50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                        Prenda
                    </button>
                    <button onclick="switchTab('tab-graficos')" id="btn-tab-graficos" class="flex-1 py-2.5 px-1 rounded-xl text-xs font-bold transition-all flex flex-col sm:flex-row items-center justify-center gap-1.5 text-slate-500 hover:text-slate-800">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Gráficos
                    </button>
                    <button onclick="switchTab('tab-plantillas')" id="btn-tab-plantillas" class="flex-1 py-2.5 px-1 rounded-xl text-xs font-bold transition-all flex flex-col sm:flex-row items-center justify-center gap-1.5 text-slate-500 hover:text-slate-800">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                        Plantillas
                    </button>
                    <button onclick="switchTab('tab-ajustes')" id="btn-tab-ajustes" class="flex-1 py-2.5 px-1 rounded-xl text-xs font-bold transition-all flex flex-col sm:flex-row items-center justify-center gap-1.5 text-slate-500 hover:text-slate-800">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31(2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Ajustes
                    </button>
                </div>

                <!-- Área de Contenido de los Tabs -->
                <div class="p-6 flex-1 overflow-y-auto">
                    
                    <!-- TAB 1: PRENDA -->
                    <div id="tab-prenda" class="tab-pane space-y-6">
                        <div>
                            <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Corte / Tipo de Camiseta</span>
                            <div class="grid grid-cols-3 gap-2">
                                <label class="flex flex-col items-center justify-center gap-1 border-2 border-slate-100 rounded-xl p-2 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50/30">
                                    <input type="radio" name="style" value="regular" checked class="hidden" onchange="updateStyle('regular')">
                                    <span class="text-xs font-bold text-slate-700">Normal</span>
                                </label>
                                <label class="flex flex-col items-center justify-center gap-1 border-2 border-slate-100 rounded-xl p-2 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50/30">
                                    <input type="radio" name="style" value="mujer" class="hidden" onchange="updateStyle('mujer')">
                                    <span class="text-xs font-bold text-slate-700">Mujer Fit</span>
                                </label>
                                <label class="flex flex-col items-center justify-center gap-1 border-2 border-slate-100 rounded-xl p-2 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50/30">
                                    <input type="radio" name="style" value="polo" class="hidden" onchange="updateStyle('polo')">
                                    <span class="text-xs font-bold text-slate-700">Tipo Polo</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Estilo de Manga</span>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="flex items-center justify-center gap-2 border-2 border-slate-100 rounded-xl p-3 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50/30">
                                    <input type="radio" name="type" value="manga-corta" checked class="hidden" onchange="updateSleeve('manga-corta')">
                                    <span class="text-xs font-bold text-slate-700">Manga Corta</span>
                                </label>
                                <label class="flex items-center justify-center gap-2 border-2 border-slate-100 rounded-xl p-3 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50/30">
                                    <input type="radio" name="type" value="manga-larga" class="hidden" onchange="updateSleeve('manga-larga')">
                                    <span class="text-xs font-bold text-slate-700">Manga Larga</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Material / Textura</span>
                            <div class="grid grid-cols-3 gap-2.5">
                                <button onclick="setMaterial('cotton')" id="mat-btn-cotton" class="px-3 py-2.5 rounded-xl text-xs font-bold border-2 border-indigo-600 bg-indigo-50/30 text-indigo-700 transition-all">
                                    Algodón
                                </button>
                                <button onclick="setMaterial('polyester')" id="mat-btn-polyester" class="px-3 py-2.5 rounded-xl text-xs font-bold border border-slate-200 text-slate-600 hover:bg-slate-50 transition-all">
                                    Poliéster
                                </button>
                                <button onclick="setMaterial('heather')" id="mat-btn-heather" class="px-3 py-2.5 rounded-xl text-xs font-bold border border-slate-200 text-slate-600 hover:bg-slate-50 transition-all">
                                    Jaspeado
                                </button>
                            </div>
                        </div>

                        <div>
                            <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Color de la Prenda</span>
                            <div class="flex flex-wrap gap-2.5 items-center">
                                <button onclick="setColor('#ffffff')" class="color-btn w-9 h-9 rounded-full border-2 border-slate-200 ring-2 ring-indigo-500 shadow-md transform hover:scale-105 transition-all" style="background:#ffffff" data-color="#ffffff" title="Blanco"></button>
                                <button onclick="setColor('#2F3E46')" class="color-btn w-9 h-9 rounded-full border border-slate-300 shadow-md transform hover:scale-105 transition-all" style="background:#2F3E46" data-color="#2F3E46" title="Carbono"></button>
                                <button onclick="setColor('#0e1111')" class="color-btn w-9 h-9 rounded-full border border-slate-300 shadow-md transform hover:scale-105 transition-all" style="background:#0e1111" data-color="#0e1111" title="Negro"></button>
                                <button onclick="setColor('#1D3557')" class="color-btn w-9 h-9 rounded-full border border-slate-300 shadow-md transform hover:scale-105 transition-all" style="background:#1D3557" data-color="#1D3557" title="Azul Marino"></button>
                                <button onclick="setColor('#2A9D8F')" class="color-btn w-9 h-9 rounded-full border border-slate-300 shadow-md transform hover:scale-105 transition-all" style="background:#2A9D8F" data-color="#2A9D8F" title="Verde Bosque"></button>
                                <button onclick="setColor('#9B2226')" class="color-btn w-9 h-9 rounded-full border border-slate-300 shadow-md transform hover:scale-105 transition-all" style="background:#9B2226" data-color="#9B2226" title="Carmesí"></button>
                                <button onclick="setColor('#E9C46A')" class="color-btn w-9 h-9 rounded-full border border-slate-300 shadow-md transform hover:scale-105 transition-all" style="background:#E9C46A" data-color="#E9C46A" title="Mostaza"></button>
                                <button onclick="setColor('#ffccd5')" class="color-btn w-9 h-9 rounded-full border border-slate-300 shadow-md transform hover:scale-105 transition-all" style="background:#ffccd5" data-color="#ffccd5" title="Rosa Pastel"></button>
                                <div class="relative w-9 h-9 rounded-full border border-slate-300 overflow-hidden shadow-md flex items-center justify-center bg-slate-50 cursor-pointer transform hover:scale-105 transition-all">
                                    <svg class="w-4 h-4 text-slate-400 pointer-events-none absolute z-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    <input type="color" id="custom-color-picker" oninput="setColor(this.value)" class="absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 2: GRAFICOS & TEXTO -->
                    <div id="tab-graficos" class="tab-pane hidden space-y-5">
                        <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                             <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Subir Imagen o Logotipo</span>
                             <label id="drop-zone" class="border-2 border-dashed border-slate-200 hover:border-indigo-500 rounded-xl p-5 flex flex-col items-center justify-center cursor-pointer transition-all bg-white group">
                                 <input type="file" id="image-input" accept="image/*" class="hidden" onchange="handleImageUpload(event)" />
                                 <svg class="w-7 h-7 text-slate-400 group-hover:text-indigo-500 mb-1 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                 <span class="text-xs font-bold text-slate-700 text-center">Haz clic o arrastra tu archivo</span>
                                 <span class="text-[10px] text-slate-400 mt-0.5">PNG, JPG (Fondo transparente recomendado)</span>
                             </label>
                             <label class="flex items-center gap-2 mt-3 cursor-pointer group">
                                 <input type="checkbox" id="remove-bg-toggle" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                                 <span class="text-xs text-slate-600 group-hover:text-slate-800 font-medium">Quitar fondo blanco de la imagen</span>
                             </label>
                         </div>

                        <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 space-y-3">
                            <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Añadir Texto Personalizado</span>
                            <div class="flex gap-2">
                                <input type="text" id="text-input" placeholder="Escribí algo..." class="block w-full rounded-lg border-slate-200 border px-3 py-2 text-xs focus:ring-indigo-500 focus:border-indigo-500" />
                                <button onclick="handleCreateText()" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-xs font-bold transition-all shrink-0 active:scale-95">
                                    Añadir
                                </button>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-wider block mb-1">Fuente</label>
                                    <select id="text-font" class="block w-full rounded-lg border-slate-200 border p-2 text-xs">
                                        <option value="'Montserrat', sans-serif">Montserrat (Moderna)</option>
                                        <option value="'Pacifico', cursive">Pacifico (Retro)</option>
                                        <option value="'Playfair Display', serif">Playfair (Elegante)</option>
                                        <option value="'Bebas Neue', sans-serif">Bebas Neue (Impacto)</option>
                                        <option value="'Outfit', sans-serif">Outfit (Premium)</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-wider block mb-1">Color de Texto</label>
                                    <div class="flex gap-1.5 items-center mt-1">
                                        <button onclick="setTextColor('#ffffff')" class="text-color-btn w-5 h-5 rounded-full border border-slate-300 ring-2 ring-indigo-500" style="background:#ffffff" data-color="#ffffff" title="Blanco"></button>
                                        <button onclick="setTextColor('#1e293b')" class="text-color-btn w-5 h-5 rounded-full border border-slate-300" style="background:#1e293b" data-color="#1e293b" title="Carbono"></button>
                                        <button onclick="setTextColor('#ea580c')" class="text-color-btn w-5 h-5 rounded-full border border-slate-300" style="background:#ea580c" data-color="#ea580c" title="Naranja"></button>
                                        <button onclick="setTextColor('#f43f5e')" class="text-color-btn w-5 h-5 rounded-full border border-slate-300" style="background:#f43f5e" data-color="#f43f5e" title="Rojo"></button>
                                        <div class="relative w-5 h-5 rounded-full border border-slate-300 overflow-hidden flex items-center justify-center bg-slate-50 cursor-pointer">
                                            <svg class="w-3 h-3 text-slate-400 pointer-events-none absolute" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            <input type="color" id="text-color-picker" oninput="setTextColor(this.value)" class="absolute inset-0 opacity-0 w-full h-full cursor-pointer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 3: PLANTILLAS -->
                    <div id="tab-plantillas" class="tab-pane hidden space-y-4">
                        <p class="text-xs text-slate-400 leading-relaxed">¿No tenés una imagen a mano? Hacé clic en una plantilla de abajo para probar el estudio inmediatamente:</p>
                        <div class="grid grid-cols-2 gap-3">
                            <button onclick="addTemplate('sunset')" class="border border-slate-200 hover:border-indigo-500 rounded-xl p-2.5 bg-slate-50 hover:bg-indigo-50/20 transition-all flex items-center gap-3">
                                <svg viewBox="0 0 100 100" class="w-12 h-12 shadow-sm rounded-lg bg-white shrink-0">
                                    <circle cx="50" cy="45" r="35" fill="#f97316"/>
                                    <rect x="0" y="50" width="100" height="3" fill="#ffffff" />
                                    <rect x="0" y="58" width="100" height="4" fill="#ffffff" />
                                    <rect x="0" y="68" width="100" height="5" fill="#ffffff" />
                                    <text x="50" y="38" font-family="'Pacifico'" font-size="12" fill="#ffffff" text-anchor="middle">Pura Vida</text>
                                </svg>
                                <div class="text-left">
                                    <span class="block text-xs font-bold text-slate-700">Retro Sun</span>
                                    <span class="text-[10px] text-slate-400">Atardecer vintage</span>
                                </div>
                            </button>

                            <button onclick="addTemplate('dev')" class="border border-slate-200 hover:border-indigo-500 rounded-xl p-2.5 bg-slate-50 hover:bg-indigo-50/20 transition-all flex items-center gap-3">
                                <svg viewBox="0 0 100 100" class="w-12 h-12 shadow-sm rounded-lg bg-slate-900 shrink-0">
                                    <rect x="10" y="10" width="80" height="80" rx="10" fill="#0f172a" stroke="#38bdf8" stroke-width="2"/>
                                    <text x="50" y="55" font-family="monospace" font-size="10" font-weight="bold" fill="#38bdf8" text-anchor="middle">DEV // LIFE</text>
                                    <text x="50" y="72" font-family="monospace" font-size="7" fill="#a7f3d0" text-anchor="middle">eat_sleep_code();</text>
                                </svg>
                                <div class="text-left">
                                    <span class="block text-xs font-bold text-slate-700">Developer</span>
                                    <span class="text-[10px] text-slate-400">Código de programación</span>
                                </div>
                            </button>

                            <button onclick="addTemplate('mountains')" class="border border-slate-200 hover:border-indigo-500 rounded-xl p-2.5 bg-slate-50 hover:bg-indigo-50/20 transition-all flex items-center gap-3">
                                <svg viewBox="0 0 100 100" class="w-12 h-12 shadow-sm rounded-lg bg-white shrink-0">
                                    <circle cx="50" cy="45" r="22" fill="#fecdd3" opacity="0.6"/>
                                    <path d="M 15 75 L 45 30 L 70 75 Z" fill="#475569" opacity="0.8"/>
                                    <path d="M 40 75 L 65 40 L 90 75 Z" fill="#334155"/>
                                    <text x="50" y="90" font-family="sans-serif" font-weight="900" font-size="7" fill="#1e293b" text-anchor="middle">WILDERNESS</text>
                                </svg>
                                <div class="text-left">
                                    <span class="block text-xs font-bold text-slate-700">Montañas</span>
                                    <span class="text-[10px] text-slate-400">Minimalista de naturaleza</span>
                                </div>
                            </button>

                            <button onclick="addTemplate('coffee')" class="border border-slate-200 hover:border-indigo-500 rounded-xl p-2.5 bg-slate-50 hover:bg-indigo-50/20 transition-all flex items-center gap-3">
                                <svg viewBox="0 0 100 100" class="w-12 h-12 shadow-sm rounded-lg bg-orange-50 shrink-0">
                                    <rect x="35" y="30" width="30" height="30" rx="6" fill="#fdba74" stroke="#7c2d12" stroke-width="2"/>
                                    <path d="M 65 37 C 75 37 75 53 65 53" stroke="#7c2d12" stroke-width="2" fill="none"/>
                                    <circle cx="43" cy="42" r="2" fill="#7c2d12"/>
                                    <circle cx="57" cy="42" r="2" fill="#7c2d12"/>
                                    <path d="M 48 48 Q 50 51 52 48" stroke="#7c2d12" stroke-width="1.5" stroke-linecap="round" fill="none"/>
                                    <text x="50" y="80" font-family="sans-serif" font-weight="bold" font-size="7" fill="#7c2d12" text-anchor="middle">Coffee Time</text>
                                </svg>
                                <div class="text-left">
                                    <span class="block text-xs font-bold text-slate-700">Mascota Café</span>
                                    <span class="text-[10px] text-slate-400">Taza de café animada</span>
                                </div>
                            </button>
                        </div>

                        <div class="border-t border-slate-100 pt-4 mt-2">
                            <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Plantillas de Texto (WordArt)</span>
                            <p class="text-[10px] text-slate-400 mb-2">Hacé clic para agregar texto decorado. Seleccioná el texto en la camiseta para editarlo.</p>
                            <div class="grid grid-cols-2 gap-3">
                                <!-- Arco -->
                                <button onclick="addTextTemplate('arch')" class="border border-slate-200 hover:border-indigo-500 rounded-xl p-2.5 bg-slate-50 hover:bg-indigo-50/20 transition-all flex items-center gap-3">
                                    <svg viewBox="0 0 100 70" class="w-12 h-10 shadow-sm rounded-lg bg-white shrink-0 overflow-visible">
                                        <defs><path id="arch-path" d="M 10 55 Q 50 0 90 55" fill="none"/></defs>
                                        <text font-family="'Montserrat',sans-serif" font-size="14" font-weight="900" fill="#6d28d9" letter-spacing="2"><textPath href="#arch-path" startOffset="50%" text-anchor="middle">ARCO</textPath></text>
                                    </svg>
                                    <div class="text-left">
                                        <span class="block text-xs font-bold text-slate-700">Arco</span>
                                        <span class="text-[10px] text-slate-400">Texto curvado hacia arriba</span>
                                    </div>
                                </button>

                                <!-- Onda -->
                                <button onclick="addTextTemplate('wave')" class="border border-slate-200 hover:border-indigo-500 rounded-xl p-2.5 bg-slate-50 hover:bg-indigo-50/20 transition-all flex items-center gap-3">
                                    <svg viewBox="0 0 100 70" class="w-12 h-10 shadow-sm rounded-lg bg-white shrink-0 overflow-visible">
                                        <defs><path id="wave-path" d="M 5 40 C 20 15 35 60 50 35 C 65 10 80 55 95 30" fill="none"/></defs>
                                        <text font-family="'Pacifico',cursive" font-size="13" fill="#e11d48" letter-spacing="1"><textPath href="#wave-path" startOffset="50%" text-anchor="middle">ONDA</textPath></text>
                                    </svg>
                                    <div class="text-left">
                                        <span class="block text-xs font-bold text-slate-700">Onda</span>
                                        <span class="text-[10px] text-slate-400">Texto con ondulación</span>
                                    </div>
                                </button>

                                <!-- Círculo -->
                                <button onclick="addTextTemplate('circle')" class="border border-slate-200 hover:border-indigo-500 rounded-xl p-2.5 bg-slate-50 hover:bg-indigo-50/20 transition-all flex items-center gap-3">
                                    <svg viewBox="0 0 100 100" class="w-12 h-12 shadow-sm rounded-lg bg-slate-900 shrink-0">
                                        <defs><path id="circle-path" d="M 50 15 A 35 35 0 1 1 49.99 15" fill="none"/></defs>
                                        <text font-family="'Bebas Neue',sans-serif" font-size="11" fill="#facc15" letter-spacing="4"><textPath href="#circle-path" startOffset="0%">CÍRCULO • DISEÑO • </textPath></text>
                                    </svg>
                                    <div class="text-left">
                                        <span class="block text-xs font-bold text-slate-700">Círculo</span>
                                        <span class="text-[10px] text-slate-400">Texto en círculo completo</span>
                                    </div>
                                </button>

                                <!-- Contorno / Stroke -->
                                <button onclick="addTextTemplate('outline')" class="border border-slate-200 hover:border-indigo-500 rounded-xl p-2.5 bg-slate-50 hover:bg-indigo-50/20 transition-all flex items-center gap-3">
                                    <svg viewBox="0 0 100 60" class="w-12 h-10 shadow-sm rounded-lg bg-white shrink-0">
                                        <text x="50" y="42" font-family="'Montserrat',sans-serif" font-size="24" font-weight="900" fill="none" stroke="#1e40af" stroke-width="2" text-anchor="middle">HOLA</text>
                                    </svg>
                                    <div class="text-left">
                                        <span class="block text-xs font-bold text-slate-700">Contorno</span>
                                        <span class="text-[10px] text-slate-400">Solo borde del texto</span>
                                    </div>
                                </button>

                                <!-- Sombra 3D -->
                                <button onclick="addTextTemplate('shadow3d')" class="border border-slate-200 hover:border-indigo-500 rounded-xl p-2.5 bg-slate-50 hover:bg-indigo-50/20 transition-all flex items-center gap-3">
                                    <svg viewBox="0 0 100 60" class="w-12 h-10 shadow-sm rounded-lg bg-white shrink-0">
                                        <text x="53" y="44" font-family="'Montserrat',sans-serif" font-size="22" font-weight="900" fill="#d1d5db" text-anchor="middle">3D</text>
                                        <text x="50" y="41" font-family="'Montserrat',sans-serif" font-size="22" font-weight="900" fill="#7c3aed" text-anchor="middle">3D</text>
                                    </svg>
                                    <div class="text-left">
                                        <span class="block text-xs font-bold text-slate-700">Sombra 3D</span>
                                        <span class="text-[10px] text-slate-400">Efecto de profundidad</span>
                                    </div>
                                </button>

                                <!-- Gradiente -->
                                <button onclick="addTextTemplate('gradient')" class="border border-slate-200 hover:border-indigo-500 rounded-xl p-2.5 bg-slate-50 hover:bg-indigo-50/20 transition-all flex items-center gap-3">
                                    <svg viewBox="0 0 100 60" class="w-12 h-10 shadow-sm rounded-lg bg-slate-900 shrink-0">
                                        <defs>
                                            <linearGradient id="grad-preview" x1="0%" y1="0%" x2="100%" y2="100%">
                                                <stop offset="0%" stop-color="#f97316"/>
                                                <stop offset="100%" stop-color="#ec4899"/>
                                            </linearGradient>
                                        </defs>
                                        <text x="50" y="40" font-family="'Outfit',sans-serif" font-size="20" font-weight="800" fill="url(#grad-preview)" text-anchor="middle">FUEGO</text>
                                    </svg>
                                    <div class="text-left">
                                        <span class="block text-xs font-bold text-slate-700">Gradiente</span>
                                        <span class="text-[10px] text-slate-400">Color degradado naranja-rosa</span>
                                    </div>
                                </button>

                                <!-- Vintage Badge -->
                                <button onclick="addTextTemplate('badge')" class="border border-slate-200 hover:border-indigo-500 rounded-xl p-2.5 bg-slate-50 hover:bg-indigo-50/20 transition-all flex items-center gap-3">
                                    <svg viewBox="0 0 100 100" class="w-12 h-12 shadow-sm rounded-lg bg-white shrink-0">
                                        <circle cx="50" cy="50" r="38" fill="none" stroke="#92400e" stroke-width="3"/>
                                        <circle cx="50" cy="50" r="32" fill="none" stroke="#92400e" stroke-width="1"/>
                                        <text x="50" y="46" font-family="'Bebas Neue',sans-serif" font-size="14" fill="#92400e" text-anchor="middle" letter-spacing="2">PREMIUM</text>
                                        <text x="50" y="62" font-family="'Montserrat',sans-serif" font-size="7" fill="#92400e" text-anchor="middle" letter-spacing="3">QUALITY</text>
                                        <line x1="20" y1="48" x2="80" y2="48" stroke="#92400e" stroke-width="0.5"/>
                                    </svg>
                                    <div class="text-left">
                                        <span class="block text-xs font-bold text-slate-700">Badge Vintage</span>
                                        <span class="text-[10px] text-slate-400">Emblema estilo retro</span>
                                    </div>
                                </button>

                                <!-- Glitch -->
                                <button onclick="addTextTemplate('glitch')" class="border border-slate-200 hover:border-indigo-500 rounded-xl p-2.5 bg-slate-50 hover:bg-indigo-50/20 transition-all flex items-center gap-3">
                                    <svg viewBox="0 0 100 60" class="w-12 h-10 shadow-sm rounded-lg bg-slate-950 shrink-0">
                                        <text x="52" y="40" font-family="monospace" font-size="20" font-weight="bold" fill="#22d3ee" text-anchor="middle" opacity="0.7">CODE</text>
                                        <text x="48" y="38" font-family="monospace" font-size="20" font-weight="bold" fill="#f43f5e" text-anchor="middle" opacity="0.7">CODE</text>
                                        <text x="50" y="39" font-family="monospace" font-size="20" font-weight="bold" fill="#ffffff" text-anchor="middle">CODE</text>
                                    </svg>
                                    <div class="text-left">
                                        <span class="block text-xs font-bold text-slate-700">Glitch</span>
                                        <span class="text-[10px] text-slate-400">Efecto digital roto</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 4: AJUSTES -->
                    <div id="tab-ajustes" class="tab-pane hidden space-y-5">
                        <div>
                            <div class="flex justify-between text-xs mb-1.5">
                                <span class="font-bold text-slate-700">Intensidad de Arrugas / Sombra</span>
                                <span id="shadow-val" class="font-semibold text-slate-500">45%</span>
                            </div>
                            <input type="range" id="shading-intensity" min="10" max="90" value="45" class="w-full h-1.5 bg-slate-100 rounded-lg appearance-none cursor-pointer accent-indigo-600" oninput="updateShadingIntensity(this.value)" />
                        </div>

                        <div>
                            <div class="flex justify-between text-xs mb-1.5">
                                <span class="font-bold text-slate-700">Opacidad de la Textura (Tela)</span>
                                <span id="texture-val" class="font-semibold text-slate-500">60%</span>
                            </div>
                            <input type="range" id="texture-opacity" min="10" max="100" value="60" class="w-full h-1.5 bg-slate-100 rounded-lg appearance-none cursor-pointer accent-indigo-600" oninput="updateTextureOpacity(this.value)" />
                        </div>
                    </div>
                </div>
            </div>         <!-- RESUMEN DE COTIZACION Y PEDIDO WHATSAPP -->
            <div class="bg-gradient-to-br from-indigo-900 to-slate-950 text-white rounded-2xl shadow-xl border border-indigo-950 p-6 relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-indigo-500/10 rounded-full blur-2xl"></div>
                
                <h4 class="font-bold text-sm text-indigo-300 uppercase tracking-wider mb-2">Presupuesto Estimado</h4>
                <div class="flex justify-between items-baseline mb-4">
                    <span class="text-slate-300 text-xs">Camiseta Premium + Impresión en Pecho/Espalda</span>
                    <span class="text-3xl font-black text-white" id="price-display">₡12,500</span>
                </div>

                <p class="text-xs text-slate-400 leading-relaxed mb-5">El precio estimado incluye camiseta 100% de alta calidad y la impresión directa digital (DTG) del diseño que creaste en esta página.</p>
                
                <a href="#" id="whatsapp-order-btn" onclick="sendWhatsAppOrder(event)" target="_blank" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-3 px-6 rounded-xl font-bold text-sm transition-all shadow-lg shadow-emerald-500/20 text-center flex items-center justify-center gap-2 group hover:-translate-y-0.5 active:translate-y-0">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Consultar Pedido por WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    // TABS / MENU LOGIC
    function switchTab(tabId) {
        document.querySelectorAll('.tab-pane').forEach(el => el.classList.add('hidden'));
        document.getElementById(tabId).classList.remove('hidden');

        document.querySelectorAll('[id^="btn-tab-"]').forEach(btn => {
            btn.className = "flex-1 py-2.5 px-1 rounded-xl text-xs font-bold transition-all flex flex-col sm:flex-row items-center justify-center gap-1.5 text-slate-500 hover:text-slate-800";
        });

        const activeBtn = document.getElementById(`btn-${tabId}`);
        if (activeBtn) {
            activeBtn.className = "flex-1 py-2.5 px-1 rounded-xl text-xs font-bold transition-all flex flex-col sm:flex-row items-center justify-center gap-1.5 text-indigo-600 bg-white shadow-sm border border-slate-200/50";
        }
    }

    // PRESETS & STATE
    
    let garmentStyle = 'regular'; // 'regular' | 'mujer' | 'polo'
    let frontElements = [];

    let backElements = [];
    let currentView = 'front'; // 'front' | 'back'
    let selectedElementId = null;
    
    let garmentColor = '#ffffff';
    let garmentMaterial = 'cotton'; // 'cotton' | 'polyester' | 'heather'
    let garmentSleeve = 'manga-corta'; // 'manga-corta' | 'manga-larga'
    
    let shadingIntensity = 0.45;
    let textureOpacity = 0.60;

    // References to DOM
    const printableZone = document.getElementById('printable-zone');
    const viewIndicator = document.getElementById('view-indicator');
    const customColorPicker = document.getElementById('custom-color-picker');
    const textInput = document.getElementById('text-input');
    const textFontSelect = document.getElementById('text-font');
    const textColorPicker = document.getElementById('text-color-picker');

    // Drag-and-drop state variables
    let dragStartPointer = { x: 0, y: 0 };
    let dragStartElement = { x: 0, y: 0 };
    let activeDragItem = null;

    // Resize/Rotate state variables
    let rotateStartPointer = { x: 0, y: 0 };
    let rotateStartAngle = 0;
    let rotateStartDist = 0;
    let rotateStartScale = 1;
    let rotateStartRotation = 0;
    let activeRotateItem = null;
    let activeRotateCenter = { x: 0, y: 0 };

    // Get current elements based on the view
    function getCurrentElements() {
        return currentView === 'front' ? frontElements : backElements;
    }

    // Toggle Active Group in SVG (front/back, short/long sleeve)
    function updateActiveGroup() {
        // Hide all base groups in base SVG
        document.querySelectorAll('#tshirt-base-svg .base-group').forEach(el => el.classList.add('hidden'));
        // Hide all overlay groups in overlay SVG
        document.querySelectorAll('#tshirt-overlay-svg .overlay-group').forEach(el => el.classList.add('hidden'));

        // Identify group ID suffix
        let suffix = `${currentView}-${garmentSleeve === 'manga-larga' ? 'long' : 'short'}-${garmentStyle}`;
        
        // Show correct base and overlay groups
        const activeBase = document.getElementById(`base-${suffix}`);
        const activeOverlay = document.getElementById(`overlay-${suffix}`);
        
        if (activeBase) activeBase.classList.remove('hidden');
        if (activeOverlay) activeOverlay.classList.remove('hidden');

        // Apply color & shading to all elements
        setColor(garmentColor);
        updateShadingIntensity(shadingIntensity * 100);
        updateTextureOpacity(textureOpacity * 100);
        setMaterial(garmentMaterial);
    }

    
    // UPDATE GARMENT STYLE (REGULAR, MUJER, POLO)
    function updateStyle(style) {
        garmentStyle = style;
        
        // Disable long sleeve for mujer and polo (only regular short sleeve is supported/realistic)
        const longSleeveLabel = document.querySelector('input[value="manga-larga"]').closest('label');
        if (style === 'mujer' || style === 'polo') {
            longSleeveLabel.style.opacity = '0.35';
            longSleeveLabel.style.pointerEvents = 'none';
            if (garmentSleeve === 'manga-larga') {
                document.querySelector('input[value="manga-corta"]').checked = true;
                garmentSleeve = 'manga-corta';
            }
        } else {
            longSleeveLabel.style.opacity = '1';
            longSleeveLabel.style.pointerEvents = 'auto';
        }
        
        updateActiveGroup();
        updatePrice();
    }

    // TOGGLE FRONT/BACK VISTA
    function toggleView(view) {
        selectedElementId = null;
        currentView = view;
        viewIndicator.innerText = `Vista: ${view === 'front' ? 'Frente' : 'Espalda'}`;
        updateActiveGroup();
        render();
        updatePrice();
    }

    // UPDATE SLEEVE TYPE (MANGA CORTA / LARGA)
    function updateSleeve(type) {
        garmentSleeve = type;
        updateActiveGroup();
        updatePrice();
    }

    // SET COLOR OF SHIRT
    function setColor(hex) {
        garmentColor = hex;
        // Update all paths with class .tshirt-fill in the SVG
        document.querySelectorAll('.tshirt-fill').forEach(el => {
            el.setAttribute('fill', hex);
        });

        // Ambient glow matches T-shirt color slightly for beautiful aesthetics
        const glow = document.getElementById('ambient-glow');
        if (hex.toLowerCase() === '#ffffff' || hex.toLowerCase() === '#faf9f6') {
            glow.style.backgroundColor = 'rgba(99, 102, 241, 0.12)';
        } else {
            glow.style.backgroundColor = `${hex}26`; // 15% opacity hex
        }

        // Highlight selected color button
        document.querySelectorAll('.color-btn').forEach(btn => {
            if (btn.dataset.color.toLowerCase() === hex.toLowerCase()) {
                btn.classList.add('ring-2', 'ring-indigo-500', 'ring-offset-2');
            } else {
                btn.classList.remove('ring-2', 'ring-indigo-500', 'ring-offset-2');
            }
        });

        updatePrice();
    }

    // SET FABRIC TEXTURE (COTTON, POLYESTER, HEATHER)
    function setMaterial(mat) {
        garmentMaterial = mat;
        
        // Hide all texture paths
        document.querySelectorAll('.tshirt-texture').forEach(el => el.classList.add('hidden'));

        // Show active texture
        if (mat === 'cotton') {
            document.querySelectorAll('.tshirt-texture.cotton').forEach(el => el.classList.remove('hidden'));
        } else if (mat === 'polyester') {
            document.querySelectorAll('.tshirt-texture.polyester').forEach(el => el.classList.remove('hidden'));
        } else if (mat === 'heather') {
            document.querySelectorAll('.tshirt-texture.heather').forEach(el => el.classList.remove('hidden'));
        }

        // Highlight button
        ['cotton', 'polyester', 'heather'].forEach(m => {
            const btn = document.getElementById(`mat-btn-${m}`);
            if (m === mat) {
                btn.className = "px-3 py-2.5 rounded-xl text-xs font-bold border-2 border-indigo-600 bg-indigo-50/30 text-indigo-700 transition-all";
            } else {
                btn.className = "px-3 py-2.5 rounded-xl text-xs font-bold border border-slate-200 text-slate-600 hover:bg-slate-50 transition-all";
            }
        });
    }

    // UPDATE SHADING INTENSITY SLIDER
    function updateShadingIntensity(val) {
        shadingIntensity = val / 100;
        document.getElementById('shadow-val').innerText = `${val}%`;
        document.querySelectorAll('#tshirt-overlay-svg .shading').forEach(el => {
            el.setAttribute('opacity', shadingIntensity);
        });
    }

    // UPDATE TEXTURE OPACITY SLIDER
    function updateTextureOpacity(val) {
        textureOpacity = val / 100;
        document.getElementById('texture-val').innerText = `${val}%`;
        document.querySelectorAll('.tshirt-texture').forEach(el => {
            el.setAttribute('opacity', textureOpacity);
        });
    }

    // REMOVE BACKGROUND: process image on canvas, make white/near-white pixels transparent
    function removeBackground(src) {
        return new Promise((resolve) => {
            const img = new Image();
            img.crossOrigin = 'anonymous';
            img.onload = function() {
                const canvas = document.createElement('canvas');
                canvas.width = img.naturalWidth;
                canvas.height = img.naturalHeight;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0);

                const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                const data = imageData.data;
                const threshold = 235;

                for (let i = 0; i < data.length; i += 4) {
                    const r = data[i];
                    const g = data[i + 1];
                    const b = data[i + 2];
                    if (r > threshold && g > threshold && b > threshold) {
                        const brightness = (r + g + b) / 3;
                        data[i + 3] = Math.round(Math.max(0, (threshold - brightness + 20) / 40 * 255));
                    }
                }

                ctx.putImageData(imageData, 0, 0);
                resolve(canvas.toDataURL('image/png'));
            };
            img.src = src;
        });
    }

    // ADD IMAGE DESIGN ELEMENT (preserves aspect ratio)
    function addImageElement(src, removeBg) {
        const pWidth = printableZone.clientWidth || 168;
        const pHeight = printableZone.clientHeight || 280;
        const maxSize = Math.min(pWidth, pHeight) * 0.7;

        const tempImg = new Image();
        tempImg.onload = function() {
            let elW = tempImg.naturalWidth;
            let elH = tempImg.naturalHeight;

            if (elW > maxSize || elH > maxSize) {
                const ratio = Math.min(maxSize / elW, maxSize / elH);
                elW = Math.round(elW * ratio);
                elH = Math.round(elH * ratio);
            }

            const newElement = {
                id: 'el-' + Date.now(),
                type: 'image',
                src: src,
                x: (pWidth - elW) / 2,
                y: (pHeight - elH) / 2 - 20,
                scale: 1.0,
                rotation: 0,
                width: elW,
                height: elH,
                removeBg: false
            };

            getCurrentElements().push(newElement);
            selectedElementId = newElement.id;
            render();
            updatePrice();
        };
        tempImg.src = src;
    }

    // HANDLE UPLOADED IMAGE
    async function handleImageUpload(e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = async function(ev) {
            const removeBg = document.getElementById('remove-bg-toggle')?.checked || false;
            let src = ev.target.result;
            if (removeBg) {
                src = await removeBackground(src);
            }
            addImageElement(src, removeBg);
        };
        reader.readAsDataURL(file);
    }

    // ADD TEXT DESIGN ELEMENT
    function handleCreateText() {
        const text = textInput.value.trim();
        if (!text) return;
        
        const font = textFontSelect.value;
        // Find selected color or use picker
        const activeColorBtn = document.querySelector('.text-color-btn.ring-2');
        const color = activeColorBtn ? activeColorBtn.dataset.color : '#1e293b';

        // Compute coordinate to center text (approximate size)
        const pWidth = printableZone.clientWidth || 168;
        const pHeight = printableZone.clientHeight || 280;

        const newElement = {
            id: 'el-' + Date.now(),
            type: 'text',
            text: text,
            fontFamily: font,
            color: color,
            x: (pWidth - 120) / 2,
            y: (pHeight - 24) / 2 + 10,
            scale: 1.1,
            rotation: 0,
            fontSize: 16
        };

        getCurrentElements().push(newElement);
        selectedElementId = newElement.id;
        textInput.value = '';
        render();
        updatePrice();
    }

    // CHANGE TEXT COLOR
    function setTextColor(hex) {
        // Highlight active btn
        document.querySelectorAll('.text-color-btn').forEach(btn => {
            if (btn.dataset.color.toLowerCase() === hex.toLowerCase()) {
                btn.classList.add('ring-2', 'ring-indigo-500');
            } else {
                btn.classList.remove('ring-2', 'ring-indigo-500');
            }
        });

        // If an element is selected and is text, update its color
        const elementsList = getCurrentElements();
        const activeEl = elementsList.find(el => el.id === selectedElementId);
        if (activeEl && activeEl.type === 'text') {
            activeEl.color = hex;
            render();
        }
    }

    // ADD PRELOADED VECTOR TEMPLATE
    function addTemplate(type) {
        // Define high-quality vectors with inline svg data URLs
        let svgString = '';
        if (type === 'sunset') {
            svgString = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" width="200" height="200">
                <circle cx="100" cy="90" r="70" fill="%23f97316"/>
                <rect x="0" y="95" width="200" height="6" fill="%23ffffff" opacity="0.9"/>
                <rect x="0" y="109" width="200" height="8" fill="%23ffffff" opacity="0.9"/>
                <rect x="0" y="125" width="200" height="10" fill="%23ffffff" opacity="0.9"/>
                <rect x="0" y="145" width="200" height="14" fill="%23ffffff" opacity="0.9"/>
                <path d="M 60 145 C 60 100 80 80 100 95 C 75 110 65 130 60 145 Z" fill="%231e293b"/>
                <path d="M 140 145 C 140 100 120 80 100 95 C 125 110 135 130 140 145 Z" fill="%231e293b"/>
                <text x="100" y="65" font-family="'Pacifico', cursive" font-size="28" font-weight="bold" fill="%23ffffff" text-anchor="middle">Pura Vida</text>
                <text x="100" y="180" font-family="'Montserrat', sans-serif" font-size="14" font-weight="900" letter-spacing="6" fill="%231e293b" text-anchor="middle">COSTA RICA</text>
            </svg>`;
        } else if (type === 'dev') {
            svgString = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" width="200" height="200">
                <rect x="10" y="10" width="180" height="180" rx="20" fill="%230f172a" stroke="%2338bdf8" stroke-width="3" />
                <text x="35" y="70" font-family="monospace" font-size="45" font-weight="bold" fill="%23f43f5e">&lt;</text>
                <text x="165" y="70" font-family="monospace" font-size="45" font-weight="bold" fill="%23f43f5e" text-anchor="end">&gt;</text>
                <text x="100" y="105" font-family="'Montserrat', sans-serif" font-size="20" font-weight="800" fill="%2338bdf8" text-anchor="middle">DEV // LIFE</text>
                <text x="100" y="140" font-family="monospace" font-size="14" fill="%23a7f3d0" text-anchor="middle">eat_sleep_code();</text>
                <circle cx="100" cy="165" r="4" fill="%2338bdf8" />
                <circle cx="85" cy="165" r="4" fill="%23e2e8f0" opacity="0.3" />
                <circle cx="115" cy="165" r="4" fill="%23e2e8f0" opacity="0.3" />
            </svg>`;
        } else if (type === 'mountains') {
            svgString = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" width="200" height="200">
                <circle cx="100" cy="90" r="45" fill="%23fecdd3" opacity="0.6"/>
                <path d="M 30 150 L 90 60 L 140 150 Z" fill="%23475569" opacity="0.8"/>
                <path d="M 80 150 L 130 80 L 180 150 Z" fill="%23334155"/>
                <path d="M 60 150 L 100 100 L 140 150 Z" fill="%2364748b" opacity="0.5"/>
                <line x1="20" y1="150" x2="180" y2="150" stroke="%231e293b" stroke-width="4" stroke-linecap="round"/>
                <text x="100" y="180" font-family="'Montserrat', sans-serif" font-size="14" font-weight="600" letter-spacing="8" fill="%231e293b" text-anchor="middle">WILDERNESS</text>
            </svg>`;
        } else if (type === 'coffee') {
            svgString = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" width="200" height="200">
                <path d="M 85 45 Q 80 30 85 20" stroke="%23f97316" stroke-width="3" stroke-linecap="round" fill="none" opacity="0.5"/>
                <path d="M 100 45 Q 95 30 100 20" stroke="%23f97316" stroke-width="3" stroke-linecap="round" fill="none" opacity="0.5"/>
                <path d="M 115 45 Q 110 30 115 20" stroke="%23f97316" stroke-width="3" stroke-linecap="round" fill="none" opacity="0.5"/>
                <rect x="65" y="55" width="70" height="70" rx="15" fill="%23fdba74" stroke="%237c2d12" stroke-width="4"/>
                <path d="M 135 70 C 155 70 155 110 135 110" stroke="%237c2d12" stroke-width="4" fill="none"/>
                <circle cx="85" cy="85" r="4" fill="%237c2d12"/>
                <circle cx="115" cy="85" r="4" fill="%237c2d12"/>
                <path d="M 95 98 Q 100 105 105 98" stroke="%237c2d12" stroke-width="3" stroke-linecap="round" fill="none"/>
                <circle cx="78" cy="92" r="3" fill="%23f87171" opacity="0.7"/>
                <circle cx="122" cy="92" r="3" fill="%23f87171" opacity="0.7"/>
                <text x="100" y="155" font-family="sans-serif" font-size="15" font-weight="bold" fill="%237c2d12" text-anchor="middle">Coffee Time</text>
            </svg>`;
        }

        const dataUri = `data:image/svg+xml;utf8,${svgString}`;
        addImageElement(dataUri);
    }

    // WORDART TEXT TEMPLATES
    function addTextTemplate(type) {
        let svgString = '';
        const userText = prompt('Escribí tu texto:', type === 'arch' ? 'ARCO' : type === 'wave' ? 'ONDA' : type === 'circle' ? 'DISEÑO' : type === 'outline' ? 'HOLA' : type === 'shadow3d' ? '3D' : type === 'gradient' ? 'FUEGO' : type === 'badge' ? 'PREMIUM' : 'CODE');
        if (!userText) return;

        const encoded = userText.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');

        if (type === 'arch') {
            svgString = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 180" width="300" height="180">
                <defs><path id="arch-p" d="M 30 150 Q 150 10 270 150" fill="none"/></defs>
                <text font-family="'Montserrat',sans-serif" font-size="48" font-weight="900" fill="%236d28d9" letter-spacing="4"><textPath href="#arch-p" startOffset="50%" text-anchor="middle">${encoded}</textPath></text>
            </svg>`;
        } else if (type === 'wave') {
            svgString = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 120" width="300" height="120">
                <defs><path id="wave-p" d="M 10 70 C 60 10 100 110 150 50 C 200 -10 240 100 290 40" fill="none"/></defs>
                <text font-family="'Pacifico',cursive" font-size="40" fill="%23e11d48" letter-spacing="2"><textPath href="#wave-p" startOffset="50%" text-anchor="middle">${encoded}</textPath></text>
            </svg>`;
        } else if (type === 'circle') {
            svgString = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" width="200" height="200">
                <defs><path id="circ-p" d="M 100 25 A 75 75 0 1 1 99.99 25" fill="none"/></defs>
                <text font-family="'Bebas Neue',sans-serif" font-size="22" fill="%23facc15" letter-spacing="6"><textPath href="#circ-p" startOffset="0%">${encoded} • ${encoded} • </textPath></text>
            </svg>`;
        } else if (type === 'outline') {
            svgString = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 100" width="300" height="100">
                <text x="150" y="72" font-family="'Montserrat',sans-serif" font-size="72" font-weight="900" fill="none" stroke="%231e40af" stroke-width="3" text-anchor="middle" letter-spacing="6">${encoded}</text>
            </svg>`;
        } else if (type === 'shadow3d') {
            svgString = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 100" width="300" height="100">
                <text x="155" y="75" font-family="'Montserrat',sans-serif" font-size="72" font-weight="900" fill="%23d1d5db" text-anchor="middle" letter-spacing="4">${encoded}</text>
                <text x="150" y="72" font-family="'Montserrat',sans-serif" font-size="72" font-weight="900" fill="%237c3aed" text-anchor="middle" letter-spacing="4">${encoded}</text>
            </svg>`;
        } else if (type === 'gradient') {
            svgString = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 100" width="300" height="100">
                <defs><linearGradient id="gfill" x1="0%25" y1="0%25" x2="100%25" y2="100%25"><stop offset="0%25" stop-color="%23f97316"/><stop offset="100%25" stop-color="%23ec4899"/></linearGradient></defs>
                <text x="150" y="72" font-family="'Outfit',sans-serif" font-size="72" font-weight="800" fill="url(%23gfill)" text-anchor="middle" letter-spacing="4">${encoded}</text>
            </svg>`;
        } else if (type === 'badge') {
            svgString = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" width="200" height="200">
                <circle cx="100" cy="100" r="85" fill="none" stroke="%2392400e" stroke-width="5"/>
                <circle cx="100" cy="100" r="75" fill="none" stroke="%2392400e" stroke-width="2"/>
                <text x="100" y="95" font-family="'Bebas Neue',sans-serif" font-size="36" fill="%2392400e" text-anchor="middle" letter-spacing="4">${encoded}</text>
                <line x1="35" y1="100" x2="165" y2="100" stroke="%2392400e" stroke-width="1"/>
                <text x="100" y="120" font-family="'Montserrat',sans-serif" font-size="12" fill="%2392400e" text-anchor="middle" letter-spacing="6">QUALITY</text>
            </svg>`;
        } else if (type === 'glitch') {
            svgString = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 100" width="300" height="100">
                <text x="153" y="65" font-family="monospace" font-size="52" font-weight="bold" fill="%2322d3ee" text-anchor="middle" opacity="0.7">${encoded}</text>
                <text x="147" y="62" font-family="monospace" font-size="52" font-weight="bold" fill="%23f43f5e" text-anchor="middle" opacity="0.7">${encoded}</text>
                <text x="150" y="63" font-family="monospace" font-size="52" font-weight="bold" fill="%23ffffff" text-anchor="middle">${encoded}</text>
            </svg>`;
        }

        const dataUri = `data:image/svg+xml;utf8,${svgString}`;
        addImageElement(dataUri);
    }

    // ALIGN ACTIVE ELEMENT (CENTER QUICK ALIGN)
    function centerActiveElement() {
        const elementsList = getCurrentElements();
        const activeEl = elementsList.find(el => el.id === selectedElementId);
        if (!activeEl) return;

        const pWidth = printableZone.clientWidth || 168;
        const pHeight = printableZone.clientHeight || 280;

        let elW = 0;
        let elH = 0;
        if (activeEl.type === 'image') {
            elW = activeEl.width * activeEl.scale;
            elH = activeEl.height * activeEl.scale;
        } else {
            // Estimate based on DOM bounding rect
            const domEl = document.getElementById(activeEl.id);
            if (domEl) {
                elW = domEl.offsetWidth;
                elH = domEl.offsetHeight;
            } else {
                elW = 120;
                elH = 20;
            }
        }

        // Center on X
        activeEl.x = (pWidth - (elW / activeEl.scale)) / 2;
        // Center on Y
        activeEl.y = (pHeight - (elH / activeEl.scale)) / 2;
        
        // Reset rotation for alignment
        activeEl.rotation = 0;
        
        render();
    }

    // DELETE SELECTED ELEMENT
    function deleteElement(id) {
        if (currentView === 'front') {
            frontElements = frontElements.filter(el => el.id !== id);
        } else {
            backElements = backElements.filter(el => el.id !== id);
        }
        selectedElementId = null;
        render();
        updatePrice();
    }

    // CLEAR ENTIRE VIEW CANVAS
    function clearCanvas() {
        if (confirm("¿Seguro que querés limpiar todos los elementos de esta vista?")) {
            if (currentView === 'front') {
                frontElements = [];
            } else {
                backElements = [];
            }
            selectedElementId = null;
            render();
            updatePrice();
        }
    }

    // DRAG LOGIC ON ELEMENT WRAPPER
    function startDragging(el, event) {
        activeDragItem = el;
        dragStartPointer.x = event.clientX;
        dragStartPointer.y = event.clientY;
        dragStartElement.x = el.x;
        dragStartElement.y = el.y;

        document.addEventListener('pointermove', onDragging);
        document.addEventListener('pointerup', stopDragging);
    }

    function onDragging(event) {
        if (!activeDragItem) return;
        const dx = event.clientX - dragStartPointer.x;
        const dy = event.clientY - dragStartPointer.y;

        activeDragItem.x = dragStartElement.x + dx;
        activeDragItem.y = dragStartElement.y + dy;

        render();
    }

    function stopDragging() {
        activeDragItem = null;
        document.removeEventListener('pointermove', onDragging);
        document.removeEventListener('pointerup', stopDragging);
    }

    // RESIZE & ROTATE HANDLE LOGIC
    function startResizeRotate(el, event, wrapper) {
        activeRotateItem = el;

        const rect = wrapper.getBoundingClientRect();
        activeRotateCenter.x = rect.left + rect.width / 2;
        activeRotateCenter.y = rect.top + rect.height / 2;

        const dx = event.clientX - activeRotateCenter.x;
        const dy = event.clientY - activeRotateCenter.y;
        rotateStartAngle = Math.atan2(dy, dx);
        rotateStartDist = Math.hypot(dx, dy);

        rotateStartScale = el.scale;
        rotateStartRotation = el.rotation;

        document.addEventListener('pointermove', onResizeRotate);
        document.addEventListener('pointerup', stopResizeRotate);
    }

    function onResizeRotate(event) {
        if (!activeRotateItem) return;

        const dx = event.clientX - activeRotateCenter.x;
        const dy = event.clientY - activeRotateCenter.y;

        const currentAngle = Math.atan2(dy, dx);
        const currentDist = Math.hypot(dx, dy);

        const angleDiff = (currentAngle - rotateStartAngle) * (180 / Math.PI);
        activeRotateItem.rotation = rotateStartRotation + angleDiff;

        const scaleDiff = currentDist / rotateStartDist;
        activeRotateItem.scale = Math.max(0.3, Math.min(2.5, rotateStartScale * scaleDiff));

        render();
    }

    // STOP RESIZE & ROTATE
    function stopResizeRotate() {
        activeRotateItem = null;
        document.removeEventListener('pointermove', onResizeRotate);
        document.removeEventListener('pointerup', stopResizeRotate);
    }

    // RENDER INTERACTIVE CANVAS DOM ELEMENTS
    function render() {
        printableZone.innerHTML = '';
        const elementsList = getCurrentElements();

        const helpLabel = document.getElementById('selection-help');
        if (selectedElementId && elementsList.some(e => e.id === selectedElementId)) {
            helpLabel.classList.remove('opacity-0');
        } else {
            helpLabel.classList.add('opacity-0');
        }

        elementsList.forEach(el => {
            const wrapper = document.createElement('div');
            wrapper.id = el.id;
            wrapper.className = `absolute select-none ${selectedElementId === el.id ? 'z-30 ring-2 ring-indigo-500 ring-offset-2 ring-offset-slate-900' : 'z-20 cursor-grab hover:ring-1 hover:ring-white/20'}`;
            wrapper.style.left = '0px';
            wrapper.style.top = '0px';
            wrapper.style.transform = `translate(${el.x}px, ${el.y}px) rotate(${el.rotation}deg) scale(${el.scale})`;
            wrapper.style.transformOrigin = 'center center';

            // Drag handle / Click selection
            wrapper.addEventListener('pointerdown', (e) => {
                e.stopPropagation();
                selectedElementId = el.id;
                render();
                startDragging(el, e);
            });

            // Content
            if (el.type === 'image') {
                const img = document.createElement('img');
                img.src = el.src;
                img.style.width = `${el.width}px`;
                img.style.height = `${el.height}px`;
                img.style.display = 'block';
                img.draggable = false;
                wrapper.appendChild(img);
            } else if (el.type === 'text') {
                const span = document.createElement('div');
                span.innerText = el.text;
                span.style.fontFamily = el.fontFamily;
                span.style.color = el.color;
                span.style.fontSize = `${el.fontSize}px`;
                span.style.fontWeight = 'bold';
                span.style.whiteSpace = 'nowrap';
                span.style.lineHeight = '1';
                wrapper.appendChild(span);
            }

            // Selection Controls (Trash & Resize/Rotate)
            if (selectedElementId === el.id) {
                // Delete button
                const delBtn = document.createElement('button');
                delBtn.className = 'absolute -top-3.5 -right-3.5 bg-red-500 hover:bg-red-600 text-white rounded-full p-1 shadow-lg transition-all flex items-center justify-center border-2 border-white hover:scale-105 active:scale-95';
                delBtn.style.width = '24px';
                delBtn.style.height = '24px';
                delBtn.innerHTML = `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>`;
                delBtn.addEventListener('pointerdown', (e) => {
                    e.stopPropagation();
                    deleteElement(el.id);
                });
                wrapper.appendChild(delBtn);

                // Resize/Rotate Anchor Handle
                const rotHandle = document.createElement('div');
                rotHandle.className = 'absolute -bottom-3.5 -right-3.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full p-1 shadow-lg cursor-se-resize transition-all flex items-center justify-center border-2 border-white hover:scale-105 active:scale-95';
                rotHandle.style.width = '24px';
                rotHandle.style.height = '24px';
                rotHandle.innerHTML = `<svg class="w-3.5 h-3.5 rotate-45" fill="currentColor" viewBox="0 0 24 24"><path d="M19 12h2v7a2 2 0 0 1-2 2h-7v-2h7v-7zm-6-8V2H6a2 2 0 0 0-2 2v7h2V4h7zm3.29 13.29a1 1 0 0 1-1.41 0L12 14.41V16H8v-4h4v1.59l2.88-2.88a1 1 0 0 1 1.41 1.41L13.41 12l2.88 2.88a1 1 0 0 1 0 1.41z"/></svg>`;
                rotHandle.addEventListener('pointerdown', (e) => {
                    e.stopPropagation();
                    startResizeRotate(el, e, wrapper);
                });
                wrapper.appendChild(rotHandle);
            }

            printableZone.appendChild(wrapper);
        });
    }

    // DESELECT ON CLICKING OUTSIDE ELEMENTS
    printableZone.addEventListener('pointerdown', (e) => {
        if (e.target === printableZone) {
            selectedElementId = null;
            render();
        }
    });

    // ESTIMATE & UPDATE PRICE
    function updatePrice() {
        let basePrice = 7500;
        if (garmentStyle === 'polo') basePrice = 9000;
        
        if (garmentSleeve === 'manga-larga') {
            basePrice += 2000;
        }

        // Texture or material fee
        if (garmentMaterial === 'heather') {
            basePrice += 1000; // heather material fee
        }

        // Print counts
        let frontPrints = frontElements.length;
        let backPrints = backElements.length;
        
        // Print base cost
        let printCost = 0;
        if (frontPrints > 0) printCost += 3000; // front print run
        if (backPrints > 0) printCost += 3000; // back print run
        
        // Additional elements cost
        if (frontPrints > 1) printCost += (frontPrints - 1) * 1000;
        if (backPrints > 1) printCost += (backPrints - 1) * 1000;

        const totalPrice = basePrice + printCost;
        document.getElementById('price-display').innerText = `₡${totalPrice.toLocaleString()}`;
    }

    // 3D TILT EFFECT ON MOUSEMOVE
    const backdrop = document.getElementById('studio-backdrop');
    const container3d = document.getElementById('preview-container');

    backdrop.addEventListener('mousemove', (e) => {
        const rect = backdrop.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        const xc = rect.width / 2;
        const yc = rect.height / 2;

        const rotateX = (yc - y) / 16; 
        const rotateY = (x - xc) / 16; 

        container3d.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
    });

    backdrop.addEventListener('mouseleave', () => {
        container3d.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg)';
        container3d.style.transition = 'transform 0.4s ease-out';
    });

    backdrop.addEventListener('mouseenter', () => {
        container3d.style.transition = 'none';
    });

    // GENERATE AND DOWNLOAD COMPOSITED IMAGE PNG
    function getSvgImage(svgId, view) {
        const svgEl = document.getElementById(svgId);
        const svgClone = svgEl.cloneNode(true);
        svgClone.setAttribute('width', '500');
        svgClone.setAttribute('height', '500');

        // Remove hidden groups and only keep the one matching current view+sleeve+style
        const suffix = `${view}-${garmentSleeve === 'manga-larga' ? 'long' : 'short'}-${garmentStyle}`;
        svgClone.querySelectorAll('.base-group, .overlay-group').forEach(g => {
            if (g.id && g.id.includes(suffix)) {
                g.classList.remove('hidden');
            } else {
                g.remove();
            }
        });

        const svgString = new XMLSerializer().serializeToString(svgClone);
        return 'data:image/svg+xml;charset=utf-8,' + encodeURIComponent(svgString);
    }

    async function renderOneSide(view, elementsList) {
        const canvas = document.createElement('canvas');
        canvas.width = 1000;
        canvas.height = 1000;
        const ctx = canvas.getContext('2d');

        ctx.fillStyle = 'rgba(0,0,0,0)';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        const loadImage = (src) => new Promise((resolve, reject) => {
            const img = new Image();
            img.crossOrigin = 'anonymous';
            img.onload = () => resolve(img);
            img.onerror = (err) => reject(err);
            img.src = src;
        });

        // 1. Get SVG for this specific view
        const baseSvgSrc = getSvgImage('tshirt-base-svg', view);
        const overlaySvgSrc = getSvgImage('tshirt-overlay-svg', view);

        // 2. Load SVGs
        const baseImg = await loadImage(baseSvgSrc);
        const overlayImg = await loadImage(overlaySvgSrc);

        // 3. Draw T-Shirt Base
        ctx.drawImage(baseImg, 0, 0, 1000, 1000);

        // 4. Draw Custom Design Elements (clipped to printable zone)
        const pLeft = 290;
        const pTop = 220;
        const pWidth = 420;
        const pHeight = 560;
        const scaleFactor = 2.5;

        ctx.save();
        ctx.beginPath();
        ctx.rect(pLeft, pTop, pWidth, pHeight);
        ctx.clip();

        for (const el of elementsList) {
            ctx.save();

            let elW = 0;
            let elH = 0;

            if (el.type === 'image') {
                elW = el.width;
                elH = el.height;
            } else {
                ctx.font = `bold ${el.fontSize}px ${el.fontFamily}`;
                const textMetric = ctx.measureText(el.text);
                elW = textMetric.width;
                elH = el.fontSize;
            }

            const cxCss = el.x + (elW / 2);
            const cyCss = el.y + (elH / 2);

            const canvasCx = pLeft + (cxCss * scaleFactor);
            const canvasCy = pTop + (cyCss * scaleFactor);

            ctx.translate(canvasCx, canvasCy);
            ctx.rotate(el.rotation * Math.PI / 180);
            ctx.scale(el.scale * scaleFactor, el.scale * scaleFactor);

            if (el.type === 'image') {
                const img = await loadImage(el.src);
                ctx.drawImage(img, -el.width / 2, -el.height / 2, el.width, el.height);
            } else if (el.type === 'text') {
                ctx.font = `bold ${el.fontSize}px ${el.fontFamily}`;
                ctx.fillStyle = el.color;
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillText(el.text, 0, 0);
            }

            ctx.restore();
        }
        ctx.restore();

        // 5. Draw Shading Overlay
        ctx.drawImage(overlayImg, 0, 0, 1000, 1000);

        return canvas;
    }

    async function exportDesign() {
        const exportBtn = document.getElementById('export-btn');
        const originalText = exportBtn.innerHTML;
        exportBtn.innerHTML = `<span class="inline-flex items-center gap-1.5"><svg class="animate-spin h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Generando...</span>`;
        exportBtn.disabled = true;

        try {
            // Render front
            const frontCanvas = await renderOneSide('front', frontElements);
            // Render back
            const backCanvas = await renderOneSide('back', backElements);

            // Download front
            const frontUrl = frontCanvas.toDataURL('image/png');
            const frontLink = document.createElement('a');
            frontLink.download = `camiseta-frente-${Date.now()}.png`;
            frontLink.href = frontUrl;
            frontLink.click();

            // Small delay so browser doesn't block second download
            await new Promise(r => setTimeout(r, 500));

            // Download back
            const backUrl = backCanvas.toDataURL('image/png');
            const backLink = document.createElement('a');
            backLink.download = `camiseta-espalda-${Date.now()}.png`;
            backLink.href = backUrl;
            backLink.click();
        } catch (err) {
            console.error("Error al exportar:", err);
            alert("No se pudo generar la imagen para exportar. Intente de nuevo.");
        } finally {
            exportBtn.innerHTML = originalText;
            exportBtn.disabled = false;
        }
    }

    // GENERATE AND REDIRECT TO WHATSAPP
    function sendWhatsAppOrder(e) {
        e.preventDefault();

        let detailString = `Hola Wilberth! Estuve diseñando una camiseta en tu demo.\n\n`;
        detailString += `*Detalles del pedido:*\n`;
        detailString += `- Estilo / Corte: ${garmentStyle === 'regular' ? 'Normal' : garmentStyle === 'mujer' ? 'Mujer Fit' : 'Tipo Polo'}\n`;
        detailString += `- Tipo de Manga: ${garmentSleeve === 'manga-corta' ? 'Manga Corta' : 'Manga Larga'}\n`;
        detailString += `- Material/Textura: ${garmentMaterial.charAt(0).toUpperCase() + garmentMaterial.slice(1)}\n`;
        detailString += `- Color de Camiseta: ${garmentColor}\n`;
        
        let frontPrints = frontElements.length;
        let backPrints = backElements.length;

        detailString += `- Diseños Frente: ${frontPrints > 0 ? `${frontPrints} elemento(s)` : 'Ninguno'}\n`;
        detailString += `- Diseños Espalda: ${backPrints > 0 ? `${backPrints} elemento(s)` : 'Ninguno'}\n`;
        detailString += `- Precio Estimado: ${document.getElementById('price-display').innerText}\n\n`;
        detailString += `¡Quiero enviarte mi diseño PNG para que lo imprimamos!`;

        const encodedMsg = encodeURIComponent(detailString);
        window.open(`https://wa.me/50685008393?text=${encodedMsg}`, '_blank');
    }

    // INITIALIZATION
    window.addEventListener('load', () => {
        updateActiveGroup();
        render();
        updatePrice();
    });
</script>
@endsection

