<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'note',
        'total_price',
        'payment_method',
        'payment_status',
        'status',
    ];

    // Tạo mối quan hệ với OrderItem (nếu cần dùng sau này)
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}