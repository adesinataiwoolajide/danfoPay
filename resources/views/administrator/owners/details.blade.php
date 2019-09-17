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
                        <a href="{{route('owner.details', $owner->owner_number)}}"> Owner Details</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('owner.edit', $owner->owner_id)}}">Edit Owner</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('owner.create')}}">All Owners</a>
                    </li>

                    @if(auth()->user()->hasRole('Administrator'))
                        <li class="breadcrumb-item"><a href="{{route('owner.restore')}}">Recycle Bin</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">List of Saved Owners </li>
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
                <h5 class="card-title">{{$owner->name}}</h5>
                <p class="card-text">{{$owner->phone_number}}</p>
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
                        <a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active"><i class="icon-user"></i>
                            <span class="hidden-xs">Operator Profile</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void();" data-target="#cars" data-toggle="pill" class="nav-link"><i class="fa fa-car"></i> <span class="hidden-xs">My Cars</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void();" data-target="#edit" data-toggle="pill" class="nav-link"><i class="icon-note"></i> <span class="hidden-xs">My Details</span></a>
                    </li>
                </ul>
                <div class="tab-content p-3">
                    <div class="tab-pane active" id="profile">
                        <h5 class="mb-3">Operator Profile</h5>
                        <div class="row">

                            <div class="col-md-12">

                                <div class="table-responsive">
                                    <div class="card">
                                        @if(count($operator) ==0)
                                            <div class="card-header" align="center" style="color: red"><i class="fa fa-table"></i>
                                                No operator Was Found For {{$owner->name}}
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
                                                                <th>Phone Number</th>
                                                                <th>Route</th>
                                                                <th>Plate Number</th>

                                                            </tr>
                                                        </thead>
                                                        <tfoot>
                                                            <tr>
                                                                <th>S/N</th>
                                                                <th>Name</th>
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


                                                                </td>
                                                                <td>{{$operators->name}}</td>
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
                        <!--/row-->
                    </div>
                    <div class="tab-pane" id="cars">
                        <div class="alert alert-info alert-dismissible" role="alert">

                                <div class="alert-icon">
                                    <i class="icon-info"></i>
                                </div>
                                <div class="alert-message">
                                    <span><strong>Info!</strong> List of Saved {{$owner->name}} Vehicles.</span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <div class="card">
                                    @if(count($car) ==0)
                                        <div class="card-header" align="center" style="color: red"><i class="fa fa-table"></i>
                                            No Car Was Found
                                        </div>

                                    @else
                                        <div class="card-header"><i class="fa fa-table"></i> List of Saved Vehicle Owners </div>
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

                        <div class="tab-pane" id="edit">
                            @include('partials._message')
                            <form action="{{route('owner.update',$owner->owner_id)}}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                <div class="form-group row ">
                                    <div class="col-sm-4">
                                        <label>Owner Name</label>
                                        <input type="text" name="name" class="form-control form-control-rounded" required
                                        placeholder="Enter The Owner Name" value="{{$owner->name}}">
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
                                        <input type="text" name="phone_number" class="form-control form-control-rounded" required
                                        placeholder="Enter The Owner's Phone Number" readonly value="{{$owner->phone_number}}">
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
                                        <label>Address</label>
                                        <textarea name="address" class="form-control form-control-rounded" required
                                        placeholder="Enter The Owner's Address">{{$owner->address}}</textarea>
                                        <span style="color: red">** This Field is Required **</span>
                                        @if ($errors->has('address'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('address') }} !</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <input type="hidden" name="owner_number" value="{{$owner->owner_number}}">
                                    <input type="hidden" name="owner_id" value="{{$owner->owner_id}}">
                                    <input type="hidden" name="details" value="<?php echo "Details" ?>">



                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success btn-lg btn-block" style="border:none">
                                            UPDATE THE OWNER</button>
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
