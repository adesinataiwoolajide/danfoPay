<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\OperatorRepository;
use DB;
use App\{VehicleOwner, Vehicle, VehicleType, VehicleOperator, User};
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class VehicleOperatorController extends Controller
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
        if(Gate::allows('Administrator', auth()->user())){
            $operator = VehicleOperator::orderBy('name', 'asc')->get();
            return view("administrator.operators.index")->with([
                'operator' => $operator,
            ]);
        }elseif(auth()->user()->hasRole('Owner')){
            $own = VehicleOwner::where('email', Auth::user()->email)->first();
            $operator = VehicleOperator::where('owner_id', $own->owner_id)->get();
            return view("administrator.operators.index")->with([
                'operator' => $operator,
            ]);
        }elseif(auth()->user()->hasRole('Operator')){
            $own = VehicleOperator::where('email', Auth::user()->email)->first();
            $operator = VehicleOperator::where('email', Auth::user()->email)->get();
            return view("administrator.operators.index")->with([
                'operator' => $operator,
            ]);
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To View The Operators List",
            ]);
        }
    }
    public function addVehicle($owner_number)
    {
        if (Gate::allows('Administrator', auth()->user())) {
            $owner = VehicleOwner::where('owner_number', 'owner_number')->first();
            $owner_id = $owner->owner_id;
            $operator = VehicleOperator::where('owner_id', $owner_id)->get();
            return view("administrator.operators.create")->with([
                'operator' => $operator,
                'owner' => $owner,
            ]);
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To View The Operators List",
            ]);
        }
    }

    public function bin()
    {
        $operator= VehicleOperator::onlyTrashed()->get();
        return view('administrator.operators.recyclebin')->with([
            'operator' => $operator,
        ]);
    }
    public function details($operator_id)
    {
        if (Gate::allows('Administrator', auth()->user())) {
            $operator = VehicleOperator::orderBy('name', 'asc')->get();
            $details = VehicleOperator::where('operator_id', $operator_id)->first();
            $owner_id = $details->owner_id;
            $own = VehicleOwner::where('owner_id', $owner_id)->first();

            $vehicle = Vehicle::where('owner_id', $owner_id)->first();
            return view("administrator.operators.details")->with([
                'operator' => $operator,
                'details' => $details,
                'own' => $own,
                'vehicle' => $vehicle
            ]);
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Edit An Operator",
            ]);
        }
    }

    public function restore($operator_id)
    {
        if (Gate::allows('Administrator', auth()->user())) {
            VehicleOperator::withTrashed()
            ->where('operator_id', $operator_id)
            ->restore();
            $operator= $this->model->show($operator_id);
            $name = $operator->name;

            return redirect()->back()->with([
                'success' => " You Have Restored". " ".$name. " " ." Successfully",

            ]);

        }else{
            return redirect()->back()->with("error", "You Dont Have Access To The Recycle Bin");
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($plate_number)
    {
        if(auth()->user()->hasPermissionTo('Add Operator') OR (Gate::allows('Administrator', auth()->user()))){
            $details = Vehicle::where('plate_number', $plate_number)->first();
            $owner_id = $details->owner_id;
            $vehicle_id = $details->vehicle_id;
            $car = Vehicle::where('owner_id', $owner_id)->get();


            return view('administrator.operators.create')->with([
                'details' => $details,
                'car' => $car
            ]);
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Add An Operator",
            ]);
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
                return redirect()->back()->with([
                    'error' => "Ooops!!! Password Does Not Match",
                ]);
            }

            if(VehicleOperator::where("email", $request->input("email"))->exists() OR(User::where("email", $request->input("email"))->exists())){
                return redirect()->back()->with("error", "The E-Mail is In Use By Another Operator");
            }

            if(VehicleOperator::where("phone_number", $request->input("phone_number"))->exists()){
                return redirect()->back()->with("error", "The Phone is In  Use By Another Operator");
            }elseif(VehicleOperator::where("vehicle_id", $request->input("vehicle_id"))->exists()){
                return redirect()->back()->with("error", "An Operator has already been allocated to a car
                with this plate number " .$request->input("plate_number"));

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
                    return redirect()->route("operator.index")->with("success", "You Have Added "
                    .$request->input("name"). " To The Operators List Successfully");
                } else{
                    return redirect()->back()->with([
                        'error' => "Network Failure, Please try again later",
                    ]);
                }
            }

        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Create An Operator",
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
    public function edit($operator_id)
    {
        if (Gate::allows('Administrator', auth()->user())) {
            $operator = VehicleOperator::orderBy('name', 'asc')->get();
            $details = VehicleOperator::where('operator_id', $operator_id)->first();
            $owner_id = $details->owner_id;
            $own = VehicleOwner::where('owner_id', $owner_id)->first();

            $vehicle = Vehicle::where('owner_id', $owner_id)->first();
            return view("administrator.operators.edit")->with([
                'operator' => $operator,
                'details' => $details,
                'own' => $own,
                'vehicle' => $vehicle
            ]);
        }elseif(auth()->user()->hasRole('Owner')){
            $own = VehicleOwner::where('email', Auth::user()->email)->first();
            $operator = VehicleOperator::where('owner_id', $own->owner_id)->get();
            $details = VehicleOperator::where('operator_id', $operator_id)->first();
            $owner_id = $details->owner_id;
            $own = VehicleOwner::where('owner_id', $owner_id)->first();

            $vehicle = Vehicle::where('owner_id', $owner_id)->first();
            return view("administrator.operators.edit")->with([
                'operator' => $operator,
                'details' => $details,
                'own' => $own,
                'vehicle' => $vehicle
            ]);
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Edit An Operator",
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
            $user_id = $user->user_id;

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

            $use = User::where('user_id', $user_id)
            ->update([
                "email" => $request->input("email"),
                "name" => $request->input("name"),
                "password" => $user->password,
                "role" => $role,
                "status" => 1,
            ]);

            if($this->model->update($data, $operator_id)){
                if($request->input("details")){
                    return redirect()->back()->with("success", "You Have Updated The Operator Details Successfully");
                }else{
                    return redirect()->route("operator.index")->with("success", "You Have Updated The Operator Details Successfully");
                }

            }


        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Update An operator",
            ]);
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
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Delete A Vehicle Operator",
            ]);
        }
    }
}
