<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function create()
    {
        return view('admin.quotes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'required|string|max:50',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $subtotal = collect($data['items'])->sum(fn($item) => $item['quantity'] * $item['unit_price']);
        $taxRate = 13;
        $taxAmount = $subtotal * ($taxRate / 100);
        $total = $subtotal + $taxAmount;

        $quote = Quote::create([
            'client_name' => $data['client_name'],
            'client_email' => $data['client_email'],
            'client_phone' => $data['client_phone'],
            'notes' => $data['notes'],
            'subtotal' => $subtotal,
            'tax_rate' => $taxRate,
            'tax_amount' => $taxAmount,
            'total' => $total,
            'status' => 'pendiente',
        ]);

        foreach ($data['items'] as $item) {
            $quote->items()->create([
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total_price' => $item['quantity'] * $item['unit_price'],
            ]);
        }

        return redirect("/admin/quotes/{$quote->id}")->with('success', 'Cotización creada');
    }

    public function show(Quote $quote)
    {
        $quote->load('items');
        return view('admin.quotes.show', compact('quote'));
    }

    public function updateStatus(Request $request, Quote $quote)
    {
        $request->validate(['status' => 'required|in:pendiente,aprobada,rechazada']);
        $quote->update(['status' => $request->status]);
        return back()->with('success', 'Estado actualizado');
    }

    public function destroy(Quote $quote)
    {
        $quote->items()->delete();
        $quote->delete();
        return redirect('/admin/dashboard')->with('success', 'Cotización eliminada');
    }
}
