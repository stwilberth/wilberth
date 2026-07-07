<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'slug', 'name', 'description', 'category',
        'url', 'cover_path', 'svg_path',
    ];
}
