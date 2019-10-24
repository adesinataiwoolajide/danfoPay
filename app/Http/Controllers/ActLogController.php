<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\{User};
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Gate;
class ActLogController extends Controller
{
    public function __construct()
    {
       $this->middleware(['role:Administrator|Customer|Owner|Operator']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('Administrator', auth()->user())){
            $activitylog = Activity::orderBy('id', 'desc')->get();
            return view("administrator.log.index")->with([
                "activitylog" => $activitylog,
            ]);
        }elseif(auth()->user()->hasRole('Customer') OR (auth()->user()->hasRole('Owner')) OR (auth()->user()->hasRole('Operator'))){
            $activitylog = Activity::where('causer_id', Auth::user()->user_id)->get();
            return view("administrator.log.index")->with([
                "activitylog" => $activitylog,
            ]);
        }else{
            return redirect()->back()->with([
                "error" => "You dont have access to this page",
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
