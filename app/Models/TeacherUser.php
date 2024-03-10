<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherUser extends Model
{
    protected $fillable = [
        'teacher_id',
        'filament_user_id'
    ];
}
