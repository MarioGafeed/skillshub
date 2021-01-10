<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function users_relation()
    {
       return $this->HasMany(User::class);
    }
}
