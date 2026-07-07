<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_number', 'quote_id',
        'client_name', 'client_id_type', 'client_id_number',
        'client_email', 'client_phone', 'notes',
        'subtotal', 'tax_rate', 'tax_amount', 'total', 'status',
    ];

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }
}
