<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MiscController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Yajra\Datatables\Datatables;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/incomes/statistic', [MiscController::class, 'incomesStatistic'])->name('incomes.statistic');
    Route::get('/expenses/statistic', [MiscController::class, 'expensesStatistic'])->name('expenses.statistic');

    Route::resource('employes', EmployeController::class)->except(['show']);
    Route::resource('items', ItemController::class)->except(['show']);
    Route::resource('incomes', IncomeController::class);
    Route::resource('expenses', ExpenseController::class);

    Route::get('/', [MiscController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [MiscController::class, 'profile'])->name('profile');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'handleLogin'])->name('login');
});
