<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Menampilkan halaman beranda frontend
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.home');
    }
}