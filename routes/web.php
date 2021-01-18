<?php

use App\Http\Resources\Agent\Agent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LotController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ApplicantsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ChangePasswordController;

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

Route::get('/', function () {
    if(auth()->user()) {
        return view('transaction');
    } else {
        return view('auth.login');
    }
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::view('/applicants', 'applicant')->name('applicant');
    Route::post('/applicant', [ApplicantsController::class, 'store']);
    Route::get('/getApplicants', [ApplicantsController::class, 'list']);
    Route::put('/applicant/{applicant}/apply-lot', [ApplicantsController::class, 'applyLot']);

    Route::view('/form', 'form')->name('form');

    Route::view('/lot', 'lot')->name('lot');
    Route::post('/lot', [LotController::class, 'store']);
    Route::get('/getLots', [LotController::class, 'list']);
    Route::delete('/{lot}/lot', [LotController::class, 'destroy']);
    Route::put('/lot/{lot}', [LotController::class, 'update']);
    Route::post('/lot-check', [LotController::class, 'checkLot']);

    Route::view('/agents', 'agent')->name('agent');
    Route::post('/agent', [AgentController::class, 'store']);
    Route::get('/getAgents', [AgentController::class, 'list']);
    Route::get('/getAgentsSelect', [AgentController::class, 'listSelect']);
    Route::delete('/{agent}/agent', [AgentController::class, 'destroy']);
    Route::put('/agent/{agent}', [AgentController::class, 'update']);

    Route::put('/payment/{lot}', [PaymentController::class, 'pay']);

    Route::view('/transactions', 'transaction')->name('transaction');
    Route::get('/getTransactions', [TransactionController::class, 'list']);
    Route::get('/transaction-print/{type}/{from}/{to}', [TransactionController::class, 'print']);
    Route::get('/transaction-print/{type}/{from}', [TransactionController::class, 'print']);
    Route::get('/transaction-print/{type}', [TransactionController::class, 'print']);
    Route::get('/getApplicantTransactions', [TransactionController::class, 'applicantList']);
    Route::get('/lot-transactions/{lot}', [TransactionController::class, 'lot']);

    Route::get('/get-income', [TransactionController::class, 'income']);

    Route::view('/users', 'user')->name('user');
    Route::post('/user', [UserController::class, 'store']);
    Route::get('/getUsers', [UserController::class, 'list']);
    Route::put('/user/{user}', [UserController::class, 'update']);
    Route::delete('/{user}/user', [UserController::class, 'destroy']);

    Route::view('/password', 'password')->name('password');
    Route::post('/change-password', [ChangePasswordController::class, 'changePassword'])->name('change-password');
});
