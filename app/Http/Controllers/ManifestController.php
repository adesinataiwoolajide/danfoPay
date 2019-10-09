<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{User, Customer, Vehicle, Negotiation, VehicleOperator, Balances, Manifest, Rounds};
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\ManifestRepository;
use Illuminate\Support\Facades\Gate;

class ManifestController extends Controller
{
    protected $model;
    public function __construct(manifest $manifest)
    {
       // set the model
       $this->model = new manifestRepository($manifest);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('Administrator', auth()->user())){
            $manifest =$this->model->all();
            return view("administrator.manifests.index")->with([
                'manifest' => $manifest,
            ]);

        }elseif(auth()->user()->hasRole('Customer')){
            $email = Auth::user()->email;
            $customer =Customer::where('email', $email)->first();
            $manifest =Manifest::where('customer_id', $customer->customer_id)->get();

            return view("administrator.manifests.index")->with([
                'manifest' => $manifest,
                'customer' => $customer
            ]);
        }elseif(auth()->user()->hasRole('Operator')){

            $own = VehicleOperator::where('email', Auth::user()->email)->first();
            $vehicle_id = $own->vehicle_id;
            $manifest =Manifest::where('vehicle_id', $vehicle_id)->get();
            return view("administrator.manifests.index")->with([
                'manifest' => $manifest,
                'own' => $own,
            ]);
        }elseif(auth()->user()->hasRole('Owner')){


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
