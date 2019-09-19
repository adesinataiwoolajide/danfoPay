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
                        <a href="{{route('payment.index')}}">
                            @if(auth()->user()->hasRole('Administrator'))
                                Customer Transactions
                            @else
                                My Transactions
                            @endif
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
                        <a href="{{route('fund.transfer.index')}}">
                           Fund Transfer
                        </a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">List of Payment Transactions </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if(count($list) ==0)
                        <div class="card-header" align="center" style="color: red"><i class="fa fa-table"></i>
                            The List is Empty
                        </div>

                    @else
                        <div class="card-header"><i class="fa fa-table"></i> List of Saved Transactions</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="default-datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Refrence</th>
                                            <th>Amount</th>
                                            <th>Currency</th>
                                            <th>Status</th>
                                            <th>Created At</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Refrence</th>
                                            <th>Amount</th>
                                            <th>Currency</th>
                                            <th>Status</th>
                                            <th>Created At</th>

                                        </tr>
                                    </tfoot>
                                    <tbody><?php
                                        $y=1; ?>
                                        @foreach($list as $lists)
                                            <tr>

                                                <td>{{$y}}</td>
                                                <td>{{$lists->reference}}</td>
                                                <td>&#8358;{{number_format($lists->amount)}}</td>
                                                <td>{{$lists->currency}}</td>
                                                <td>
                                                    @if(($lists->status) == 'success')
                                                        <p style="color:green"> {{ucwords($lists->status)}} </p>
                                                    @else
                                                    <p style="color:red"> {{ucwords($lists->status)}} </p>
                                                    @endif
                                                </td>
                                                <td>{{$lists->created_at}}</td>
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
