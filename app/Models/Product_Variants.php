<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_Variants extends Model
{
    public $timestamps = false;
    protected $table = 'product_variants'; 

    protected $fillable = [
        'product_id', 'sku', 'size', 'color', 'stock_quantity', 'price', 'image'
    ];
}
