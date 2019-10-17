<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{User, Customer, Balances, Payments, FundTransfer};
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\FundTransferRepository;
use Illuminate\Support\Facades\Gate;
class FundTransferAPIController extends ApiController
{
    protected $model;
    public function __construct(FundTransfer $transfer)
    {
       // set the model
       $this->model = new FundTransferRepository($transfer);
    }
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
            $transfer = FundTransfer::where('sender', $phone_number)->orWhere('reciever', $phone_number)->get();
            $single =Balances::where('user_id', Auth::user()->user_id)->first();
        
            return response()->json([
                'success' => true,
                'message' => Auth::user()->name. ' Customer Single Balance',
                'data' => [
                    "balance" => $balance,
                    "transfer" => $transfer,
                    "single" => $single,
                    "customer" => $customer,
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
        if(auth()->user()->hasRole('Customer')){
            $this->validate($request, [
                'recipient' => 'required|min:1|max:255|',
                'amount' => 'required|min:1|max:255'
            ]);

            $balance =Balances::where('user_id', Auth::user()->user_id)->first();
            $credit = $balance->total_amount;
            $debit = $request->input('amount');
            $recipient = $request->input('recipient');

            $sell = Customer::where('email', Auth::user()->email)->first();
            $phone= $sell->phone_number;

            function generateCustomeNumber($length)
            {
                return strtoupper(substr(md5(uniqid(rand())), 0, (-32 + $length)));
            }
            $number = strtoupper(generateCustomeNumber(10));

            if($debit > $credit){
                
                return response()->json([
                    'error' => true,
                    'message' => "Insufficient Fund",
                    'data' => [],
                ], 400);
            }elseif($phone == $recipient){
                
                return response()->json([
                    'error' => true,
                    'message' => "You Cannot Transfer Fund To yourself",
                    'data' => [],
                ], 400);
            }else{
                if(Customer::where('phone_number', $recipient)->exists()){
                    $creditor = Customer::where('phone_number', $recipient)->first();
                    $creditor_email = $creditor->email;
                    $cost = User::where('email', $creditor_email)->first();
                    $cost_id = $cost->user_id;
                    $debt_id = Auth::user()->user_id;

                    if(Balances::where('user_id', $cost_id)->exists()){
                        $update = Balances::where('user_id', Auth::user()->user_id)
                        ->update([
                            "total_amount" => $credit - $debit,
                            "user_id" => Auth::user()->user_id,
                        ]);
                        $foll = Balances::where('user_id', $cost_id)->first();
                        $myBal = $foll->total_amount;
                        $updat = Balances::where('user_id', $cost_id)
                        ->update([
                            "total_amount" => $myBal + $debit,
                            "user_id" => $cost_id,
                        ]);
                        $fund = new FundTransfer ([
                            "sender" => $phone,
                            'reciever' => $recipient,
                            'amount' => $debit,
                        ]);

                        if(($updat) AND ($fund->save())){
                            return response()->json([
                                'success' => true,
                                'message' => "You Have Credited $recipient with $debit Successfully",
                                'data' => [],
                            ], 200);
                            //return redirect()->route("fund.transfer.index")->with("success", "You Have Credited $recipient with $debit Successfully");
                        }else{
                            return response()->json([
                                'success' => true,
                                'message' => "YNetwork Failure, Please Try again later",
                                'data' => [],
                            ], 400);
                        }
                    }else{
                        $update = Balances::where('user_id', Auth::user()->user_id)
                        ->update([
                            "total_amount" => $credit - $debit,
                            "user_id" => Auth::user()->user_id,
                        ]);

                        $fund = new FundTransfer ([
                            "sender" => $phone,
                            'reciever' => $recipient,
                            'amount' => $debit,
                        ]);
                        $adding = new Balances ([
                            "user_id" => $cost_id,
                            'total_amount' => $debit,
                            'customer_code' => $number,
                        ]);
                        if($adding->save() AND ($fund->save())){
                            return redirect()->route("fund.transfer.index")->with("success", "You Have Credited $recipient Wallet  with $debit Successfully");
                        }else{
                            return redirect()->back()->with("error", "Network Failure, Please Try Again Later");
                        }
                    }
                }else {
                    
                    return response()->json([
                        'error' => true,
                        'message' => "$recipient Details Does Not Exist on This Platform",
                        'data' => [],
                    ], 400);
                }
            }
        }else{
            return response()->json([
                'error' => true,
                'message' => 'You dont have access to this page',
                'data' => [],
            ], 400);
        }
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
