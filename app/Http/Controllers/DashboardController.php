<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == "user") {
            return redirect()->route('produk.etalase');
        }

        return view('dashboard');
    }
}
