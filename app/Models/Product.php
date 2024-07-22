<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'prod_no',
        'category',
        'prod_name',
        'prod_description',
        'prod_date',
        'prod_price',
        'prod_img',
        'status'
    ];

    protected $primaryKey = 'prod_no';

}
