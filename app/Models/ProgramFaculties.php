<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramFaculties extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function program()
    {
        return $this->belongsTo(Programs::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculties::class);
    }

}
