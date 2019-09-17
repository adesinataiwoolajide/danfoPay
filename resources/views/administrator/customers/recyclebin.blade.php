@extends('layouts.app')

@section('content')

<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>

                    @if(auth()->user()->hasRole('Administrator'))
                        <li class="breadcrumb-item"><a href="{{route('customer.restore')}}">Restore Deleted Customers</a></li>
                    @endif
                    <li class="breadcrumb-item">
                        <a href="{{route('customer.index')}}">Add Customer</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">List of Deleted Customers </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if(count($customer) ==0)
                        <div class="card-header" align="center" style="color: red"><i class="fa fa-table"></i>
                            The List is Empty
                        </div>

                    @else
                        <div class="card-header"><i class="fa fa-table"></i> List of Deleted Users</div>
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
                                                    <a href="{{route('customer.undelete', $customers->email)}}" class="btn btn-success"
                                                        onclick="return(confirmToRestore());">
                                                        <i class="fa fa-refresh"></i>
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
    </div>
</div>


<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
@endsection
