<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
//holf on

//test response below

Route::get('/test', function(){
    return response()->json([
        'success' => true,
        'message' => 'Welcome to DanfoPay API Resources.',
        'data' => [],
    ], 200);
});
Route::group(["prefix" => "v1/"], function(){

    Route::group(["prefix" => "auth"], function(){
        Route::post('/login', 'API\AuthAPIController@login');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    });
    Route::group(['middleware' => ['auth:api', 'role:customer']], function () {
        Route::group(["prefix" => "customers"], function(){
            Route::get("/{email}", "API\CustomerAPIController@show")->name("api.customer.show");
            Route::get("/edit/{email}", "API\CustomerAPIController@edit")->name("api.customer.edit");
            Route::get("delete/{email}", "API\CustomerAPIController@destroy")->name("api.customer.delete");
            Route::post("/update/{email}", "API\CustomerAPIController@update")->name("api.customer.update");
            Route::post("/save", "API\CustomerAPIController@store")->name("api.customer.save");

        });
        Route::group(["prefix" => "wallet"], function(){
            Route::post('/fund', 'PaymentController@redirectToGateway')->name('api.fund.pay');
        });
        Route::group(["prefix" => "balances"], function(){
            Route::get('/index', 'BalanceController@index')->name('balance.index');
            Route::get('/payment/callback', 'PaymentController@handleGatewayCallback')->name('api.fund.wallet');
            Route::post('/card/callback', 'PaymentController@card')->name('api.fund.card');
        });
        Route::group(["prefix" => "transactions"], function(){
            Route::get('/index', 'BalanceController@singleTransaction')->name('api.payment.index');

        });
        Route::group(["prefix" => "fund_transfer"], function(){
            Route::get('/create/', 'FundTransferController@create')->name('api.fund.transfer.create');
            Route::get('/initiate', 'FundTransferController@index')->name('api.fund.transfer.index');
            Route::post('/save', 'FundTransferController@store')->name('api.fund.transfer.save');

        });
    });
    Route::group(['middleware' => ['auth:api', 'role:owner']], function () {

        Route::group(["prefix" => "owners"], function(){
            Route::get("/{email}", "API\OwnerAPIController@show")->name("api.owner.show");
            Route::get("edit/{email}", "API\OwnerAPIController@edit")->name("api.owner.edit");
            Route::get("delete/{email}", "API\OwnerAPIController@destroy")->name("api.owner.delete");
            Route::post("/update/{email}", "API\OwnerAPIController@update")->name("api.owner.update");
            Route::post("/save", "API\OwnerAPIController@store")->name("api.owner.save");
            Route::get("/vehicle/{owner_number}", "VehicleController@create")->name("api.owner.vehicle");
            Route::get("/operator/{owner_number}", "VehicleOperatorController@create")->name("api.operator.create");
        });

    });
    Route::group(['middleware' => ['auth:api', 'role:operator']], function () {

        Route::post("/save", "API\OperatorAPIController@store")->name("api.operator.save");
        Route::get("/index", "API\OperatorAPIController@index")->name("api.operator.index");
        Route::get("/edit/{operator_id}", "API\OperatorAPIController@edit")->name("api.operator.edit");
        Route::post("/update/{operator_id}", "API\OperatorAPIController@update")->name("api.operator.update");
        Route::get("/delete/{operator_id}", "API\OperatorAPIController@destroy")->name("api.operator.delete");
        Route::get("/details/{operator_id}", "API\OperatorAPIController@details")->name("api.operator.details");

    });

    Route::group(['middleware' => ['auth:api']], function() {
        Route::group(["prefix" => "auth"], function(){
            Route::get('/logout', 'API\AuthAPIController@logout');
        });
    });
});

Route::fallback(function(){
    return response()->json([
        'message' => 'Requested Resource Not Found. Contact tadesina@jethroltd.com for more info'], 404);
});


// Route::group(["prefix" => "v1/"], function(){

//     Route::group(["prefix" => "customers"], function(){
//         Route::get("/", "API\CustomerAPIController@index")->name("api.customer.index");
//         Route::get("/{email}", "API\CustomerAPIController@show")->name("api.customer.show");
//         Route::get("/edit/{email}", "API\CustomerAPIController@edit")->name("api.customer.edit");
//         Route::get("delete/{email}", "API\CustomerAPIController@destroy")->name("api.customer.delete");
//         Route::post("/update/{email}", "API\CustomerAPIController@update")->name("api.customer.update");
//         Route::post("/save", "API\CustomerAPIController@store")->name("api.customer.save");

//     });
//     Route::group(["prefix" => "owners"], function(){
//         Route::get("/", "API\OwnerAPIController@index")->name("api.owner.index");
//         Route::get("/{email}", "API\OwnerAPIController@show")->name("api.owner.show");
//         Route::get("edit/{email}", "API\OwnerAPIController@edit")->name("api.owner.edit");
//         Route::get("delete/{email}", "API\OwnerAPIController@destroy")->name("api.owner.delete");
//         Route::post("/update/{email}", "API\OwnerAPIController@update")->name("api.owner.update");
//         Route::post("/save", "API\OwnerAPIController@store")->name("api.owner.save");
//     });

//     Route::group(["prefix" => "auth"], function(){
//         Route::post("/custromer_reg", "API\CustomerAPIController@store")->name("api.customer.reg");
//         Route::post("/owner_reg", "API\OwnerAPIController@store")->name("api.owner.reg");
//         Route::post('/login', 'API\AuthAPIController@login');
//         //Route::get('/logout', 'API\AuthAPIController@logout');
//         Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
//         Route::post('password/reset', 'Auth\ResetPasswordController@reset');
//     });

//     Route::group(['middleware' => ['auth:api']], function() {
//         Route::group(["prefix" => "auth"], function(){
//             Route::get('/logout', 'API\AuthAPIController@logout');
//         });
//     });

// });


