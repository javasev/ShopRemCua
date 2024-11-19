<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WellcomeController extends Controller
{
    public function index()
    {
        // Trả về view 'welcome'
        return view('welcome');
    }
}
