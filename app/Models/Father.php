<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Father extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birth_place',
        'birth_date',
        'religion',
        'citizenship',
        'education',
        'work',
        'monthly_income',
        'address',
        'phone',
        'died_at',
    ];

    public function students()
    {
        return $this->hasMany(Student::class,'father_id');
    }

}
