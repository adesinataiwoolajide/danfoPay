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
                        <a href="{{route('operator.create',$details->owner_number)}}">Add Vehicle Operator</a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{route('vehicle.index')}}">All Vehicle</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('owner.create')}}">View Owners</a>
                    </li>
                    @if(auth()->user()->hasRole('Administrator'))
                        <li class="breadcrumb-item"><a href="{{route('vehicle.restore')}}">Recycle Bin</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">List of Saved cars </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> Please Fill The Below Form To Add A New Owner</div>
                    <div class="card-body">
                        @include('partials._message')
                        <form action="{{route('vehicle.save')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group row ">
                                <div class="col-sm-3">
                                    <label>Owner Name</label>
                                    <input type="text" name="name" class="form-control form-control-rounded" required
                                    placeholder="Enter The Owner Name" value="{{$details->name}}" readonly>
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
                                    placeholder="Enter The Owner's Phone Number"  value="{{$details->phone_number}}" readonly>
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

                                <div class="col-sm-3">
                                    <label>Plate Number</label>
                                    <input type="text" name="plate_number" class="form-control form-control-rounded" required
                                    placeholder="Enter The Plate Number" minlength="9" maxlength="10">
                                    <span style="color: red">** This Field is Required **</span>
                                    @if ($errors->has('plate_number'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <div class="alert-icon contrast-alert">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="alert-message">
                                                <span><strong>Error!</strong> {{ $errors->first('plate_number') }} !</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-3">
                                    <label>Vehicle Brand</label>
                                    <input type="text" name="brand" class="form-control form-control-rounded" required
                                    placeholder="Repeat The Brand">
                                    <span style="color: red">** This Field is Required **</span>
                                    @if ($errors->has('brand'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <div class="alert-icon contrast-alert">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="alert-message">
                                                <span><strong>Error!</strong> {{ $errors->first('brand') }} !</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-sm-12">
                                    <label>Vehicle Type</label>
                                    <select class="form-control form-control-rounded" name="type_id" required>
                                        <option value=""> -- Select The Vehicle Type -- </option>
                                        <option value=""> </option>
                                        @foreach($type as $types)
                                            <option value="{{$types->type_id}}"> {{$types->type_name}}  </option>
                                        @endforeach
                                    <select>
                                    <span style="color: red">** This Field is Required **</span>
                                    @if ($errors->has('type_id'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <div class="alert-icon contrast-alert">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="alert-message">
                                                <span><strong>Error!</strong> {{ $errors->first('type_id') }} !</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <input type="hidden" name="owner_id" value="{{$details->owner_id}}">



                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success btn-lg btn-block" style="border:none">
                                        ADD THE VEHICLE</button>
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
                    @if(count($car) ==0)
                        <div class="card-header" align="center" style="color: red"><i class="fa fa-table"></i>
                            No Car Was Found For {{$details->name}}
                        </div>

                    @else
                        <div class="card-header"><i class="fa fa-table"></i> List of Saved Owner Vehicle</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="default-datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Plate Number</th>
                                            <th>Brand</th>
                                            <th>Owner</th>
                                            <th>Type</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Plate Number</th>
                                            <th>Brand</th>
                                            <th>Owner</th>
                                            <th>Type</th>
                                        </tr>
                                    </tfoot>
                                    <tbody><?php
                                        $y=1; ?>
                                        @foreach($car as $cars)
                                        <tr>

                                            <td>{{$y}}

                                                <a href="{{route('add.operator',$cars->plate_number)}}"
                                                    onclick="" class="btn btn-primary">
                                                    <i class="fa fa-user"></i>
                                                </a>
                                                <a href="{{route('vehicle.edit',$cars->vehicle_id)}}"
                                                    onclick="" class="btn btn-success">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            </td>
                                            <td>{{$cars->plate_number}}</td>
                                            <td>{{$cars->brand}}</td>
                                            <td>{{$cars->owner->name}}</td>
                                            <td>{{$cars->type->type_name}}</td>

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
