<?php

use App\Http\Controllers\FeesModeTypeController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\StudentCourseRegistrationController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DurationTypeController;
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



Route::post("/ledgers", [LedgerController::class, 'create_ledger']);
Route::get("/incomeLedgers", [LedgerController::class, 'get_income']);
Route::get("/expenditureLedgers", [LedgerController::class, 'get_expenditure']);

Route::group(array('prefix' => 'dev'), function() {

    Route::group(array('prefix' => 'students'), function() {

    });
    //ledgers
    Route::post("/ledgers", [LedgerController::class, 'create_ledger']);
    Route::get("/incomeLedger", [LedgerController::class, 'get_income']);
    Route::get("/expenditureLedgers", [LedgerController::class, 'get_expenditure']);







    //course

    Route::get("states",[StateController::class, 'index']);
    Route::get("states/{id}",[StateController::class, 'index_by_id']);

    //Fees Modes
    Route::get("feesModeTypes",[FeesModeTypeController::class, 'index']);
    Route::get("feesModeTypes/{id}",[FeesModeTypeController::class, 'index_by_id']);




    Route::get("subjects",[SubjectController::class, 'index']);





    Route::get("logout",[UserController::class,'logout']);

    Route::get("users",[UserController::class,'index']);



    //transactions
    Route::group(array('prefix' => 'transactions'), function() {
        Route::post('/incomeTransactions', [TransactionController::class, 'saveIncomeTransaction']);
        Route::get('/incomeTransactions', [TransactionController::class, 'getIncomeTransactions']);
        Route::post('/expenditureTransactions', [TransactionController::class, 'saveExpenditureTransaction']);
        Route::get('/getExpenditureTransactions', [TransactionController::class, 'getExpenditureTransactions']);
        Route::get('/getTransactionYears', [TransactionController::class, 'get_transaction_years']);
        Route::get('/getIncomeLedgersGroupTotal/{year}', [TransactionController::class, 'get_income_ledgers_group_total_by_year']);
        Route::get('/incomeLedgersTotal/{year}/{month}', [TransactionController::class, 'get_income_ledgers_group_total_by_year_n_month']);
        Route::get('/expenditureLedgersTotal/{year}', [TransactionController::class, 'get_expenditure_ledgers_group_total_by_year']);
        Route::get('/expenditureLedgersTotal/{year}/{month}', [TransactionController::class, 'get_expenditure_ledgers_group_total_by_year_n_month']);
        Route::get('/cashBook', [TransactionController::class, 'getCashBook']);
    });
});

