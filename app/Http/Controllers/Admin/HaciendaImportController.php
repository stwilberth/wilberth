<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HaciendaDocument;
use App\Models\Invoice;
use App\Models\Quote;
use App\Services\HaciendaXmlParser;
use Illuminate\Http\Request;

class HaciendaImportController extends Controller
{
    public function create()
    {
        $documents = HaciendaDocument::with('invoice')->latest()->limit(50)->get();

        return view('admin.hacienda.import', compact('documents'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'xmls' => 'required|array|min:1',
            'xmls.*' => 'required|file',
        ]);

        $summary = [
            'imported' => [],
            'duplicates' => [],
            'skipped' => [],
            'errors' => [],
            'responses' => [],
        ];

        foreach ($data['xmls'] as $file) {
            $name = $file->getClientOriginalName();
            $content = file_get_contents($file->getRealPath());

            try {
                $rootName = HaciendaXmlParser::rootName($content);
            } catch (\Throwable $e) {
                $summary['errors'][] = "{$name}: {$e->getMessage()}";

                continue;
            }

            if (in_array($rootName, ['Respuesta', 'MensajeHacienda'])) {
                try {
                    $resp = HaciendaXmlParser::parseResponse($content);
                } catch (\Throwable $e) {
                    $summary['errors'][] = "{$name}: {$e->getMessage()}";

                    continue;
                }

                $doc = HaciendaDocument::where('clave', $resp['clave'])->first();

                if (! $doc) {
                    $summary['errors'][] = "{$name}: no se encontró un comprobante con esa clave.";

                    continue;
                }

                $doc->update([
                    'respuesta_estado' => $resp['estado'],
                    'respuesta_fecha' => $resp['fecha'],
                    'respuesta_mensajes' => $resp['mensajes'] ?: null,
                    'respuesta_xml' => $content,
                ]);

                $summary['responses'][] = "{$resp['clave']}: {$resp['estado']}".($doc->invoice ? ' (factura '.$doc->invoice->invoice_number.')' : '');

                continue;
            }

            try {
                $parsed = HaciendaXmlParser::parse($content);
            } catch (\Throwable $e) {
                $summary['errors'][] = "{$name}: {$e->getMessage()}";

                continue;
            }

            if (HaciendaDocument::where('clave', $parsed['clave'])->exists()) {
                $summary['duplicates'][] = $parsed['clave'];

                continue;
            }

            $document = HaciendaDocument::create([
                'clave' => $parsed['clave'],
                'numero_consecutivo' => $parsed['numero_consecutivo'],
                'document_type' => $parsed['type'],
                'fecha_emision' => $parsed['fecha_emision'],
                'emisor' => $parsed['emisor'],
                'emisor_data' => $parsed['emisor_data'],
                'receptor' => $parsed['receptor']['name'],
                'total' => $parsed['total'],
                'raw_xml' => $content,
            ]);

            if (! in_array($parsed['type'], ['factura', 'factura_exportacion', 'tiquete'])) {
                $summary['skipped'][] = "{$name}: documento {$parsed['type']} registrado sin factura.";

                continue;
            }

            $quote = $this->findQuote($parsed['receptor']);

            $invoice = Invoice::create([
                'invoice_number' => $parsed['numero_consecutivo'] ?: $this->generarNumero(),
                'quote_id' => $quote?->id,
                'hacienda_document_id' => $document->id,
                'client_name' => $parsed['receptor']['name'],
                'client_id_type' => $parsed['receptor']['id_type'],
                'client_id_number' => $parsed['receptor']['id_number'],
                'client_address' => $parsed['receptor']['address'] ?: null,
                'client_email' => $parsed['receptor']['email'],
                'client_phone' => $parsed['receptor']['phone'] ?: '—',
                'notes' => null,
                'subtotal' => $parsed['subtotal'],
                'tax_rate' => $parsed['tax_rate'],
                'tax_amount' => $parsed['tax_amount'],
                'total' => $parsed['total'],
                'status' => 'emitida',
            ]);

            foreach ($parsed['items'] as $item) {
                $invoice->items()->create([
                    'description' => $item['description'],
                    'quantity' => (int) round($item['quantity']),
                    'unit_price' => $item['unit_price'],
                    'total_price' => $item['total_price'],
                ]);
            }

            $summary['imported'][] = "{$parsed['numero_consecutivo']} — {$parsed['receptor']['name']}".($quote ? ' (cotización #'.$quote->id.')' : '');
        }

        return redirect('/admin/hacienda/import')->with('import_summary', $summary);
    }

