<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
    ];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function averageGrade()
    {
        $avg = $this->activities()->whereNotNull('grade')->avg('grade');
        return $avg !== null ? round($avg, 2) : null;
    }
}
