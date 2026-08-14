<?php

namespace App\Services;

use InvalidArgumentException;
use SimpleXMLElement;

class HaciendaXmlParser
{
    protected static array $typeMap = [
        'FacturaElectronica' => 'factura',
        'FacturaExportacion' => 'factura_exportacion',
        'TiqueteElectronico' => 'tiquete',
        'NotaCreditoElectronica' => 'nota_credito',
        'NotaDebitoElectronica' => 'nota_debito',
        'ConfirmacionReceptor' => 'confirmacion',
    ];

    protected static array $idTypeMap = [
        '01' => 'fisica',
        '02' => 'juridica',
        '03' => 'dimex',
        '05' => 'nite',
    ];

    public static function rootName(string $xml): string
    {
        $previous = libxml_use_internal_errors(true);

        try {
            $root = new SimpleXMLElement($xml, LIBXML_NONET | LIBXML_COMPACT | LIBXML_PARSEHUGE);
        } catch (\Throwable $e) {
            libxml_clear_errors();
            libxml_use_internal_errors($previous);
            throw new InvalidArgumentException('El archivo no es un XML válido.');
        }

        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        return $root->getName();
    }

    public static function parseResponse(string $xml): array
    {
        $previous = libxml_use_internal_errors(true);

        try {
            $root = new SimpleXMLElement($xml, LIBXML_NONET | LIBXML_COMPACT | LIBXML_PARSEHUGE);
        } catch (\Throwable $e) {
            libxml_clear_errors();
            libxml_use_internal_errors($previous);
            throw new InvalidArgumentException('El archivo no es un XML válido.');
        }

        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        $clave = trim((string) ($root->Clave ?? ''));
        if (! strlen($clave)) {
            throw new InvalidArgumentException('El XML de Respuesta no contiene una clave válida.');
        }

        $estado = trim((string) ($root->EstadoMensaje ?? $root->Estado ?? ''));
        $fecha = trim((string) ($root->Fecha ?? ''));
        $codigo = trim((string) ($root->Codigo ?? ''));
        $detalle = trim((string) ($root->DetalleMensaje ?? ''));

        $mensajes = [];
        if ($codigo !== '' || $detalle !== '') {
            $mensajes[] = ['codigo' => $codigo, 'mensaje' => $detalle];
        }
        foreach ($root->Mensaje ?? [] as $msg) {
            $hasChildren = count($msg->children()) > 0;
            $mensajes[] = [
                'codigo' => $hasChildren ? trim((string) ($msg->Codigo ?? '')) : '',
                'mensaje' => $hasChildren ? trim((string) ($msg->Mensaje ?? '')) : trim((string) $msg),
            ];
        }

        return [
            'clave' => $clave,
            'estado' => $estado,
            'fecha' => $fecha,
            'codigo' => $codigo,
            'mensajes' => $mensajes,
        ];
    }

