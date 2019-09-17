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
                        <a href="{{route('fund.transfer.index')}}">
                           Fund Transfer
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('balance.index')}}">
                            @if(auth()->user()->hasRole('Administrator'))
                                Customer Balances
                            @else
                                My Balance
                            @endif
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('payment.index')}}">
                            @if(auth()->user()->hasRole('Administrator'))
                                Customer Transactions
                            @else
                                My Transactions
                            @endif
                        </a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">List of Balances </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> Please Fill The Below Form To Transfer Fund </div>
                    <div class="card-body">
                        @include('partials._message')
                        <form action="{{route('fund.transfer.save')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group row ">

                                <div class="col-sm-4">

                                    <input type="number" name="recipient" class="form-control form-control-rounded" required
                                    placeholder="Enter Phone Number" value="{{old('recipient')}}">
                                    <span style="color: red">** This Field is Required **</span>
                                    @if ($errors->has('name'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <div class="alert-icon contrast-alert">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="alert-message">
                                                <span><strong>Error!</strong> {{ $errors->first('recipient') }} !</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-4">

                                    <input type="number" name="amount" class="form-control form-control-rounded" required
                                    placeholder="Enter Amount" value="{{old('amount')}}" minlength="1">
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
                                    <button type="submit" class="btn btn-success btn-lg btn-block" style="border:none">
                                        TRANSFER THE FUND
                                    </button>
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
                    @if(count($balance) ==0)
                        <div class="card-header" align="center" style="color: red"><i class="fa fa-table"></i>
                            The List is Empty
                        </div>

                    @else
                        <div class="card-header"><i class="fa fa-table"></i> List of Saved Balances</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="default-datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Amount</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Amount</th>
                                        </tr>
                                    </tfoot>
                                    <tbody><?php
                                        $y=1; ?>
                                        @foreach($balance as $balances)
                                            <tr>

                                                <td>{{$y}}</td>

                                                <td>{{$balances->users->name}}</td>
                                                <td>{{$balances->users->email}}</td>
                                                <td>
                                                    @foreach (customers($balances->users->email) as $item)
                                                        {{$item->phone_number}}
                                                    @endforeach
                                                </td>
                                                <td>&#8358;{{number_format($balances->total_amount)}}</td>

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
