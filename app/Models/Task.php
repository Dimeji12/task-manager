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
    protected $fillable = ['name', 'description', 'status', 'user_id','due_date'];

    /**
     * A task belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
