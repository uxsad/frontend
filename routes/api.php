<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/websites/{id}/url', function ($id) {
    return \App\Models\Website::findOrFail($id)->base_url;
})->name('api.website.url');

Route::get('/websites/{id}', function ($id) {
    return \App\Models\Website::findOrFail($id);
})->name('api.website');

Route::get('/websites', function () {
    return \App\Models\Website::all();
})->name('api.all_websites');

Route::post('/websites/add', [\App\Http\Controllers\EmotionController::class, 'analyzeInteractions'])->name('api.add_interactions_data');

Route::get('/library/{id}', function ($id) {
    $website = \App\Models\Website::findOrFail($id);
    $content = file_get_contents(('js/uxsad-library.js'));
    $content = preg_replace('/%IDENTIFIER%/', $id, $content, 1);
    //$content = preg_replace('/%UXSAD_URL_CHECK_API%/', route('api.website.url', $id), $content, 1);
    $content = preg_replace('/%REAL_URL%/', $website->base_url, $content, 1);
    $content = preg_replace('/%API_ENDPOINT%/', route("api.add_interactions_data"), $content, 1);
    return response($content)
        ->header('Content-Type', 'application/javascript');
})->name('get-js');
