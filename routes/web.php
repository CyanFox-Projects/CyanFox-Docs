<?php

use App\Livewire\Docs;
use App\Livewire\Home;
use App\Livewire\Impress;
use App\Livewire\Privacy;
use Illuminate\Support\Facades\Route;

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

if (!config('app.disable_language_switcher')) {
    Route::group(['prefix' => 'lang'], function () {
        Route::get('de', function () {
            cookie()->queue(cookie()->forget('language'));
            cookie()->queue(cookie()->forever('language', 'de'));

            return redirect()->back();
        })->name('lang.de');

        Route::get('en', function () {
            cookie()->queue(cookie()->forget('language'));
            cookie()->queue(cookie()->forever('language', 'en'));

            return redirect()->back();
        })->name('lang.en');
    });
}

Route::group(['prefix' => 'theme'], function () {
    Route::get('dark', function () {
        cookie()->queue(cookie()->forget('theme'));
        cookie()->queue(cookie()->forever('theme', 'dark'));

        return redirect()->back();
    })->name('theme.dark');

    Route::get('light', function () {
        cookie()->queue(cookie()->forget('theme'));
        cookie()->queue(cookie()->forever('theme', 'light'));

        return redirect()->back();
    })->name('theme.light');
});

Route::group(['middleware' => ['web', 'language', 'theme']], function () {
    if (config('legal.impress') !== null) {
        Route::get('impress', Impress::class)->name('impress');
    }

    if (config('legal.privacy') !== null) {
        Route::get('privacy', Privacy::class)->name('privacy');
    }

    Route::get('/', Home::class)->name('home');
    Route::get('{path}', Docs::class)->where('path', '.*');
});
