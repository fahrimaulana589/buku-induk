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
        return $this->belongsTo(Evaluasi::class);
    }
}
