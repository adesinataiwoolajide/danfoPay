<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\OwnerRepository;
use DB;
use App\{VehicleOwner, Vehicle, VehicleOperator};
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class VehicleOwnerController extends Controller
{
    protected $model;
    public function __construct(VehicleOwner $owner)
    {
       // set the model
       $this->model = new OwnerRepository($owner);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('Administrator', auth()->user())) {
            $owner = VehicleOwner::orderBy('name', 'asc')->get();
            return view("administrator.owners.create")->with([
                'owner' => $owner,
            ]);
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To View The Owners List",
            ]);
        }
    }

    public function bin()
    {
        $owner= VehicleOwner::onlyTrashed()->get();
        return view('administrator.owners.recyclebin')->with([
            'owner' => $owner,
        ]);
    }

    public function details($owner_number)
    {
        if (Gate::allows('Administrator', auth()->user())) {

            $owner = VehicleOwner::where('owner_number', $owner_number)->first();
            $own = VehicleOwner::where('owner_number', $owner_number)->first();
            $owner_id = $owner->owner_id;
            $car = Vehicle::where('owner_id', $owner_id)->get();
            $operator = VehicleOperator::where('owner_id', $owner_id)->get();
            return view("administrator.owners.details")->with([
                'operator' => $operator,
                'owner' => $owner,
                'own' => $own,
                'car' => $car
            ]);
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Edit An Operator",
            ]);
        }
    }


    public function restore($owner_id)
    {
        if (Gate::allows('Administrator', auth()->user())) {
            VehicleOwner::withTrashed()
            ->where('owner_id', $owner_id)
            ->restore();
            $owner= $this->model->show($owner_id);
            $name = $owner->name;
            $email = auth()->user()->email;

            activity()
                ->performedOn($owner)
                ->causedBy(auth()->user()->id)
                ->withProperties([
                    'owner_name' => $name,
                ])
            ->log('restored');
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
        if(auth()->user()->hasPermissionTo('Add Owner') OR (Gate::allows('Administrator', auth()->user()))){
            $this->validate($request, [
                'name' =>'required|min:1|max:255',
                'phone_number' =>'required|min:1|max:255|unique:vehicle_owner',
                'address' =>'required|min:1',
                'password' =>'required|min:1',
                'repeat' =>'required|min:1',
            ]);

            if($request->input("password") != $request->input('repeat')){
                return redirect()->back()->with([
                    'error' => "Ooops!!! Password Does Not Match",
                ]);
            }

            if(VehicleOwner::where("phone_number", $request->input("phone_number"))->exists()){
                return redirect()->back()->with("error", "The Phone is In Use By Another Owner");
            }

            function generateRandomHash($length)
            {
                return strtoupper(substr(md5(uniqid(rand())), 0, (-32 + $length)));
            }

            $owner_number = strtoupper(generateRandomHash(6));
            $data = ([
                "owner" => new VehicleOwner,
                "name" => $request->input("name"),
                "phone_number" => $request->input("phone_number"),
                "address" => $request->input("address"),
                "owner_number" => $owner_number,
                "password" => Hash::make($request->input("password")),
            ]);

            if($this->model->create($data)){
                //$addRoles = $data->assignRole("Owner");
                return redirect()->route("owner.create")->with("success", "You Have Added "
                .$request->input("name"). " To The Owners List Successfully");
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Create A Owner",
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
    public function edit($owner_id)
    {
        if(auth()->user()->hasPermissionTo('Edit Owner') OR
            (Gate::allows('Administrator', auth()->user()))){
            $own= $this->model->show($owner_id);
            $owner= $this->model->all();
            return view('administrator.owners.edit')->with([
                'owner' => $owner,
                'own' => $own,
            ]);
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Edit An Owner",
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
    public function update(Request $request, $owner_id)
    {
        if(auth()->user()->hasPermissionTo('Update Owner') OR
            (Gate::allows('Administrator', auth()->user()))){
                $this->validate($request, [
                    'name' =>'required|min:1|max:255',
                    'address' =>'required|min:1',

                ]);

            $owner_number = $request->input("owner_number");
            $details = VehicleOwner::where("owner_id", $request->input("owner_id"))->first();
            $password = $details->password;

            $data = ([
                "owner" => new VehicleOwner,
                "name" => $request->input("name"),
                "phone_number" => $request->input("phone_number"),
                "address" => $request->input("address"),
                "owner_number" => $owner_id,
                "password" =>$password,
            ]);

            if($this->model->update($data, $owner_id)){
                if($request->input("details")){
                    return redirect()->back()->with("success", "You Have Updated The Owner Details Successfully");
                }else{
                    return redirect()->route("owner.create")->with("success", "Updated $details->name Details Successfully");
                }

            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Update A Owner",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($owner_id)
    {
        if(auth()->user()->hasPermissionTo('Delete Owner') OR
            (Gate::allows('Administrator', auth()->user()))){
            $owner =  $this->model->show($owner_id);
            $details= $owner->name;

            if (($owner->delete($owner_id))AND ($owner->trashed())) {
                return redirect()->back()->with([
                    'success' => "You Have Deleted $details From The Owner's List Successfully",
                ]);
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Delete An Owner",
            ]);
        }
    }
}