    public function downloadXml(HaciendaDocument $document)
    {
        return response($document->raw_xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="'.$document->clave.'.xml"',
        ]);
    }

    public function storeFromQuote(Request $request, Quote $quote)
    {
        $data = $request->validate([
            'xml' => 'required|file',
            'pdf' => 'nullable|file|mimes:pdf',
        ]);

        $file = $data['xml'];
        $name = $file->getClientOriginalName();
        $content = file_get_contents($file->getRealPath());

        try {
            $rootName = HaciendaXmlParser::rootName($content);
        } catch (\Throwable $e) {
            return back()->with('error', "{$name}: {$e->getMessage()}");
        }

        if (in_array($rootName, ['Respuesta', 'MensajeHacienda'])) {
            try {
                $resp = HaciendaXmlParser::parseResponse($content);
            } catch (\Throwable $e) {
                return back()->with('error', "{$name}: {$e->getMessage()}");
            }

            $doc = HaciendaDocument::where('clave', $resp['clave'])->first();

            if (! $doc || $doc->invoice?->quote_id !== $quote->id) {
                return back()->with('error', 'La respuesta de Hacienda no corresponde a esta cotización.');
            }

            $doc->update([
                'respuesta_estado' => $resp['estado'],
                'respuesta_fecha' => $resp['fecha'],
                'respuesta_mensajes' => $resp['mensajes'] ?: null,
                'respuesta_xml' => $content,
            ]);

            return redirect("/admin/quotes/{$quote->id}")->with('success', "Respuesta de Hacienda registrada: {$resp['estado']}.");
        }

        try {
            $parsed = HaciendaXmlParser::parse($content);
        } catch (\Throwable $e) {
            return back()->with('error', "{$name}: {$e->getMessage()}");
        }

        if (HaciendaDocument::where('clave', $parsed['clave'])->exists()) {
            return back()->with('error', "{$parsed['clave']}: ese XML ya fue importado.");
        }

        if (! $this->receptorMatchesQuote($parsed['receptor'], $quote)) {
            return back()->with('error', 'El receptor del XML no coincide con el cliente de esta cotización (email o cédula).');
        }

        if ($quote->invoice()->exists()) {
            return back()->with('error', 'Esta cotización ya tiene una factura asociada.');
        }

        $document = HaciendaDocument::create([
            'clave' => $parsed['clave'],
            'numero_consecutivo' => $parsed['numero_consecutivo'],
            'document_type' => $parsed['type'],
            'fecha_emision' => $parsed['fecha_emision'],
            'emisor' => $parsed['emisor'],
            'emisor_data' => $parsed['emisor_data'],
            'receptor' => $parsed['receptor']['name'],
            'total' => $parsed['total'],
            'raw_xml' => $content,
        ]);

        $invoice = Invoice::create([
            'invoice_number' => $parsed['numero_consecutivo'] ?: $this->generarNumero(),
            'quote_id' => $quote->id,
            'hacienda_document_id' => $document->id,
            'client_name' => $parsed['receptor']['name'],
            'client_id_type' => $parsed['receptor']['id_type'],
            'client_id_number' => $parsed['receptor']['id_number'],
            'client_address' => $parsed['receptor']['address'] ?: null,
            'client_email' => $parsed['receptor']['email'],
            'client_phone' => $parsed['receptor']['phone'] ?: '—',
            'notes' => null,
            'subtotal' => $parsed['subtotal'],
            'tax_rate' => $parsed['tax_rate'],
            'tax_amount' => $parsed['tax_amount'],
            'total' => $parsed['total'],
            'status' => 'emitida',
        ]);

        foreach ($parsed['items'] as $item) {
            $invoice->items()->create([
                'description' => $item['description'],
                'quantity' => (int) round($item['quantity']),
                'unit_price' => $item['unit_price'],
                'total_price' => $item['total_price'],
            ]);
        }

        $quote->update(['status' => 'facturada']);

        if ($request->hasFile('pdf')) {
            $path = $request->file('pdf')->storeAs('invoices/'.$invoice->id, 'factura-original.pdf', 'local');
            $this->fixStoragePermissions(dirname($path));
            $invoice->update(['original_pdf' => $path]);
        }

        return redirect("/admin/quotes/{$quote->id}")->with('success', "Cotización convertida en factura {$invoice->invoice_number}.");
    }

    protected function fixStoragePermissions(string $relativeDir): void
    {
        $root = rtrim(config('filesystems.disks.local.root'), '/');
        $current = $root;
        foreach (explode('/', $relativeDir) as $segment) {
            $current .= '/'.$segment;
            if (is_dir($current)) {
                @chmod($current, 0775);
            }
        }
    }

    protected function receptorMatchesQuote(array $receptor, Quote $quote): bool
    {
        if (! empty($receptor['email']) && ! empty($quote->client_email)) {
            return strcasecmp($receptor['email'], $quote->client_email) === 0;
        }

        if (! empty($receptor['id_number']) && ! empty($quote->client_id_number)) {
            return $receptor['id_number'] === $quote->client_id_number;
        }

        return false;
    }

    protected function findQuote(array $receptor): ?Quote
    {
        if (! empty($receptor['email'])) {
            $quote = Quote::where('client_email', $receptor['email'])->latest()->first();
            if ($quote) {
                return $quote;
            }
        }

        if (! empty($receptor['id_number'])) {
            return Quote::where('client_id_number', $receptor['id_number'])->latest()->first();
        }

        return null;
    }

    protected function generarNumero(): string
    {
        $last = Invoice::max('id') ?? 0;

        return 'FAC-'.now()->format('Ymd').'-'.str_pad($last + 1, 4, '0', STR_PAD_LEFT);
    }
}
