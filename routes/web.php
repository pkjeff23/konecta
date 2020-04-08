<?php

use Illuminate\Support\Facades\Route;


Route::resource('/users', 'UserController');

Route::resource('/clients', 'ClientsController');

Route::get('/', function () {
    return view('layout');
});

Auth::routes();

