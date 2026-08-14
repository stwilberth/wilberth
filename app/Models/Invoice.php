<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_number', 'quote_id', 'hacienda_document_id',
        'client_name', 'client_id_type', 'client_id_number', 'client_address',
        'client_email', 'client_phone', 'notes', 'original_pdf',
        'subtotal', 'tax_rate', 'tax_amount', 'total', 'status', 'slug',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            if (empty($invoice->slug)) {
                $invoice->slug = Str::random(16);
            }
        });
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    public function haciendaDocument()
    {
        return $this->belongsTo(HaciendaDocument::class);
    }
}
