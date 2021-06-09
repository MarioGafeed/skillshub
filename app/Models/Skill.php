<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function exams()
    {
       return $this->HasMany(Exam::class);
    }

    public function cat()
    {
       return $this->belongsTo(Cat::class);
    }


    public function jname($lang = null)
        {
          $lang = $lang ?? App::getlocale(); // For Dashboard, ?? Means if $lang not null make $lang = App::getlocale();
          return json_decode($this->name)->$lang;
        }

    public function getstudentsNum()
    {
      $studentsNum = 0;
      foreach($this->exams() as $exam)
      $studentsNum += $exam->users()->count;

      return $studentsNum;
    }


    public function scopeActive($query)
    {
      return $query->where('active', 1);  // ScopePopular:: U must use this fnction with Kamal Case,,To use In all where when need to filter to active..
    }

}
