<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addons extends Model
{
    use HasFactory;

    protected $fillable = [
        'addonsID',
        'addons_name',
        'addons_price',
        'addons_img'
    ];

    protected $primaryKey = 'addonsID';

}
