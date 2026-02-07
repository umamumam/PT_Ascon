<?php

use App\Models\Tracking;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VesselController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\TrackingDetailController;
use App\Http\Controllers\SailingScheduleController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/services', function () {
    return view('services');
});
Route::get('/news', function () {
    return view('news');
});
Route::get('/careers', function () {
    return view('careers');
});
Route::get('/contact', function () {
    return view('contact');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/sailing', [SailingScheduleController::class, 'publicSchedules'])->name('sailing-schedule');
Route::get('/etracking', [TrackingController::class, 'publicTracking'])->name('public.tracking');
Route::get('/sailing-schedule/search-ports', [SailingScheduleController::class, 'searchPorts'])->name('sailing-schedule.search-ports');
Route::get('/sailing-schedule/download-pdf', [SailingScheduleController::class, 'downloadPdf'])->name('sailing-schedule.download-pdf');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/setting', [ProfileController::class, 'setting'])->name('profile.setting');
    Route::get('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UserController::class);
    Route::resource('ports', PortController::class);
    Route::resource('vessels', VesselController::class);

    Route::get('schedules/template/download', [SailingScheduleController::class, 'downloadTemplate'])->name('schedules.template.download');
    Route::post('schedules/import', [SailingScheduleController::class, 'import'])->name('schedules.import');

    Route::resource('schedules', SailingScheduleController::class);

    Route::get('trackings/template/download', [TrackingController::class, 'downloadTemplate'])
        ->name('trackings.template.download');
    Route::post('trackings/import', [TrackingController::class, 'import'])
        ->name('trackings.import');
    Route::post('/tracking/{trackingId}/details', [TrackingDetailController::class, 'store'])
        ->name('tracking_details.store');

    Route::resource('trackings', TrackingController::class);
});

require __DIR__ . '/auth.php';
