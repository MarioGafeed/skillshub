<?php

namespace App\Http\Controllers\Web;
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
      $user = Auth::user();
      $data['startShowexambtn'] = true;

      if ($user !== null) {
        $userexamPivotRow = $user->exams()->where('exam_id', $id)->first();
        if ($userexamPivotRow !== null and $userexamPivotRow->pivot->status == 'closed') {
          $data['startShowexambtn'] = false;
        }
      }
        return view('web.exams.show')->with($data);
    }

    public function start($examId, Request $request)
    {
      $user = Auth::user();
      if (! $user->exams->contains($examId)) {
        $user->exams()->attach($examId);
      }
      else {
        $user->exams()->updateExistingPivot($examId, [
          'status' => 'closed',
        ]);
      }
      $request->session()->flash('prev', "start/$examId");
      return redirect( url("exams/show/questions/$examId") );
    }

    public function showquestions($examId,  Request $request)
    {
      // Secure Inspector to show start exam from another exam id
      if (session('prev') !== "start/$examId") {
        return redirect( url("exams/show/$examId") );
      }
  // Secure Inspector from show submit from insepe
      $request->session()->flash('Qprev', "questions/$examId");
      $data['exam'] =  Exam::findOrFail($examId);
      return view('web.exams.showquestions')->with($data);
    }

    public function submit($examId, Request $request)
    {
      if (session('Qprev') !==  "questions/$examId") {
        return redirect( url("exams/show/$examId") );
      }
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


      if ($time_mins > $pivotRow->duration_mins) {
        $score = 0;
      }
      // Update Pivot row
      $user->exams()->updateExistingPivot($examId, [
        'score'      => $score,
        'time_mins' => $time_mins,
        'status'    => 'closed'
      ]);
      $request->session()->flash("success", "You finish exam successfully with score: $score %");
      return redirect( url("exams/show/$examId") );
    }
}
