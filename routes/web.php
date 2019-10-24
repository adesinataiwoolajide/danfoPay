<?php

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
    return view('auth.login')->with('error', 'Please Login with Your Details');
});

Route::post("/user_login", "AdministratorController@userlogin")->name("admin.login");
Route::get("/signin", "AdministratorController@logout")->name("admin.logout");
//Route::get("/administrator", "AdministratorController@index")->name("admin.index");

Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetFor');


// Route::group(["prefix" => "api/v1/"], function(){

//     Route::group(["prefix" => "users"], function(){
//         Route::get("/", "APIUserController@index")->name("user.all.api");
//         Route::get("/{user_id}", "APIUserController@show")->name("user.single.api");
//         Route::get("/{role}", "APIUserController@userCategory")->name("user.category.api");
//     });

//     Route::group(["prefix" => "vehicle_types"], function(){
//         Route::get("/", "APIVehicleTypeController@index")->name("vehicle..all.api");
//         Route::post("/create", "APIVehicleTypeController@store")->name("vehicle..store.api");
//         Route::get("/{user_id}", "APIVehicleTypeController@show")->name("vehicle.type.single.api");
//         Route::get("delete/{user_id}", "APIVehicleTypeController@destroy")->name("vehicle.type.delete.api");

//     });
// });



Auth::routes(['verify' => true]);

