<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function questions_relation()
    {
       return $this->HasMany(Question::class);
    }

    public function skills_relation()
    {
       return $this->BelongsTo(Skill::class);
    }

    public function users_relation()
    {
      return $this->BelongsToMany(User::class);
    }
}
