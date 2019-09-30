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
                        <li class="breadcrumb-item">
                            <a href="{{route('bulk-sms')}}">Send Bulk SMS</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('bulk-sms-index')}}">All Bulk SMS</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('send-sms-restore')}}">Restore SMS</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">Send Bulk SMS </li>
                </ol>
            </div>
        </div>
        @if(auth()->user()->hasRole('Administrator'))
            <div class="row">
                <div class="col-lg-12">
                    @include('partials._message')
                </div>
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header"><i class="fa fa-table"></i> Please Fill The Below Form To Send Bulk SMS</div>
                        <div class="card-body">

                            <form action="{{route('send-sms')}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="form-group row ">
                                    <div class="col-sm-6">
                                        <label>Message Subject</label>
                                        <input type="text" name="subject" class="form-control form-control-rounded" required
                                        placeholder="Enter The Message Subject" value="">
                                        <span style="color: red">** This Field is Required **</span>
                                        @if ($errors->has('subject'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('subject') }} !</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Message Recipient</label>
                                        <select class="form-control form-control-rounded" name="recipient" required>
                                            <option value=""> -- Select The Recipients -- </option>
                                            <option value=""> </option><?php
                                            $admin = array("All","Customer", "Operator", "Owner"); ?>

                                            @foreach($admin as $list_roles)
                                                <option value="{{$list_roles}}"> {{$list_roles}}  </option>
                                            @endforeach
                                        <select>
                                        <span style="color: red">** This Field is Required **</span>
                                        @if ($errors->has('recipient'))
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
                                    <div class="col-sm-6">
                                        <label>Recipient Phone numbers (seperate with a comma [,])</label>
                                        <textarea name="numbers" class="form-control form-control-rounded" required>@foreach($customer as $customers){{trim($customers->phone_number.",")}}@endforeach
                                        </textarea>
                                        <span style="color: red">** This Field is Required **</span>
                                        @if ($errors->has('numbers'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('numbers') }} !</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Message Content</label>
                                        <textarea name="message" class="form-control form-control-rounded" required
                                        placeholder="Enter The Message Here"> </textarea>
                                        <span style="color: red">** This Field is Required **</span>
                                        @if ($errors->has('message'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('message') }} !</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success btn-lg btn-block" style="border:none">
                                            SEND SMS
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        @endif

    </div>
</div>


<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
@endsection
