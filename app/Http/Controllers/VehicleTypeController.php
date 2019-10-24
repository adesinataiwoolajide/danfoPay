<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TypeRepository;
use DB;
use App\{VehicleType};
use Illuminate\Support\Facades\Gate;
class VehicleTypeController extends Controller
{
    protected $model;
    public function __construct(VehicleType $type)
    {
       // set the model
       $this->model = new TypeRepository($type);
       $this->middleware(['role:Administrator']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('Administrator', auth()->user())) {
            $type = VehicleType::orderBy('type_name', 'asc')->get();
            return view("administrator.vehicle_types.create")->with([
                'type' => $type,
            ]);
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To View The Vehicle Type",
            ]);
        }
    }

    public function bin()
    {
        $type= VehicleType::onlyTrashed()->get();
        return view('administrator.vehicle_types.recyclebin')->with([
            'type' => $type,
        ]);
    }

    public function restore($type_id)
    {
        if (Gate::allows('Administrator', auth()->user())) {
            VehicleType::withTrashed()
            ->where('type_id', $type_id)
            ->restore();
            $typo= $this->model->show($type_id);
            $name = $typo->type_name;
            $email = auth()->user()->email;

            activity()
                ->performedOn($typo)
                ->causedBy(auth()->user()->id)
                ->withProperties([
                    'type_name' => $name,
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
        if(auth()->user()->hasPermissionTo('Add Vehicle Type') OR (Gate::allows('Administrator', auth()->user()))){
            $this->validate($request, [
                'type_name' =>'required|min:1|max:255|unique:vehicle_types',
            ]);

            $data = ([
                "type" => new VehicleType,
                "type_name" => $request->input("type_name"),
            ]);

            if($this->model->create($data)){
                return redirect()->route("vehicle.type.create")->with("success", "You Have Added "
                .$request->input("type_name"). " To The Vehicle Type Successfully");
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Create A Vehicle Type",
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($type_id)
    {
        if(auth()->user()->hasPermissionTo('Edit Vehicle Type') OR
            (Gate::allows('Administrator', auth()->user()))){
            $type= $this->model->show($type_id);
            $typo= $this->model->all();
            return view('administrator.vehicle_types.edit')->with([
                'type' => $type,
                'typo' => $typo,
            ]);
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Edit A Vehicle Type",
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
    public function update(Request $request, $type_id)
    {
        if(auth()->user()->hasPermissionTo('Update Vehicle Type') OR
            (Gate::allows('Administrator', auth()->user()))){
            $this->validate($request, [
                'type_name' =>'required|min:1|max:255|',
            ]);

            $data = ([
                "type" => $this->model->show($type_id),
                "type_name" => $request->input("type_name"),
            ]);

            if($this->model->update($data, $type_id)){
                return redirect()->route("vehicle.type.create")->with("success", "You Have Changed The Vehicle Type Name From ". " ".
                $request->input('prev_name') ." ". " To " .$request->input("type_name"). " ". "Successfully");
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Update A Vehicle Type",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($type_id)
    {
        if(auth()->user()->hasPermissionTo('Delete Vehicle Type') OR
            (Gate::allows('Administrator', auth()->user()))){
            $type =  $this->model->show($type_id);
            $details= $type->type_name;

            if (($type->delete($type_id))AND ($type->trashed())) {
                return redirect()->back()->with([
                    'success' => "You Have Deleted $details From The Vehicle Type Successfully",
                ]);
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Delete A Vehicle Type",
            ]);
        }
    }
}
