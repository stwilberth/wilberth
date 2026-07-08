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
            'client_id_type' => 'required|in:fisica,juridica,dimex,nite',
            'client_id_number' => 'required|string|max:20',
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

        $last = Quote::max('id') ?? 0;
        $quoteNumber = 'COT-' . now()->format('Y') . '-' . str_pad($last + 1, 4, '0', STR_PAD_LEFT);

        $quote = Quote::create([
            'quote_number' => $quoteNumber,
            'client_name' => $data['client_name'],
            'client_id_type' => $data['client_id_type'],
            'client_id_number' => $data['client_id_number'],
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

    public function edit(Quote $quote)
    {
        $quote->load('items');
        return view('admin.quotes.edit', compact('quote'));
    }

    public function update(Request $request, Quote $quote)
    {
        $data = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_id_type' => 'required|in:fisica,juridica,dimex,nite',
            'client_id_number' => 'required|string|max:20',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'required|string|max:50',
            'notes' => 'nullable|string',
            'status' => 'required|in:pendiente,aprobada,rechazada',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $subtotal = collect($data['items'])->sum(fn($item) => $item['quantity'] * $item['unit_price']);
        $taxRate = 13;
        $taxAmount = $subtotal * ($taxRate / 100);
        $total = $subtotal + $taxAmount;

        $quote->update([
            'client_name' => $data['client_name'],
            'client_id_type' => $data['client_id_type'],
            'client_id_number' => $data['client_id_number'],
            'client_email' => $data['client_email'],
            'client_phone' => $data['client_phone'],
            'notes' => $data['notes'],
            'status' => $data['status'],
            'subtotal' => $subtotal,
            'tax_rate' => $taxRate,
            'tax_amount' => $taxAmount,
            'total' => $total,
        ]);

        $quote->items()->delete();
        foreach ($data['items'] as $item) {
            $quote->items()->create([
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total_price' => $item['quantity'] * $item['unit_price'],
            ]);
        }

        return redirect("/admin/quotes/{$quote->id}")->with('success', 'Cotización actualizada');
    }

    public function updateStatus(Request $request, Quote $quote)
    {
        $request->validate(['status' => 'required|in:pendiente,aprobada,rechazada']);
        $quote->update(['status' => $request->status]);
        return back()->with('success', 'Estado actualizado');
    }

    public function publicView(Quote $quote)
    {
        $quote->load('items');
        return view('quotes.public', compact('quote'));
    }

    public function downloadPdf(Quote $quote)
    {
        $quote->load('items');
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('quotes.pdf', compact('quote'));
        return $pdf->download("cotizacion-{$quote->id}.pdf");
    }

    public function destroy(Quote $quote)
    {
        $quote->items()->delete();
        $quote->delete();
        return redirect('/admin/dashboard')->with('success', 'Cotización eliminada');
    }
}
