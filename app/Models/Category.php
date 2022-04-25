<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $appends = ['parent_category_name'];

    protected $table = 'categories';

    protected $fillable = [
        'parent_id',
        'name',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }
    // Define accessor
    public function getParentCategoryNameAttribute()
    {
        return $this->parent ? $this->parent->name : null;
    }

    public function scopeWithParent($query)
    {
        return $query->whereNull('parent_id');
    }
    public function scopeWithChildren($query)
    {
        return $query->whereNotNull('parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id')->withTimestamps();
    }

    public function scopeWithName($query, $name)
    {
        return $name ? $query->where('name', 'LIKE', "%{$name}%") : null;
    }

    public function scopeWithParentId($query, $parentId)
    {
        return $parentId ? $query->where('parent_id', $parentId) : null;
    }
}
