<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id', 'product_id', 'product_name', 'quantity', 'price', 'image', 'category'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Thêm phương thức để lấy các mặt hàng trong giỏ hàng của người dùng
    public static function getItemsByUser($userId)
    {
        return self::where('user_id', $userId)->get();
    }
}

