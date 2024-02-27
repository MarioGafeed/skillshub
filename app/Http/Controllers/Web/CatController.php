<?php
namespace App\Http\Controllers\Web;
use App\Models\Cat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CatController extends Controller
{
    public function show($id)
    {
      $data['cat'] = Cat::findOrFail($id);
      $data['allCats'] = Cat::select('id', 'name')->active()->get();
      $data['skills'] = $data['cat']->skills()->active()->paginate(10);
      return view('web.cats.show')->with($data);
    }
}
