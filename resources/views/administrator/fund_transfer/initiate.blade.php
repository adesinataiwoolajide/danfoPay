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

                    <li class="breadcrumb-item active" aria-current="page">List of Balances </li>
                </ol>
            </div>
        </div>
        @if(auth()->user()->hasRole('Customer'))
            <div class="row">
                <div class="col-lg-9">

                    <div class="card">
                        <div class="card-header"><i class="fa fa-table"></i>
                            @if(count($balance) ==0)
                                Please Click on The Below Link to Fund Your Wallet
                            @else
                                Please Fill The Below Form To Transfer Fund
                            @endif
                        </div>
                        <div class="card-body">
                            @include('partials._message')
                            @if(count($balance) ==0)
                                <a href="{{route('balance.index')}}" class="btn btn-success btn-lg btn-block"> Fund Your Account </a>
                            @else
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
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card gradient-yoda">
                        <div class="card-body">
                            <p style="color:white">DanfoPay <i class="fa fa-car"></i></p>
                            <h5 class="text-white mb-0">
                                @if(count($balance) ==0)
                                0
                                @else
                                &#8358;{{number_format($single->total_amount)}}
                                @endif
                                <span class="float-right">
                                <i class="fa fa-money"></i></span>
                            </h5>

                            <div class="progress my-3" style="height:3px;">
                                <div class="progress-bar" style="width:100%"></div>

                            </div>
                                <p class="mb-0 text-white small-font">{{$customer->customer_number}}
                                    <span class="float-right"> <i class="fa fa-vcard"></i></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if(count($transfer) ==0)
                        <div class="card-header" align="center" style="color: red"><i class="fa fa-table"></i>
                            The List is Empty
                        </div>

                    @else
                        <div class="card-header"><i class="fa fa-table"></i> List of Saved Fund Transfer</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="default-datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Sender</th>
                                            <th>Reciever</th>
                                            <th>Amount</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Sender</th>
                                            <th>Reciever</th>
                                            <th>Amount</th>
                                        </tr>
                                    </tfoot>
                                    <tbody><?php
                                        $y=1; ?>
                                        @foreach($transfer as $transfers)
                                            <tr>

                                                <td>{{$y}}</td>

                                                <td>{{$transfers->sender}}</td>
                                                <td>{{$transfers->reciever}}</td>

                                                <td>&#8358;{{number_format($transfers->amount)}}</td>

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
        @if(auth()->user()->hasRole('Administrator'))
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
                                                    @foreach(usersList($balances->user_id) as $item)
                                                        <td>{{$item->name}}</td>
                                                        <td>{{$item->email}}</td>
                                                        <td>
                                                            @foreach (customers($item->email) as $lide)
                                                                {{$lide->phone_number}}
                                                            @endforeach
                                                        </td>

                                                    @endforeach
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
        @endif
    </div>
</div>


<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
@endsection
