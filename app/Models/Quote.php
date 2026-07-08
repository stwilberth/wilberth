<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = [
        'quote_number', 'client_name', 'client_id_type', 'client_id_number',
        'client_email', 'client_phone', 'notes',
        'subtotal', 'tax_rate', 'tax_amount', 'total', 'status',
    ];

    public function items()
    {
        return $this->hasMany(QuoteItem::class);
    }
}
