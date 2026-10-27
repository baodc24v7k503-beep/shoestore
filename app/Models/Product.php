<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'slug',
        'name_pd',
        'image',
        'price',
        'sale_price',
        'short_description',
        'description',
        'is_featured',
        'status',
        'category_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function variants()
    {
        return $this->hasMany(Product_Variants::class, 'product_id', 'id');
    }
}
