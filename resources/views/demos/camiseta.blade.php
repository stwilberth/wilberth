@extends('layouts.app')

@section('title', 'Diseñá tu Camiseta Online - Demo Interactiva - Wilberth')

@section('content')
<section class="bg-gradient-to-r from-indigo-600 to-indigo-800 text-white py-16 mb-12">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Diseñá tu Camiseta</h1>
        <p class="text-xl text-indigo-100 max-w-2xl mx-auto">Subí tu imagen, elegí color y posición. Velo al instante.</p>
    </div>
</section>

<section class="mb-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-6 flex items-center justify-center" style="min-height: 500px;">
            <div id="preview" class="relative">
                <svg id="tshirt-preview" viewBox="0 0 400 500" width="100%" style="max-width: 400px;" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <clipPath id="tshirt-clip">
                            <path d="M200 30 C180 30 160 35 140 45 L100 25 L90 50 L120 70 C110 90 105 110 100 140 L80 150 L85 170 L110 160 L120 380 C125 420 140 440 160 450 L240 450 C260 440 275 420 280 380 L290 160 L315 170 L320 150 L300 140 C295 110 290 90 280 70 L310 50 L300 25 L260 45 C240 35 220 30 200 30Z" />
                        </clipPath>
                    </defs>
                    <g clip-path="url(#tshirt-clip)">
                        <rect id="tshirt-body" x="0" y="0" width="400" height="500" fill="#ffffff" />
                        <image id="design-image" href="" x="100" y="140" width="200" height="200" preserveAspectRatio="xMidYMid slice" style="display:none;" />
                    </g>
                    <path d="M200 30 C180 30 160 35 140 45 L100 25 L90 50 L120 70 C110 90 105 110 100 140 L80 150 L85 170 L110 160 L120 380 C125 420 140 440 160 450 L240 450 C260 440 275 420 280 380 L290 160 L315 170 L320 150 L300 140 C295 110 290 90 280 70 L310 50 L300 25 L260 45 C240 35 220 30 200 30Z" fill="none" stroke="#ccc" stroke-width="2" />
                    <path d="M200 30 L200 450" fill="none" stroke="#ddd" stroke-width="1" stroke-dasharray="4" />
                </svg>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="font-bold text-gray-900 mb-4">Opciones</h3>

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Imagen</label>
                        <input type="file" id="image-input" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Color de camiseta</label>
                        <div class="flex flex-wrap gap-2">
                            <button class="color-btn w-8 h-8 rounded-full border-2 border-gray-300" style="background:#ffffff" data-color="#ffffff" title="Blanco"></button>
                            <button class="color-btn w-8 h-8 rounded-full border-2 border-gray-300" style="background:#000000" data-color="#000000" title="Negro"></button>
                            <button class="color-btn w-8 h-8 rounded-full border-2 border-gray-300" style="background:#1a56db" data-color="#1a56db" title="Azul"></button>
                            <button class="color-btn w-8 h-8 rounded-full border-2 border-gray-300" style="background:#dc2626" data-color="#dc2626" title="Rojo"></button>
                            <button class="color-btn w-8 h-8 rounded-full border-2 border-gray-300" style="background:#16a34a" data-color="#16a34a" title="Verde"></button>
                            <button class="color-btn w-8 h-8 rounded-full border-2 border-gray-300" style="background:#ca8a04" data-color="#ca8a04" title="Amarillo"></button>
                            <button class="color-btn w-8 h-8 rounded-full border-2 border-gray-300" style="background:#7c3aed" data-color="#7c3aed" title="Morado"></button>
                            <button class="color-btn w-8 h-8 rounded-full border-2 border-gray-300" style="background:#f97316" data-color="#f97316" title="Naranja"></button>
                            <button class="color-btn w-8 h-8 rounded-full border-2 border-gray-300" style="background:#ec4899" data-color="#ec4899" title="Rosa"></button>
                            <button class="color-btn w-8 h-8 rounded-full border-2 border-gray-300" style="background:#64748b" data-color="#64748b" title="Gris"></button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Posición del diseño</label>
                        <select id="position-select" class="block w-full rounded-lg border-gray-300 border p-2.5 text-sm">
                            <option value="chest-center">Pecho frente (centro)</option>
                            <option value="chest-left">Pecho lado izquierdo</option>
                            <option value="full-front">Frente completo</option>
                            <option value="back">Espalda</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tamaño del diseño</label>
                        <input type="range" id="size-range" min="50" max="300" value="150" class="w-full" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de camiseta</label>
                        <div class="flex gap-3">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="type" value="manga-corta" checked class="text-indigo-600" />
                                <span class="text-sm">Manga corta</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="type" value="manga-larga" class="text-indigo-600" />
                                <span class="text-sm">Manga larga</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 text-white rounded-xl shadow-lg p-6 text-center">
                <p class="text-sm mb-3">¿Querés una app web como esta para tu negocio?</p>
                <a href="https://wa.me/50685008393?text=Hola! Vi el demo de diseño de camisetas y quiero una app así" target="_blank" class="bg-white text-indigo-600 px-6 py-2.5 rounded-lg font-semibold text-sm hover:bg-indigo-50 transition-colors inline-block">Consultar por WhatsApp</a>
            </div>
        </div>
    </div>
</section>

<script>
    const tshirtBody = document.getElementById('tshirt-body');
    const designImage = document.getElementById('design-image');
    const imageInput = document.getElementById('image-input');
    const positionSelect = document.getElementById('position-select');
    const sizeRange = document.getElementById('size-range');
    const typeRadios = document.querySelectorAll('input[name="type"]');

    let uploadedImageUrl = null;

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                uploadedImageUrl = ev.target.result;
                designImage.setAttribute('href', uploadedImageUrl);
                designImage.style.display = 'block';
                updatePosition();
            };
            reader.readAsDataURL(file);
        }
    });

    document.querySelectorAll('.color-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.color-btn').forEach(b => b.classList.remove('ring-2', 'ring-indigo-500'));
            this.classList.add('ring-2', 'ring-indigo-500');
            tshirtBody.setAttribute('fill', this.dataset.color);
        });
    });
    document.querySelector('.color-btn').classList.add('ring-2', 'ring-indigo-500');

    positionSelect.addEventListener('change', updatePosition);
    sizeRange.addEventListener('input', updatePosition);

    function updatePosition() {
        const pos = positionSelect.value;
        const size = parseInt(sizeRange.value);
        const svg = document.getElementById('tshirt-preview');
        const vbWidth = 400;
        const vbHeight = 500;

        let x, y, w, h;

        switch(pos) {
            case 'chest-center':
                w = size;
                h = size;
                x = (vbWidth - w) / 2;
                y = 160;
                break;
            case 'chest-left':
                w = size * 0.7;
                h = size * 0.7;
                x = 70;
                y = 170;
                break;
            case 'full-front':
                w = size * 1.2;
                h = size * 1.2;
                x = (vbWidth - w) / 2;
                y = 120;
                break;
            case 'back':
                w = size;
                h = size;
                x = (vbWidth - w) / 2;
                y = 140;
                break;
        }

        designImage.setAttribute('x', x);
        designImage.setAttribute('y', y);
        designImage.setAttribute('width', w);
        designImage.setAttribute('height', h);
    }

    typeRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            const isLong = this.value === 'manga-larga';
            const path = document.querySelector('#tshirt-clip path, #tshirt-preview > path');
        });
    });

    updatePosition();
</script>
@endsection
