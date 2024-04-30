<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prenium extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'phone',
        'favorite'
    ];

    protected $hidden = [
        'password'
    ];

    protected $table = 'preniums';

    protected $primaryKey = 'prenium_id';

    public $incrementing = true;

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}