<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'evaluasi_id',
    ];

    public function evaluasi()
    {
        return $this->belongsTo(Evaluasi::class,'evaluasi_id');
    }

    public function evaluasis()
    {
        return $this->hasMany(Evaluasi::class,'evaluasi_id');
    }

    public function reports()
    {
        return $this->belongsToMany(Report::class,'evaluasi_reports')->withPivot(['value']);
    }
}
