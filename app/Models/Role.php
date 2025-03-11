<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name']; // Allow mass assignment for the 'name' field

     // Define the relationship to User
     public function users()
     {
         return $this->hasMany(User::class);
     }
}
