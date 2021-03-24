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
    return redirect(route('dashboard'));
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/website/{id}', function ($id) {
        $website = \App\Models\Website::findOrFail($id);
        return "This is the page of the website '{$website->name}' (id: {$website->id})";
    })->name('website');
});

require __DIR__ . '/auth.php';
