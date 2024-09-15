<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function dataNotFound()
    {
        return view('errors.data_not_found');
    }
}
