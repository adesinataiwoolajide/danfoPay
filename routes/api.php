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
        Route::post('/signin', 'API\AuthAPIController@login');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    });

    Route::group(['middleware' => ['auth:api']], function() {
        Route::group(["prefix" => "auth"], function(){
            Route::get('/signout', 'API\AuthAPIController@logout');
        });
    });

    Route::group(['middleware' => ['auth:api', 'role:Customer|Owner|Operator']], function () {
        Route::group(["prefix" => "dashboard"], function(){
            Route::get("/", "API\DashboardAPIController@index")->name("api.dashboard.index");
        });

        Route::group(["prefix" => "negotiation"], function(){
            Route::get('/', 'API\NegotiationAPIController@index')->name('api.negotiation.index');
            Route::post('/save', 'API\NegotiationAPIController@store')->name('api.negotiation.save');
            Route::get("/edit/{negotiation_id}", "API\NegotiationAPIController@edit")->name("api.negotiation.edit");
            Route::post("/update/{negotiation_id}", "API\NegotiationAPIController@update")->name("api.negotiation.update");
            Route::get("/accept/{negotiation_id}", "API\NegotiationAPIController@accept")->name("api.negotiation.accept");
            Route::get("/decline/{negotiation_id}", "API\NegotiationAPIController@decline")->name("api.negotiation.decline");
            Route::get("/renegotiate/{negotiation_id}", "API\NegotiationAPIController@renogotiate")->name("api.negotiation.renogotiate");
            Route::get("/pay/{negotiation_id}", "API\NegotiationAPIController@pay")->name("api.negotiation.pay");
        });

        Route::group(["prefix" => "manifest"], function(){
            Route::get('/', 'API\ManifestAPIController@index')->name('api.manifest.index');
        });
    });
    Route::group(['middleware' => ['auth:api', 'role:Customer']], function () {

        Route::group(["prefix" => "customer"], function(){
            Route::post("/save", "API\CustomerAPIController@store")->name("api.customer.save");
            Route::get("/{customer_id}", "API\CustomerAPIController@show")->name("api.customer.show");
            Route::get("/edit/{email}", "API\CustomerAPIController@edit")->name("api.customer.edit");
           // Route::get("delete/{email}", "API\CustomerAPIController@destroy")->name("api.customer.delete");
            Route::post("/update/{customer_id}", "API\CustomerAPIController@update")->name("api.customer.update");
        });

        Route::group(["prefix" => "wallet"], function(){
            Route::post('/fund', 'API\PaymentAPIController@redirectToGateway')->name('api.fund.pay');
        });

        Route::group(["prefix" => "balance"], function(){
            Route::get('/', 'API\BalanceAPIController@index')->name('api.balance.index');
            Route::get('/payment/callback', 'API\PaymentAPIController@handleGatewayCallback')->name('api.fund.wallet');
            Route::post('/card/callback', 'API\PaymentAPIController@card')->name('api.fund.card');
        });

        Route::group(["prefix" => "transaction"], function(){
            Route::get('/', 'API\BalanceAPIController@singleTransaction')->name('api.payment.index');
        });

        Route::group(["prefix" => "fund_transfer"], function(){
            Route::get('/', 'API\FundTransferAPIController@index')->name('api.fund.transfer.index');
            Route::post('/save', 'API\FundTransferAPIController@store')->name('api.fund.transfer.save');

        });
    });
    Route::group(['middleware' => ['auth:api', 'role:Owner']], function () {

        Route::group(["prefix" => "owner"], function(){
            Route::get("/{email}", "API\OwnerAPIController@show")->name("api.owner.show");
            Route::get("edit/{email}", "API\OwnerAPIController@edit")->name("api.owner.edit");
            Route::get("delete/{email}", "API\OwnerAPIController@destroy")->name("api.owner.delete");
            Route::post("/update/{email}", "API\OwnerAPIController@update")->name("api.owner.update");
            Route::post("/save", "API\OwnerAPIController@store")->name("api.owner.save");
            Route::get("/vehicle/{owner_number}", "API\VehicleAPIController@create")->name("api.owner.vehicle");
            Route::get("/operator/{owner_number}", "API\VehicleOperatorController@create")->name("api.operator.create");
        });

        Route::group(["prefix" => "vehicle"], function(){
            Route::get("/{vehicle_id}", "API\VehicleAPIController@edit")->name("api.vehicle.edit");
            Route::post("/save", "API\VehicleAPIController@store")->name("api.vehicle.save");
            Route::get("/", "API\VehicleAPIController@index")->name("api.vehicle.index");
            Route::get("/operator/{vehicle_id}", "API\OperatorAPIController@create")->name("api.add.operator");
            Route::post("/update/{vehicle_id}", "API\VehicleAPIController@update")->name("api.vehicle.update");
            Route::get("/delete/{vehicle_id}", "API\VehicleAPIController@destroy")->name("api.vehicle.delete");
        });

    });
    Route::group(['middleware' => ['auth:api', 'role:Operator']], function () {

        Route::post("/save", "API\OperatorAPIController@store")->name("api.operator.save");
        Route::get("/index", "API\OperatorAPIController@index")->name("api.operator.index");
        Route::get("/edit/{operator_id}", "API\OperatorAPIController@edit")->name("api.operator.edit");
        Route::post("/update/{operator_id}", "API\OperatorAPIController@update")->name("api.operator.update");
        Route::get("/delete/{operator_id}", "API\OperatorAPIController@destroy")->name("api.operator.delete");
        Route::get("/details/{operator_id}", "API\OperatorAPIController@details")->name("api.operator.details");

    });


});

Route::fallback(function(){
    return response()->json([
        'message' => 'Requested Resource Not Found. Please Contact tadesina@jethroltd.com for more info'], 404);
});
