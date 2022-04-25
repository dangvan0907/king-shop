<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id')->withTimestamps();
    }

    public function hasCategory($categoryId)
    {
        return $this->categories->contains('id', $categoryId);
    }


    public function scopeWithName($query, $name)
    {
        return $name ? $query->where('name', 'LIKE', "%{$name}%") : null;
    }

    public function scopeWithCategoryIds($query, $categoryId)
    {
        return $categoryId ? $query->whereHas('categories', fn($q) => $q->where('category_id', $categoryId)) : null;
    }

    public function scopeWithMinPrice($query, $minPrice)
    {
        return $minPrice ? $query->where('price', '>=', $minPrice) : null;
    }

    public function scopeWithMaxPrice($query, $maxPrice)
    {
        return $maxPrice ? $query->where('price', '<=', $maxPrice) : null;
    }

    public function assignCategories($categoryIds)
    {
        return $this->categories()->attach($categoryIds);
    }

    public function syncCategories($categoryIds)
    {
        return $this->categories()->sync($categoryIds);
    }
}
