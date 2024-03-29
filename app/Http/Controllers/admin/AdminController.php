<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AdminController extends Controller
{
    public function index()
    {
      $superAdminRole = Role::where('name', 'superadmin')->first();
      $adminRole      = Role::where('name', 'teacher')->first();
      $data['admins'] =  User::whereIn('role_id', [$superAdminRole->id, $adminRole->id])->orderby('id', 'DESC')->paginate(10);
      return view('admin.admins.index')->with($data);
    }

    public function create()
    {
      $data['roles'] = Role::select('id', 'name')->whereIn('name', ['teacher', 'superadmin'])->get();
      return view('admin.admins.create')->with($data);
    }

    public function store(Request $request)
    {
      $request->validate([
        'name'      => 'required|string|max:255',
        'email'     => 'required|email|max:255|unique:users',
        'password'  => 'required|string|min:3|max:12|confirmed',
        'role_id'   => 'required|exists:roles,id'
      ]);
      $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'role_id'  => $request->role_id
      ]);
      event(new Registered($user));

      return redirect(url('dashboard/admins'));
    }

    public function promote($id)
    {
      $admin = User::FindOrFail($id);
      $admin->update([
        'role_id'=> Role::select('id')->where('name', 'superadmin')->first()->id
      ]);
      return back();
    }

    public function demote($id)
    {
      $superadmin = User::FindOrFail($id);
      $superadmin->update([
        'role_id'=> Role::select('id')->where('name', 'teacher')->first()->id
      ]);
      return back();
    }
}
