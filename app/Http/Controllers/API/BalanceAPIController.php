<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{User, Customer, Balances, Payments};
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\BalanceRepository;
use Illuminate\Support\Facades\Gate;
use Unicodeveloper\Paystack\Paystack;
class BalanceAPIController extends ApiController
{
    protected $model;
    public function __construct(Balances $balance)
    {
       // set the model
       $this->model = new BalanceRepository($balance);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('Customer')){
            $user_id = Auth::user()->user_id;
            $balance =Balances::where('user_id', $user_id)->get();
            return response()->json([
                'success' => true,
                'message' => Auth::user()->name. ' Customer Balance',
                'data' => [
                    'balance' => $balance,
                    'user_id' => $user_id,
                ],
            ], 200);
        }else{
            return response()->json([
                'error' => true,
                'message' => 'You dont have access to this page',
                'data' => [],
            ], 400);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function singleTransaction()
    {
        if(auth()->user()->hasRole('Customer')){
            $user_id = Auth::user()->user_id;
            $list = Payments::where('user_id',  Auth::user()->user_id)->orderBy('payment_id', 'desc')->get();
            return response()->json([
                'success' => true,
                'message' => Auth::user()->name. ' Customer Single Balance',
                'data' => [
                    'list' => $list,
                    'user_id' => $user_id,
                ],
            ], 200);
        }else{
            return response()->json([
                'error' => true,
                'message' => 'You dont have access to this page',
                'data' => [],
            ], 400);
        }
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
