<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'photo',
        'birth_place',
        'birth_date',
        'nuptk',
        'nip',
        'position',
        'level',
        'gender',
        'religion',
        'address',
        'phone',
        'education',
        'status',
        'work_start_date',
    ];

    public function classes()
    {
        return $this->hasMany(Clas::class);
    }


    public function lessons(){
        return $this->belongsToMany(Lesson::class,'class_lessons','teacher_id','lesson_id');
    }

}
