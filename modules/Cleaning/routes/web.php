<?php

use Illuminate\Support\Facades\Route;
use Modules\Cleaning\Http\Controllers\Admin\ClientController;
use Modules\Cleaning\Http\Controllers\Admin\BusinessListingController;
use Modules\Cleaning\Http\Controllers\Admin\AdCampaignController;
use Modules\Cleaning\Http\Controllers\Admin\ClientMessageController;
use Modules\Cleaning\Http\Controllers\Admin\DashboardController;
use Modules\Cleaning\Http\Controllers\Admin\InvoiceController;
use Modules\Cleaning\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use Modules\Cleaning\Http\Controllers\Admin\PropertyController;
use Modules\Cleaning\Http\Controllers\Admin\ReviewController;
use Modules\Cleaning\Http\Controllers\Admin\StaffController;
use Modules\Cleaning\Http\Controllers\Admin\JobController;
use Modules\Cleaning\Http\Controllers\Admin\OperationsController;
use Modules\Cleaning\Http\Controllers\Admin\RecurringJobPlanController;
use Modules\Cleaning\Http\Controllers\Admin\ServiceController;
use Modules\Cleaning\Http\Controllers\Admin\SocialAutomationController;
use Modules\Cleaning\Http\Controllers\Admin\TeamMessageController;
use Modules\Cleaning\Http\Controllers\Admin\ThemeMarketplaceController;
use Modules\Cleaning\Http\Controllers\Admin\TimesheetController;
use Modules\Cleaning\Http\Controllers\Admin\WebLeadController;
use Modules\Cleaning\Http\Controllers\Admin\WebchatController;
use Modules\Cleaning\Http\Controllers\Admin\WidgetController;
use Modules\Cleaning\Http\Controllers\Client\PortalController as ClientPortalController;
use Modules\Cleaning\Http\Controllers\Frontend\TestimonialsController;
use Modules\Cleaning\Http\Controllers\Staff\PortalController;
use Modules\Cleaning\Http\Controllers\Staff\Auth\LoginController as StaffAuthLoginController;
use Modules\Cleaning\Http\Controllers\Client\Auth\LoginController as ClientAuthLoginController;
use Modules\Cleaning\Http\Controllers\Staff\Auth\ForgotPasswordController as StaffForgotPasswordController;
use Modules\Cleaning\Http\Controllers\Staff\Auth\ResetPasswordController as StaffResetPasswordController;
use Modules\Cleaning\Http\Controllers\Client\Auth\ForgotPasswordController as ClientForgotPasswordController;
use Modules\Cleaning\Http\Controllers\Client\Auth\ResetPasswordController as ClientResetPasswordController;

$adminPrefix = trim((string) config('mojar.admin_prefix', 'app'), '/');

Route::middleware(['web'])->group(function () {
    Route::get('/testimonials', [TestimonialsController::class, 'index'])->name('cleaning.testimonials');
    Route::get('/services', function () {
        return view('cleaning.services');
    })->name('cleaning.services');
});

