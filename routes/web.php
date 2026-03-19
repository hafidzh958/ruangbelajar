<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.home');
});

Route::get('/about', function () {
    return view('user.about');
});

Route::get('/program', function () {
    return view('user.program');
});

Route::get('/contact', function () {
    return view('user.contact');
});

Route::get('/register', function () {
    return view('user.register');
});
