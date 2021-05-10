<?php

namespace App\Http\Controllers\web;
use App\Models\Exam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function show($id)
    {
      $data['exam'] =  Exam::findOrFail($id);
        return view('web.exams.show')->with($data);
    }

    public function showquestions($id)
    {
      $data['exam'] =  Exam::findOrFail($id);
      return view('web.exams.showquestions')->with($data);
    }
}
