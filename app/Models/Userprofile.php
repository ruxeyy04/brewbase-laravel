<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userprofile extends Model
{
    use HasFactory;

    protected $fillable = [
        'userid',
        'fname',
        'lname',
        'midname',
        'suffix',
        'contact_no',
        'tel_no',
        'gender',
        'birthdate',
        'street',
        'barangay',
        'city',
        'province',
        'region',
        'country',
        'postalcode',
        'profile_img',
        'status'
    ];

    protected $primaryKey = 'userid';

}
