@extends('layouts.app')

@section('content')

<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row pt-2 pb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{route('operator.edit', $details->operator_id)}}">Edit Operator</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('operator.details', $details->operator_id)}}"> Operator Details</a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{route('operator.index')}}">All Operators</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('owner.create')}}">View Owners</a>
                    </li>
                    @if(auth()->user()->hasRole('Administrator'))
                        <li class="breadcrumb-item"><a href="{{route('operator.restore')}}">Recycle Bin</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">List of Saved Operators </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> Please Fill The Below Form To Update The Operator Details</div>
                    <div class="card-body">
                        @include('partials._message')
                        <form action="{{route('operator.update', $details->operator_id)}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group row ">
                                <div class="col-sm-3">
                                    <label>Operator Name</label>
                                    <input type="text" name="name" class="form-control form-control-rounded" required
                                    placeholder="Enter The Owner Name" value="{{$details->name}}">
                                    <span style="color: red">** This Field is Required **</span>
                                    @if ($errors->has('name'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <div class="alert-icon contrast-alert">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="alert-message">
                                                <span><strong>Error!</strong> {{ $errors->first('name') }} !</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-sm-3">
                                    <label>Phone Number</label>
                                    <input type="number" name="phone_number" class="form-control form-control-rounded" required
                                    placeholder="Enter The Owner's Phone Number" value="{{$details->phone_number}}">
                                    <span style="color: red">** This Field is Required **</span>
                                    @if ($errors->has('phone_number'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <div class="alert-icon contrast-alert">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="alert-message">
                                                <span><strong>Error!</strong> {{ $errors->first('phone_number') }} !</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label>Car Route</label>
                                    <input type="text" name="route" class="form-control form-control-rounded"
                                    value="{{$details->route}}" required>
                                    <span style="color: red">** This Field is Required **</span>
                                    @if ($errors->has('route'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <div class="alert-icon contrast-alert">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="alert-message">
                                                <span><strong>Error!</strong> {{ $errors->first('route') }} !</span>
                                            </div>
                                        </div>
                                    @endif

                                </div>

                                <div class="col-sm-4">
                                    <label>Operator E-Mail</label>
                                    <input class="form-control form-control-rounded"
                                    value="{{$details->email}}"" name="email" required>
                                    <span style="color: green">** This Field is Readonly **</span>

                                </div>


                                <div class="col-sm-4">
                                    <label>Car Owner</label>
                                    <input class="form-control form-control-rounded"
                                    value="{{$own->name}}"" readonly>
                                    <span style="color: green">** This Field is Readonly **</span>

                                </div>

                                <div class="col-sm-4">
                                    <label>Car Details</label>
                                    <input name="brand" class="form-control form-control-rounded"
                                    value="{{$vehicle->plate_number . " ". $vehicle->brand . ", ". $vehicle->type->type_name}}" readonly>
                                    <span style="color: green">** This Field is Readonly **</span>

                                </div>

                                <input type="hidden" name="owner_id" value="{{$own->owner_id}}">
                                <input type="hidden" name="vehicle_id" value="{{$vehicle->vehicle_id}}">
                                <input type="hidden" name="operator_id" value="{{$own->operator_id}}">



                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success btn-lg btn-block" style="border:none">
                                        UPDATE THE OPERATOR</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if(count($operator) ==0)
                        <div class="card-header" align="center" style="color: red"><i class="fa fa-table"></i>
                            The List id Empty
                        </div>

                    @else
                        <div class="card-header"><i class="fa fa-table"></i> List of Saved Vehicle Operators</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="default-datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>E-Mail</th>
                                            <th>Phone Number</th>
                                            <th>Route</th>
                                            <th>Plate Number</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>E-Mail</th>
                                            <th>Phone Number</th>
                                            <th>Route</th>
                                            <th>Plate Number</th>

                                        </tr>
                                    </tfoot>
                                    <tbody><?php
                                        $y=1; ?>
                                        @foreach($operator as $operators)
                                        <tr>

                                            <td>{{$y}}

                                                <a href="{{route('operator.details',$operators->operator_id)}}" class="btn btn-success">
                                                    <i class="fa fa-list"></i>
                                                </a>
                                                <a href="{{route('operator.edit',$operators->operator_id)}}" class="btn btn-primary">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                @if(auth()->user()->hasRole('Administrator'))
                                                    <a href="{{route('operator.delete',$operators->operator_id)}}" class="btn btn-danger">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{$operators->name}}</td>
                                            <td>{{$operators->email}}</td>
                                            <td>{{$operators->phone_number}}</td>
                                            <td>{{$operators->route}}</td>
                                            <td>{{$operators->cars->plate_number}}</td>

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
