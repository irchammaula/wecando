<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TurnitinController extends Controller
{
    public function index()
    {
        return view('customer.cekturnitin');
    }
}
