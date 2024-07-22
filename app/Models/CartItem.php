<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'prod_no',
        'userid',
        'quantity',
        'created_at',
        'addonsID'
    ];

    protected $primaryKey = 'cart_id';

}
