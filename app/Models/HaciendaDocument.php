<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HaciendaDocument extends Model
{
    protected $fillable = [
        'clave', 'numero_consecutivo', 'document_type', 'fecha_emision',
        'emisor', 'emisor_data', 'receptor', 'total', 'raw_xml',
        'respuesta_estado', 'respuesta_fecha', 'respuesta_mensajes', 'respuesta_xml',
    ];

    protected $casts = [
        'emisor_data' => 'array',
        'respuesta_mensajes' => 'array',
    ];

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
