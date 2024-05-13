<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'phone',
        'gender',
        'date_of_birth'
    ];

    protected $table = 'profiles';

    protected $primaryKey = 'profile_id';

    public $incrementing = true;

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
