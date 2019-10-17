<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{User, Customer, Vehicle, Negotiation, VehicleOperator, Balances, Manifest, Rounds, VehicleOwner};
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\ManifestRepository;
use Illuminate\Support\Facades\Gate;

class ManifestAPIController extends ApiController
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
        if(auth()->user()->hasRole('Customer')){
            $email = Auth::user()->email;
            $customer =Customer::where('email', $email)->first();
            $manifest =Manifest::where('customer_id', $customer->customer_id)->orderBy('manifest_id','desc')->get();;

            // return view("administrator.manifests.index")->with([
            //     'manifest' => $manifest,
            //     'customer' => $customer
            // ]);

            return response()->json([
                'success' => true,
                'message' => $email.' List of Manifests',
                'data' => [
                    'manifest' => $manifest,
                    'customer' => $customer
                ],

            ], 200);
        }elseif(auth()->user()->hasRole('Operator')){

            $own = VehicleOperator::where('email', Auth::user()->email)->first();
            $vehicle_id = $own->vehicle_id;
            $manifest =Manifest::where('vehicle_id', $vehicle_id)->orderBy('manifest_id','desc')->get();;

            return response()->json([
                'success' => true,
                'message' => Auth::user()->email.' List of Manifests',
                'data' => [
                    'manifest' => $manifest,
                    'own' => $own
                ],

            ], 200);
        }elseif(auth()->user()->hasRole('Owner')){

            $own = VehicleOwner::where('email', Auth::user()->email)->first();
            $owner_id = $own->owner_id;
            $car = Vehicle::where('owner_id', $owner_id)->orderBy('vehicle_id', 'desc')->get();

            return response()->json([
                'success' => true,
                'message' => Auth::user()->email.' List of Manifests',
                'data' => [
                    'car' => $car,
                    'own' => $own,
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
