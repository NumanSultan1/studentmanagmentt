<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CoursePublicController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryPublicController;
use App\Http\Controllers\TestimonialPublicController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/courses', [CoursePublicController::class, 'index'])->name('courses');
Route::get('/courses/{course}', [CoursePublicController::class, 'show'])->name('courses.show');
Route::post('/courses/{course}/enroll', [CoursePublicController::class, 'enroll'])->middleware('auth')->name('courses.enroll');
Route::get('/gallery', [GalleryPublicController::class, 'index'])->name('gallery');
Route::get('/testimonials', [TestimonialPublicController::class, 'index'])->name('testimonials');
Route::post('/testimonials', [TestimonialPublicController::class, 'store'])->middleware('auth')->name('testimonials.store');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Dashboard Redirect Route
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('student.dashboard');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Portal (Role-based access)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Student CRUD
    Route::resource('students', App\Http\Controllers\Admin\StudentController::class);
    
    // Course CRUD
    Route::resource('courses', App\Http\Controllers\Admin\CourseController::class);
    
    // Gallery CRUD
    Route::resource('gallery', App\Http\Controllers\Admin\GalleryController::class)->except(['show', 'edit', 'update']);
    
    // Testimonial management
    Route::get('/testimonials', [App\Http\Controllers\Admin\TestimonialController::class, 'index'])->name('testimonials.index');
    Route::post('/testimonials/{testimonial}/toggle-feature', [App\Http\Controllers\Admin\TestimonialController::class, 'toggleFeature'])->name('testimonials.toggle-feature');
    Route::delete('/testimonials/{testimonial}', [App\Http\Controllers\Admin\TestimonialController::class, 'destroy'])->name('testimonials.destroy');
    
    // Contact Messages management
    Route::get('/messages', [App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [App\Http\Controllers\Admin\ContactMessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{message}/toggle-read', [App\Http\Controllers\Admin\ContactMessageController::class, 'toggleRead'])->name('messages.toggle-read');
    Route::delete('/messages/{message}', [App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('messages.destroy');
});

/*
|--------------------------------------------------------------------------
| Student Portal
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/courses', [App\Http\Controllers\Student\CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{course}', [App\Http\Controllers\Student\CourseController::class, 'show'])->name('courses.show');
    Route::get('/testimonials', [App\Http\Controllers\Student\TestimonialController::class, 'index'])->name('testimonials.index');
    Route::post('/testimonials', [App\Http\Controllers\Student\TestimonialController::class, 'store'])->name('testimonials.store');
});

require __DIR__.'/auth.php';