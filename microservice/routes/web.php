<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
});

Route::get('/{id}', function () {
    return view('main');
})->name('item');

Route::get('/list', function () {
    return view('main');
})->name('list');

Route::get('/create', function () {
    return view('main');
});
