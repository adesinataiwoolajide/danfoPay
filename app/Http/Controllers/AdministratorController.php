<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\{User, Balances, Customer, FundTransfer,Payments, Vehicle, VehicleOperator, VehicleOwner, VehicleType};
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Gate;
class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function userlogin(Request $request)
    {

        $data = [
            "email" => $request->input("email"),
            "password" => $request->input("password"),
        ];
        $user = User::where('user_id', 1)->first();
        $user->assignRole('Administrator');
        if(Auth::attempt($data)){
            $usertype = Auth::user()->role;
            switch ($usertype){
                case (auth()->user()->hasRole('Administrator') OR
                    (auth()->user()->hasRole('Admin')));
                    if(auth()->user()->hasRole('Administrator')){
                        $message = "Administrator";
                    }else{
                        $message = "Admin";
                    }
                    auth()->user()->givePermissionTo([

                    ]);
                break;

                case (auth()->user()->hasRole('Customer'));
                    $message = "Customer";
                    auth()->user()->givePermissionTo([
                        'Add Customer', 'Edit Customer', 'Update Customer', 'Delete Customer',

                    ]);
                break;

                default:
                $message = "un Authorised User";
            }

            if(!empty($usertype)){

                return redirect()->route("administrator.dashboard")->with([
                    "success" => Auth::user()->name. " ". "Welcome To $message  Dashboard"
                ]);
            }else{

                return redirect()->back()->with([
                    "error" => "Ooops!!! Invalid User Name or Password",
                ]);
            }
        }else{

            return redirect()->back()->with([
                "error" => "Ooops!! Your Account Does Not Exist",
            ]);
        }
    }

    public function logout(Request $request)
    {

        Auth::logout();
        return view("auth.login");
    }
    public function index()
    {
        if(Gate::allows('Administrator', auth()->user())){
            $balance = Balances::orderBy('balance_id', 'asc')->get();
            $customer = Customer::all();
            $fundTransfer = FundTransfer::all();
            $payment = Payments::all();
            $user = User::all();
            $vehicle = Vehicle::all();
            $operator = VehicleOperator::all();
            $type = Vehicletype::orderBy('type_id', 'asc')->get();
            $owner = VehicleOwner::all();

            return view("administrator.dashboard")->with([
                "balance" => $balance,
                "customer" => $customer,
                "fundTransfer" => $fundTransfer,
                "payment" => $payment,
                "user" => $user,
                "vehicle" => $vehicle,
                "operator" => $operator,
                "type" => $type,
                "owner" => $owner,

            ]);
        }elseif(auth()->user()->hasRole('Customer')){
            $balance =Balances::where('user_id', Auth::user()->user_id)->get();
            $customer =Customer::where('email', Auth::user()->email)->first();
            $phone_number = $customer->phone_number;
            $fundTransfer = FundTransfer::where('sender', $phone_number)->orWhere('reciever', $phone_number)->get();
            $payment = Payments::where('user_id', Auth::user()->user_id)->get();
            $user = User::where('user_id', Auth::user()->user_id)->first();
            $single =Balances::where('user_id', Auth::user()->user_id)->first();
            return view("administrator.dashboard")->with([
                "single" => $single,
                "balance" => $balance,
                "customer" => $customer,
                "fundTransfer" => $fundTransfer,
                "payment" => $payment,
                "user" => $user,
            ]);
        }else{
            return redirect()->back()->with([
                "error" => "Ooops!! Please Login with a valid details",
            ]);
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
