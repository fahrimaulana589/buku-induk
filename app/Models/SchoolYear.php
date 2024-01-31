<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function lulusan()
    {
        return $this->belongsToMany(Student::class,'student_graduetes');
    }

    public function keluar()
    {
        return $this->belongsToMany(Student::class,'student_dropouts');
    }
}
