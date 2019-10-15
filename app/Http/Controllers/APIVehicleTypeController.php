<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\VehchicleType as VehchicleTypeResource;
use App\VehicleType;
use App\Repositories\TypeRepository;
class APIVehicleTypeController extends Controller
{
    public function __construct(VehicleType $type)
    {
       // set the model
       $this->model = new TypeRepository($type);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VehchicleTypeResource::collection(VehicleType::paginate(10));
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
        $rules = [
            'type_name' => 'required|min:1|max:255|unique:vehicle_types',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validator Failed'], 422);
        }else{
            $data = ([
                "type" => new VehicleType,
                "type_name" => $request->input("type_name"),
            ]);
            if($data->save()){
                return redirect()->route("vehicle.all.api");
            }else{
                return response()->json([
                    'message' => 'Validator Failed'], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type_id)
    {
        return new VehchicleTypeResource(VehicleType::find($type_id));
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
    public function destroy($type_id)
    {
        $type = VehicleType::where('type_id', $type_id)->first(); // File::find($id)
        if($type) {
           $del = $type->delete();
           return redirect()->route('vehicle..all.api');
        }else{
            echo "Error in Deleting";
        }
    }
}
