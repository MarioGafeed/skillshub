<?php

namespace App\Http\Controllers\Web;

use session;
use App\Models\Cat;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
  public function show($id)
  {
    $data['subscripeMSG'] = "";

    $data['skill'] = Skill::findOrFail($id);
    $user = Auth::user();
    if ($user == null) {
      return redirect(url('/login'));
    } else {
      if ($user->skills->contains($id)) {
        $skill = $user->skills()->where('skill_id', $id)->first();

        if ($skill->pivot->subscriber == 1) {

          $data['exams'] = $data['skill']->exams()->active()->paginate(4);

          return view('web.skills.show')->with($data);
        } else {
          $data['subscripeMSG'] = "suspend";
   
          $data['subscripeMSG'] = "Your accound suspend plz contact Admin:  01096389912";
          return view('web.skills.show')->with($data);
        }
      } else {       
        $data['subscripeMSG'] = "First: You should Subscribe this skill, Plz contact Admin:  01096389912";

        return view('web.skills.show')->with($data);
      }
    }
  }
}
