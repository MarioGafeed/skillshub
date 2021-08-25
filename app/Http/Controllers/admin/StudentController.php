<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    public function index()
    {
      $studentRole = Role::where('name', 'student')->first();
      $data['students'] = User::where('role_id', $studentRole->id)->where('who_added', Auth::user()->id)->orderby('id','desc')->paginate(10);
      return view('admin.students.index')->with($data);
    }

    public function showScores($id)
    {
      $student = User::findOrFail($id);
      if ($student->role->name !== 'student' ) {
        return back();
      }
        $data['student'] = $student;
        $data['exams']    = $student->exams;
        return view('admin.students.show-scores')->with($data);
    }

    public function openExam($studentId, $examId)
    {
      $student = User::findOrFail($studentId);
      $student->exams()->updateExistingPivot($examId, [
        'status' => 'opened'
      ]);
      return back();
    }

    public function closeExam($studentId, $examId)
    {
      $student = User::findOrFail($studentId);
      $student->exams()->updateExistingPivot($examId, [
        'status' => 'closed'
      ]);
      return back();
    }

    public function toggle(User $user)
    {
      $user->update([
        'active' => ! $user->active
      ]);
      return back();
    }
}
