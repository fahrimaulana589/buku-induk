<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public $fillable = [
        'class_id',
        'school_year_id',
        'student_id',
        'semester',
        'status',
    ];

    public function class()
    {
        return $this->belongsTo(Clas::class, 'class_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function schoolYearh()
    {
        return $this->belongsTo(SchoolYear::class, 'school_year_id');
    }

    public function values()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_values')->withPivot(['test_id','value']);
    }

    public function evaluasis()
    {
        return $this->belongsToMany(Evaluasi::class, 'evaluasi_reports')->withPivot(['value']);
    }

    public function notes()
    {
        return $this->hasMany(Note::class,'report_id');
    }
}
