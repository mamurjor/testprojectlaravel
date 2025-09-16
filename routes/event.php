<?php


use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdminController;

// ইভেন্টের লিস্ট দেখানো
Route::get('/eventlist', [EventController::class, 'index'])->name('eventlist');

// নির্দিষ্ট ইভেন্টের ডিটেইলস দেখানো
Route::get('event/{event}', [EventController::class, 'show'])->name('event.show');

// রেজিস্ট্রেশন করা
Route::post('event/{event}/register', [RegistrationController::class, 'store'])->name('event.register');


Route::middleware('auth')->prefix('admin')->group(function() {
    Route::get('events', [AdminController::class, 'index'])->name('admin.index');
    Route::get('events/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('events', [AdminController::class, 'store'])->name('admin.store');
    Route::get('events/{event}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('events/{event}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('events/{event}', [AdminController::class, 'destroy'])->name('admin.destroy');
});


?>
