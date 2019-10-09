@extends('layouts.app')

@section('content')

<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row pt-2 pb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                    @if(auth()->user()->hasRole('Customer'))
                        <li class="breadcrumb-item"><a href="{{route('negotiation.edit',$nego->negotiation_id)}}">Edit Negotiation</a></li>
                    @endif
                    <li class="breadcrumb-item"><a href="{{route('negotiation.index')}}">Negotiations</a></li>
                    <li class="breadcrumb-item active" aria-current="page">List of Negotiations</li>

                </ol>
            </div>
        </div>
        @if(auth()->user()->hasRole('Customer'))
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> Please Fill The Below Form To Update The Negotiation </div>
                    <div class="card-body">
                        @include('partials._message')
                        <form action="{{route('negotiation.update',$nego->negotiation_id)}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group row ">
                                <div class="col-sm-2">
                                    <label>Vehicle Number</label>
                                    <input type="text" name="vehicle_number" class="form-control form-control-rounded" required
                                    placeholder="Enter The Vehicle Number" value="{{$car->vehicle_number}}" maxlength="6" >
                                    <span style="color: red">** This Field is Required </span>
                                    @if ($errors->has('vehicle_number'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <div class="alert-icon contrast-alert">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="alert-message">
                                                <span><strong>Error!</strong> {{ $errors->first('vehicle_number') }} !</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-sm-4">
                                    <label>From Destination</label>
                                    <input type="text" name="from_destination" class="form-control form-control-rounded" required
                                    placeholder="Enter The Starting Point" value="{{$nego->from_destination}}">
                                    <span style="color: red">** This Field is Required **</span>
                                    @if ($errors->has('from_destination'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <div class="alert-icon contrast-alert">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="alert-message">
                                                <span><strong>Error!</strong> {{ $errors->first('from_destination') }} !</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-4">
                                    <label>To Destination</label>
                                    <input type="text" name="to_destination" class="form-control form-control-rounded" required
                                    placeholder="Enter The Destination" value="{{$nego->to_destination}}">
                                    <span style="color: red">** This Field is Required **</span>
                                    @if ($errors->has('to_destination'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <div class="alert-icon contrast-alert">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="alert-message">
                                                <span><strong>Error!</strong> {{ $errors->first('to_destination') }} !</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-2">
                                    <label>Fare Amount</label>
                                    <input type="number" name="amount" class="form-control form-control-rounded"
                                    value="{{$nego->amount}}" required placeholder="Enter The Fare Amount">
                                    <span style="color: red">** This Field is Required</span>
                                    @if ($errors->has('amount'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <div class="alert-icon contrast-alert">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="alert-message">
                                                <span><strong>Error!</strong> {{ $errors->first('amount') }} !</span>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                                <input type="hidden" name="negotiation_id" value="{{$nego->negoriation_id}}">


                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success btn-lg btn-block" style="border:none">
                                        UPDATE THE NEGOTIATION FARE</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @endif
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    @if(count($negotiation) ==0)
                        <div class="card-header" align="center" style="color: red"><i class="fa fa-table"></i>
                            Negotiations List is Empty
                        </div>

                    @else
                        <div class="card-header"><i class="fa fa-table"></i>
                            @if(auth()->user()->hasRole('Administrator'))
                                List of All Customers Negotiations

                            @elseif(auth()->user()->hasRole('Operator'))
                                My Vehicle Negotiations
                            @elseif(auth()->user()->hasRole('Owner'))
                                My Vehicle Negotiations
                            @else
                                My Negotiations
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="default-datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>From</th>
                                            <th>Destination </th>
                                            <th>Amount</th>
                                            <th>Customer</th>
                                            <th>Vehicle</th>
                                            <th>Status</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S/N</th>
                                            <th>From</th>
                                            <th>Destination </th>
                                            <th>Amount</th>
                                            <th>Customer</th>
                                            <th>Vehicle</th>
                                            <th>Status</th>

                                        </tr>
                                    </tfoot>
                                    <tbody><?php
                                        $y=1; ?>
                                        @foreach($negotiation as $negotiations)
                                            <tr>

                                                <td>{{$y}}
                                                    @if(auth()->user()->hasRole('Operator'))

                                                        <a href="" class="btn btn-primary">
                                                            <i class="fa fa-plus"></i> Accept
                                                        </a>
                                                        <a href="" class="btn btn-primary">
                                                            <i class="fa fa-cencel"></i> Decline
                                                        </a>

                                                    @endif
                                                    @if(auth()->user()->hasRole('Customer'))
                                                        @if($negotiations->status ==2)
                                                            <a href="{{route('negotiation.edit',$negotiations->negotiation_id)}}" class="btn btn-primary">
                                                                <i class="fa fa-pencil"></i> Edit
                                                            </a>
                                                        @elseif($negotiations->status ==1)
                                                            <a href="{{route('negotiation.pay',$negotiations->negotiation_id)}}" class="btn btn-success">
                                                                <i class="fa fa-money"></i> Pay &#8358;{{number_format($negotiations->amount)}}
                                                            </a>
                                                        @elseif($negotiations->status ==3)
                                                            Paid
                                                        @else
                                                            <a href="{{route('negotiation.edit',$negotiations->negotiation_id)}}" class="btn btn-primary">
                                                                <i class="fa fa-pencil"></i> Edit
                                                            </a>
                                                        @endif

                                                    @endif

                                                </td>
                                                <td>{{$negotiations->from_destination}}</td>
                                                <td>{{$negotiations->to_destination}}</td>
                                                <td>&#8358;{{number_format($negotiations->amount)}}</td>
                                                <td>{{$negotiations->custo->email}}</td>
                                                <td>{{$negotiations->car->plate_number}}</td>
                                                <td>@if($negotiations->status ==0)
                                                    <p style="color:red"> Pending </p>

                                                    @elseif($negotiations->status ==1)
                                                        <p style="color:green"> Confirmed </p>

                                                    @elseif($negotiations->status ==2)
                                                        <p style="color:blue"> Re Negotiate </p>
                                                    @elseif($negotiations->status ==3)
                                                        <p style="color:orange"> Paid </p>
                                                    @else
                                                        <p style="color:pink"> Decline </p>
                                                    @endif

                                                </td>

                                            </tr><?php $y++; ?>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>


<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
@endsection
