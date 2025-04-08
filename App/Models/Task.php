<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'description', 'status','due_date',"created_by"];

    /**
     * A task belongs to a user.
     */
  // Task.php
// Task.php
// Task.php
   // Define the many-to-many relationship with the User model
// Task.php
public function users()
{
    return $this->belongsToMany(User::class, 'task_user');
}

public function creator()
{
    return $this->belongsTo(User::class, 'created_by');
}
}
