<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'lesson_id'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function clas()
    {
        return $this->belongsToMany(Clas::class,'class_lessons','lesson_id','class_id')->withPivot(['teacher_id','day']);
    }

    public function reports()
    {
        return $this->belongsToMany(Report::class,'lesson_values')->withPivot(['test_id','value']);
    }
}
