<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\Cat;

class Skillcontroller extends Controller
{
  public function index()
  {
    $data['skills'] = Skill::orderBy('id', 'DESC')->paginate(7);
    $data['cats']   = Cat::select('id', 'name')->get();
    return view('admin.skills.index')->with($data);
  }

  public function store(Request $request)
  {
    dd($request->all());
      $request->validate([
        'name_en' => 'required|max:50|string',
        'name_ar' => 'required|max:50|string',
        'cat_id'  => 'required|exists:cats,id',
        'img'     => 'required|image|max:2048'
      ]);
      Skill::create([
        'name'=>json_encode([
          'en'=>$request->name_en,
          'ar'=>$request->name_ar
        ]),
      ]);
      $request->session()->flash('msg', 'Row ADDED Sucessfully');
      return back();
  }

}
