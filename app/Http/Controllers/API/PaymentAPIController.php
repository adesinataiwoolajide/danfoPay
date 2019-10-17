<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{User, Payments, Balances, CheetahPay};
use DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\PaymentRepository;
use Illuminate\Support\Facades\Gate;
class PaymentAPIController extends ApiController
{
    protected $model;
    public $paystack;
    public function __construct(Payments $pay, Paystack $payment)
    {
       // set the model
       $this->paystack = new Paystack();
       $this->model = new PaymentRepository($pay);
       //$this->cheetahPay = new CheetahPay(XQKWNGWKFKhKfUAtgZIU, 5710139023);
    }

    public function redirectToGateway()
    {
        return $this->paystack->getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = $this->paystack->getPaymentData();
        //dd($paymentDetails);
        if(Payments::where('reference', data_get($paymentDetails, 'data.reference'))->exists()){
            return redirect()->route("balance.index")->with("success", "Successfully");
        }else{
            $insert = ([
                "pay" => new Payments,
                "user_id" => Auth::user()->user_id,
                'amount' => data_get($paymentDetails, 'data.amount'),
                'reference' => data_get($paymentDetails, 'data.reference'),
                'status' => data_get($paymentDetails, 'data.status'),
                'currency' => data_get($paymentDetails, 'data.currency'),
            ]);

            $newAmount = data_get($paymentDetails, 'data.amount')/100;
            if(Balances::where('user_id', Auth::user()->user_id)->exists()){
                $former = Balances::where('user_id', Auth::user()->user_id)->first();
                $amount = $former->total_amount;
                $update = Balances::where('user_id', Auth::user()->user_id)
                ->update([
                    "total_amount" => $amount + $newAmount,
                    "user_id" => Auth::user()->user_id,
                    'customer_code' => data_get($paymentDetails, 'data.customer.customer_code'),
                ]);
                if($this->model->create($insert)){
                    //return redirect()->route("balance.index")->with("success", "You Have Updated Your Balance with $newAmount Successfully");
                    return response()->json([
                        'success' => true,
                        'message' => "You Have Updated Your Balance with $newAmount Successfully",
                        'data' => [],
                    ], 200);

                }else{

                    //return redirect()->route("balance.index")->with("eoor", "Network Failure");
                    return response()->json([
                        'error' => true,
                        'message' => 'Network Failure',
                        'data' => [],
                    ], 400);
                }
            }else{
                $adding = new Balances ([
                    "user_id" => Auth::user()->user_id,
                    'total_amount' => $newAmount,
                    'customer_code' => data_get($paymentDetails, 'data.customer.customer_code'),
                ]);
                if($this->model->create($insert) AND ($adding->save())){

                    //return redirect()->route("balance.index")->with("success", "You Have Credited Your Wallet with $newAmount Successfully");
                    return response()->json([
                        'success' => true,
                        'message' => "You Have Credited Your Wallet with $newAmount Successfully",
                        'data' => [],
                    ], 200);
                 }else{
                    return response()->json([
                        'error' => true,
                        'message' => 'Network Failure, Please Try Again Later',
                        'data' => [],
                    ], 400);
                    //return redirect()->route("balance.index")->with("eoor", "Network Failure, Please Try Again Later");
                 }
            }
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * This fluent method does all the dirty work of verifying that the just concluded transaction was actually valid,
         * It verifies the transaction reference with Paystack Api and then grabs the data returned from Paystack.
         * In that data, we have a lot of good stuff, especially the `authorization_code` that you can save in your db
         * to allow for easy recurrent subscription.
         */
        $payment = $this->paystack->getPaymentData();

    }

    public function customers(){
        /**
         * This method gets all the customers that have performed transactions on your platform with Paystack
         * @returns array
         */
       $paid =  $this->paystack->getAllCustomers();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function card(Request $request)
    {
        $this->validate($request, [
            'pin' => 'required|min:1|max:255|',
            'card_amount' => 'required|min:1|max:255',
            'network' => 'required|min:1|max:255',

        ]);
        $cheetahPay = new CheetahPay(XQKWNGWKFKhKfUAtgZIU, 5710139023);
        $pin = $request->input('pin');
        $amount = $request->input('card_amount');
        $depositorsPhoneNo = '08138139333';
        $network = $request->input('network');;
        $orderId = 123;


        $response = $cheetahPay->pinDeposit($pin, $amount, $network, $orderID, $depositorsPhoneNo);
         dd($response);
        if($response['success'] == true){
            echo  "Airtime has been received, now awaiting validation";
        }else{
        // Deposit failed, See print out message
            print($response['message']);
        }

    }


    public function create()
    {
        return view('administrator.wallet.index');
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
