<?php

namespace App\Http\Controllers\admin;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;


class StudentController extends Controller
{
    public function index()
    {
      $studentRole = Role::where('name', 'student')->first();
      $data['students'] = User::where('role_id', $studentRole->id)->where('who_added', Auth::user()->id)->orderby('id','desc')->paginate(10);
      return view('admin.students.index')->with($data);
    }
    // Create New Student from Instructor
    public function create()
    {
      $data['roles'] = Role::select('id', 'name')->where('name', 'student')->get();
      return view('admin.students.create')->with($data);
    }

    public function store(Request $request)
    {
      $request->validate([
        'name'      => 'required|string|max:255',
        'email'     => 'required|email|max:255|unique:users',
        'password'  => 'required|string|min:3|max:12|confirmed',
        'role_id'   => 'required|exists:roles,id',        
      ]);

      $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'role_id'  => $request->role_id,
        'who_added'=> Auth::user()->id
      ]);
      event(new Registered($user));

      return redirect(url('dashboard/students'));
    }

    public function showScores($id)
    {
      $student = User::findOrFail($id);
      if ($student->role->name !== 'student' ) {
        return back();
      }
        $data['student']  = $student;
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

    public function show_answers($studentId, $examId)
    {

      $student = User::findOrFail($studentId);
      if ($student->role->name !== 'student' ) {
        return back();
      }
        $data['student']  = $student;
        $data['questions']    = $student->questions->where('exam_id', $examId);
    
        return view('admin.students.show_answers')->with($data);

      // $student = User::where('id', $studentId)->first();            
      // $questions = $student->questions()->where('exam_id', $examId)->get();
      // return view('admin.students.show_answers', [
      //   'questions' => $questions,
      //   'student ' => $student,
      // ]);
    }

    public function toggle(User $user)
    {
      $user->update([
        'active' => ! $user->active
      ]);
      return back();
    }
}
