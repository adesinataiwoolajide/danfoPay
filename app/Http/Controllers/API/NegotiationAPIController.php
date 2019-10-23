<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{User, Customer, Vehicle, Negotiation, VehicleOperator, Balances, Manifest, Rounds, VehicleOwner};
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\NegotiationRepository;
use Illuminate\Support\Facades\Gate;
class NegotiationAPIController extends ApiController
{
    protected $model;
    public function __construct(Negotiation $negotiation)
    {
       // set the model
       $this->model = new NegotiationRepository($negotiation);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('Customer')){
            $email = Auth::user()->email;
            $customer =Customer::where('email', $email)->first();
            $negotiation =Negotiation::where('customer_id', $customer->customer_id)->orderBy('negotiation_id','desc')->get();

            return response()->json([
                'success' => true,
                'message' => $email.' List of Negotiationa',
                'data' => [
                    'negotiation' => $negotiation,
                    'customer' => $customer
                ],

            ], 200);
        }elseif(auth()->user()->hasRole('Operator')){

            $operator = VehicleOperator::where('email', Auth::user()->email)->first();
            $vehicle_id = $own->vehicle_id;
            $negotiation =Negotiation::where('vehicle_id', $vehicle_id)->orderBy('negotiation_id','desc')->get();

            return response()->json([
                'success' => true,
                'message' => $email.' List of Negotiations',
                'data' => [
                    'negotiation' => $negotiation,
                    'operator' => $operator,
                ],

            ], 200);
        }elseif(auth()->user()->hasRole('Owner')){

            $owner = VehicleOwner::where('email', Auth::user()->email)->first();
            $owner_id = $owner->owner_id;
            $owner_car = Vehicle::where('owner_id', $owner_id)->orderBy('vehicle_id', 'desc')->get();

            foreach($owner_car as $items){
                $negotiation =Negotiation::where('vehicle_id', $items->vehicle_id)->orderBy('negotiation_id','desc')->get();
            }

            return response()->json([
                'success' => true,
                'message' => Auth::user()->email.' List of Negotiations',
                'data' => [
                    'negotiation' => $negotiation,
                    'owner_car' => $owner_car,
                    'owner' => $owner,

                ],

            ], 200);

        } else{
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
                'vehicle_number' => 'required|min:1|max:255|',
                'from_destination' => 'required|min:1|max:255|',
                'to_destination' => 'required|min:1|max:255|',
                'amount' => 'required|min:1|max:255'
            ]);

            $check = Vehicle::where([
                "vehicle_number" => $request->input("vehicle_number")
            ])->get();
            if(count($check) > 0){

                $details = Vehicle::where('vehicle_number', $request->input("vehicle_number"))->first();
                $vehicle_id = $details->vehicle_id;

                $email = Auth::user()->email;
                $customer =Customer::where('email', $email)->first();

                $data = ([
                    "vehicle" => new Negotiation,
                    "vehicle_id" => $vehicle_id,
                    "from_destination" => $request->input("from_destination"),
                    "to_destination" => $request->input("to_destination"),
                    "amount" => $request->input("amount"),
                    "customer_id" => $customer->customer_id,

                    "status" => 0,

                ]);

                if($this->model->create($data)){

                    return response()->json([
                        'success' => true,
                        'message' => "You Have Added Your Negotiation For ".$request->input("vehicle_number").
                        " Successfully, Please Kindle Tell the Operator to confirm your negotiation",
                        'data' => [

                        ],

                    ], 200);
                }else{

                    return response()->json([
                        'error' => true,
                        'message' => 'Network Failure, Please Try Again Later',
                        'data' => [],
                    ], 400);
                }

            }else{

                return response()->json([
                    'error' => true,
                    'message' => $request->input("vehicle_number"). " Does Not Found for any Vehicle",
                    'data' => [],
                ], 400);
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
    public function edit($negotiation_id)
    {
        if(auth()->user()->hasRole('Customer')){

            $email = Auth::user()->email;
            $customer =Customer::where('email', $email)->first();
            $nego = $this->model->show($negotiation_id);
            $negotiation =Negotiation::where('customer_id', $customer->customer_id)->get();
            $car = Vehicle::where('vehicle_id', $nego->vehicle_id)->first();
            return response()->json([
                'error' => true,
                'message' => 'Edit Your Negotiation',
                'data' => [
                    'negotiation' => $negotiation,
                    'customer' => $customer,
                    'nego' => $nego,
                    'car' => $car,
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $negotiation_id)
    {
        if(auth()->user()->hasRole('Customer')){
            $this->validate($request, [
                'vehicle_number' => 'required|min:1|max:255|',
                'from_destination' => 'required|min:1|max:255|',
                'to_destination' => 'required|min:1|max:255|',
                'amount' => 'required|min:1|max:255'
            ]);

            $check = Vehicle::where([
                "vehicle_number" => $request->input("vehicle_number")
            ])->get();
            if(count($check) > 0){

                $details = Vehicle::where('vehicle_number', $request->input("vehicle_number"))->first();
                $vehicle_id = $details->vehicle_id;

                $email = Auth::user()->email;
                $customer =Customer::where('email', $email)->first();

                $data = ([
                    "vehicle" => $this->model->show($negotiation_id),
                    "vehicle_id" => $vehicle_id,
                    "from_destination" => $request->input("from_destination"),
                    "to_destination" => $request->input("to_destination"),
                    "amount" => $request->input("amount"),
                    "customer_id" => $customer->customer_id,
                    "status" => 0,

                ]);

                if($this->model->update($data, $negotiation_id)){

                    return response()->json([
                        'success' => true,
                        'message' => 'You Have Updated The Nogotiation Successfully',
                        'data' => [],
                    ], 400);
                }else{

                    return response()->json([
                        'error' => true,
                        'message' => 'Network Failure, Please Try Again Later',
                        'data' => [],
                    ], 400);
                }

            }else{
                return response()->json([
                    'error' => true,
                    'message' => $request->input("vehicle_number"). " Does Not Found for any Vehicle",
                    'data' => [],
                ], 400);
            }
        }else{
            return response()->json([
                'error' => true,
                'message' => 'You dont have access to this page',
                'data' => [],
            ], 400);
        }
    }

    public function accept($negotiation_id)
    {
        if(auth()->user()->hasRole('Operator')){

            $nego = $this->model->show($negotiation_id);

            $data = ([
                "vehicle" => $nego->negotiation_id,
                "vehicle_id" => $nego->vehicle_id,
                "from_destination" => $nego->from_destination,
                "to_destination" => $nego->to_destination,
                "amount" => $nego->amount,
                "customer_id" => $nego->customer_id,
                "status" => 1,

            ]);

            if($this->model->update($data, $negotiation_id)){

                return response()->json([
                    'success' => true,
                    'message' => 'You Have Accepted The Negotiation Successfully',
                    'data' => [],
                ], 400);
            }else{
                return response()->json([
                    'error' => true,
                    'message' => 'Network Failure',
                    'data' => [],
                ], 400);
            }

        }else{
            return response()->json([
                'error' => true,
                'message' => 'You dont have access to this page',
                'data' => [],
            ], 400);
        }
    }
    public function decline($negotiation_id)
    {
        if(auth()->user()->hasRole('Operator')){

            $nego = $this->model->show($negotiation_id);
            $data = ([
                "vehicle" => $this->model->show($negotiation_id),
                "vehicle_id" => $nego->vehicle_id,
                "from_destination" => $nego->from_destination,
                "to_destination" => $nego->to_destination,
                "amount" => $nego->amount,
                "customer_id" => $nego->customer_id,
                "status" => 3,

            ]);

            if($this->model->update($data, $negotiation_id)){

                return response()->json([
                    'success' => true,
                    'message' => 'You Have Declined The Negotiation Successfully',
                    'data' => [],
                ], 400);
            }else{
                return redirect()->back()->with("error", " Network Failure, Please Try Again Later");
            }

        }else{
            return response()->json([
                'error' => true,
                'message' => 'You dont have access to this page',
                'data' => [],
            ], 400);
        }
    }
    public function pay($negotiation_id)
    {
        if(auth()->user()->hasRole('Customer')){

            $nego = $this->model->show($negotiation_id);
            //dd($nego);
            $email = Auth::user()->email;
            $customer =Customer::where('email', $email)->first();
            $deed = Negotiation::where([
                'customer_id' => $customer->customer_id,
                'negotiation_id' => $negotiation_id,
            ])->first();

            if(Balances::where('user_id', Auth::user()->user_id)->exists()){
                $balance =Balances::where('user_id', Auth::user()->user_id)->first();
                $total = $balance->total_amount;
                $pay = $nego->amount;

                if($pay > $total){

                    return response()->json([
                        'error' => true,
                        'message' => 'Insufficient Fund, Please Fund Your Wallet',
                        'data' => [],
                    ], 400);

                }else{

                    $data = ([
                        "vehicle" => $this->model->show($negotiation_id),
                        "vehicle_id" => $nego->vehicle_id,
                        "from_destination" => $nego->from_destination,
                        "to_destination" => $nego->to_destination,
                        "amount" => $nego->amount,
                        "customer_id" => $nego->customer_id,
                        "status" => 3,
                    ]);

                    $updat = Balances::where('user_id', Auth::user()->user_id)
                    ->update([
                        "total_amount" => $total - $pay,
                        "user_id" => Auth::user()->user_id,
                    ]);

                    $lo = $total - $pay;

                    if(Rounds::where('vehicle_id', $nego->vehicle_id)->exists()){

                        $hope = Rounds::where('vehicle_id', $nego->vehicle_id)->first();

                        $round = Rounds::where('vehicle_id', $nego->vehicle_id)
                        ->update([
                            "current_balance" => $hope->current_balance + $pay,
                        ]);

                        $manifest = new Manifest([
                            "vehicle_id" => $nego->vehicle_id,
                            "amount" => $pay,
                            "customer_id" => $customer->customer_id,
                            "negotiation_id" => $negotiation_id,
                        ]);
                    }else{

                        $round = new Rounds([
                            "vehicle_id" => $nego->vehicle_id,
                            "current_balance" => $pay,
                        ]);

                        $round->save();

                        $manifest = new Manifest([
                            "vehicle_id" => $nego->vehicle_id,
                            "amount" => $pay,
                            "customer_id" => $customer->customer_id,
                        ]);

                    }


                    if($this->model->update($data, $negotiation_id) AND (!empty($updat)) AND($manifest->save()) ){

                        return response()->json([
                            'success' => true,
                            'message' => "You Have Paid $pay Successfully, Your Balance is $lo",
                            'data' => [],
                        ], 200);
                    }else{
                        return response()->json([
                            'error' => true,
                            'message' => 'Network Failure',
                            'data' => [],
                        ], 400);
                    }

                }

            }else{
                return response()->json([
                    'error' => true,
                    'message' => 'Please kindly fund your wallet',
                    'data' => [],
                ], 400);
            }



        }else{
            return response()->json([
                'error' => true,
                'message' => 'You dont have access to this page',
                'data' => [],
            ], 400);
        }
    }
    public function renogotiate($negotiation_id)
    {
        if(auth()->user()->hasRole('Operator')){

            $nego = $this->model->show($negotiation_id);
            $data = ([
                "vehicle" => $this->model->show($negotiation_id),
                "vehicle_id" => $nego->vehicle_id,
                "from_destination" => $nego->from_destination,
                "to_destination" => $nego->to_destination,
                "amount" => $nego->amount,
                "customer_id" => $nego->customer_id,
                "status" => 2,

            ]);

            if($this->model->update($data, $negotiation_id)){
                return response()->json([
                    'success' => true,
                    'message' => "You Have nitiated The Re Negotiation Successfully",
                    'data' => [],
                ], 200);

            }else{
                return response()->json([
                    'error' => true,
                    'message' => 'Network Failure',
                    'data' => [],
                ], 400);
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
