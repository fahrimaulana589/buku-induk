<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'mother_id',
        'father_id',
        'class_id',
        'nis',
        'name',
        'photo',
        'status',
        'gender',
        'birth_place',
        'birth_date',
        'religion',
        'citizenship',
        'fam_order',
        'fam_count',
        'fam_status',
        'language',
        'address',
        'phone',
        'live_with',
        'blood_type',
        'height',
        'weight',
        'hobby',
    ];

    public function nameandis() : Attribute
    {
        return Attribute::get(function (){
           return "pos";
        });
    }

    public function father()
    {
        return $this->belongsTo(Father::class);
    }

    public function mother()
    {
        return $this->belongsTo(Mother::class);
    }

    public function class()
    {
        return $this->belongsTo(Clas::class,'class_id');
    }

    public function guardian()
    {
        return $this->hasOne(Guardian::class);
    }

    public function lulus()
    {
        return $this->belongsToMany(SchoolYear::class,'student_graduetes');
    }

    public function keluar()
    {
        return $this->belongsToMany(SchoolYear::class,'student_dropouts')->withPivot(['semester','reason']);
    }

    public function report()
    {
        return $this->hasOne(Report::class);
    }

}
