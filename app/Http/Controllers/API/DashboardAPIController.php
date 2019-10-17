<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\{User, Balances, Customer, FundTransfer,Payments, Vehicle, VehicleOperator, VehicleOwner, VehicleType, BulkSms};
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Gate;
class DashboardAPIController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if(auth()->user()->hasRole('Customer')){
            $balance =Balances::where('user_id', Auth::user()->user_id)->get();
            $customer =Customer::where('email', Auth::user()->email)->first();
            $phone_number = $customer->phone_number;
            $fundTransfer = FundTransfer::where('sender', $phone_number)->orWhere('reciever', $phone_number)->get();
            $payment = Payments::where('user_id', Auth::user()->user_id)->get();
            $user = User::where('user_id', Auth::user()->user_id)->first();
            $single =Balances::where('user_id', Auth::user()->user_id)->first();
            return response()->json([
                'success' => true,
                'message' => $user->email. ' Welcome Customer Dashboard',
                'data' => [
                    "single" => $single,
                    "balance" => $balance,
                    "customer" => $customer,
                    "fundTransfer" => $fundTransfer,
                    "payment" => $payment,
                    "user" => $user,
                ],

            ], 200);

        }elseif(auth()->user()->hasRole('Owner')){
            $user = User::where('user_id', Auth::user()->user_id)->first();
            $owner = VehicleOwner::where('email', Auth::user()->email)->first();
            $own = VehicleOwner::where('email', Auth::user()->email)->get();
            $vehicle = Vehicle::where('owner_id', $owner->owner_id)->get();
            return response()->json([
                'success' => true,
                'message' => $user->email. ' Welcome Owner Dashboard',
                'data' => [
                    "user" => $user,
                    "owner" => $owner,
                    "vehicle" => $vehicle,
                    "own" => $own,
                ],

            ], 200);

        }elseif(auth()->user()->hasRole('Operator')){
            $user = User::where('user_id', Auth::user()->user_id)->first();
            $operator = VehicleOperator::where('email', Auth::user()->email)->first();

            return response()->json([
                'success' => true,
                'message' => $user->email. ' Welcome Operator Dashboard',
                'data' => [
                   "user" => $user,
                   "operator" => $operator,
                ],

            ], 200);

        }else{
            return response()->json([
                'error' => true,
                'message' => ' Please Login with your valid',
                'data' => [
                ],

            ], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
