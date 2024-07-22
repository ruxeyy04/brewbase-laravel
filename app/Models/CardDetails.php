<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'paycard_id',
        'pay_id',
        'userid',
        'cardholder_name',
        'card_number',
        'expiration',
        'cvv'
    ];

    protected $primaryKey = 'paycard_id';

}
