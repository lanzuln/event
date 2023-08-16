<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\EventCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/logout', [dashboardController::class, 'destroy'])->name('logout');

Route::get('/dashboard', function () {
    return view('pages.dashboard.dashboard-page');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //Event controller
    Route::controller(EventController::class)->group(function () {
        Route::post('/create-event', 'createEvent');
        Route::get('/read-event', 'readEvent');
        Route::post('/update-event', 'updateEvent');
        Route::post('/delete-event', 'deleteEvent');
        // -- event page
        Route::get('/event', 'eventPage')->name('event_page');
        Route::post("/event-by-id",'eventByID');

        Route::get("/",'all_event');


    });

      //Event category controller
      Route::controller(EventCategoryController::class)->group(function () {
        Route::post('/create-category', 'category_create');
        Route::get('/read-category', 'category_read');
        Route::post('/update-category', 'category_update');
        Route::post('/delete-category', 'category_delete');

        // -- event category page
        Route::get('/event-Category', 'eventCategoryPage')->name('event_category_page');
        Route::post("/category-by-id",'CategoryByID');

        // Route::get("/",'all_event');


    });



});

require __DIR__.'/auth.php';
