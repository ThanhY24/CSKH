<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ServicesGroupController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChangeController;
use App\Http\Controllers\TransactionResultController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\InvoicesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('v1')->group(function () {
    // Customer
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::get('/customers/{id}', [CustomerController::class, 'show']);
    Route::post('/customers', [CustomerController::class, 'store']);
    Route::post('/customers/{id}', [CustomerController::class, 'update']);
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);
    Route::get('/hide_customers/{id}', [CustomerController::class, 'hide_customers']);
    Route::get('/search_customers', [CustomerController::class, 'search']);
    Route::post('/upload_customers', [CustomerController::class, 'upload_customers']);
    // Staff
    Route::get('/staff', [StaffController::class, 'index']);
    Route::get('/staff/{id}', [StaffController::class, 'show']);
    Route::post('/staff', [StaffController::class, 'store']);
    Route::post('/staff/{id}', [StaffController::class, 'update']);
    Route::delete('/staff/{id}', [StaffController::class, 'destroy']);
    Route::post('/staff-search', [StaffController::class, 'search']);
    Route::post('/staff-login', [AuthController::class, 'staff_login']);

    Route::get('/hide_staff/{id}', [StaffController::class, 'hide_staff']);
    Route::get('/search_staff', [StaffController::class, 'search']);
    Route::get('/staff-logout', [AuthController::class, 'staff_logout']);
    Route::post('/upload_staff', [StaffController::class, 'upload_staff']);

    // Services Group
    Route::get('/services-group', [ServicesGroupController::class, 'index']);
    Route::get('/services-group-and-services', [ServicesGroupController::class, 'getServicesGroupAndServices']);
    Route::get('/services-group/{id}', [ServicesGroupController::class, 'show']);
    Route::post('/services-group', [ServicesGroupController::class, 'store']);
    Route::post('/services-group/{id}', [ServicesGroupController::class, 'update']);
    Route::delete('/services-group/{id}', [ServicesGroupController::class, 'destroy']);
    // Services 
    Route::get('/services', [ServicesController::class, 'index']);
    Route::get('/services/{id}', [ServicesController::class, 'show']);
    Route::post('/services', [ServicesController::class, 'store']);
    Route::post('/services/{id}', [ServicesController::class, 'update']);
    Route::delete('/services/{id}', [ServicesController::class, 'destroy']);
    
    // Controller
    Route::get('/products',[ProductsController::class, 'index']);
    Route::get('/products/{id}',[ProductsController::class, 'show']);
    Route::post('/products',[ProductsController::class, 'store']);
    Route::post('/products/{id}', [ProductsController::class, 'update']);
    Route::get('/products-in-services/{idSer}', [ProductsController::class, 'product_by_IDServices']);
    // Change
    Route::get('/change',[ChangeController::class, 'index']);
    Route::post('/insert-change',[ChangeController::class, 'store']);
    Route::get('/edit-change/{id}',[ChangeController::class, 'show']);
    Route::post('/edit-change/{id}',[ChangeController::class, 'update']);
    // Transaction
    Route::get('/transaction',[ChangeController::class, 'index']);
    Route::post('/insert-transaction',[ChangeController::class, 'store']);
    Route::get('/transaction/{id}',[ChangeController::class, 'show']);

    // Transaction Result
    Route::get('/transaction-result',[TransactionResultController::class, 'index']);
    Route::post('/insert-transaction-result',[TransactionResultController::class, 'store']);

    Route::get('/transaction',[TransactionController::class, 'index']);
    Route::get('/transaction/{id}',[TransactionController::class, 'show']);
    Route::post('/insert-transaction',[TransactionController::class, 'store']);
    Route::post('/transaction-transfer',[TransactionController::class, 'transfer']);
    Route::get('/transaction-complete/{id}',[TransactionController::class, 'update_status']);
    Route::post('/transaction-copy/{id}',[TransactionController::class, 'copy']);
    Route::get('/transaction-delete/{id}',[TransactionController::class, 'delete']);

    // Quotation
    Route::post('/quotation/insert',[QuotationController::class, 'create_quotation']);
    Route::post('/quotation/copy',[QuotationController::class, 'copy_quotation']);
    Route::get('/quotation/details/{id}',[QuotationController::class, 'get_quotation_byID']);
    Route::get('/quotation/print/{id}',[QuotationController::class, 'update_status']);
    Route::get('/quotation',[QuotationController::class, 'get_quotation']);
    Route::get('/quotation-by-customerID/{id}',[QuotationController::class, 'get_quotation_byIDCus']);
    Route::post('/quotation/sendmail/{idQuo}',[QuotationController::class, 'sendmail']);
    // Invoices
    Route::post('/invoices/insert',[InvoicesController::class, 'create_invoices']);
    Route::post('/invoices/e_invoices',[InvoicesController::class, 'testE_Invocies']);
    Route::get('/invoices',[InvoicesController::class, 'get_invoices']);
    Route::get('/invoices/details/{id}',[InvoicesController::class, 'get_invoices_byID']);
    // Invoices => eInvoies
    Route::get('/eInvoices/create/{id}',[InvoicesController::class, 'import_EInvoices']);
    // 
    // Exports
    Route::get('/staff-export', [ExcelExportController::class, 'export_staff']);
    // Dashboard
    Route::get('/dashboard/transaction/{id}', [TransactionController::class, 'get_data_transaction_statistical']);

});
    


