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
                        <a href="{{route('bulk-sms-index')}}">All SMS</a>
                    </li>
                    @if(auth()->user()->hasRole('Administrator'))

                        <li class="breadcrumb-item">
                            <a href="{{route('bulk-sms')}}">Send Bulk SMS</a>
                        </li>

                        <li class="breadcrumb-item"><a href="{{route('send-sms-restore')}}">Restore SMS</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">All SMS </li>
                </ol>
            </div>
        </div>
        @if(auth()->user()->hasRole('Administrator') OR auth()->user()->hasRole('Customer'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        @if(count($sms) ==0)
                            <div class="card-header" align="center" style="color: red"><i class="fa fa-table"></i>
                                The List is Empty
                            </div>

                        @else
                            <div class="card-header"><i class="fa fa-table"></i> List of Saved Sms</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="default-datatable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Name</th>
                                                <th>Phone Number</th>
                                                <th>Subject</th>
                                                <th>Message</th>

                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Name</th>
                                                <th>Phone Number</th>
                                                <th>Subject</th>
                                                <th>Message</th>
                                            </tr>
                                        </tfoot>
                                        <tbody><?php
                                            $y=1; ?>
                                            @foreach($sms as $smses)
                                                <tr>

                                                    <td>{{$y}}</td>

                                                    <td>{{$smss->phone_number}}</td>
                                                    <td>{{$smss->phone_number}}</td>
                                                    <td>{{$smss->subject}}</td>
                                                    <td>{{$smss->message}}</td>

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
