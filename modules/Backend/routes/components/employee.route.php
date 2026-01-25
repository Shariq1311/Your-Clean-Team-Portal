<?php

/**
 * Employee Portal Routes
 *
 * Routes for the employee dashboard, time logs, schedule, and statistics
 * All routes are protected by auth middleware to ensure only authenticated employees can access
 */

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:web'])->prefix('employee')->name('employee.')->group(function () {

    // Dashboard - Main employee portal entry point
    Route::get('/dashboard', function () {
        return Inertia::render('employee/Dashboard');
    })->name('dashboard');

    // Time Logs - View historical time entries
    Route::get('/time-logs', function () {
        return Inertia::render('employee/TimeLogs');
    })->name('time-logs');

    // Schedule - View assigned jobs and schedule
    Route::get('/schedule', function () {
        return Inertia::render('employee/Schedule');
    })->name('schedule');

    // Statistics - View earnings and hours statistics
    Route::get('/statistics', function () {
        return Inertia::render('employee/Statistics');
    })->name('statistics');

});
