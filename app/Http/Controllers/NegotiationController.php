<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{User, Customer, Vehicle, Negotiation, VehicleOperator, Balances, Manifest, Rounds, VehicleOwner};
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\NegotiationRepository;
use Illuminate\Support\Facades\Gate;
class NegotiationController extends Controller
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
        if(Gate::allows('Administrator', auth()->user())){
            $negotiation =Negotiation::orderBy('negotiation_id','desc')->get();
            return view("administrator.negotiations.index")->with([
                'negotiation' => $negotiation,
            ]);

        }elseif(auth()->user()->hasRole('Customer')){
            $email = Auth::user()->email;
            $customer =Customer::where('email', $email)->first();
            $negotiation =Negotiation::where('customer_id', $customer->customer_id)->orderBy('negotiation_id','desc')->get();

            return view("administrator.negotiations.index")->with([
                'negotiation' => $negotiation,
                'customer' => $customer
            ]);
        }elseif(auth()->user()->hasRole('Operator')){

            $own = VehicleOperator::where('email', Auth::user()->email)->first();
            $vehicle_id = $own->vehicle_id;
            $negotiation =Negotiation::where('vehicle_id', $vehicle_id)->orderBy('negotiation_id','desc')->get();
            return view("administrator.negotiations.index")->with([
                'negotiation' => $negotiation,
                'own' => $own,
            ]);
        }elseif(auth()->user()->hasRole('Owner')){

            $own = VehicleOwner::where('email', Auth::user()->email)->first();
            $owner_id = $own->owner_id;
            $car = Vehicle::where('owner_id', $owner_id)->orderBy('vehicle_id', 'desc')->get();
            return view("administrator.negotiations.index")->with([
                'car' => $car,
                'own' => $own,
            ]);

        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To This Page",
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
        //return view("administrator.negotiations.create");
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
                    return redirect()->back()->with("success", "You Have Added Your Negotiation For "
                    .$request->input("vehicle_number"). " Successfully, Please Kindle Tell the Operator to confirm your negotiation");
                }else{
                    return redirect()->back()->with("error", " Network Failure, Please Try Again Later");
                }

            }else{
                return redirect()->back()->with("error", $request->input("vehicle_number"). " Does Not Found for any Vehicle");
            }
        }else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To This Page",
            ]);
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

            return view("administrator.negotiations.edit")->with([
                'negotiation' => $negotiation,
                'customer' => $customer,
                'nego' => $nego,
                'car' => $car,
            ]);
        }else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To This Page",
            ]);
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
                    return redirect()->route("negotiation.index")->with("success", "You Have Updated The Nogotiation Successfully");
                }else{
                    return redirect()->back()->with("error", " Network Failure, Please Try Again Later");
                }

            }else{
                return redirect()->back()->with("error", $request->input("vehicle_number"). " Does Not Found for any Vehicle");
            }
        }else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To This Page",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
                return redirect()->route("negotiation.index")->with("success", "You Have Accepted The Negotiation Successfully");
            }else{
                return redirect()->back()->with("error", " Network Failure, Please Try Again Later");
            }

        }else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To This Page",
            ]);
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
                return redirect()->route("negotiation.index")->with("success", "You Have Declined The Negotiation Successfully");
            }else{
                return redirect()->back()->with("error", " Network Failure, Please Try Again Later");
            }

        }else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To This Page",
            ]);
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
                    return redirect()->back()->with([
                        'error' => "Insufficient Fund, Please Fund Your Wallet",
                    ]);

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
                        return redirect()->route("negotiation.index")->with("success", "You Have Paid $pay Successfully, Your Balance is $lo");
                    }else{
                        return redirect()->back()->with("error", " Network Failure, Please Try Again Later");
                    }

                }

            }else{
                return redirect()->back()->with([
                    'error' => "Please Kindly Found Your Wallet",
                ]);
            }



        }else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To This Page",
            ]);
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
                return redirect()->route("negotiation.index")->with("success", "You Have Initiated The Re Negotiation Successfully");
            }else{
                return redirect()->back()->with("error", " Network Failure, Please Try Again Later");
            }

        }else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To This Page",
            ]);
        }
    }


    public function destroy($id)
    {
        //
    }
}
