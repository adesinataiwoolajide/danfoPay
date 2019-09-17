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
                        <a href="{{route('vehicle.index')}}">All Vehicle</a>
                    </li>
                    {{-- <li class="breadcrumb-item">
                        <a href="{{route('owner.create')}}">View Owners</a>
                    </li> --}}
                    @if(auth()->user()->hasRole('Administrator'))
                        <li class="breadcrumb-item"><a href="{{route('vehicle.restore')}}">Recycle Bin</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">List of Saved cars </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                 @include('partials._message')
                <div class="card">
                    @if(count($car) ==0)
                        <div class="card-header" align="center" style="color: red"><i class="fa fa-table"></i>
                            No Car Was Found
                        </div>

                    @else
                        <div class="card-header"><i class="fa fa-table"></i> List of Saved Vehicle Owners </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="default-datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Plate Number</th>
                                            <th>Brand</th>
                                            <th>Owner</th>
                                            <th>Type</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Plate Number</th>
                                            <th>Brand</th>
                                            <th>Owner</th>
                                            <th>Type</th>
                                        </tr>
                                    </tfoot>
                                    <tbody><?php
                                        $y=1; ?>
                                        @foreach($car as $cars)
                                        <tr>

                                            <td>{{$y}}

                                                <a href="{{route('vehicle.edit',$cars->vehicle_id)}}"
                                                    onclick="" class="btn btn-success">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="{{route('vehicle.delete',$cars->vehicle_id)}}"
                                                    onclick="" class="btn btn-danger">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                                <a href="{{route('add.operator',$cars->plate_number)}}"
                                                    class="btn btn-primary">
                                                    <i class="fa fa-user"></i>
                                                </a>
                                            </td>
                                            <td>{{$cars->plate_number}}</td>
                                            <td>{{$cars->brand}}</td>
                                            <td>{{$cars->owner->name}}</td>
                                            <td>{{$cars->type->type_name}}</td>

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
