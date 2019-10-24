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
                        <a href="{{route('log.index')}}">Log</a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">List of Activities Log </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if(count($activitylog) ==0)
                        <div class="card-header" align="center" style="color: red"><i class="fa fa-table"></i>
                            The List is Empty
                        </div>

                    @else
                        <div class="card-header"><i class="fa fa-table"></i> List of Saved Log</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="default-datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Action</th>
                                                @if(auth()->user()->hasRole('Administrator'))
                                                    <th>Email</th>
                                                @endif
                                            <th>Properties</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Action</th>
                                                @if(auth()->user()->hasRole('Administrator'))
                                                    <th>Email</th>
                                                @endif
                                            <th>Properties</th>
                                        </tr>
                                    </tfoot>
                                    <tbody><?php
                                        $y=1; ?>
                                        @foreach($activitylog as $log)
                                            <tr>

                                                <td>{{$y}}</td>
                                                <td>{{$log->description}}</td>
                                                @if(auth()->user()->hasRole('Administrator'))
                                                    <td>
                                                        @foreach (usersList($log->causer_id) as $item)
                                                            {{$item->email}}
                                                        @endforeach
                                                    </td>
                                                @endif
                                                <td>{{$log->properties}}</td>

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
