<?php

namespace App\Http\Controllers\web;
use App\Models\Exam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function show($id)
    {
      $data['exam'] =  Exam::findOrFail($id);
        return view('web.exams.show')->with($data);
    }

    public function start($examId)
    {
      $user = Auth::user();
      $user->exams()->attach($examId);

      return redirect( url("exams/show/questions/$examId") );
    }

    public function showquestions($id)
    {
      $data['exam'] =  Exam::findOrFail($id);
      return view('web.exams.showquestions')->with($data);
    }
}
