<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function questions()
    {
       return $this->HasMany(Question::class);
    }

    public function skill()
    {
       return $this->BelongsTo(Skill::class);
    }

    public function users()
    {
      return $this->BelongsToMany(User::class)
      ->withPivot('score','time_mins','status')
      ->withTimestamps();
    }

    public function jname($lang = null)
        {
          $lang = $lang ?? App::getlocale(); // For Dashboard, ?? Means if $lang not null make $lang = App::getlocale();
          return json_decode($this->name)->$lang;
        }

    public function jdesc($lang = null)
        {
          $lang = $lang ?? App::getlocale(); // For Dashboard, ?? Means if $lang not null make $lang = App::getlocale();
          return json_decode($this->desc)->$lang;
        }




}
