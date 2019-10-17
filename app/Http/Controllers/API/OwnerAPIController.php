<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\OwnerRepository;
use DB;
use App\{VehicleOwner, Vehicle, VehicleOperator, User};
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OwnerAPIController extends ApiController
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

           /**
     * @OA\Get(
     *     path="/api/v1/owners",
     *     tags={"Vehicle Owners"},
     *     summary="Authority: None | Get all owners",
     *     @OA\Response(response="200", description="All owners returned"),
     *     @OA\Response(response="400", description="Bad Request")
     * )
     */
    public function index()
    {
        $owner = VehicleOwner::orderBy('name', 'asc')->get();
        $counter = $owner->count();
        $message = $counter.' item(s) returned';
        return $this->sendResponse($owner->toArray(), $message);
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
    /**
     * @OA\Post(
     *     path="/api/owners",
     *     tags={"Customers"},
     *     summary="Authority: Vehicle Owner | Create a new account",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                @OA\RequestBody(
     *                    required=true,
     *                    content="application/json",
     *                 ),
     *
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="phone_number",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="address",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 example={"name":"Customer title e.g Mr, Mrs etc.","name":"Customer name", "email":"Customer email", "phone":"Customer phone"}
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Owner created successfully"),
     *     @OA\Response(response="400", description="Bad Request")
     * )
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' =>'required|min:1|max:255',
            'phone_number' => 'required|min:1|max:255',
            'email' => 'required|min:1|max:255',
            'address' => 'required|min:1',
            'password' => 'required|min:1',
            'repeat' => 'required|min:1',
        ]);

        if($request->input("password") != $request->input('repeat')){
            return response()->json([
                'error' => true,
                'message' =>  'Password does not matched',
                'data' => [],
            ], 400);
        }

        if(VehicleOwner::where("email", $request->input("email"))->exists() OR(User::where("email", $request->input("email"))->exists())){
            return response()->json([
                'error' => true,
                'message' => $request->input("email").'is in use by another user',
                'data' => [],
            ], 400);
        }

        if(VehicleOwner::where("phone_number", $request->input("phone_number"))->exists()){
            return response()->json([
                'error' => true,
                'message' => $request->input("phone_number").'is in use by another customer',
                'data' => [],
            ], 400);
        }

        function generateRandomHash($length)
        {
            return strtoupper(substr(md5(uniqid(rand())), 0, (-32 + $length)));
        }

        $owner_number = strtoupper(generateRandomHash(6));
        $role = $request->input("role");
        $data = ([
            "owner" => new VehicleOwner,
            "name" => $request->input("name"),
            "email" => $request->input("email"),
            "phone_number" => $request->input("phone_number"),
            "address" => $request->input("address"),
            "owner_number" => $owner_number,

        ]);

        $use = new User([
            "email" => $request->input("email"),
            "name" => $request->input("name"),
            "password" => Hash::make($request->input("password")),
            "role" => $request->input("role"),
            "status" => 1,
        ]);


        if($this->model->create($data) AND ($use->save())){

            $addRoles = $use->assignRole($role);

            return response()->json([
                'success' => true,
                'message' => $request->input("email").' You Have registered your account successfully',
                'data' => [],

            ], 200);

        }else{
            return response()->json([
                'error' => true,
                'message' => 'Network Failure',
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
    public function show($email)
    {
        $user = User::where('user_id', Auth::user()->user_id)->first();
        $own = VehicleOwner::where('email', Auth::user()->email)->get();
        return response()->json([
            'success' => true,
            'message' => 'Owner Details',
            'data' => [
                'own' => $own
            ],
        ], 200);
    
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
