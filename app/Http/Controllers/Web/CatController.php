<?php

namespace App\Http\Controllers\web;
use App\Models\Cat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CatController extends Controller
{
    public function show($id)
    {
      $data['cat'] = Cat::findOrFail($id);
      $data['allCats'] = Cat::select('id', 'name')->get();
      $data['skills'] = $data['cat']->skills()->paginate(3);    
      return view('web.cats.show')->with($data);
    }
}
