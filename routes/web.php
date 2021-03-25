<?php

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

Route::get('/test-login', function () {
    \Illuminate\Support\Facades\Auth::login(\App\Models\User::all()->random(), $remember = true);
    return redirect(route('dashboard.all'));
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('/dashboard')->name('dashboard.')->group(function () {
        Route::get('/', function () {
            return view('home', ['type'=>\App\BreadcrumbsHelper::DASHBOARD_ALL,'websites' => [...Auth::user()->websites, ...Auth::user()->shared_with]]);
        })->name('all');
        Route::get('/my', function () {
            return view('home', ['type'=>\App\BreadcrumbsHelper::DASHBOARD_MINE,'websites' => Auth::user()->websites]);
        })->name('mine');
        Route::get('/shared', function () {
            return view('home', ['type'=>\App\BreadcrumbsHelper::DASHBOARD_SHARED,'websites' => Auth::user()->shared_with]);
        })->name('shared');
    });

    Route::get('/website/{id}', function ($id) {
        $website = \App\Models\Website::findOrFail($id);
        return view('website', ['website' => $website]);
    })->name('website');
    Route::get('/page/{id}', function ($id) {
        $page = \App\Models\Page::findOrFail($id);
        return view('page', ['page' => $page]);
    })->name('page');
});

require __DIR__ . '/auth.php';
