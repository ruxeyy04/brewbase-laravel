<?php

namespace App\Http\Controllers\incharge;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InchargeController extends Controller
{
    public function dashboard () {
        return view('incharge.home');
    }

    public function orders() {
        return view('incharge.orders');
    }
    public function products() {
        return view('incharge.products');
    }
}
