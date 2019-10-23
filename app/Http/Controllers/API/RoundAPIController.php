<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{User, Customer, Vehicle, Negotiation, VehicleOperator, Balances, Manifest, Rounds, VehicleOwner};
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\RoundRepository;
use Illuminate\Support\Facades\Gate;

class RoundAPIController extends ApiController
{
    protected $model;
    public function __construct(ROunds $round)
    {
       // set the model
       $this->model = new RoundRepository($round);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('Operator')){

            $own = VehicleOperator::where('email', Auth::user()->email)->first();
            $vehicle_id = $own->vehicle_id;
            $round =Rounds::where('vehicle_id', $vehicle_id)->get();

            return response()->json([
                'success' => true,
                'message' => "List of Rounds",
                'data' => [
                    'round' => $round,
                    'own' => $own,
                ],
            ], 200);
        }elseif(auth()->user()->hasRole('Owner')){
            $owner = VehicleOwner::where('email', Auth::user()->email)->first();
            $owner_id = $owner->owner_id;
            $owner_car = Vehicle::where('owner_id', $owner_id)->orderBy('vehicle_id', 'desc')->get();
            foreach($owner_car as $rounds){
                $rounds->plate_number;
                $rounds->vehicle_number;
                $rounds->current_balance;
            }

            return response()->json([
                'success' => true,
                'message' => "List of Round",
                'data' => [
                    'rounds' => $rounds,
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
