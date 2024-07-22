<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'orddet_id',
        'order_id',
        'prod_no',
        'quantity',
        'prod_price',
        'addonsID',
        'addonsPrice',
        'totalAmount'

    ];

    protected $primaryKey = 'orddet_id';

}
