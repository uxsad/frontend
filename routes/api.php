<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/library/{id}', function ($id) {
    $website = \App\Models\Website::findOrFail($id);
    $content = file_get_contents(('js/uxsad-library.js'));
    $content = preg_replace('/%IDENTIFIER%/', $id, $content, 1);
    //$content = preg_replace('/%UXSAD_URL_CHECK_API%/', route('api.website.url', $id), $content, 1);
    $content = preg_replace('/%REAL_URL%/', $website->base_url, $content, 1);
    return response($content)
        ->header('Content-Type', 'application/javascript');
})->name('get-js');

