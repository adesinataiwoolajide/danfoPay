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
                        <a href="{{route('add.operator', $details->plate_number)}}">Add Oparator</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('operator.index')}}">View All Oparators</a>
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
                    <div class="card-header"><i class="fa fa-table"></i> Please Fill The Below Form To Add A New Operator</div>
                    <div class="card-body">
                        @include('partials._message')
                        <form action="{{route('operator.save')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group row ">
                                <div class="col-sm-3">
                                    <label>Operator Name</label>
                                    <input type="text" name="name" class="form-control form-control-rounded" required
                                    placeholder="Enter The Owner Name" value="{{old('name')}}">
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
                                    placeholder="Enter The Owner's Phone Number" value="{{old('phone_number')}}">
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
                                    value="{{old('route')}}" required>
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
                                <div class="col-sm-3">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control form-control-rounded" required
                                    placeholder="Enter The Owner's Password" >
                                    <span style="color: red">** This Field is Required **</span>
                                    @if ($errors->has('password'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <div class="alert-icon contrast-alert">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="alert-message">
                                                <span><strong>Error!</strong> {{ $errors->first('password') }} !</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-3">
                                    <label>Repeat Password</label>
                                    <input type="password" name="repeat" class="form-control form-control-rounded" required
                                    placeholder="Repeat The Password">
                                    <span style="color: red">** This Field is Required **</span>
                                    @if ($errors->has('password'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <div class="alert-icon contrast-alert">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="alert-message">
                                                <span><strong>Error!</strong> {{ $errors->first('password') }} !</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-sm-3">
                                    <label>Car Owner</label>
                                    <input class="form-control form-control-rounded"
                                    value="{{$details->owner->name}}" readonly>
                                    <span style="color: green">** This Field is Readonly **</span>

                                </div>

                                <div class="col-sm-3">
                                    <label>Car Details</label>
                                    <input name="brand" class="form-control form-control-rounded"
                                    value="{{$details->plate_number . " ". $details->brand . ", ". $details->type->type_name}}" readonly>
                                    <span style="color: green">** This Field is Readonly **</span>

                                </div>

                                <input type="hidden" name="owner_id" value="{{$details->owner_id}}">
                                <input type="hidden" name="vehicle_id" value="{{$details->vehicle_id}}">



                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success btn-lg btn-block" style="border:none">
                                        ADD THE OPERATOR</button>
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
                            No Car Was Found For {{$details->owner->name}}
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
                                                {{-- <a href="{{route('owner.delete',$cars->vehicle_id)}}" class="btn btn-danger"
                                                     onclick="return(confirmToDelete());">
                                                <i class="fa fa-trash-o"></i>
                                                </a>
                                                <a href="{{route('owner.edit',$cars->vehicle_id)}}" class="btn btn-success"
                                                    onclick="return(confirmToEdit());">
                                                    <i class="fa fa-pencil"></i>
                                                </a> --}}
                                                {{-- <a href="{{route('owner.vehicle',$cars->owner_number)}}" class="btn btn-primary"
                                                    onclick="return(confirmToEdit());">
                                                    <i class="fa fa-car"></i>
                                                </a> --}}
                                                <a href="{{route('add.operator',$cars->plate_number)}}"
                                                     class="btn btn-primary">
                                                    <i class="fa fa-user"></i>
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
