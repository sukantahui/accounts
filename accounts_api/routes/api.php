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




Route::group(array('prefix' => 'dev'), function() {
    
    Route::group(array('prefix' => 'students'), function() {

    });
    //ledgers
    Route::post("/ledgers", [LedgerController::class, 'create_ledger']);
    Route::get("/incomeLedger", [LedgerController::class, 'get_income']);
    Route::get("/expenditureLedger", [LedgerController::class, 'get_expenditure']);
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
        Route::get("/all",[TransactionController::class, 'get_all_transactions']);
        Route::get("/feesCharged",[TransactionController::class, 'get_all_fees_charged_transactions']);

        Route::get("/dues/studentId/{id}",[TransactionController::class, 'get_total_dues_by_student_id']);

        Route::get("/dues/SCRId/{id}",[TransactionController::class, 'get_student_due_by_student_course_registration_id']);


        //saving fees charged
        Route::post("/feesCharged",[TransactionController::class, 'save_fees_charge']);
        //saving fees received
        Route::post("/feesReceived",[TransactionController::class, 'save_fees_received']);

        Route::get("/billDetails/id/{id}",[TransactionController::class, 'get_bill_details_by_id']);
    });
});

