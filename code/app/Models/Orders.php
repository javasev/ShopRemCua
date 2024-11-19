<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory; 

    protected $fillable = [ 
        'user_id', 
        'total', 
        'status', 
        'payment_method' 
    ]; 

    // Quan hệ một-nhiều với OrderItem 
    public function items() 
    { 
        return $this->hasMany(OrderItem::class); 
    } 

    // Quan hệ với User 
    public function user() 
    { 
        return $this->belongsTo(User::class); 
    } 
}