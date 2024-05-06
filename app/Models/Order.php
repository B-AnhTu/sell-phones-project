<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = ['user_id','email'];
   
    // public function cus(){
    //     return $this->hasOne(User::class,'id','user_id');
    // }
    // public function order_detail(){
    //     return $this->hasMany(Order::class,'id','order_id');
    // }
    use HasFactory;
}
