<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayPallController extends Controller
{
    public function paypal($total){
        dd($total);
    }
}
