<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FallbackController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('errors.404');
    }
}
