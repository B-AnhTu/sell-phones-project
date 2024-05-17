<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'phone_id', 'quantities', 'total_price'];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function phone()
    {
        return $this->belongsTo(Phone::class, 'phone_id');
    }
}
