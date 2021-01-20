<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function show($id)
    {
        return view('web.exams.show');
    }

    public function showquestions($id)
    {
      return view('web.exams.showquestions');
    }
}
