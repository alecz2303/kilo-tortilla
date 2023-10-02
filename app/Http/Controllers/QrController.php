<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrController extends Controller
{
    public function index()
    {
        $link = "https://codeanddeploy.com/category/laravel";

        return view('barcode', [
            'link' => $link
        ]);
    }
}
