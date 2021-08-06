<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\Cat;

class Skillcontroller extends Controller
{
  public function index()
  {
    $data['skills'] = Skill::orderBy('id', 'DESC')->paginate(10);
    $data['cats']   = Cat::select('id', 'name')->get();
    return view('admin.skills.index')->with($data);
  }

  public function store(Request $request)
  {
      $request->validate([
        'name_en' => 'required|max:50|string',
        'name_ar' => 'required|max:50|string',
        'cat_id'  => 'required|exists:cats,id',
        'img'     => 'required|image|max:2048'
      ]);

      $imgpath = Storage::putFile("skills", $request->file('img'));

      Skill::create([
        'name'=>json_encode([
          'en'=>$request->name_en,
          'ar'=>$request->name_ar,
        ]),
        'img'=>$imgpath,
        'cat_id'=>$request->cat_id,
      ]);
      $request->session()->flash('msg', 'Row ADDED Sucessfully');
      return back();
  }

  public function update(Request $request)
  {
      $request->validate([
        // Add id
        'id'      => 'required|exists:skills,id',
        'name_en' => 'required|max:50|string',
        'name_ar' => 'required|max:50|string',
        'cat_id'  => 'required|exists:cats,id',
        'img'     => 'nullable|image|max:2048'
      ]);

      $skill = Skill::FindOrFail($request->id);
      $path = $skill->img;
      if($request->hasFile('img')){
        Storage::delete($path);
        $path = Storage::putfile("skills", $request->file('img'));
      }
      $skill->update([
         'name'  =>  json_encode([
          'en'   =>  $request->name_en,
          'ar'   =>  $request->name_ar
        ]),
        'cat_id' => $request->cat_id,
        'img'    => $path
      ]);
      $request->session()->flash('msg', 'Row UPDATED Sucessfully');
      return back();
  }


  public function delete(Skill $skill, Request $request)
  {
    try {
      $path = $skill->img;
      $skill->delete();
      Storage::delete($path);
      $msg = "Row DELETED Successfully";
      $request->session()->flash('msg', $msg);
    } catch (\Exception $e) {
        $msgError = "Row DELETED Failed";
        $request->session()->flash('msgError', $msgError);
    }

    return back();
  }

  public function toggle(Skill $skill)
  {
    $skill->update([
      'active' => ! $skill->active
    ]);
    return back();
  }

}
