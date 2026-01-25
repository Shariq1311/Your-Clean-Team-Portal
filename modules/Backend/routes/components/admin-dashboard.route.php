<?php

/**
 * Admin Dashboard Routes
 *
 * Routes for the admin dashboard, employee management, and payroll
 * All routes are protected by admin and auth middleware
 */

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:web', 'admin'])->prefix('admin-portal')->name('admin.portal.')->group(function () {

    // Main Admin Dashboard
    Route::get('/dashboard', function () {
        return Inertia::render('admin/AdminDashboard');
    })->name('dashboard');

    // Employee Management
    Route::get('/employees', function () {
        return Inertia::render('admin/EmployeeManagement');
    })->name('employees');

    // Time Tracking Overview
    Route::get('/time-logs', function () {
        return Inertia::render('admin/TimeTrackingOverview');
    })->name('time-logs');

    // Payroll Summary
    Route::get('/payroll', function () {
        return Inertia::render('admin/PayrollSummary');
    })->name('payroll');

});
