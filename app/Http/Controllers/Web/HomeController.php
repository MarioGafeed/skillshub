<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\controller;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
      return view('web.home.index');
    }
}
