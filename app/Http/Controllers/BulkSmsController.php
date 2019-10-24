<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Twilio\Rest\Client;
use App\{Customer, BulkSms};
use Validator;
Use DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\BulkSmsRepository;
use Illuminate\Support\Facades\Gate;
class BulkSmsController extends Controller
{
    protected $model;
    public function __construct(BulkSms $sms)
    {
       // set the model
       $this->model = new BulkSmsRepository($sms);
       $this->middleware(['role:Administrator|Customer|Owner|Operator']);
    }

    public function index()
    {
        if(Gate::allows('Administrator', auth()->user())){
            $sms = BulkSms::orderBy('sms_id', 'desc')->get();
            return view("administrator.bulk-sms.index")->with([
                'sms' => $sms
            ]);
        }elseif(auth()->user()->hasRole('Customer')){
            $email = Auth::user()->email;
            $customer =Customer::where('email', $email)->first();
            $phone_number = $customer->phone_number;
            $sms = BulkSms::where('phone_number', $phone_number)->orderBy('sms_id', 'desc')->get();
            return view("administrator.bulk-sms.index")->with([
                'sms' => $sms
            ]);
        }else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To This Page",
            ]);
        }
    }
    public function create()
    {
        $customer = Customer::orderBy('customer_id', 'desc')->get();
        return view("administrator.bulk-sms.create")->with([
            'customer' => $customer
        ]);
    }
    public function save( Request $request )
    {
       // Your Account SID and Auth Token from twilio.com/console
       $sid    = env( 'TWILIO_SID' );
       $token  = env( 'TWILIO_TOKEN' );
       $client = new Client( $sid, $token );

       $validator = Validator::make($request->all(), [
           'numbers' => 'required',
           'message' => 'required',
           'subject' => 'required',
           'recipient' => 'required'
       ]);

       if ( $validator->passes() ) {

           $numbers_in_arrays = explode( ',' , $request->input( 'numbers' ) );

           $message = $request->input( 'message' );
           $subject = $request->input( 'subject' );
           $count = 0;

           foreach( $numbers_in_arrays as $number )
           {
               $count++;

               $client->messages->create(
                   $number,
                   [
                       'from' => env( 'TWILIO_FROM' ),
                       'body' => $message,
                       'subject' => $subject,
                   ]
               );
           }

           return back()->with( 'success', $count . " messages sent!" );

       } else {
           return back()->withErrors( $validator );
       }
    }
}
