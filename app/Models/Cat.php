<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function skills()
    {
       return $this->hasMany(Skill::class);
    }

    public function jname($lang = null)
    {
      $lang = $lang ?? App::getlocale(); // For Dashboard, ?? Means if $lang not null make $lang = App::getlocale();
      return json_decode($this->name)->$lang;
    }
}
