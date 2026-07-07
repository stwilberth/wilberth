<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Wilberth</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-sm">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-black text-slate-900">Panel Admin</h1>
            <p class="text-slate-500 text-sm mt-1">Ingresa tu contraseña</p>
        </div>

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-6">{{ session('error') }}</div>
        @endif

        <form method="POST" action="/admin/login" class="space-y-4">
            @csrf
            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Contraseña</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none"
                    placeholder="••••••••" />
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-xl transition-colors">
                Ingresar
            </button>
        </form>
    </div>
</body>
</html>
