<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\{User, Customer};
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Repositories\CustomerRepository;

class CustomerAPIController extends ApiController
{
    protected $model;
    public function __construct(Customer $customers){

       // set the model
       $this->model = new CustomerRepository($customers);
       $this->middleware(['role:Administrator|Customer']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *     path="/api/v1/customers",
     *     tags={"Customers"},
     *     summary="Authority: None | Get all customers",
     *     @OA\Response(response="200", description="All customers returned"),
     *     @OA\Response(response="400", description="Bad Request")
     * )
     */
    public function index()
    {
        $customers = $this->model->all();
        $counter = $customers->count();
        $message = $counter.' item(s) returned';
        return $this->sendResponse($customers->toArray(), $message);
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
     *     path="/api/customers",
     *     tags={"Customers"},
     *     summary="Authority: Customer | Create a new account",
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
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 example={"name":"Customer name", "email":"Customer email", "phone_number":"Customer phone", "password":"Customer Password"}
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Customer created successfully"),
     *     @OA\Response(response="400", description="Bad Request")
     * )
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:1|max:255|',
            'email' => 'required||min:1|max:255|unique:customers',
            'password' => 'required|min:1|max:255|',
            'phone_number' => 'required|min:1|max:255'
        ]);
        if(Customer::where("email", $request->input("email"))->exists() OR(User::where("email", $request->input("email"))->exists())){
            return response()->json([
                'error' => true,
                'message' => $request->input("email").' is in use by another customer',
                'data' => [],
            ], 400);
        }
        if(Customer::where("phone_number", $request->input("phone_number"))->exists()){
            return response()->json([
                'error' => true,
                'message' => $request->input("phone_number").' ssis in use by another customer',
                'data' => [],
            ], 400);
        }
        if($request->input("password") != $request->input("confirm_password")){
            return response()->json([
                'error' => true,
                'message' =>  'Password does not matched',
                'data' => [],
            ], 400);
        }
        function generateCustomerNumber($length)
        {
            return strtoupper(substr(md5(uniqid(rand())), 0, (-32 + $length)));
        }
        $customer_number = strtoupper(generateCustomerNumber(10));
        $role = 'Customer';

        $data = ([
            "email" => $request->input("email"),
            "name" => $request->input("name"),
            "phone_number" =>($request->input("phone_number")),
            "customer_number" => $customer_number,
        ]);

        $use = new User([
            "email" => $request->input("email"),
            "name" => $request->input("name"),
            "password" => Hash::make($request->input("password")),
            "role" => $role,
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
        // are u alive ?
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
       /**
     * @OA\Get(
     *     path="/api/customers/{email}",
     *     tags={"Categories"},
     *     summary="Authority: Customer | Get details of a Customer by the Currently Authenticated User",
     *     description="email Emailis compulsory",
     *     @OA\Parameter(
     *        name="email",
     *        description="email Email",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *            type="email"
     *        )
     *     ),
     *     @OA\Response(response="200", description="Customer retrieved successfully"),
     *     @OA\Response(response="401", description="Unauthenticated. Token needed"),
     * )
     */
    public function show($customer_id)
    {
        $customer = Customer::where('customer_id', $customer_id)->first();

        $email = $customer->email;
        $cust= $this->model->show($customer_id);
        $user_roles = Role::all();
        if(!empty($customer)){
            return response()->json([
                'success' => true,
                'message' => $customer->email. ' Please Preview Your Details',
                'data' => [
                    'customer' => $customer,
                ],
            ], 200);
        }else{
            return response()->json([
                'success' => true,
                'message' => $customer->email. ' Does Not Exists',
                'data' => [],
            ], 404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     /**
     * @OA\Get(
     *     path="/api/customers/edit/{email}",
     *     tags={"Categories"},
     *     summary="Authority: Customer | Get details of a Customer by the Currently Authenticated User",
     *     description="email Emailis compulsory",
     *     @OA\Parameter(
     *        name="email",
     *        description="email Email",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *            type="email"
     *        )
     *     ),
     *     @OA\Response(response="200", description="Customer retrieved successfully"),
     *     @OA\Response(response="401", description="Unauthenticated. Token needed"),
     * )
     */
    public function edit($email)
    {
        $customer = Customer::where('email', $email)->first();
        $customer_id = $customer->customer_id;
        $cust= $this->model->show($customer_id);
        $user_roles = Role::all();
        if(!empty($customer)){
            return response()->json([
                'success' => true,
                'message' => $customer->email. ' Please Edit Your Details',
                'data' => [
                    'customer' => $customer,
                ],
            ], 200);
        }else{
            return response()->json([
                'success' => true,
                'message' => $customer->email. ' Does Not Exists',
                'data' => [],
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Put(
     *     path="/api/customers/{email}",
     *     tags={"Customers"},
     *     summary="Authority: None | Update an existing customer by the Currently Authenticated User",
     *     @OA\Parameter(
     *        name="id",
     *        description="Customer EMail",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *            type="integer"
     *        )
     *     ),
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
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 example={"name":"Customer name", "email":"Customer email", "phone_number":"Customer phone", "password":"Customer Password"}
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Customer updated successfully"),
     *     @OA\Response(response="400", description="Bad Request"),
     * )
     */
    public function update(Request $request, $customer_id)
    {
        $this->validate($request, [
            'name' => 'required|min:1|max:255|',
            'email' => 'required||min:1|max:255',
            'phone_number' => 'required|min:1|max:255'
        ]);

        $customer = Customer::where('customer_id', $customer_id)->first();
        $email = $customer->email;
        $user = User::where('email', $email)->first();
        $customer_id = $customer->customer_id;

        $user_id = $user->user_id;

        $customer_number = $request->input("customer_number");
        $customer_id = $request->input("customer_id");
        $role = 'Customer';

        $data = ([
            "customer" => $this->model->show($customer_id),
            "email" => $request->input("email"),
            "name" => $request->input("name"),
            "phone_number" =>($request->input("phone_number")),
            "customer_number" => $customer_number,
        ]);

        $use = User::where('user_id', $user_id)
        ->update([
            "email" => $request->input("email"),
            "name" => $request->input("name"),
            "password" => $user->password,
            "role" => 'Customer',
            "status" => 1,
        ]);
        if($this->model->update($data, $customer_id)){
            return response()->json([
                'success' => true,
                'message' => $request->input("email").' You Have updated your details successfully',
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Put(
     *     path="/api/customers/delete/{email}",
     *     tags={"Customers"},
     *     summary="Authority: None | Delete an existing customer by the Currently Authenticated User",
     *     @OA\Parameter(
     *        name="id",
     *        description="Customer EmIal",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *            type="integer"
     *        )
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                @OA\RequestBody(
     *                    required=true,
     *                    content="application/json",
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *
     *                 example={ "email":"Customer email"}
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Customer details Deleted updated successfully"),
     *     @OA\Response(response="400", description="Bad Request"),
     * )
     */
    public function destroy($email)
    {
        $customer = Customer::where('email', $email)->first();
        $user = User::where('email', $email)->first();
        $customer_id = $customer->customer_id;

        $customer =  $this->model->show($customer_id);
        $email = $customer->email;
        $use = User::where([
            "email" => $email,
        ])->first();

        $details= $use->name;
        $email = $use->email;
        $roles = $use->role;
        $user_id = $use->user_id;

        if (($customer->delete($customer_id)) AND ($customer->trashed()) AND ($use->delete($user_id)) AND ($use->trashed())) {
            return response()->json([
                'success' => true,
                'message' => ' You Have Deleted your details successfully',
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
}
