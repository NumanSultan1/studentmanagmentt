<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $team = [
            [
                'name' => 'Dr. Robert Chen',
                'role' => 'Dean of Computer Science',
                'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=300&q=80',
                'bio' => 'Over 15 years teaching CS. Ph.D. from MIT.'
            ],
            [
                'name' => 'Sarah Jenkins',
                'role' => 'Lead UI/UX Instructor',
                'image' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=300&q=80',
                'bio' => 'Design consultant and former Lead UX Designer at Spotify.'
            ],
            [
                'name' => 'Prof. Alan Turing',
                'role' => 'Senior Database Architect',
                'image' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=300&q=80',
                'bio' => 'Specializes in database scalability and SQL optimization.'
            ]
        ];

        return view('public.about', compact('team'));
    }
}
