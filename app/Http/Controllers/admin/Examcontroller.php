<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Events\ExamAddedEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Skill;

class ExamController extends Controller
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
        'desc_en' => 'required|string',
        'desc_ar' => 'required|string',
        'skill_id'=> 'required|exists:skills,id',
        'questions_no'=> 'required|integer|min:1',
        'diff'    => 'required|integer|min:1|max:5',
        'duration_mins'=> 'required|integer|min:1',
        'img'     => 'required|image|max:2048'
      ]);

      $imgpath = Storage::putFile("exams", $request->file('img'));

      $exam = Exam::create([
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
      // $request->session()->flash('prev', "exam/$exam->id");

      return redirect( url("dashboard/exams/create-questions/{$exam->id}") );
  }

  public function createQuestions(Exam $exam, Request $request )
  {
    // if (session('prev') !== "exam/$exam->id"  and session('current') !== "exam/$exam->id") {
    //   $val = $request->session()->all();
    //   return redirect( url('dashboard/exams') );
    // }
    $data['exam_id'] =  $exam->id;
    $data['questions_no'] =  $exam->questions_no;

    return view('admin.exams.create-questions')->with($data);
  }

  public function storeQuestions(Exam $exam, Request $request)
  {
    // $request->session()->flash('current', "$exam/$exam->id");
    $request->validate([
      'title'              => 'required|array|unique:questions',
      'title.*'            => 'required',
      'right_ans'          => 'required|array',
      'right_ans.*'        => 'required|string|in:1,2,3,4',
      'op1'                => 'required|array',
      'op1.*'              => 'required',
      'op2'                => 'required|array',
      'op2.*'              => 'required',
      'op3'                => 'required|array',
      'op3.*'              => 'required',
      'op4'                => 'required|array',
      'op4.*'              => 'required',
    ]);
    for ($i=0; $i < $exam->questions_no; $i++) {
           Question::create([
        'exam_id'             => $exam->id,
        'title'               => $request->title[$i],
        'right_ans'           => $request->right_ans[$i],
        'op1'                 => $request->op1[$i],
        'op2'                 => $request->op2[$i],
        'op3'                 => $request->op3[$i],
        'op4'                 => $request->op4[$i],
      ]);
    }
    $exam->update([
      'active' => '1'
    ]);
    // $request->session()->flash('prev', "exam/$exam->id");
    event(new ExamAddedEvent);

    return redirect('dashboard/exams');
  }

  public function edit(Exam $exam)
  {
    $data['skills'] = Skill::select('id', 'name')->get();
    $data['exam'] = $exam;
    return view('admin.exams.edit')->with($data);
  }
  public function update(Exam $exam, Request $request)
  {
    $request->validate([
      'name_en'          => 'required|string|max:50',
      'name_ar'          => 'required|string|max:50',
      'desc_en'          => 'required|string',
      'desc_ar'          => 'required|string',
      'img'              => 'nullable|image|max:2048',
      'skill_id'         => 'required|exists:skills,id',
      'diff'             => 'required|integer|min:1|max:5',
      'duration_mins'    => 'required|integer|min:1',
    ]);

    $path = $exam->img;

    if ($request->hasfile('img')) {
      Storage::delete($path);
      storage::putfile("exams", $request->file('img'));
    }
    $exam->update([
      'name' => json_encode([
        'en' => $request->name_en,
        'ar' => $request->name_ar,
      ]),
      'desc' => json_encode([
        'en' => $request->desc_en,
        'ar' => $request->desc_ar
      ]),
      'img'      => $path,
      'skill_id' => $request->skill_id,
      'diff'     => $request->diff,
      'duration_mins'     => $request->duration_mins,
    ]);


    $request->session()->flash('mgs', 'row updated successfully');
    return redirect( url("dashboard/exams/show/{$exam->id}") );
  }

  public function editQuestion(Exam $exam, Question $question)
  {
     $data['exam']     = $exam;
     $data['ques']     = $question;
     return view('admin.exams.edit-question')->with($data);
  }
  public function updateQuestion(Exam $exam, Question $question, Request $request)
  {
    $data = $request->validate([
      'title'         =>  'required',
      'right_ans'     =>  'required|in:1,2,3,4',
      'op1'       =>  'required',
      'op2'       =>  'required',
      'op3'       =>  'required',
      'op4'       =>  'required',
    ]);
    $question->update($data);
    return redirect( url("dashboard/exams/show-question/{$exam->id}") );
  }

  public function delete(Exam $exam, Request $request)
  {
    try {
      $path = $exam->img;
      $exam->questions()->delete();
      $exam->delete();
      Storage::delete($path);
      $msg = "Row DELETED Successfully";
      $request->session()->flash('msg', $msg);
    } catch (\Exception $e) {
        $msgError = "Row DELETED Failed";
        $request->session()->flash('msgError', $msgError);
    }

    return back();
  }

  public function toggle(Exam $exam, Request $request)
  {
    if ($exam->questions()->count() ==  $exam->questions_no ) {
      $exam->update([
        'active' => ! $exam->active
      ]);
    }
    else {
      $msgError = "Exam activated failed please review the questions number of this exam";
      $request->session()->flash('msgError', $msgError);
    }
    return back();
  }
}
