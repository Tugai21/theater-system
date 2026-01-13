<?php

use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/', function () {
    return redirect()->route('login');
});

// Status check route
Route::get('/admin-status', function () {
    try {
        $user = User::where('email', 'admin@gmail.com')->first();
        
        if (!$user) {
            return response("❌ Admin user not found in database\n\nVisit /setup-admin to create it", 404);
        }
        
        return response(
            "ℹ️  Admin User Status:\n" .
            "━━━━━━━━━━━━━━━━━━━━━━\n" .
            "Email: " . $user->email . "\n" .
            "Name: " . $user->name . "\n" .
            "Admin: " . ($user->is_admin ? "✅ YES" : "❌ NO") . "\n" .
            "Email Verified: " . ($user->email_verified_at ? "✅ YES" : "❌ NO") . "\n" .
            "━━━━━━━━━━━━━━━━━━━━━━\n" .
            "Test Login:\n" .
            "Email: admin@gmail.com\n" .
            "Password: 123456789\n",
            200
        );
    } catch (\Exception $e) {
        return response("❌ Database Error: " . $e->getMessage(), 500);
    }
});

// Setup route to create or update admin user
Route::get('/setup-admin', function () {
    try {
        // First, check if admin user exists
        $user = User::where('email', 'admin@gmail.com')->first();
        
        if ($user) {
            // Update existing user to ensure is_admin is true
            $user->update([
                'is_admin' => true,
                'email_verified_at' => $user->email_verified_at ?? now(),
            ]);
            return response("✅ Admin user updated successfully!\n\nEmail: admin@gmail.com\nPassword: 123456789\nAdmin Status: YES", 200);
        } else {
            // Create new admin user
            $user = User::create([
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456789'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]);
            
            return response("✅ Admin user created successfully!\n\nEmail: admin@gmail.com\nPassword: 123456789\nAdmin Status: YES", 201);
        }
    } catch (\Exception $e) {
        return response("❌ Error: " . $e->getMessage(), 500);
    }
});

Route::get('/dashboard', [PerformanceController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function () {
    Route::resource('admin/performances', PerformanceController::class)
        ->names('admin.performances')
        ->middleware('admin')
        ->except(['show']);
    
    Route::get('admin/users', [UserController::class, 'index'])->name('admin.users.index')->middleware('admin');
    Route::post('admin/users/{user}/toggle-admin', [UserController::class, 'toggleAdmin'])->name('admin.users.toggleAdmin')->middleware('admin');
});

require __DIR__.'/auth.php';