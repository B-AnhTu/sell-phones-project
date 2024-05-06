<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;
    protected $fillable = [
        'manufacturer_name',
        'image'
    ];

    protected $table = 'manufacturers';

    protected $primaryKey = 'manu_id';

    public $incrementing = true;

    public function phones()
    {
        return $this->hasMany(Phone::class, 'manu_id');
    }
}
