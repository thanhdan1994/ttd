<?php
namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function bookmarks()
    {
        return view('home.index');
    }
}
