<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{User, Customer, Vehicle, Negotiation, VehicleOperator, Balances, Manifest, Rounds, VehicleOwner};
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\RoundRepository;
use Illuminate\Support\Facades\Gate;
class RoundController extends Controller
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
        if(Gate::allows('Administrator', auth()->user())){
            $round =$this->model->all();
            return view("administrator.rounds.index")->with([
                'round' => $round,
            ]);


        }elseif(auth()->user()->hasRole('Operator')){

            $own = VehicleOperator::where('email', Auth::user()->email)->first();
            $vehicle_id = $own->vehicle_id;
            $round =Rounds::where('vehicle_id', $vehicle_id)->get();
            return view("administrator.rounds.index")->with([
                'round' => $round,
                'own' => $own,
            ]);
        }elseif(auth()->user()->hasRole('Owner')){
            $own = VehicleOwner::where('email', Auth::user()->email)->first();
            $owner_id = $own->owner_id;
            $car = Vehicle::where('owner_id', $owner_id)->orderBy('vehicle_id', 'desc')->get();
            return view("administrator.rounds.index")->with([
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
