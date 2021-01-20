<?php

namespace App\Models;

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
      return $this->BelongsToMany(User::class);
    }
}
