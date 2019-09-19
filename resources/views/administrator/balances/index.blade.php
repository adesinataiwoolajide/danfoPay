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
                        <a href="{{route('balance.index')}}">
                            @if(auth()->user()->hasRole('Administrator'))
                                Customer Accounts
                            @else
                                My Account
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
                    <li class="breadcrumb-item">
                        <a href="{{route('fund.transfer.index')}}">
                           Fund Transfer
                        </a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">List of Balances </li>
                </ol>
            </div>
        </div>
        @if(auth()->user()->hasRole('Customer'))
            <div class="row">
                <div class="col-lg-12">
                    @include('partials._message')
                </div>
                <div class="col-lg-4">

                    <div class="card">
                        <div class="card-header"><i class="fa fa-table"></i> Please Fill The Below Form To Fund Your Wallet Throught ATM</div>
                        <div class="card-body">

                            <form action="{{route('fund.pay')}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="form-group row ">
                                    <div class="col-sm-12">

                                        <input type="number" name="amount" class="form-control form-control-rounded" required
                                        placeholder="Enter The The Amount To Fund" value="">
                                        <span style="color: red">** This Field is Required **</span>
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
                                    <input type="hidden" name="email" value="{{Auth::user()->email}}">
                                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">
                                    <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success btn-lg btn-block" style="border:none">
                                            FUND WALLET
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">

                    <div class="card">
                        <div class="card-header"><i class="fa fa-table"></i> Please Fill The Below Form To Fund Your Wallet Recharge Card</div>
                        <div class="card-body">

                            <form action="{{route('fund.card')}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="form-group row ">
                                    <div class="col-sm-4">

                                        <input type="number" name="card" class="form-control form-control-rounded" required
                                        placeholder="Enter The The Card Number" value="{{old('card')}}">
                                        <span style="color: red">** This Field is Required **</span>
                                        @if ($errors->has('card'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('card') }} !</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-4">

                                        <input type="number" name="card_amount" class="form-control form-control-rounded" required
                                        placeholder="Enter The The Amount" value="{{old('card_amount')}}">
                                        <span style="color: red">** This Field is Required **</span>
                                        @if ($errors->has('card'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('card_amount') }} !</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-4">

                                        <select class="form-control form-control-rounded" required name="network">
                                            <option value=""> -- Select Provider -- </option>
                                            <option value=""> </option>
                                            <option value="AIRTEL"> AIRTEL </option>
                                            <option value="9 MOBILE"> E9 MOBILE </option>
                                            <option value="GLO"> GLO </option>
                                            <option value="MTN"> MTN </option>
                                            <option value="MTN TRANSFER"> MTN TRANSFER </option>


                                        </select>
                                        <span style="color: red">** This Field is Required **</span>
                                        @if ($errors->has('network'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('network') }} !</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success btn-lg btn-block" style="border:none">
                                        FUND WALLET
                                    </button>
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
