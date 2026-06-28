<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price',
        'badge', 'category', 'images', 'video', 'is_active'
    ];

    protected $casts = [
        'images'    => 'array',
        'is_active' => 'boolean',
    ];

    public function getThumbnailAttribute(): string
    {
        return $this->images[0] ?? '/IMAGE/SUPER.jpeg';
    }
}
