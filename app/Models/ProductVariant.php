<?php

namespace App\Models;

use Database\Factories\ProductVariantFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['cut', 'sleeve_style', 'material', 'base_price'])]
class ProductVariant extends Model
{
    use HasFactory;

    /** @use HasFactory<ProductVariantFactory> */

    protected $table = 'product_variants';

    public $timestamps = true;

    protected function casts(): array
    {
        return [
            'base_price' => 'decimal:2',
        ];
    }

    public function getKeyName(): string
    {
        return 'id';
    }

    public static function findByVariant(string $cut, string $sleeveStyle, string $material): ?self
    {
        return static::where('cut', $cut)
            ->where('sleeve_style', $sleeveStyle)
            ->where('material', $material)
            ->first();
    }
}