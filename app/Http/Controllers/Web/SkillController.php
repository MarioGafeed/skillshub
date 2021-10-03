<?php

namespace App\Http\Controllers\Web;
use App\Models\Skill;
use App\Models\Exam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function show($id)
    {
      $data['skill'] = Skill::findOrFail($id);
      $data['exams'] = $data['skill']->exams()->active()->paginate(4);
      return view('web.skills.show')->with($data);
    }
}
