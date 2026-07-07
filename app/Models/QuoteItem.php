<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteItem extends Model
{
    protected $fillable = [
        'quote_id', 'description', 'quantity', 'unit_price', 'total_price',
    ];

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }
}
