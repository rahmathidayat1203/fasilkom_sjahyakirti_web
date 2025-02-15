<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Programs extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    /**
     * Get the faculty that owns the program.
     */
    public function faculty()
    {
        return $this->belongsTo(Faculties::class);
    }

    /**
     * Get the user who created the program.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
