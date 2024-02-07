<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'value',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
