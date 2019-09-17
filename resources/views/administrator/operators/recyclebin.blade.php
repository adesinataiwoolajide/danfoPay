@extends('layouts.app')

@section('content')

<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row pt-2 pb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                    @if(auth()->user()->hasRole('Administrator'))
                        <li class="breadcrumb-item"><a href="{{route('operator.restore')}}">Recycle Bin</a></li>
                    @endif
                    <li class="breadcrumb-item">
                        <a href="{{route('operator.index')}}">All Operators</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('owner.create')}}">View Owners</a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">List of Deleted Operators </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if(count($operator) ==0)
                        <div class="card-header" align="center" style="color: red"><i class="fa fa-table"></i>
                            The List id Empty
                        </div>

                    @else
                        <div class="card-header"><i class="fa fa-table"></i> List of Deleted Vehicle Operators</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="default-datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Phone Number</th>
                                            <th>Route</th>
                                            <th>Plate Number</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
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

                                                <a href="{{route('operator.undelete', $operators->operator_id)}}"
                                                    onclick="return(confirmToRestore());" class="btn btn-danger">
                                                    <i class="fa fa-trash-o"></i>Restore
                                                </a>
                                            </td>
                                            <td>{{$operators->name}}</td>
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
