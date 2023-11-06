<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'active',
        'who_added'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
       return $this->BelongsTo(Role::class);
    }

    public function exams()
    {
      return $this->BelongsToMany(Exam::class)
       ->withPivot('score','time_mins','status')
       ->withTimestamps();
    }

    public function questions()
    {
      return $this->BelongsToMany(Question::class)
       ->withPivot('user_answer','right_ans')
       ->withTimestamps();
    }

    public function scopeActive($query)
    {
      return $query->where('active', 1);  // ScopePopular:: U must use this fnction with Kamal Case,,To use In all where when need to filter to active..
    }
}
