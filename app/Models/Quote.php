<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Quote extends Model
{
    protected $fillable = [
        'quote_number',         'client_name', 'client_id_type', 'client_id_number', 'client_address',
        'client_email', 'client_phone', 'notes',
        'subtotal', 'tax_rate', 'tax_amount', 'total', 'status', 'slug',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($quote) {
            if (empty($quote->slug)) {
                $quote->slug = Str::random(16);
            }
        });
    }

    public function items()
    {
        return $this->hasMany(QuoteItem::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
