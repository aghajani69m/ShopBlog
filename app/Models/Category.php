<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'parent'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function child()
    {
        return $this->hasMany(Category::class , 'parent', 'id');

    }
    public function discounts()
    {
        return $this->belongsToMany(Discount::class);
    }
}
