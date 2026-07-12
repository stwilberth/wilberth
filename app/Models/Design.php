<?php

namespace App\Models;

use Database\Factories\DesignFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Relationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'user_id',
    'product_cut',
    'sleeve_style',
    'material',
    'color',
    'layers',
    'view_side',
    'price_estimate',
    'exported_png_path',
])]
class Design extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'layers' => 'array',
            'price_estimate' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    #[Relationship]
    public function assets(): HasMany
    {
        return $this->hasMany(DesignAsset::class);
    }

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, [
            'product_cut' => 'cut',
            'sleeve_style' => 'sleeve_style',
            'material' => 'material',
        ]);
    }
}