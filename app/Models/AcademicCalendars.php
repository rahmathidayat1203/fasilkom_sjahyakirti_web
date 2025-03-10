<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicCalendars extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
}
