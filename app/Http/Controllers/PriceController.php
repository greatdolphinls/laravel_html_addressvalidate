<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class PriceController extends Controller
{

    public function price_free() {


        Session::flash('plan','Free');
        return view('signup');
    }

    public function price_business() {

        Session::flash('plan','Business-Monthly');
        return view('signup');
    }
    public function price_enterprise() {

        Session::flash('plan','Enterprise');
        return view('signup');
    }
}
