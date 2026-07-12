<?php

namespace App\Models;

use Database\Factories\DesignAssetFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['design_id', 'path', 'type', 'position', 'size', 'rotation'])]
class DesignAsset extends Model
{
    use HasFactory;

    /** @use HasFactory<DesignAssetFactory> */

    protected function casts(): array
    {
        return [
            'position' => 'array',
            'size' => 'array',
            'rotation' => 'integer',
        ];
    }

    public function design(): BelongsTo
    {
        return $this->belongsTo(Design::class);
    }

    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->path);
    }
}