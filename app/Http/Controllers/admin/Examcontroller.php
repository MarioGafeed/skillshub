<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

  public function showQuestions(Exam $exam)
  {
    // $data['questions'] = $exam->questions;
    $data['exam'] = $exam;
    return view('admin.exams.show-questions')->with($data);
  }

  public function create()
  {
    $data['skills']   = Skill::select('id', 'name')->get();

    return view('admin.exams.create')->with($data);
  }

  public function store(Request $request)
  {
      $request->validate([
        'name_en' => 'required|max:50|string',
        'name_ar' => 'required|max:50|string',
        'desc_en' => 'required|max:5000|string',
        'desc_ar' => 'required|max:5000|string',
        'skill_id'=> 'required|exists:skills,id',
        'questions_no'=> 'required|integer|min:1',
        'diff'    => 'required|integer|min:1|max:5',
        'duration_mins'=> 'required|integer|min:1',
        'img'     => 'required|image|max:2048'
      ]);

      $imgpath = Storage::putFile("exams", $request->file('img'));

      Exam::create([
        'name'=>json_encode([
          'en'=>$request->name_en,
          'ar'=>$request->name_ar,
        ]),
        'desc'=>json_encode([
          'en'=>$request->desc_en,
          'ar'=>$request->desc_ar,
        ]),
        'img'=>$imgpath,
        'skill_id'=>$request->skill_id,
        'questions_no'=>$request->questions_no,
        'diff'=>$request->diff,
        'duration_mins'=>$request->duration_mins,
        'active' => 0,
      ]);
      $request->session()->flash('msg', 'Row ADDED Sucessfully');
      return back();
  }
}
