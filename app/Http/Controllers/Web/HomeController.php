<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Exam;

class HomeController extends Controller
{
    public function index()
    {
      $data['cats']  = Cat::select('id', 'name')->get();
      $data['exams'] = Exam::where('active', '1')->OrderBy('id', 'DESC')->paginate(8);
      return view('web.home.index')->with($data);
    }
}
