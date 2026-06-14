<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images'); 
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}