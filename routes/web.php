<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\QuoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/paginas-web', [ServiceController::class, 'paginasWeb'])->name('paginas-web');
Route::get('/proceso', [ServiceController::class, 'proceso'])->name('proceso');
Route::get('/hosting', [ServiceController::class, 'hosting'])->name('hosting');
Route::get('/demo', [ServiceController::class, 'demo'])->name('demo');

Route::view('/demo/customizer', 'customizer-react')->name('customizer.react');

Route::get('/proyectos', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/portafolio/{slug}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/cotizacion/{quote}', [App\Http\Controllers\Admin\QuoteController::class, 'publicView'])->name('quotes.public');
Route::get('/cotizacion/{quote}/pdf', [App\Http\Controllers\Admin\QuoteController::class, 'downloadPdf'])->name('quotes.pdf');
Route::get('/factura/{invoice}', [App\Http\Controllers\Admin\InvoiceController::class, 'publicView'])->name('invoices.public');
Route::get('/factura/{invoice}/pdf', [App\Http\Controllers\Admin\InvoiceController::class, 'pdf'])->name('invoices.pdf');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/invoices', [App\Http\Controllers\Admin\InvoiceController::class, 'index'])->name('admin.invoices.index');
        Route::get('/invoices/create-from-quote/{quote}', [App\Http\Controllers\Admin\InvoiceController::class, 'createFromQuote'])->name('admin.invoices.create-from-quote');
        Route::post('/invoices', [App\Http\Controllers\Admin\InvoiceController::class, 'store'])->name('admin.invoices.store');
        Route::get('/invoices/{invoice}', [App\Http\Controllers\Admin\InvoiceController::class, 'show'])->name('admin.invoices.show');
        Route::delete('/invoices/{invoice}', [App\Http\Controllers\Admin\InvoiceController::class, 'destroy'])->name('admin.invoices.destroy');
        Route::get('/quotes/create', [QuoteController::class, 'create'])->name('admin.quotes.create');
        Route::post('/quotes', [QuoteController::class, 'store'])->name('admin.quotes.store');
        Route::get('/quotes/{quote}', [QuoteController::class, 'show'])->name('admin.quotes.show');
        Route::get('/quotes/{quote}/edit', [QuoteController::class, 'edit'])->name('admin.quotes.edit');
        Route::put('/quotes/{quote}', [QuoteController::class, 'update'])->name('admin.quotes.update');
        Route::post('/quotes/{quote}/status', [QuoteController::class, 'updateStatus'])->name('admin.quotes.status');
        Route::delete('/quotes/{quote}', [QuoteController::class, 'destroy'])->name('admin.quotes.destroy');
    });
});
