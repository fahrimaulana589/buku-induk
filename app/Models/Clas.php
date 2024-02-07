<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clas extends Model
{
    protected $table = "classes";

    use HasFactory;

    protected $fillable = [
        'name',
        'teacher_id'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class,'class_lessons','class_id','lesson_id')
            ->withPivot(['teacher_id']);
    }

    public function reports()
    {
        return $this->hasMany(Report::class,'class_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class,'class_id');
    }
}
