<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'order_date',
        'status',
        'userid',
        'prepared_by',
        'received_data'
    ];

    protected $primaryKey = 'order_id';

}
