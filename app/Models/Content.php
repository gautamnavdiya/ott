<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'genre',
        'thumbnail',
        'poster',
        'banner',
        'video',
        'release_year',
        'duration',
        'rating',
        'language',
        'is_trending',
        'is_featured',
        'is_top_pick',
        'view_count',
    ];

    protected $casts = [
        'is_trending' => 'boolean',
        'is_featured' => 'boolean',
        'is_top_pick' => 'boolean',
        'rating' => 'decimal:1',
        'release_year' => 'integer',
        'duration' => 'integer',
        'view_count' => 'integer',
    ];
}
