<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = [
        'client_name', 'client_email', 'client_phone', 'notes',
        'subtotal', 'tax_rate', 'tax_amount', 'total', 'status',
    ];

    public function items()
    {
        return $this->hasMany(QuoteItem::class);
    }
}
