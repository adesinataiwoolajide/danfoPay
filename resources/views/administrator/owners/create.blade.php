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
                        <a href="{{route('owner.create')}}">
                            @if(auth()->user()->hasRole('Administrator'))
                                View Owners
                            @else
                                My Details
                            @endif

                        </a>
                    </li>

                    @if(auth()->user()->hasRole('Administrator'))
                        <li class="breadcrumb-item"><a href="{{route('owner.restore')}}">Recycle Bin</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">

                         @if(auth()->user()->hasRole('Administrator'))
                            List of Saved Owners
                        @else
                            My Details
                        @endif
                    </li>
                </ol>
            </div>
        </div>
        @if(auth()->user()->hasRole('Administrator'))
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> Please Fill The Below Form To Add A New Owner</div>
                    <div class="card-body">
                        @include('partials._message')
                        <form action="{{route('owner.save')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group row ">
                                <div class="col-sm-4">
                                    <label>Owner Name</label>
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
                                <div class="col-sm-4">
                                    <label>Owner E-Mail</label>
                                    <input type="email" name="email" class="form-control form-control-rounded" required
                                    placeholder="Enter The Owner E-Mail" value="{{old('email')}}">
                                    <span style="color: red">** This Field is Required **</span>
                                    @if ($errors->has('email'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <div class="alert-icon contrast-alert">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="alert-message">
                                                <span><strong>Error!</strong> {{ $errors->first('email') }} !</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-sm-4">
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

                                <div class="col-sm-4">
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
                                <div class="col-sm-4">
                                    <label>Repeat Password</label>
                                    <input type="password" name="repeat" class="form-control form-control-rounded" required
                                    placeholder="Repeat The Password">
                                    <span style="color: red">** This Field is Required **</span>
                                    @if ($errors->has('repeat'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <div class="alert-icon contrast-alert">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="alert-message">
                                                <span><strong>Error!</strong> {{ $errors->first('repeat') }} !</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-sm-4">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control form-control-rounded" required
                                    placeholder="Enter The Owner's Address">{{old('address')}}</textarea>
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
                                <input type="hidden" name="role" value="{{"Owner"}}">



                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success btn-lg btn-block" style="border:none">
                                        ADD THE OWNER</button>
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
                    @if(auth()->user()->hasRole('Administrator'))
                        @if(count($owner) ==0)
                            <div class="card-header" align="center" style="color: red"><i class="fa fa-table"></i>
                                The List is Empty
                            </div>

                        @else
                            <div class="card-header"><i class="fa fa-table"></i> List of Saved Owners</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="default-datatable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Owner Name</th>
                                                <th>E-Mail</th>
                                                <th>Phone Number</th>
                                                <th>Address</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Owner Name</th>
                                                <th>E-Mail</th>
                                                <th>Phone Number</th>
                                                <th>Address</th>
                                            </tr>
                                        </tfoot>
                                        <tbody><?php
                                            $y=1; ?>
                                            @foreach($owner as $owners)
                                            <tr>

                                                <td>{{$y}}
                                                    <a href="{{route('owner.delete',$owners->owner_id)}}"
                                                        onclick="return(confirmToDelete());" class="btn btn-danger">
                                                    <i class="fa fa-trash-o"></i>
                                                    </a>
                                                    <a href="{{route('owner.edit',$owners->owner_id)}}"
                                                        onclick="return(confirmToEdit());" class="btn btn-success">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="{{route('owner.vehicle',$owners->owner_number)}}" class="btn btn-primary">
                                                        <i class="fa fa-car"></i>
                                                    </a>
                                                    <a href="{{route('owner.details',$owners->owner_number)}}" class="btn btn-default">
                                                        <i class="fa fa-list"></i>
                                                    </a>
                                                    {{-- <a href="{{route('operator.create',$owners->owner_number)}}"
                                                        onclick="">
                                                        <i class="fa fa-user"></i>
                                                    </a> --}}
                                                </td>
                                                <td>{{$owners->name}}</td>
                                                <td>{{$owners->email}}</td>
                                                <td>{{$owners->phone_number}}</td>
                                                <td>{{$owners->address}}</td>

                                            </tr><?php $y++; ?>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        @endif
                    @else

                        <div class="card-header"><i class="fa fa-table"></i> MY DETAILS</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="default-datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Owner Name</th>
                                            <th>E-Mail</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Owner Name</th>
                                            <th>E-Mail</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                        </tr>
                                    </tfoot>
                                    <tbody><?php
                                        $y=1; ?>
                                        @foreach($own as $owns)
                                        <tr>

                                            <td>{{$y}}

                                                <a href="{{route('owner.edit',$owns->owner_id)}}"
                                                    onclick="return(confirmToEdit());" class="btn btn-success">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="{{route('owner.vehicle',$owns->owner_number)}}" class="btn btn-primary">
                                                    <i class="fa fa-car"></i>
                                                </a>
                                                <a href="{{route('owner.details',$owns->owner_number)}}" class="btn btn-default">
                                                    <i class="fa fa-list"></i>
                                                </a>
                                                {{-- <a href="{{route('operator.create',$owners->owner_number)}}"
                                                    onclick="">
                                                    <i class="fa fa-user"></i>
                                                </a> --}}
                                            </td>
                                            <td>{{$owns->name}}</td>
                                            <td>{{$owns->email}}</td>
                                            <td>{{$owns->phone_number}}</td>
                                            <td>{{$owns->address}}</td>

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
