<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

if (App::environment('local')) {
    Route::get('/test-login', function () {
        \Illuminate\Support\Facades\Auth::login(\App\Models\User::all()->random(), $remember = true);
        return redirect(route('dashboard.all'));
    });
}

Route::middleware(['auth'])->group(function () {
    Route::prefix('/dashboard')
        ->name('dashboard.')
        ->group(function () {
            Route::get('/', [WebsiteController::class, 'index'])->name('all');
            Route::get('/my', [WebsiteController::class, 'indexOnlyOfProperty'])->name('mine');
            Route::get('/shared', [WebsiteController::class, 'indexOnlyShared'])->name('shared');
        });
    Route::resource('websites', WebsiteController::class)->except(['index']);

    Route::resource('websites.pages', PageController::class)->shallow();
});

require __DIR__ . '/auth.php';
