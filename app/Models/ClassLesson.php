<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassLesson extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'class_id',
        'lesson_id',
        'teacher_id',
        'day',
    ];

    public function clas()
    {
        return $this->belongsTo(Clas::class,'class_id');
    }

    public function Lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
