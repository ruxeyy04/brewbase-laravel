<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'deladd_id',
        'userid',
        'fullname',
        'street',
        'barangay',
        'city',
        'province',
        'region',
        'country',
        'postalcode',
        'phone_number',
        'additionalinfo',
        'status'

    ];

    protected $primaryKey = 'deladd_id';

}