Route::group(["prefix" => "administrator", "middleware" => "verified"], function(){

    Route::group(['middleware' => ['role:Administrator|Customer|Owner|Operator']], function () {

        Route::get("/dashboard", "AdministratorController@index")->name("administrator.dashboard");

        Route::group(["prefix" => "users"], function(){
            Route::get("/", "UserController@index")->name("user.create");
            Route::post("/save", "UserController@store")->name("user.save");
            Route::get("/edit/{user_id}", "UserController@edit")->name("user.edit");
            Route::get("/delete/{user_id}", "UserController@destroy")->name("user.delete");
            Route::post("/update/{user_id}", "UserController@update")->name("user.update");
            Route::get("/recyclebin", "UserController@bin")->name("user.restore");
            Route::get("/restore/{user_id}", "UserController@restore")->name("user.undelete");
            Route::get("/change_password", "UserController@resetpassword")->name("change.pasword");
            Route::post("/update_password/{user_id}", "UserController@updatepassword")->name("update.password");
            Route::get("/profile", "UserController@profile")->name("user.profile");
            Route::post("/update_profile/{user_id}", "UserController@updateprofile")->name("profile.update");
        });

        Route::group(["prefix" => "vehicle_types"], function(){
            Route::get("/", "VehicleTypeController@index")->name("vehicle.type.create");
            Route::post("/save", "VehicleTypeController@store")->name("vehicle.type.save");
            Route::get("/edit/{type_id}", "VehicleTypeController@edit")->name("vehicle.type.edit");
            Route::get("/delete/{type_id}", "VehicleTypeController@destroy")->name("vehicle.type.delete");
            Route::post("/update/{type_id}", "VehicleTypeController@update")->name("vehicle.type.update");
            Route::get("/recyclebin", "VehicleTypeController@bin")->name("vehicle.type.restore");
            Route::get("/restore/{type_id}", "VehicleTypeController@restore")->name("vehicle.type.undelete");
        });

        Route::group(["prefix" => "owners"], function(){
            Route::get("/", "VehicleOwnerController@index")->name("owner.create");
            Route::post("/save", "VehicleOwnerController@store")->name("owner.save");
            Route::get("/edit/{owner_id}", "VehicleOwnerController@edit")->name("owner.edit");
            Route::get("/delete/{owner_id}", "VehicleOwnerController@destroy")->name("owner.delete");
            Route::post("/update/{owner_id}", "VehicleOwnerController@update")->name("owner.update");
            Route::get("/recyclebin", "VehicleOwnerController@bin")->name("owner.restore");
            Route::get("/restore/{email}", "VehicleOwnerController@restore")->name("owner.undelete");
            Route::get("/details/{owner_number}", "VehicleOwnerController@details")->name("owner.details");

            Route::get("/vehicle/{owner_number}", "VehicleController@create")->name("owner.vehicle");
            Route::get("/operator/{owner_number}", "VehicleOperatorController@create")->name("operator.create");
        });
        Route::group(["prefix" => "vehicles"], function(){
            Route::get("/edit/{vehicle_id}", "VehicleController@edit")->name("vehicle.edit");
            Route::post("/save", "VehicleController@store")->name("vehicle.save");
            Route::get("/", "VehicleController@index")->name("vehicle.index");
            Route::get("/operator/{vehicle_id}", "VehicleOperatorController@create")->name("add.operator");
            Route::post("/update/{vehicle_id}", "VehicleController@update")->name("vehicle.update");
            Route::get("/delete/{vehicle_id}", "VehicleController@destroy")->name("vehicle.delete");

            Route::get("/recyclebin", "VehicleController@bin")->name("vehicle.restore");
            Route::get("/restore/{vehicle_id}", "VehicleController@restore")->name("vehicle.undelete");
        });

        Route::group(["prefix" => "operators"], function(){

            Route::post("/save", "VehicleOperatorController@store")->name("operator.save");
            Route::get("/", "VehicleOperatorController@index")->name("operator.index");
            Route::get("/edit/{operator_id}", "VehicleOperatorController@edit")->name("operator.edit");
            Route::post("/update/{operator_id}", "VehicleOperatorController@update")->name("operator.update");
            Route::get("/delete/{operator_id}", "VehicleOperatorController@destroy")->name("operator.delete");
            Route::get("/restore/{operator_id}", "VehicleOperatorController@restore")->name("operator.undelete");
            Route::get("/details/{operator_id}", "VehicleOperatorController@details")->name("operator.details");
            Route::get("/recyclebin", "VehicleOperatorController@bin")->name("operator.restore");

        });


        Route::group(["prefix" => "customers"], function(){

            Route::post("/save", "CustomerController@store")->name("customer.save");
            Route::get("/index", "CustomerController@index")->name("customer.index");
            Route::get("/edit/{email}", "CustomerController@edit")->name("customer.edit");
            Route::post("/update/{email}", "CustomerController@update")->name("customer.update");
            Route::get("/delete/{email}", "CustomerController@destroy")->name("customer.delete");
            Route::get("/restore/{email}", "CustomerController@restore")->name("customer.undelete");
            Route::get("/recyclebin", "CustomerController@bin")->name("customer.restore");

        });

        Route::group(["prefix" => "wallet"], function(){
            // Route::get('/index', 'PaymentController@index')->name('fund.index');
            Route::post('/fund', 'PaymentController@redirectToGateway')->name('fund.pay');
        });

        Route::group(["prefix" => "balances"], function(){
            Route::get('/', 'BalanceController@index')->name('balance.index');
            Route::get('/payment/callback', 'PaymentController@handleGatewayCallback')->name('fund.wallet');
            Route::post('/card/callback', 'PaymentController@card')->name('fund.card');
        });
        Route::group(["prefix" => "transactions"], function(){
            Route::get('/', 'BalanceController@singleTransaction')->name('payment.index');

        });
        Route::group(["prefix" => "fund_transfer"], function(){
            Route::get('/create/', 'FundTransferController@create')->name('fund.transfer.create');
            Route::get('/', 'FundTransferController@index')->name('fund.transfer.index');
            Route::post('/save', 'FundTransferController@store')->name('fund.transfer.save');

        });

        Route::group(["prefix" => "bulk_sms"], function(){

            Route::get('/create/', 'BulkSmsController@create')->name('bulk-sms');
            Route::get('/', 'BulkSmsController@index')->name('bulk-sms-index');
            Route::post('/send-bulksms/', 'BulkSmsController@save')->name('send-sms');
            Route::post('/bulksms/', 'BulkSmsController@save')->name('send-sms-restore');
        });
        Route::group(["prefix" => "negotiations"], function(){

            Route::get('/', 'NegotiationController@index')->name('negotiation.index');
            Route::post('/save', 'NegotiationController@store')->name('negotiation.save');
            Route::get("/edit/{negotiation_id}", "NegotiationController@edit")->name("negotiation.edit");
            Route::post("/update/{negotiation_id}", "NegotiationController@update")->name("negotiation.update");
            Route::get("/accept/{negotiation_id}", "NegotiationController@accept")->name("negotiation.accept");
            Route::get("/decline/{negotiation_id}", "NegotiationController@decline")->name("negotiation.decline");
            Route::get("/renegotiate/{negotiation_id}", "NegotiationController@renogotiate")->name("negotiation.renogotiate");

            Route::get("/pay/{negotiation_id}", "NegotiationController@pay")->name("negotiation.pay");

        });

        Route::group(["prefix" => "manifests"], function(){

            Route::get('/', 'ManifestController@index')->name('manifest.index');

        });
        Route::group(["prefix" => "rounds"], function(){
            Route::get('/', 'RoundController@index')->name('round.index');
        });

        Route::group(["prefix" => "log"], function(){
            Route::get('/', 'ActLogController@index')->name('log.index');
        });
    });
});
