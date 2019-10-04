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
                        <a href="{{route('operator.index')}}">
                            @if(auth()->user()->hasRole('Administrator'))
                                View All Oparators
                            @elseif(auth()->user()->hasRole('Owner'))
                                My Operators
                            @else
                                My Details
                            @endif
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('owner.create')}}">
                            @if(auth()->user()->hasRole('Administrator'))
                                View All Owners
                             @elseif(auth()->user()->hasRole('Owner'))
                                My Details
                            @else

                            @endif
                        </a>
                    </li>
                    @if(auth()->user()->hasRole('Administrator'))
                        <li class="breadcrumb-item"><a href="{{route('operator.restore')}}">Recycle Bin</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">
                         @if(auth()->user()->hasRole('Administrator'))
                            List of All Oparators
                        @elseif(auth()->user()->hasRole('Owner'))
                            My Operators
                        @else
                            My Details
                        @endif
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                @include('partials._message')
                <div class="card">
                    @if(count($operator) ==0)
                        <div class="card-header" align="center" style="color: red"><i class="fa fa-table"></i>
                            The List is Empty
                        </div>

                    @else
                        <div class="card-header"><i class="fa fa-table"></i>   @if(auth()->user()->hasRole('Administrator'))
                            List of All Oparators
                        @elseif(auth()->user()->hasRole('Owner'))
                            My Operators
                        @else
                            My Details
                        @endif</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="default-datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>E-Mail</th>
                                            <th>Phone Number</th>
                                            <th>Route</th>
                                            <th>Plate Number</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>E-Mail</th>
                                            <th>Phone Number</th>
                                            <th>Route</th>
                                            <th>Plate Number</th>

                                        </tr>
                                    </tfoot>
                                    <tbody><?php
                                        $y=1; ?>
                                        @foreach($operator as $operators)
                                        <tr>

                                            <td>{{$y}}
                                                @if(auth()->user()->hasRole('Operator'))

                                                    {{-- <a href="{{route('operator.edit',$operators->operator_id)}}" class="btn btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a> --}}
                                                @else
                                                    <a href="{{route('operator.details',$operators->operator_id)}}" class="btn btn-success">
                                                        <i class="fa fa-list"></i>
                                                    </a>
                                                    <a href="{{route('operator.edit',$operators->operator_id)}}" class="btn btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endif
                                                @if(auth()->user()->hasRole('Administrator'))
                                                    <a href="{{route('operator.delete',$operators->operator_id)}}" class="btn btn-danger">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{$operators->name}}</td>
                                            <td>{{$operators->email}}</td>
                                            <td>{{$operators->phone_number}}</td>
                                            <td>{{$operators->route}}</td>
                                            <td>{{$operators->cars->plate_number}}</td>

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
