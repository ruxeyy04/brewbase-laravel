<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'pay_id',
        'userid',
        'order_id',
        'deladd_id',
        'payment_date',
        'payment_method',
        'amount'
    ];

    protected $primaryKey = 'pay_id';

}
