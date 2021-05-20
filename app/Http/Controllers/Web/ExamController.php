<?php

namespace App\Http\Controllers\web;
use App\Models\Exam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

    public function submit($examId, Request $request)
    {
      $request->validate([
        'answers'   => 'required|array',
        'answers.*' => 'required|in:1,2,3,4',
      ]);
      // Calculate Score..
      $points = 0;
      $exam = Exam::findOrFail($examId);
      $totalcount = $exam->questions->count();

      foreach ($exam->questions as $question) {
        if(isset( $request->answers[$question->id] ) ){
          $userAns  = $request->answers[$question->id];
          $rightAns = $question->right_ans;
          if ($userAns == $rightAns) {
            $points += 1;
          }
        }
      }
      $score = ($points/$totalcount) * 100;

      // Calculate Time
      $user = Auth::user();
      $pivotRow = $user->exams()->where('exam_id', $examId)->first();
      $starttime =  $pivotRow->pivot->created_at;
      $submitTime = Carbon::now();
      $time_mins = $submitTime->diffInMinutes($starttime);

      // Update Pivot row
      $user->exams()->updateExistingPivot($examId, [
        'score'      => $score,
        'time_mins' => $time_mins
      ]);
      return redirect( url("exams/show/$examId") );
    }
}
