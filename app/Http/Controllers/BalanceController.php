<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{User, Customer, Balances, Payments};
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\BalanceRepository;
use Illuminate\Support\Facades\Gate;
use Unicodeveloper\Paystack\Paystack;
class BalanceController extends Controller
{
    protected $model;
    public function __construct(Balances $balance)
    {
       // set the model
       $this->model = new BalanceRepository($balance);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Gate::allows('Administrator', auth()->user())){
            $balance =$this->model->all();
            return view('administrator.balances.index')->with([
                'balance' => $balance,
            ]);

        }elseif(auth()->user()->hasRole('Customer')){
            $user_id = Auth::user()->user_id;
            $balance =Balances::where('user_id', $user_id)->get();

            return view('administrator.balances.index')->with([
                'balance' => $balance,
            ]);

        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To This Page",
            ]);
        }

    }

    public function singleTransaction()
    {
        if(Gate::allows('Administrator', auth()->user())){
            $list = Payments::orderBy('payment_id', 'desc')->get();
            return view("administrator.transactions.index")->with( [
                "list" => $list,
            ]);
        }elseif(auth()->user()->hasRole('Customer')){
            $list = Payments::where('user_id',  Auth::user()->user_id)->orderBy('payment_id', 'desc')->get();
            return view("administrator.transactions.index")->with( [
                "list" => $list,
            ]);
        }else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To This Page",
            ]);
        }
    }

    public function fund()
    {

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
     * Show the form for indexing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function list($id)
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
