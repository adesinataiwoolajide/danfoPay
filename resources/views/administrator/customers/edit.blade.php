@extends('layouts.app')

@section('content')

<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{route('customer.edit',$cust->email)}}">
                            @if(auth()->user()->hasRole('Administrator'))
                                Edit Customer
                            @else
                                Edit My Details
                            @endif
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('customer.index')}}">
                        @if(auth()->user()->hasRole('Administrator'))
                            Add Customer
                        @else
                             My Details
                        @endif</a>
                    </li>
                    @if(auth()->user()->hasRole('Administrator'))
                        <li class="breadcrumb-item"><a href="{{route('customer.restore')}}">Restore Deleted Customers</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">List of Saved Customers </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> Please Fill The Below Form To Update Details</div>
                    <div class="card-body">
                        @include('partials._message')
                        <form action="{{route('customer.update', $cust->email)}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group row ">
                                <div class="col-sm-3">
                                    <label>Full Name</label>
                                    <input type="text" name="name" class="form-control form-control-rounded" required
                                    placeholder="Enter The Full Name" value="{{$cust->name}}">
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
                                    <label>User Role</label>
                                    <select class="form-control form-control-rounded" name="role" required>
                                        <option value="Customer"> Customer </option>

                                    <select>

                                </div>
                                <div class="col-sm-3">
                                    <label>E-Mail</label>
                                    <input type="email" name="email" required placeholder="Please Enter The E-Mail"
                                    class="form-control form-control-rounded" value="{{$cust->email}}" readonly>


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
                                <div class="col-sm-3">
                                    <label>Phone Number</label>
                                    <input type="number" name="phone_number" required placeholder="Please Enter The Phone Number"
                                    class="form-control form-control-rounded" value="{{$cust->phone_number}}" readonly>

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

                               <input type="hidden" value="{{$cust->customer_id}}" name="customer_id">
                               <input type="hidden" value="{{$cust->customer_number}}" name="customer_number">

                                <div class="col-sm-12">
                                    <button type="CUSTOMER" class="btn btn-success btn-lg btn-block" style="border:none">

                                        @if(auth()->user()->hasRole('Administrator'))
                                            UPDATE THE USER
                                        @else
                                            UPDATE MY DETAILS
                                        @endif
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if(auth()->user()->hasRole('Administrator'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        @if(count($customer) ==0)
                            <div class="card-header" align="center" style="color: red"><i class="fa fa-table"></i>
                                The List is Empty
                            </div>

                        @else
                            <div class="card-header"><i class="fa fa-table"></i> List of Saved Users</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="default-datatable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>Customer Number</th>

                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>Customer Number</th>
                                            </tr>
                                        </tfoot>
                                        <tbody><?php
                                            $y=1; ?>
                                            @foreach($customer as $customers)
                                            <tr>

                                                <td>{{$y}}
                                                    <a href="{{route('customer.delete', $customers->email)}}" class="btn btn-danger" onclick="return(confirmToDelete());">
                                                    <i class="fa fa-trash-o"></i>
                                                    </a>
                                                    <a href="{{route('customer.edit', $customers->email)}}" class="btn btn-success" onclick="return(confirmToEdit());">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </td>
                                                <td>{{$customers->name}}</td>
                                                <td>{{$customers->email}}</td>
                                                <td>{{$customers->phone_number}}</td>
                                                <td>{{$customers->customer_number}}</td>

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
        @endif
    </div>
</div>


<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
@endsection
