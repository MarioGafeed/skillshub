<?php

namespace App\Http\Controllers\web;
use App\Models\Skill;
use App\Models\Exam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function show($id)
    {
      $data['skill'] = Skill::findOrFail($id);    
       return view('web.skills.show')->with($data);
    }
}