Route::middleware(['web', 'auth', 'admin'])->prefix($adminPrefix . '/cleaning')->name('admin.cleaning.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('clients', ClientController::class);
    Route::resource('listings', BusinessListingController::class)->except(['show']);
    Route::resource('ads', AdCampaignController::class)->parameters(['ads' => 'ad'])->except(['show']);
    Route::resource('properties', PropertyController::class);
    Route::resource('staff', StaffController::class);
    Route::resource('services', ServiceController::class);
    Route::get('invoices/{invoice}/print', [InvoiceController::class, 'printView'])->name('invoices.print');
    Route::get('invoices/{invoice}/download', [InvoiceController::class, 'download'])->name('invoices.download');
    Route::post('invoices/{invoice}/send', [InvoiceController::class, 'send'])->name('invoices.send');
    Route::resource('invoices', InvoiceController::class);
    Route::get('payments', [AdminPaymentController::class, 'index'])->name('payments.index');
    Route::get('payments/{payment}', [AdminPaymentController::class, 'show'])->name('payments.show');
    Route::post('payments/{payment}/lifecycle-events', [AdminPaymentController::class, 'storeLifecycleEvent'])->name('payments.lifecycle.store');
    Route::resource('jobs', JobController::class);
    Route::patch('jobs/{job}/quick-assign', [JobController::class, 'quickAssign'])->name('jobs.quick-assign');
    Route::patch('jobs/{job}/quick-reschedule', [JobController::class, 'quickReschedule'])->name('jobs.quick-reschedule');
    Route::get('dispatch-board', [OperationsController::class, 'dispatchBoard'])->name('dispatch.board');
    Route::get('scheduling', [OperationsController::class, 'scheduling'])->name('scheduling.index');
    Route::get('reporting', [OperationsController::class, 'reporting'])->name('reporting.index');
    Route::get('team-messages', [TeamMessageController::class, 'index'])->name('team-messages.index');
    Route::post('team-messages', [TeamMessageController::class, 'store'])->name('team-messages.store');
    Route::get('social', [SocialAutomationController::class, 'index'])->name('social.index');
    Route::post('social/dispatch', [SocialAutomationController::class, 'dispatchNow'])->name('social.dispatch');
    Route::patch('social/{post}/retry', [SocialAutomationController::class, 'retry'])->name('social.retry');
    Route::get('theme-marketplace', [ThemeMarketplaceController::class, 'index'])->name('theme-marketplace.index');
    Route::patch('theme-marketplace/{theme}/activate', [ThemeMarketplaceController::class, 'activate'])->name('theme-marketplace.activate');
    Route::get('webchat', [WebchatController::class, 'index'])->name('webchat.index');
    Route::get('webchat/{conversation}', [WebchatController::class, 'show'])->name('webchat.show');
    Route::post('webchat/{conversation}/reply', [WebchatController::class, 'reply'])->name('webchat.reply');
    Route::patch('webchat/{conversation}/status', [WebchatController::class, 'updateStatus'])->name('webchat.status');
    Route::get('widgets', [WidgetController::class, 'index'])->name('widgets.index');
    Route::put('widgets', [WidgetController::class, 'update'])->name('widgets.update');
    // Reviews
    Route::get('reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('reviews/{review}', [ReviewController::class, 'show'])->name('reviews.show');
    Route::patch('reviews/{review}/approve', [ReviewController::class, 'approve'])->name('reviews.approve');
    Route::patch('reviews/{review}/reject', [ReviewController::class, 'reject'])->name('reviews.reject');
    Route::patch('reviews/{review}/respond', [ReviewController::class, 'respond'])->name('reviews.respond');
    Route::delete('reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    // Client messages
    Route::get('messages', [ClientMessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{client}/thread', [ClientMessageController::class, 'thread'])->name('messages.thread');
    Route::post('messages/{client}/reply', [ClientMessageController::class, 'reply'])->name('messages.reply');
    Route::delete('messages/{message}', [ClientMessageController::class, 'destroy'])->name('messages.destroy');
    // Timesheets
    Route::get('timesheets', [TimesheetController::class, 'index'])->name('timesheets.index');
    Route::get('timesheets/{log}', [TimesheetController::class, 'show'])->name('timesheets.show');
    Route::delete('timesheets/{log}', [TimesheetController::class, 'destroy'])->name('timesheets.destroy');
    Route::resource('recurring-plans', RecurringJobPlanController::class)->parameters(['recurring-plans' => 'recurringPlan']);
    Route::resource('leads', WebLeadController::class)->only(['index', 'show', 'update']);
    Route::post('jobs/{job}/complete', [JobController::class, 'complete'])->name('jobs.complete');
});

Route::middleware(['web', 'guest'])->prefix('staff')->name('staff.portal.')->group(function () use ($adminPrefix) {
    Route::get('login', [StaffAuthLoginController::class, 'index'])->name('login');
    Route::post('login', [StaffAuthLoginController::class, 'login']);
    Route::get('forgot-password', [StaffForgotPasswordController::class, 'index'])->name('forgot_password');
    Route::post('forgot-password', [StaffForgotPasswordController::class, 'forgotPassword']);
    Route::get('reset-password/{email}/{token}', [StaffResetPasswordController::class, 'index'])->name('reset_password');
    Route::post('reset-password/{email}/{token}', [StaffResetPasswordController::class, 'resetPassword']);
});

Route::middleware(['web', 'guest'])->prefix('client')->name('client.portal.')->group(function () use ($adminPrefix) {
    Route::get('login', [ClientAuthLoginController::class, 'index'])->name('login');
    Route::post('login', [ClientAuthLoginController::class, 'login']);
    Route::get('forgot-password', [ClientForgotPasswordController::class, 'index'])->name('forgot_password');
    Route::post('forgot-password', [ClientForgotPasswordController::class, 'forgotPassword']);
    Route::get('reset-password/{email}/{token}', [ClientResetPasswordController::class, 'index'])->name('reset_password');
    Route::post('reset-password/{email}/{token}', [ClientResetPasswordController::class, 'resetPassword']);
});

Route::middleware(['web', 'signed'])->prefix('client/invoices/{invoice}/email')->name('client.portal.invoices.email.')->group(function () {
    Route::get('/download', [ClientPortalController::class, 'downloadInvoiceFromEmail'])->name('download');
    Route::get('/stripe', [ClientPortalController::class, 'startEmailInvoiceStripeCheckout'])->name('stripe.start');
    Route::get('/paypal', [ClientPortalController::class, 'startEmailInvoicePayPalCheckout'])->name('paypal.start');
});

Route::middleware(['web'])->prefix('client/invoices/{invoice}/email')->name('client.portal.invoices.email.')->group(function () {
    Route::get('/stripe/success', [ClientPortalController::class, 'completeInvoiceStripeCheckout'])->name('stripe.success');
    Route::get('/stripe/cancel', [ClientPortalController::class, 'cancelInvoiceStripeCheckout'])->name('stripe.cancel');
    Route::get('/paypal/complete', [ClientPortalController::class, 'completeInvoicePayPalPayment'])->name('paypal.complete');
    Route::get('/paypal/cancel', [ClientPortalController::class, 'cancelInvoicePayPalPayment'])->name('paypal.cancel');
});

Route::middleware(['web', 'auth', 'staff.password.change'])->prefix('staff')->name('staff.portal.')->group(function () {
    Route::get('/change-password', [PortalController::class, 'changePasswordForm'])->name('password.edit');
    Route::post('/change-password', [PortalController::class, 'changePassword'])->name('password.update');

    Route::get('/time/status', [PortalController::class, 'timeStatus'])->name('time.status');
    Route::post('/time/clock-in', [PortalController::class, 'timeClockIn'])->name('time.clock_in');
    Route::post('/time/clock-out', [PortalController::class, 'timeClockOut'])->name('time.clock_out');
    Route::get('/time/statistics', [PortalController::class, 'timeStatistics'])->name('time.statistics');

    Route::get('/', [PortalController::class, 'index'])->name('dashboard');
    Route::get('/jobs', [PortalController::class, 'jobs'])->name('jobs.index');
    Route::get('/jobs/{job}', [PortalController::class, 'show'])->name('jobs.show');
    Route::post('/jobs/{job}/complete', [PortalController::class, 'complete'])->name('jobs.complete');

    Route::post('/jobs/{job}/clock-in', [PortalController::class, 'clockIn'])->name('jobs.clock_in');
    Route::post('/jobs/{job}/clock-out', [PortalController::class, 'clockOut'])->name('jobs.clock_out');
});

Route::middleware(['web', 'auth', 'client.password.change'])->prefix('client')->name('client.portal.')->group(function () {
    Route::get('/change-password', [ClientPortalController::class, 'changePasswordForm'])->name('password.edit');
    Route::post('/change-password', [ClientPortalController::class, 'changePassword'])->name('password.update');

    Route::get('/', [ClientPortalController::class, 'index'])->name('dashboard');
    Route::get('/invoices', [ClientPortalController::class, 'invoices'])->name('invoices.index');
    Route::get('/invoices/{invoice}', [ClientPortalController::class, 'showInvoice'])->name('invoices.show');
    Route::get('/invoices/{invoice}/download', [ClientPortalController::class, 'downloadInvoice'])->name('invoices.download');
    Route::post('/invoices/{invoice}/stripe', [ClientPortalController::class, 'startInvoiceStripeCheckout'])->name('invoices.stripe.start');
    Route::get('/invoices/{invoice}/stripe/success', [ClientPortalController::class, 'completeInvoiceStripeCheckout'])->name('invoices.stripe.success');
    Route::get('/invoices/{invoice}/stripe/cancel', [ClientPortalController::class, 'cancelInvoiceStripeCheckout'])->name('invoices.stripe.cancel');
    Route::post('/invoices/{invoice}/paypal', [ClientPortalController::class, 'startInvoicePayPalPayment'])->name('invoices.paypal.start');
    Route::get('/invoices/{invoice}/paypal/complete', [ClientPortalController::class, 'completeInvoicePayPalPayment'])->name('invoices.paypal.complete');
    Route::get('/invoices/{invoice}/paypal/cancel', [ClientPortalController::class, 'cancelInvoicePayPalPayment'])->name('invoices.paypal.cancel');
    Route::get('/jobs', [ClientPortalController::class, 'jobs'])->name('jobs.index');
    Route::get('/jobs/{job}', [ClientPortalController::class, 'show'])->name('jobs.show');
    Route::get('/jobs/{job}/review', [ClientPortalController::class, 'reviewForm'])->name('reviews.form');
    Route::post('/jobs/{job}/review', [ClientPortalController::class, 'reviewSubmit'])->name('reviews.submit');
    Route::get('/messages', [ClientPortalController::class, 'messages'])->name('messages.index');
    Route::post('/messages', [ClientPortalController::class, 'messageSend'])->name('messages.send');
    Route::get('/payments', [ClientPortalController::class, 'payments'])->name('payments.index');
});
