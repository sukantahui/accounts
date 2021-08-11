<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\FeesModeTypeController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\StudentCourseRegistrationController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LedgerController;
use App\Models\Ledger;
use App\Models\LedgerType;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//get the user if you are authenticated
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("login",[UserController::class,'login']);



Route::post("register",[UserController::class,'register']);

Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's

    Route::get("revokeAll",[UserController::class,'revoke_all']);

    Route::get('/me', function(Request $request) {
        return auth()->user();
    });
    Route::get("user",[UserController::class,'getCurrentUser']);
    Route::get("logout",[UserController::class,'logout']);

    //get all users
    Route::get("users",[UserController::class,'getAllUsers']);


});





Route::group(array('prefix' => 'dev'), function() {
    Route::get('/incomeLedgers', [LedgerController::class,'get_income']);
    Route::get('/expenditureLedgers', [LedgerController::class,'get_expenditure']);
    Route::get('/assets',[AssetController::class,'index']);

    // transaction
    Route::post('/incomeTransactions',[TransactionController::class,'saveIncomeTransaction']);
    Route::get('/incomeTransactions',[TransactionController::class,'getIncomeTransactions']);

    Route::post('/expenditureTransactions',[TransactionController::class,'saveExpenditureTransaction']);
    Route::get('/expenditureTransactions', [TransactionController::class,'getExpenditureTransactions']);

    Route::get('/transactionYears', [TransactionController::class,'get_transaction_years']);

    Route::get('/incomeLedgersTotal/{year}',[TransactionController::class,'get_income_ledgers_group_total_by_year']);
    Route::get('/incomeLedgersTotal/{year}/{month}',[TransactionController::class,'get_income_ledgers_group_total_by_year_n_month']);

    Route::get('/expenditureLedgersTotal/{year}',[TransactionController::class,'get_expenditure_ledgers_group_total_by_year']);
    Route::get('/expenditureLedgersTotal/{year}/{month}',[TransactionController::class,'get_expenditure_ledgers_group_total_by_year_n_month']);


    Route::post('/ledgers', [LedgerController::class,'create']);
    Route::get('/cashBook', [LedgerController::class,'getCashBook']);
});

