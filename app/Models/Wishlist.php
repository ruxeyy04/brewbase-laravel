<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'wishlist_id',
        'prod_no',
        'userid',
        'created_at'
    ];

    protected $primaryKey = 'wishlist_id';

}
