<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EventsController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
Route::get('/calendar/callback', [CalendarController::class, 'callback'])->name('calendar.callback');

