<?php

use App\Http\Controllers\{
    AttendingEventController,
    AttendingSystemController,
    DeleteCommentController,
    SavedSystemController,
    EventController,
    EventIndexController,
    EventShowController,
    GalleryController,
    galleryIndexController,
    LikeEventController,
    LikeSystemController,
    ProfileController,
    SavedEventController,
    StoreCommentController,
    WelcomeController
};
use App\Models\Country;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class)->name("welcome");
Route::get("/e", EventIndexController::class)->name("eventIndex");
Route::get("/e/{id}", EventShowController::class)->name("eventShow");
Route::get("/gallery", galleryIndexController::class)->name("galleryIndex");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource("/events", EventController::class)->name("index", "events.index");
    Route::resource("/galleries", GalleryController::class)->name("index", "galleries.index");
    Route::get("/countries/{country}", function (Country $country) {
        return response()->json($country->cities);
    });

    Route::get("liked-events", LikeEventController::class)->name("likedEvents");
    Route::get("saved-events", SavedEventController::class)->name("savedEvents");
    Route::get("attending-events", AttendingEventController::class)->name("attendingEvents");

    Route::post("/events-like/{id}", LikeSystemController::class)->name("events.like");
    Route::post("/events-save/{id}", SavedSystemController::class)->name("events.save");
    Route::post("/events-attending/{id}", AttendingSystemController::class)->name("events.attending");

    Route::post("/events/{id}/comments", StoreCommentController::class)->name("events.comments");
    Route::delete("events/{id}/comments/{comment}", DeleteCommentController::class)->name("events.comments.destroy");

});


require __DIR__.'/auth.php';