<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Writing extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'title',
        'content',
        'cover',
        'description',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
