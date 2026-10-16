<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'type',
        'name',
        'date',
        'grade',
        'description',
    ];

    protected $casts = [
        'date' => 'date',
        'grade' => 'float',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
