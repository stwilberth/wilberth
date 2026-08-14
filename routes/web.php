<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BriefController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\QuoteController;
use App\Http\Controllers\Admin\BriefLinkController;
use App\Http\Controllers\Admin\HaciendaImportController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/paginas-web', [ServiceController::class, 'paginasWeb'])->name('paginas-web');
Route::get('/proceso', [ServiceController::class, 'proceso'])->name('proceso');
Route::get('/hosting', [ServiceController::class, 'hosting'])->name('hosting');
Route::get('/demo', [ServiceController::class, 'demo'])->name('demo');
Route::get('/demo/camiseta', [ServiceController::class, 'demoCamiseta'])->name('demo.camiseta');

Route::view('/demo/customizer', 'customizer-react')->name('customizer.react');

Route::get('/brief/{token?}', [BriefController::class, 'show'])->name('brief.show');
Route::post('/brief', [BriefController::class, 'store'])->name('brief.store');

Route::get('/proyectos', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/portafolio/{slug}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/cotizacion/{quote:slug}', [App\Http\Controllers\Admin\QuoteController::class, 'publicView'])->name('quotes.public');
Route::get('/cotizacion/{quote:slug}/pdf', [App\Http\Controllers\Admin\QuoteController::class, 'downloadPdf'])->name('quotes.pdf');
Route::get('/factura/{invoice:slug}', [App\Http\Controllers\Admin\InvoiceController::class, 'publicView'])->name('invoices.public');
Route::get('/factura/{invoice:slug}/pdf', [App\Http\Controllers\Admin\InvoiceController::class, 'pdf'])->name('invoices.pdf');
Route::get('/factura/{invoice:slug}/pdf-original', [App\Http\Controllers\Admin\InvoiceController::class, 'downloadOriginalPdf'])->name('invoices.original-pdf');

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
        Route::post('/invoices/{invoice}/pdf-original', [App\Http\Controllers\Admin\InvoiceController::class, 'uploadOriginalPdf'])->name('admin.invoices.upload-original-pdf');
        Route::delete('/invoices/{invoice}', [App\Http\Controllers\Admin\InvoiceController::class, 'destroy'])->name('admin.invoices.destroy');
        Route::get('/hacienda/import', [App\Http\Controllers\Admin\HaciendaImportController::class, 'create'])->name('admin.hacienda.import');
        Route::post('/hacienda/import', [App\Http\Controllers\Admin\HaciendaImportController::class, 'store'])->name('admin.hacienda.store');
        Route::get('/hacienda/{haciendaDocument}/xml', [App\Http\Controllers\Admin\HaciendaImportController::class, 'downloadXml'])->name('admin.hacienda.xml');
        Route::get('/quotes/create', [QuoteController::class, 'create'])->name('admin.quotes.create');
        Route::post('/quotes', [QuoteController::class, 'store'])->name('admin.quotes.store');
        Route::get('/quotes/{quote}', [QuoteController::class, 'show'])->name('admin.quotes.show');
        Route::get('/quotes/{quote}/edit', [QuoteController::class, 'edit'])->name('admin.quotes.edit');
        Route::put('/quotes/{quote}', [QuoteController::class, 'update'])->name('admin.quotes.update');
        Route::post('/quotes/{quote}/status', [QuoteController::class, 'updateStatus'])->name('admin.quotes.status');
        Route::post('/quotes/{quote}/hacienda', [HaciendaImportController::class, 'storeFromQuote'])->name('admin.quotes.hacienda');
        Route::delete('/quotes/{quote}', [QuoteController::class, 'destroy'])->name('admin.quotes.destroy');
        Route::get('/brief-links', [BriefLinkController::class, 'index'])->name('admin.brief-links.index');
        Route::get('/brief-links/create', [BriefLinkController::class, 'create'])->name('admin.brief-links.create');
        Route::post('/brief-links', [BriefLinkController::class, 'store'])->name('admin.brief-links.store');
        Route::get('/brief-links/{briefLink}', [BriefLinkController::class, 'show'])->name('admin.brief-links.show');
        Route::post('/brief-links/{briefLink}/toggle', [BriefLinkController::class, 'toggle'])->name('admin.brief-links.toggle');
        Route::delete('/brief-links/{briefLink}', [BriefLinkController::class, 'destroy'])->name('admin.brief-links.destroy');
        Route::get('/brief/{brief}/download', [BriefLinkController::class, 'download'])->name('admin.brief.download');
    });
});
