<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'image',         // Legacy single image
        'is_trending',
        'stock',         // Inventory count
        'category',      // Product category
        'status',        // Active or Draft
        'images',        // JSON array of gallery images
        'sizes',         // JSON array of sizes
        'colors',        // JSON array of colors
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_trending' => 'boolean',
        'images' => 'array',
        'sizes' => 'array',
        'colors' => 'array',
        'price' => 'decimal:2',
    ];
}