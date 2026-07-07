<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;

class DashboardController extends Controller
{
    public function index()
    {
        $quotes = Quote::with('items')->latest()->get();

        $stats = [
            'total' => $quotes->count(),
            'pendientes' => $quotes->where('status', 'pendiente')->count(),
            'aprobadas' => $quotes->where('status', 'aprobada')->count(),
            'rechazadas' => $quotes->where('status', 'rechazada')->count(),
        ];

        return view('admin.dashboard', compact('quotes', 'stats'));
    }
}
