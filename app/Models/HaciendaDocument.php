<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HaciendaDocument extends Model
{
    protected $fillable = [
        'clave', 'numero_consecutivo', 'document_type', 'fecha_emision',
        'emisor', 'receptor', 'total', 'raw_xml',
    ];

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
