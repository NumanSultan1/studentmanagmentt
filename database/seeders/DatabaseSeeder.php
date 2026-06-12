<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed only the System Administrator account
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'System Administrator',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '+1 (555) 019-2834',
                'address' => '123 University Ave, Boston, MA',
                'bio' => 'Lead administrator of the student management portal.',
            ]
        );

        // Seed a demo Student account
        User::updateOrCreate(
            ['email' => 'student@example.com'],
            [
                'name' => 'Jane Student',
                'password' => Hash::make('password'),
                'role' => 'student',
                'phone' => '+1 (555) 012-3456',
                'address' => '456 College Rd, Boston, MA',
                'bio' => 'Software engineering major currently in my 2nd semester.',
            ]
        );

        \App\Models\Student::updateOrCreate(
            ['email' => 'student@example.com'],
            [
                'name' => 'Jane Student',
                'phone' => '+1 (555) 012-3456',
                'address' => '456 College Rd, Boston, MA',
                'department' => 'Software Engineering',
                'semester' => '2nd',
            ]
        );

        // 2. Seed a few clean sample courses categorized by Semester to demonstrate the new portal layout
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Course::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();
        $sampleCourses = [
            [
                'title' => 'Programming Fundamentals (Python)',
                'image' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=600&q=80',
                'description' => 'Introduction to basic programming concepts, control flow, functions, and data structures.',
                'instructor' => 'Dr. Robert Chen',
                'semester' => '1st Semester',
                'is_featured' => true,
            ],
            [
                'title' => 'Calculus & Analytical Geometry',
                'image' => 'https://images.unsplash.com/photo-1509228468518-180dd4864904?auto=format&fit=crop&w=600&q=80',
                'description' => 'Advanced mathematical limits, derivatives, integration, and their engineering applications.',
                'instructor' => 'Prof. Sarah Miller',
                'semester' => '1st Semester',
                'is_featured' => false,
            ],
            [
                'title' => 'Object-Oriented Programming (Java)',
                'image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=600&q=80',
                'description' => 'Detailed concepts of abstraction, encapsulation, inheritance, polymorphism, and interface design.',
                'instructor' => 'Dr. Robert Chen',
                'semester' => '2nd Semester',
                'is_featured' => true,
            ],
            [
                'title' => 'Database Management Systems',
                'image' => 'https://images.unsplash.com/photo-1544383835-bda2bc66a55d?auto=format&fit=crop&w=600&q=80',
                'description' => 'Relational models, SQL query optimization, transaction management, and normalization.',
                'instructor' => 'Prof. Alan Turing',
                'semester' => '3rd Semester',
                'is_featured' => true,
            ]
        ];

        foreach ($sampleCourses as $course) {
            Course::create($course);
        }
    }
}
