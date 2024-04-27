<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Phone extends Model
{
    use HasFactory, Notifiable;

    
    protected $fillable = [
        'phone_name',
        'phone_image',
        'description',
        'quantities',
        'price',
        'status',
        'purchases',
        'manu_id',
        'category_id'
    ];

    protected $table = 'phones';

    protected $primaryKey = 'phone_id';

    public $incrementing = true;

}
