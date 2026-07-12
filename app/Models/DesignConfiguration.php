<?php

namespace App\Models;

use Database\Factories\DesignConfigurationFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'user_id', 'name', 'product_type', 'canvas', 'layers', 
    'selected_variants', 'preview_image', 'price', 'status'
])]
class DesignConfiguration extends Model
{
    use HasFactory;

    /** @use HasFactory<DesignConfigurationFactory> */

    protected function casts(): array
    {
        return [
            'canvas' => 'array',
            'layers' => 'array',
            'selected_variants' => 'array',
            'preview_image' => 'array',
            'price' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}