<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description',
        'instructor',
        'semester',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function enrolledStudents()
    {
        return $this->belongsToMany(User::class, 'enrollments', 'course_id', 'user_id')->withTimestamps();
    }
}
