<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone_id',
        'quantity',
        'price'
    ];

    protected $table = 'carts';

    protected $primaryKey = 'cart_id';

    public $incrementing = true;

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function phone(){
        return $this->hasMany(Phone::class, 'phone_id');
    }

}
