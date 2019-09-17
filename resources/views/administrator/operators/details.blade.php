@extends('layouts.app')

@section('content')

<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-12">

                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{route('operator.details', $details->operator_id)}}"> Operator Details</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('operator.edit', $details->operator_id)}}">Edit Operator</a>
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
    </div>
    @include('partials._message')
    <!-- End Breadcrumb-->

    <div class="row">
        <div class="col-lg-4">
           <div class="card profile-card-2">
            <div class="card-img-block">
                <img class="img-fluid" src="{{asset('styling/assets/images/user.png')}}" alt="Card image cap">
            </div>
            <div class="card-body pt-5">
                <img src="{{asset('styling/assets/images/user.png')}}" alt="profile-image" class="profile">
                <h5 class="card-title">{{$details->name}}</h5>
                <p class="card-text">{{$details->phone_number}}</p>
                <div class="icon-block" align="center">
                    <a href="javascript:void();"><i class="fa fa-facebook bg-facebook text-white"></i></a>
                    <a href="javascript:void();"> <i class="fa fa-twitter bg-twitter text-white"></i></a>
                    <a href="javascript:void();"> <i class="fa fa-google-plus bg-google-plus text-white"></i></a>
                </div>
            </div>

            <div class="card-body border-top border-light">

            </div>
        </div>

        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                    <li class="nav-item">
                        <a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active"><i class="icon-user"></i> <span class="hidden-xs">Profile</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void();" data-target="#cars" data-toggle="pill" class="nav-link"><i class="fa fa-car"></i> <span class="hidden-xs">Cars</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void();" data-target="#edit" data-toggle="pill" class="nav-link"><i class="icon-note"></i> <span class="hidden-xs">Edit</span></a>
                    </li>
                </ul>
                <div class="tab-content p-3">
                    <div class="tab-pane active" id="profile">
                        <h5 class="mb-3">Operator Profile</h5>
                        <div class="row">

                            <div class="col-md-12">

                                <div class="table-responsive">
                                    <table class="table table-hover table-responsive">
                                        <tbody>
                                            <tr>
                                                <td>Owner Name</td>
                                                <td><?php echo $own->name ?></td>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <td>Operator Name</td>
                                                <td><?php echo $details->name ?></td>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <td>Car Number</td>
                                                <td>{{$details->cars->plate_number}}</td>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <td>Vehicle Type</td>
                                                <td><?php echo $vehicle->type->type_name ?></td>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <td>Car Route</td>
                                                <td>{{$details->route}}</td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                    </div>
                    <div class="tab-pane" id="cars">
                        <div class="alert alert-info alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <div class="alert-icon">
                                    <i class="icon-info"></i>
                                </div>
                                <div class="alert-message">
                                    <span><strong>Info!</strong> Lorem Ipsum is simply dummy text.</span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <tbody>
                                        <tr>
                                            <td>
                                            <span class="float-right font-weight-bold">3 hrs ago</span> Here is your a link to the latest summary report from the..
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <span class="float-right font-weight-bold">Yesterday</span> There has been a request on your account since that was..
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <span class="float-right font-weight-bold">9/10</span> Porttitor vitae ultrices quis, dapibus id dolor. Morbi venenatis lacinia rhoncus.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <span class="float-right font-weight-bold">9/4</span> Vestibulum tincidunt ullamcorper eros eget luctus.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <span class="float-right font-weight-bold">9/4</span> Maxamillion ais the fix for tibulum tincidunt ullamcorper eros.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane" id="edit">
                            @include('partials._message')
                                <form action="{{route('operator.update', $details->operator_id)}}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="form-group row ">
                                        <div class="col-sm-4">
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

                                        <div class="col-sm-4">
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
                                        <div class="col-sm-4">
                                            <label>Car Owner</label>
                                            <input class="form-control form-control-rounded"
                                            value="{{$own->name}}"" readonly>
                                            <span style="color: green">** This Field is Readonly **</span>

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



                                        <div class="col-sm-6">
                                            <label>Car Details</label>
                                            <input name="brand" class="form-control form-control-rounded"
                                            value="{{$vehicle->plate_number . " ". $vehicle->brand . ", ". $vehicle->type->type_name}}" readonly>
                                            <span style="color: green">** This Field is Readonly **</span>

                                        </div>

                                        <input type="hidden" name="owner_id" value="{{$own->owner_id}}">
                                        <input type="hidden" name="details" value="<?php echo "Details" ?>">
                                        <input type="hidden" name="vehicle_id" value="{{$vehicle->vehicle_id}}">



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
        </div>
   <!--Start Back To Top Button-->
    <a href="" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
@endsection
