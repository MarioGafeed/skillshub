<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cat;

class CatController extends Controller
{
    public function index()
    {
      $data['cats'] = Cat::orderBy('id', 'DESC')->paginate(7);
      return view('admin.cats.index')->with($data);
    }

    public function store(Request $request)
    {
        $request->validate([
          'name_en' => 'required|max:50|string',
          'name_ar' => 'required|max:50|string'
        ]);
        Cat::create([
          'name'=>json_encode([
            'en'=>$request->name_en,
            'ar'=>$request->name_ar
          ]),
        ]);
        $request->session()->flash('msg', 'Row ADDED Sucessfully');
        return back();
    }

    public function update(Request $request)
    {
        $request->validate([
          'id' => 'required|exists:cats',
          'name_en' => 'required|max:50|string',
          'name_ar' => 'required|max:50|string'
        ]);
        Cat::FindOrFail($request->id)->update([
           'name'=>json_encode([
            'en'=>$request->name_en,
            'ar'=>$request->name_ar
          ]),
        ]);
        $request->session()->flash('msg', 'Row UPDATED Sucessfully');
        return back();
    }

    public function delete(Cat $cat, Request $request)
    {
      try {
        $cat->delete();
        $msg = "Row DELETED Successfully";
        $request->session()->flash('msg', $msg);
      } catch (\Exception $e) {
          $msgError = "Row DELETED Failed";
          $request->session()->flash('msgError', $msgError);
      }

      return back();
    }

    public function toggle(Cat $cat)
    {
      $cat->update([
        'active' => ! $cat->active
      ]);
      return back();
    }
}
