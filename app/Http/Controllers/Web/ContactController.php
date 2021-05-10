<?php

namespace App\Http\Controllers\Web;
use App\Models\Setting;
Use App\Models\Message;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
  public function index()
  {
    $data['setting'] = Setting::select('email', 'phone')->first();
    return view('web.contact.index')->with($data);
  }

  public function send(Request $request)
  {
    // Method for API

    // $validator = Validator::Make($request->all(), [
    //   'name' => 'required|string|max:255'  ,
    //   'email' => 'required|email|max:255'  ,
    //   'subject' => 'nullable|string|max:255'  ,
    //   'body' => 'required|string'
    // ]);
    //
    //   if($validator->fails())
    //   {
    //     $errors = $validator->errors();
    //     // return redirect( url('contact') )->withErrors($errors);
    //     return Response::json($errors);
    //   }

// Method for Ajax

    $request->validate([
      'name' => 'required|string|max:255'  ,
      'email' => 'required|email|max:255'  ,
      'subject' => 'nullable|string|max:255'  ,
      'body' => 'required|string'
    ]);

      Message::create([
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'body' => $request->body
      ]);

      // $request->session()->flash('success', 'your message send successfuly');
      // return back();

      $data = ['success' => 'your message send successfuly'];
      return Response::json($data);
     


  }
}
