<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userinfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'userid',
        'email',
        'username',
        'usertype',
        'password'
    ];

    protected $primaryKey = 'userid';

}
