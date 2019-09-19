<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{User, Customer};
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\CustomerRepository;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    protected $model;
    public function __construct(Customer $customer)
    {
       // set the model
       $this->model = new CustomerRepository($customer);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('Administrator', auth()->user())){
            $customer =$this->model->all();
            $user_roles = Role::all();
            return view('administrator.customers.index')->with([
                'customer' => $customer,
            ]);

        }elseif(auth()->user()->hasRole('Customer')){
            $email = Auth::user()->email;
            $customer =Customer::where('email', $email)->get();

            return view('administrator.customers.index')->with([
                'customer' => $customer,
            ]);

        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To This Page",
            ]);
        }

    }

    public function bin()
    {
        $customer= Customer::onlyTrashed()->get();
        return view('administrator.customers.recyclebin')->with([
            'customer' => $customer,
        ]);
    }

    public function restore($email)
    {
        if (Gate::allows('Administrator', auth()->user())) {
            $customer =  Customer::withTrashed()->where('email', $email)->first();
            $user = User::where('email', $email)->first();
            $customer_id = $customer->customer_id;

            $cost = Customer::withTrashed()->where('customer_id', $customer_id)->restore();
            $customer =  $this->model->show($customer_id);
            $user = User::withTrashed()->where('email', $email)->restore();

            return redirect()->back()->with([
                'success' => " You Have Restored". " ".$customer->name. " " ." Details Successfully",

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
        if (Gate::allows('Administrator', auth()->user()) OR (Auth::hasRole('Customer'))) {
            $this->validate($request, [
                'name' => 'required|min:1|max:255|',
                'email' => 'required||min:1|max:255|unique:customers',
                'password' => 'required|min:1|max:255|',
                'phone_number' => 'required|min:1|max:255'
            ]);

            if(Customer::where("email", $request->input("email"))->exists() OR(User::where("email", $request->input("email"))->exists())){
                return redirect()->back()->with("error", "The E-Mail is In Use By Another Customer");
            }
            if(Customer::where("phone_number", $request->input("phone_number"))->exists()){
                return redirect()->back()->with("error", "The Phone Number is In Use By Another Customer");
            }
            if($request->input("password") != $request->input("confirm_password")){
                return redirect()->back()->with("error", "Password Does not match");
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

                return redirect()->route("customer.index")->with("success", "You Have Added "
                .$request->input("name"). " To The Customer List Successfully");

            }else{
                return redirect()->back()->with("error", "Network Failure");
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Create A Customer",
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
    public function edit($email)
    {
        {
            $customer = Customer::where('email', $email)->first();
            $customer_id = $customer->customer_id;

            if(auth()->user()->hasPermissionTo('Edit Customer') OR
                (Gate::allows('Administrator', auth()->user()))){
                $cust= $this->model->show($customer_id);

                $customer =$this->model->all();
                $user_roles = Role::all();
                return view('administrator.customers.edit')->with([
                    'customer' => $customer,
                    'user_roles' => $user_roles,
                    'cust' => $cust
                ]);

            }elseif(auth()->user()->hasRole('Customer')){
                $cust= $this->model->show($customer_id);
                return view('administrator.customers.edit')->with([
                    'customer' => $customer,
                ]);

            } else{
                return redirect()->back()->with([
                    'error' => "You Dont have Access To This Page",
                ]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $email)
    {
        if (Gate::allows('Administrator', auth()->user()) OR (Auth::user()->hasRole('Customer'))) {
            $this->validate($request, [
                'name' => 'required|min:1|max:255|',
                'email' => 'required||min:1|max:255',
                'phone_number' => 'required|min:1|max:255'
            ]);

            $customer = Customer::where('email', $email)->first();
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
                return redirect()->route("customer.index")->with("success", "You Have Updated The Customer Details Successfully");

            }else{
                return redirect()->back()->with("error", "Network Failure");
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Update A Customer",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($email)
    {
        if (Gate::allows('Administrator', auth()->user())) {
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
                // $use->removeRole($roles);
                return redirect()->back()->with([
                    'success' => "You Have Deleted  $details From The Customer List Successfully",
                ]);
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Delete A Customer",
            ]);
        }

    }
}
