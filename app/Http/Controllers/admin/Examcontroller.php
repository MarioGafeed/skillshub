<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Skill;

class Examcontroller extends Controller
{
  public function index()
  {
    $data['exams'] = Exam::select('id', 'name', 'skill_id', 'img', 'questions_no', 'active')->orderBy('id', 'DESC')->paginate(10);
    $data['skills']   = Skill::select('id', 'name')->get();
    return view('admin.exams.index')->with($data);
  }

  public function show(Exam $exam)
  {
    $data['exam'] = $exam;
    return view('admin.exams.show')->with($data);
  }
}
