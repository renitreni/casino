<?php

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

Route::get('/', function () {
    return 'Coming Soon!';
});

Route::get('/login', fn () => view('project-one.login'))->name('login');
Route::get('/dashboard', fn () => view('project-one.dashboard'))->name('dashboard');
Route::get('/agents', fn () => view('project-one.agents'))->name('agents');
Route::get('/players', fn () => view('project-one.players'))->name('players');
Route::get('/admins', fn () => view('project-one.admins'))->name('admins');
