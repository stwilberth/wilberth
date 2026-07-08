<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Quote;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('items')->latest()->get();
        return view('admin.invoices.index', compact('invoices'));
    }

    public function createFromQuote(Quote $quote)
    {
        $quote->load('items');
        return view('admin.invoices.create', compact('quote'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'quote_id' => 'nullable|exists:quotes,id',
            'client_name' => 'required|string|max:255',
            'client_id_type' => 'required|in:fisica,juridica,dimex,nite',
            'client_id_number' => 'required|string|max:20',
            'client_address' => 'nullable|string|max:500',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'required|string|max:50',
            'notes' => 'nullable|string',
            'status' => 'required|in:emitida,anulada',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $subtotal = collect($data['items'])->sum(fn($item) => $item['quantity'] * $item['unit_price']);
        $taxRate = 13;
        $taxAmount = $subtotal * ($taxRate / 100);
        $total = $subtotal + $taxAmount;

        $last = Invoice::max('id') ?? 0;
        $invoiceNumber = 'FAC-' . now()->format('Ymd') . '-' . str_pad($last + 1, 4, '0', STR_PAD_LEFT);

        $invoice = Invoice::create([
            'invoice_number' => $invoiceNumber,
            'quote_id' => $data['quote_id'],
            'client_name' => $data['client_name'],
            'client_id_type' => $data['client_id_type'],
            'client_id_number' => $data['client_id_number'],
            'client_address' => $data['client_address'] ?? null,
            'client_email' => $data['client_email'],
            'client_phone' => $data['client_phone'],
            'notes' => $data['notes'],
            'status' => $data['status'],
            'subtotal' => $subtotal,
            'tax_rate' => $taxRate,
            'tax_amount' => $taxAmount,
            'total' => $total,
        ]);

        foreach ($data['items'] as $item) {
            $invoice->items()->create([
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total_price' => $item['quantity'] * $item['unit_price'],
            ]);
        }

        return redirect("/admin/invoices/{$invoice->id}")->with('success', 'Factura creada');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('items');
        return view('admin.invoices.show', compact('invoice'));
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->items()->delete();
        $invoice->delete();
        return redirect('/admin/invoices')->with('success', 'Factura eliminada');
    }

    public function pdf(Invoice $invoice)
    {
        $invoice->load('items');
        $pdf = Pdf::loadView('invoices.pdf', compact('invoice'));
        return $pdf->download("factura-{$invoice->invoice_number}.pdf");
    }

    public function publicView(Invoice $invoice)
    {
        $invoice->load('items');
        return view('invoices.public', compact('invoice'));
    }
}
