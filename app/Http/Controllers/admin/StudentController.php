<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;


class StudentController extends Controller
{
    public function index()
    {
      $studentRole = Role::where('name', 'student')->first();
      $data['students'] = User::where('role_id', 3)->orderby('id','desc')->paginate(10);
      return view('admin.students.index')->with($data);
    }
}