    public static function parse(string $xml): array
    {
        $previous = libxml_use_internal_errors(true);

        try {
            $root = new SimpleXMLElement($xml, LIBXML_NONET | LIBXML_COMPACT | LIBXML_PARSEHUGE);
        } catch (\Throwable $e) {
            libxml_clear_errors();
            libxml_use_internal_errors($previous);
            throw new InvalidArgumentException('El archivo no es un XML válido.');
        }

        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        $rootName = $root->getName();
        $type = self::$typeMap[$rootName] ?? 'desconocido';

        $text = fn (string $path): ?string => isset($root->{$path})
            ? trim((string) $root->{$path})
            : null;

        $clave = $text('Clave') ?? '';
        if (! strlen($clave)) {
            throw new InvalidArgumentException('El XML no contiene una clave de Hacienda válida.');
        }

        $receptor = $root->Receptor ?? null;
        $receptorIdentificacion = $receptor->Identificacion ?? null;

        $clientName = trim((string) ($receptor->Nombre ?? ''));
        $idTypeCode = trim((string) ($receptorIdentificacion->Tipo ?? ''));
        $idNumber = trim((string) ($receptorIdentificacion->Numero ?? ''));
        $email = trim((string) ($receptor->CorreoElectronico ?? ''));
        $phone = trim((string) ($receptor->Telefono->NumTelefono ?? ''));
        $address = trim((string) ($receptor->Ubicacion->OtrasSenas ?? ''));

        $emisor = $root->Emisor ?? null;
        $emisorIdentificacion = $emisor->Identificacion ?? null;
        $emisorUbicacion = $emisor->Ubicacion ?? null;

        $emisorData = [
            'name' => trim((string) ($emisor->Nombre ?? '')),
            'name_comercial' => trim((string) ($emisor->NombreComercial ?? '')),
            'id_type' => self::$idTypeMap[trim((string) ($emisorIdentificacion->Tipo ?? ''))] ?? 'fisica',
            'id_number' => trim((string) ($emisorIdentificacion->Numero ?? '')),
            'email' => trim((string) ($emisor->CorreoElectronico ?? '')),
            'phone' => trim((string) ($emisor->Telefono->NumTelefono ?? '')),
            'address' => trim((string) ($emisorUbicacion->OtrasSenas ?? '')),
            'province' => trim((string) ($emisorUbicacion->Provincia ?? '')),
            'canton' => trim((string) ($emisorUbicacion->Canton ?? '')),
            'district' => trim((string) ($emisorUbicacion->Distrito ?? '')),
        ];

        $items = [];
        foreach ($root->DetalleServicio->LineaDetalle ?? [] as $line) {
            $quantity = (float) ($line->Cantidad ?? 0);
            $unitPrice = (float) ($line->PrecioUnitario ?? 0);
            $totalPrice = (float) ($line->MontoTotal ?? $line->SubTotal ?? 0);
            $taxAmount = 0.0;
            foreach ($line->Impuesto ?? [] as $impuesto) {
                $taxAmount += (float) ($impuesto->Monto ?? 0);
            }

            if ($totalPrice == 0 && $quantity > 0) {
                $totalPrice = $quantity * $unitPrice;
            }

            $items[] = [
                'description' => trim((string) ($line->Detalle ?? '')),
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'total_price' => $totalPrice,
                'tax_amount' => $taxAmount,
            ];
        }

        $resumen = $root->ResumenFactura ?? null;
        $sumLineTotals = collect($items)->sum('total_price');
        $sumLineTax = collect($items)->sum('tax_amount');

        $subtotal = self::floatValue($resumen->TotalGravado ?? null) + self::floatValue($resumen->TotalExento ?? null);
        if ($subtotal == 0) {
            $subtotal = self::floatValue($resumen->TotalVenta ?? null);
        }
        if ($subtotal == 0) {
            $subtotal = $sumLineTotals;
        }

        $taxAmount = self::floatValue($resumen->TotalImpuesto ?? null);
        if ($taxAmount == 0) {
            $taxAmount = $sumLineTax;
        }

        $total = self::floatValue($resumen->TotalComprobante ?? null);
        if ($total == 0) {
            $total = $subtotal + $taxAmount;
        }

        $taxRate = $subtotal > 0 ? round(($taxAmount / $subtotal) * 100, 2) : 0;

        return [
            'type' => $type,
            'document_type_raw' => $rootName,
            'clave' => $clave,
            'numero_consecutivo' => $text('NumeroConsecutivo') ?? '',
            'fecha_emision' => $text('FechaEmision'),
            'emisor' => trim((string) ($root->Emisor->Nombre ?? '')),
            'emisor_data' => $emisorData,
            'receptor' => [
                'name' => $clientName,
                'id_type' => self::$idTypeMap[$idTypeCode] ?? 'fisica',
                'id_number' => $idNumber,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
            ],
            'items' => $items,
            'subtotal' => $subtotal,
            'tax_rate' => $taxRate,
            'tax_amount' => $taxAmount,
            'total' => $total,
        ];
    }

    protected static function floatValue(mixed $value): float
    {
        return (float) trim((string) $value);
    }
}
