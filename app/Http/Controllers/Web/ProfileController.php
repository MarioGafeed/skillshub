<?php

namespace App\Http\Controllers\Web;

use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
      return view('web.profile.index');
    }

    public function show_answers(Exam $exam) 
    {
      $user = Auth::user();        
      $questions = $user->questions()->where('exam_id', $exam->id)->get();      
      return view('web.profile.show-answers', [
        'questions' => $questions,
        'exam' => $exam
      ]);
    }
}
