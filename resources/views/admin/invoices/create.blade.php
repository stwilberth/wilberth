<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crear Factura - Admin Wilberth</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-50 min-h-screen">
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <h1 class="text-xl font-black text-slate-900">Nueva Factura</h1>
            <a href="/admin/invoices" class="text-sm text-slate-500 hover:text-slate-700">← Volver</a>
        </div>
    </header>

    <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <form method="POST" action="/admin/invoices" id="quote-form" class="space-y-6">
            @csrf
            @if ($quote ?? null)
                <input type="hidden" name="quote_id" value="{{ $quote->id }}" />
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 space-y-4">
                <h3 class="text-lg font-bold text-slate-900">Datos del Cliente</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-3">
                        <label for="client_name" class="block text-sm font-medium text-slate-700 mb-1">Nombre *</label>
                        <input type="text" id="client_name" name="client_name" value="{{ $quote->client_name ?? '' }}" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none" />
                    </div>
                    <div>
                        <label for="client_id_type" class="block text-sm font-medium text-slate-700 mb-1">Tipo ID *</label>
                        <select id="client_id_type" name="client_id_type" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
                            <option value="fisica" {{ ($quote->client_id_type ?? '') === 'fisica' ? 'selected' : '' }}>Cédula Física</option>
                            <option value="juridica" {{ ($quote->client_id_type ?? '') === 'juridica' ? 'selected' : '' }}>Cédula Jurídica</option>
                            <option value="dimex" {{ ($quote->client_id_type ?? '') === 'dimex' ? 'selected' : '' }}>DIMEX</option>
                            <option value="nite" {{ ($quote->client_id_type ?? '') === 'nite' ? 'selected' : '' }}>NITE</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label for="client_id_number" class="block text-sm font-medium text-slate-700 mb-1">Número ID *</label>
                        <input type="text" id="client_id_number" name="client_id_number" value="{{ $quote->client_id_number ?? '' }}" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none" />
                    </div>
                    <div>
                        <label for="client_email" class="block text-sm font-medium text-slate-700 mb-1">Email *</label>
                        <input type="email" id="client_email" name="client_email" value="{{ $quote->client_email ?? '' }}" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none" />
                    </div>
                    <div>
                        <label for="client_phone" class="block text-sm font-medium text-slate-700 mb-1">Teléfono *</label>
                        <input type="tel" id="client_phone" name="client_phone" value="{{ $quote->client_phone ?? '' }}" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none" />
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-900">Items</h3>
                    <button type="button" id="add-item" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">+ Agregar item</button>
                </div>

                <div id="items-container" class="space-y-3">
                    @forelse (($quote->items ?? []) as $i => $item)
                        <div class="item-row grid grid-cols-1 md:grid-cols-[1fr_80px_120px] gap-3 items-start">
                            <div>
                                <label class="block text-xs font-medium text-slate-500 mb-1">Descripción</label>
                                <input type="text" name="items[{{ $i }}][description]" value="{{ $item->description }}" required
                                    class="w-full px-3 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm" />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-500 mb-1">Cant.</label>
                                <input type="number" name="items[{{ $i }}][quantity]" value="{{ $item->quantity }}" min="1" required
                                    class="w-full px-3 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm" />
                            </div>
                            <div class="flex gap-2">
                                <div class="flex-1">
                                    <label class="block text-xs font-medium text-slate-500 mb-1">Precio</label>
                                    <input type="number" name="items[{{ $i }}][unit_price]" value="{{ $item->unit_price }}" step="0.01" min="0" required
                                        class="w-full px-3 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm" />
                                </div>
                                <button type="button" class="remove-item mt-5 p-2.5 text-red-400 hover:text-red-600 transition-colors {{ $loop->first ? 'hidden' : '' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="item-row grid grid-cols-1 md:grid-cols-[1fr_80px_120px] gap-3 items-start">
                            <div>
                                <label class="block text-xs font-medium text-slate-500 mb-1">Descripción</label>
                                <input type="text" name="items[0][description]" required
                                    class="w-full px-3 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm" />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-500 mb-1">Cant.</label>
                                <input type="number" name="items[0][quantity]" value="1" min="1" required
                                    class="w-full px-3 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm" />
                            </div>
                            <div class="flex gap-2">
                                <div class="flex-1">
                                    <label class="block text-xs font-medium text-slate-500 mb-1">Precio</label>
                                    <input type="number" name="items[0][unit_price]" step="0.01" min="0" required
                                        class="w-full px-3 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm" />
                                </div>
                                <button type="button" class="remove-item mt-5 p-2.5 text-red-400 hover:text-red-600 transition-colors hidden">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="border-t border-slate-100 pt-4 space-y-2">
                    <div class="flex justify-between text-sm text-slate-600">
                        <span>Subtotal</span>
                        <span id="subtotal">₡0</span>
                    </div>
                    <div class="flex justify-between text-sm text-slate-600">
                        <span>IVA (13%)</span>
                        <span id="tax">₡0</span>
                    </div>
                    <div class="flex justify-between text-lg font-bold text-slate-900 border-t border-slate-200 pt-2">
                        <span>Total</span>
                        <span id="total">₡0</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <label for="notes" class="block text-sm font-medium text-slate-700 mb-1">Notas</label>
                <textarea id="notes" name="notes" rows="3"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">{{ $quote->notes ?? '' }}</textarea>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <label for="status" class="block text-sm font-medium text-slate-700 mb-1">Estado</label>
                <select id="status" name="status" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
                    <option value="emitida">Emitida</option>
                    <option value="anulada">Anulada</option>
                </select>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-8 py-3 rounded-xl transition-colors">Crear Factura</button>
                <a href="/admin/invoices" class="bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium px-8 py-3 rounded-xl transition-colors">Cancelar</a>
            </div>
        </form>
    </main>

    <script>
        let itemIndex = {{ count($quote->items ?? []) }};

        function formatColones(n) {
            return '₡' + Math.round(n).toLocaleString('es-CR');
        }

        function updateTotals() {
            let subtotal = 0;
            document.querySelectorAll('.item-row').forEach(row => {
                const qty = parseInt(row.querySelector('[name$="[quantity]"]').value) || 0;
                const price = parseFloat(row.querySelector('[name$="[unit_price]"]').value) || 0;
                subtotal += qty * price;
            });
            const tax = subtotal * 0.13;
            const total = subtotal + tax;
            document.getElementById('subtotal').textContent = formatColones(subtotal);
            document.getElementById('tax').textContent = formatColones(tax);
            document.getElementById('total').textContent = formatColones(total);
        }

        function createItemRow() {
            const template = document.querySelector('.item-row');
            const clone = template.cloneNode(true);
            clone.querySelectorAll('[name$="[description]"]').forEach(el => el.name = `items[${itemIndex}][description]`);
            clone.querySelectorAll('[name$="[quantity]"]').forEach(el => { el.name = `items[${itemIndex}][quantity]`; el.value = '1'; });
            clone.querySelectorAll('[name$="[unit_price]"]').forEach(el => { el.name = `items[${itemIndex}][unit_price]`; el.value = ''; });
            const removeBtn = clone.querySelector('.remove-item');
            removeBtn.classList.remove('hidden');
            removeBtn.addEventListener('click', () => { clone.remove(); updateTotals(); });
            clone.querySelectorAll('input').forEach(input => input.addEventListener('input', updateTotals));
            itemIndex++;
            return clone;
        }

        document.getElementById('add-item')?.addEventListener('click', () => {
            document.getElementById('items-container').appendChild(createItemRow());
        });

        document.querySelectorAll('.item-row input').forEach(input => input.addEventListener('input', updateTotals));

        document.querySelectorAll('.remove-item:not(.hidden)').forEach(btn => {
            btn.addEventListener('click', () => { btn.closest('.item-row').remove(); updateTotals(); });
        });

        updateTotals();
    </script>
</body>
</html>
