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
use App\Http\Controllers\User\UserTrackingController;

use App\Http\Controllers\PublicCmsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\SocialFeedController;
use App\Http\Controllers\LandingSettingController;
use App\Http\Controllers\InquiryController;

// ─── Public routes ────────────────────────────────────────────────────────────
Route::get('/', [PublicCmsController::class, 'welcome']);
Route::get('/about', function () {
    return view('about');
});
Route::get('/services', function () {
    return view('services');
});
Route::get('/news', [PublicCmsController::class, 'news'])->name('public.news.index');
Route::get('/news/{slug}', [PublicCmsController::class, 'showNews'])->name('public.news.show');
Route::get('/careers', [PublicCmsController::class, 'careers'])->name('public.careers.index');
Route::get('/contact', function () {
    return view('contact');
});
Route::post('/contact', [PublicCmsController::class, 'storeInquiry'])->name('public.contact.store');

Route::get('/sailing', [SailingScheduleController::class, 'publicSchedulesNew'])->name('sailing-schedule');
Route::get('/sailing-classic', [SailingScheduleController::class, 'publicSchedules'])->name('sailing-schedule-classic');
Route::get('/etracking', [TrackingController::class, 'publicTracking'])->name('public.tracking');
Route::get('/sailing-schedule/search-ports', [SailingScheduleController::class, 'searchPorts'])->name('sailing-schedule.search-ports');
Route::get('/sailing-schedule/download-pdf', [SailingScheduleController::class, 'downloadPdf'])->name('sailing-schedule.download-pdf');

Route::get('/sitemap.xml', function () {
    $news = \App\Models\News::all();
    return response()->view('sitemap', compact('news'))->header('Content-Type', 'text/xml');
});


// ─── /dashboard: redirect sesuai role ─────────────────────────────────────────
Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->isUser()) {
        return redirect()->route('user.tracking.index');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ─── User routes (role=user) ──────────────────────────────────────────────────
Route::middleware(['auth', 'user.role'])->prefix('user')->name('user.')->group(function () {
    Route::get('/tracking/{type?}', [UserTrackingController::class, 'index'])->name('tracking.index');
});

// ─── Admin routes (role=admin) ────────────────────────────────────────────────
Route::middleware(['auth', 'admin'])->group(function () {
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

    Route::get('trackings/template/download', [TrackingController::class, 'downloadTemplate'])->name('trackings.template.download');
    Route::post('trackings/import', [TrackingController::class, 'import'])->name('trackings.import');
    Route::post('/tracking/{trackingId}/details', [TrackingDetailController::class, 'store'])->name('tracking_details.store');
    Route::put('tracking-details/{id}', [TrackingDetailController::class, 'update'])->name('tracking_details.update');
    Route::delete('tracking-details/{id}', [TrackingDetailController::class, 'destroy'])->name('tracking_details.destroy');
    Route::resource('trackings', TrackingController::class);

    // CMS Administration routes
    Route::resource('cms/news', NewsController::class)->names([
        'index'   => 'cms.news.index',
        'store'   => 'cms.news.store',
        'update'  => 'cms.news.update',
        'destroy' => 'cms.news.destroy',
    ])->except(['create', 'show', 'edit']);

    Route::resource('cms/careers', CareerController::class)->names([
        'index'   => 'cms.careers.index',
        'store'   => 'cms.careers.store',
        'update'  => 'cms.careers.update',
        'destroy' => 'cms.careers.destroy',
    ])->except(['create', 'show', 'edit']);

    Route::resource('cms/feeds', SocialFeedController::class)->names([
        'store'   => 'cms.feeds.store',
        'update'  => 'cms.feeds.update',
        'destroy' => 'cms.feeds.destroy',
    ])->only(['store', 'update', 'destroy']);

    Route::get('cms/settings', [LandingSettingController::class, 'index'])->name('cms.settings.index');
    Route::post('cms/settings', [LandingSettingController::class, 'update'])->name('cms.settings.update');

    Route::get('cms/inquiries', [InquiryController::class, 'index'])->name('cms.inquiries.index');
    Route::delete('cms/inquiries/{id}', [InquiryController::class, 'destroy'])->name('cms.inquiries.destroy');
    Route::post('cms/inquiries/{id}/read', [InquiryController::class, 'markAsRead'])->name('cms.inquiries.read');
});

require __DIR__ . '/auth.php';
