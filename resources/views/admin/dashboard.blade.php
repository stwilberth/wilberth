<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Admin Wilberth</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-50 min-h-screen">
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <h1 class="text-xl font-black text-slate-900">Admin</h1>
                <nav class="hidden md:flex items-center gap-1 ml-4">
                    <a href="/admin/dashboard" class="px-4 py-2 text-sm font-medium bg-indigo-50 text-indigo-700 rounded-lg">Cotizaciones</a>
                    <a href="/admin/quotes/create" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all">Nueva Cotización</a>
                    <a href="/admin/invoices" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all">Facturas</a>
                </nav>
            </div>
            <div class="flex items-center gap-3">
                <a href="/" class="text-sm text-slate-500 hover:text-slate-700">Ver sitio</a>
                <form method="POST" action="/admin/logout">
                    @csrf
                    <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm mb-6">{{ session('success') }}</div>
        @endif

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200">
                <p class="text-3xl font-black text-slate-900">{{ $stats['total'] }}</p>
                <p class="text-sm text-slate-500 mt-1">Totales</p>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200">
                <p class="text-3xl font-black text-amber-600">{{ $stats['pendientes'] }}</p>
                <p class="text-sm text-slate-500 mt-1">Pendientes</p>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200">
                <p class="text-3xl font-black text-emerald-600">{{ $stats['aprobadas'] }}</p>
                <p class="text-sm text-slate-500 mt-1">Aprobadas</p>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200">
                <p class="text-3xl font-black text-red-600">{{ $stats['rechazadas'] }}</p>
                <p class="text-sm text-slate-500 mt-1">Rechazadas</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h2 class="text-lg font-bold text-slate-900">Cotizaciones</h2>
                <a href="/admin/quotes/create" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold px-4 py-2 rounded-lg transition-colors">+ Nueva</a>
            </div>

            @if ($quotes->isEmpty())
                <div class="p-12 text-center text-slate-400">
                    <p class="text-lg">No hay cotizaciones aún</p>
                    <a href="/admin/quotes/create" class="text-indigo-600 hover:text-indigo-800 font-medium text-sm mt-2 inline-block">Crear la primera</a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50 text-slate-600 text-xs uppercase tracking-wider">
                            <tr>
                                <th class="text-left px-6 py-3 font-medium">Cliente</th>
                                <th class="text-left px-6 py-3 font-medium">Contacto</th>
                                <th class="text-right px-6 py-3 font-medium">Total</th>
                                <th class="text-center px-6 py-3 font-medium">Estado</th>
                                <th class="text-left px-6 py-3 font-medium">Fecha</th>
                                <th class="text-center px-6 py-3 font-medium">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($quotes as $quote)
                                @php
                                    $badge = match($quote->status) {
                                        'pendiente' => 'bg-amber-100 text-amber-800',
                                        'aprobada' => 'bg-emerald-100 text-emerald-800',
                                        'rechazada' => 'bg-red-100 text-red-800',
                                        default => 'bg-slate-100 text-slate-800',
                                    };
                                @endphp
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-slate-900">{{ $quote->client_name }}</td>
                                    <td class="px-6 py-4 text-slate-500">
                                        <div>{{ $quote->client_email }}</div>
                                        <div class="text-xs">{{ $quote->client_phone }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-right font-mono font-medium">₡{{ number_format($quote->total, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $badge }}">{{ $quote->status }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500 text-xs">{{ $quote->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-6 py-4 text-center space-x-2">
                                        <a href="/admin/quotes/{{ $quote->id }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Ver</a>
                                        <a href="/admin/quotes/{{ $quote->id }}/edit" class="text-amber-600 hover:text-amber-800 text-sm font-medium">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </main>
</body>
</html>
