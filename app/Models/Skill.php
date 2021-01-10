<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function exams_relation()
    {
       return $this->HasMany(Exam::class);
    }

    public function cats_relation()
    {
       return $this->belongsTo(Cat::class);
    }


}
