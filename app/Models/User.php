<?php

namespace App\Models;

use App\Models\City;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'role_id',
        'type',
        'city_id',
        'active',
        'who_added'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
       return $this->BelongsTo(Role::class);
    }

    public function City()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

    public function exams()
    {
      return $this->BelongsToMany(Exam::class)
       ->withPivot('score','time_mins','status')
       ->withTimestamps();
    }

    public function skills()
    {
      return $this->BelongsToMany(Skill::class)
       ->withPivot('priceSubscribtion','subscriber', 'subscribtionperiod')
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
