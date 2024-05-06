<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'phone',
        'image',
        'gender',
        'date_of_birth'
    ];

    protected $table = 'profiles';

    protected $primaryKey = 'profile_id';

    public $incrementing = true;

    public function users(){
        return $this->hasOne(User::class, 'user_id');
    }
}
