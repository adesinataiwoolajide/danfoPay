<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\OperatorRepository;
use DB;
use App\{VehicleOwner, Vehicle, VehicleType, VehicleOperator, User};
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class OperatorAPIController extends ApiController
{
    protected $model;
    public function __construct(VehicleOperator $operator)
    {
       // set the model
       $this->model = new OperatorRepository($operator);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('Owner')){
            $owner = VehicleOwner::where('email', Auth::user()->email)->first();
            $my_operator = VehicleOperator::where('owner_id', $owner->owner_id)->get();

            return response()->json([
                'error' => true,
                'message' => '',
                'data' => [
                    'my_operator' => $my_operator,
                    'owner' => $owner,
                ],
            ], 200);
        }elseif(auth()->user()->hasRole('Operator')){
            $own = VehicleOperator::where('email', Auth::user()->email)->first();
            $operator = VehicleOperator::where('email', Auth::user()->email)->get();
            return response()->json([
                'error' => true,
                'message' => '',
                'data' => [
                    'operator' => $operator,
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

    public function addVehicle($owner_number)
    {
        if (Gate::allows('Administrator', auth()->user())) {
            $owner = VehicleOwner::where('owner_number', 'owner_number')->first();
            $owner_id = $owner->owner_id;
            $operator = VehicleOperator::where('owner_id', $owner_id)->get();
            // return view("administrator.operators.create")->with([
            //     'operator' => $operator,
            //     'owner' => $owner,
            // ]);
            return response()->json([
                'error' => true,
                'message' => '',
                'data' => [
                    'operator' => $operator,
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

    public function details($operator_id)
    {
        if (Gate::allows('Administrator', auth()->user())) {
            $operator = VehicleOperator::orderBy('name', 'asc')->get();
            $details = VehicleOperator::where('operator_id', $operator_id)->first();
            $owner_id = $details->owner_id;
            $own = VehicleOwner::where('owner_id', $owner_id)->first();

            $vehicle = Vehicle::where('owner_id', $owner_id)->first();

            return response()->json([
                'error' => true,
                'message' => '',
                'data' => [
                    'operator' => $operator,
                    'details' => $details,
                    'own' => $own,
                    'vehicle' => $vehicle
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
    public function create($vehicle_id)
    {
        if(auth()->user()->hasPermissionTo('Add Operator') OR (auth()->user()->hasRole('Owner'))){
            $own = VehicleOwner::where('email', Auth::user()->email)->first();
            $details = Vehicle::where('vehicle_id', $vehicle_id)->first();
            $owner_id = $own->owner_id;
            $vehicle_id = $details->vehicle_id;
            $car = Vehicle::where('owner_id', $owner_id)->get();

            return response()->json([
                'success' => true,
                'message' => '',
                'data' => [
                    'details' => $details,
                    'car' => $car,
                    'own' => $own
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->hasRole('Owner') OR (Gate::allows('Administrator', auth()->user()))){
            $this->validate($request, [
                'name' =>'required|min:1|max:255',
                'phone_number' =>'required|min:1|max:255',
                'email' =>'required|min:1|max:255',
                'route' =>'required|min:1',
                'password' =>'required|min:1',
                'repeat' =>'required|min:1',
            ]);

            if($request->input("password") != $request->input('repeat')){
                return response()->json([
                    'error' => true,
                    'message' => 'Password Does Not Match',
                    'data' => [],
                ], 400);
            }

            if(VehicleOperator::where("email", $request->input("email"))->exists() OR(User::where("email", $request->input("email"))->exists())){
                return response()->json([
                    'error' => true,
                    'message' => 'E-Mail is in use by another operator',
                    'data' => [],
                ], 400);
            }

            if(VehicleOperator::where("phone_number", $request->input("phone_number"))->exists()){
                return response()->json([
                    'error' => true,
                    'message' => 'Phone Number is in use',
                    'data' => [],
                ], 400);
            }elseif(VehicleOperator::where("vehicle_id", $request->input("vehicle_id"))->exists()){

                return response()->json([
                    'error' => true,
                    'message' => "An Operator has already been allocated to a car with this plate number " .$request->input("plate_number"),
                    'data' => [],
                ], 400);

            }else{
                $data = ([
                    "operator" => new VehicleOperator,
                    "name" => $request->input("name"),
                    "phone_number" => $request->input("phone_number"),
                    "route" => $request->input("route"),
                    "owner_id" => $request->input("owner_id"),
                    "vehicle_id" => $request->input("vehicle_id"),
                    "email" => $request->input("email"),
                ]);
                $role = 'Operator';

                $use = new User([
                    "email" => $request->input("email"),
                    "name" => $request->input("name"),
                    "password" => Hash::make($request->input("password")),
                    "role" => $role,
                    "status" => 1,
                ]);

                if($this->model->create($data)AND ($use->save())){
                    $addRoles = $use->assignRole($role);

                    return response()->json([
                        'error' => true,
                        'message' => "You Have Added ".$request->input("name"). " To The Operators List Successfully",
                        'data' => [],
                    ], 400);
                } else{
                    return response()->json([
                        'error' => true,
                        'message' => 'Network Failure',
                        'data' => [],
                    ], 400);
                }
            }

        } else{
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
    public function show($vehicle_id)
    {
        if(auth()->user()->hasRole('Owner')){
            $own = VehicleOwner::where('email', Auth::user()->email)->first();
            $details = VehicleOperator::where('vehicle_id', $vehicle_id)->get();

            if(count($details) == 0){
                return response()->json([
                    'error' => true,
                    'message' => 'No Operator was found for $vehicle_id',
                    'data' => [],
                ], 400);
            }else{
                $owner_id = $own->owner_id;
                $vehicle_id = $details->vehicle_id;
                return response()->json([
                    'success' => true,
                    'message' => '',
                    'data' => [
                        'details' => $details,
                        'own' => $own
                    ],
                ], 200);
            }

        } else{
            return response()->json([
                'error' => true,
                'message' => 'You dont have access to this page',
                'data' => [],
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($operator_id)
    {
        if (Gate::allows('Administrator', auth()->user())) {
            $operator = VehicleOperator::orderBy('name', 'asc')->get();
            $details = VehicleOperator::where('operator_id', $operator_id)->first();
            $owner_id = $details->owner_id;
            $own = VehicleOwner::where('owner_id', $owner_id)->first();

            $vehicle = Vehicle::where('owner_id', $owner_id)->first();
            return response()->json([
                'error' => true,
                'message' => '',
                'data' => [
                    'operator' => $operator,
                    'details' => $details,
                    'own' => $own,
                    'vehicle' => $vehicle
                ],
            ], 200);
        }elseif(auth()->user()->hasRole('Owner')){
            $own = VehicleOwner::where('email', Auth::user()->email)->first();
            $operator = VehicleOperator::where('owner_id', $own->owner_id)->get();
            $details = VehicleOperator::where('operator_id', $operator_id)->first();
            $owner_id = $details->owner_id;
            $own = VehicleOwner::where('owner_id', $owner_id)->first();

            $vehicle = Vehicle::where('owner_id', $owner_id)->first();

            return response()->json([
                'error' => true,
                'message' => '',
                'data' => [
                    'operator' => $operator,
                    'details' => $details,
                    'own' => $own,
                    'vehicle' => $vehicle
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $operator_id)
    {
        if(auth()->user()->hasPermissionTo('Update Operator')
            OR (Gate::allows('Administrator', auth()->user()))){
            $this->validate($request, [
                'name' =>'required|min:1|max:255',
                'phone_number' =>'required|min:1|max:255',
                'route' =>'required|min:1',
                'email' => 'required'

            ]);
            $details = VehicleOperator::where('operator_id', $operator_id)->first();
            $email = $details->email;
            $user = User::where('email', $email)->first();

            $owner_id = $details->owner_id;
            //$user_id = $user->user_id;

            $data = ([
                "operator" => $this->model->show($operator_id),
                "name" => $request->input("name"),
                "phone_number" => $request->input("phone_number"),
                "route" => $request->input("route"),
                "owner_id" => $request->input("owner_id"),
                "vehicle_id" => $request->input("vehicle_id"),
                "email" => $request->input("email"),
                "password" => $details->password,
            ]);

            $role = 'Owner';

            $use = User::where('email',  $request->input("email"))
            ->update([
                "email" => $request->input("email"),
                "name" => $request->input("name"),
                "password" => Hash::make($request->input("email")),
                "role" => $role,
                "status" => 1,
            ]);

            if($this->model->update($data, $operator_id)){

                return response()->json([
                    'error' => true,
                    'message' => 'You Have Updated The Operator Details Successfully',
                    'data' => [],
                ], 200);

            }


        } else{
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
    public function destroy($operator_id)
    {
        if(auth()->user()->hasPermissionTo('Delete Operator') OR
            (Gate::allows('Administrator', auth()->user()))){
            $operator =  $this->model->show($operator_id);
            $details= $operator->name;

            if (($operator->delete($operator_id))AND ($operator->trashed())) {
                return redirect()->back()->with([
                    'success' => "You Have Deleted $details From The Vehicle Operator Successfully",
                ]);
                return response()->json([
                    'error' => true,
                    'message' => 'You Have Deleted $details From The Vehicle Operator Successfully',
                    'data' => [],
                ], 200);
            }
        } else{
            return response()->json([
                'error' => true,
                'message' => 'You dont have access to this page',
                'data' => [],
            ], 400);
        }
    }
}
