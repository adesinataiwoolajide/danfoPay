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
                        <li class="breadcrumb-item"><a href="{{route('vehicle.type.restore')}}">Recycle Bin</a></li>
                    @endif
                    <li class="breadcrumb-item">
                        <a href="{{route('vehicle.type.create')}}">View Vehicle Type</a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">List of Deleted Vehicle Types </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if(count($type) ==0)
                        <div class="card-header" align="center" style="color: red"><i class="fa fa-table"></i>
                            The List is Empty
                        </div>

                    @else
                        <div class="card-header"><i class="fa fa-table"></i> List of Saved Vehicle Types</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="default-datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Type Name</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Type Name</th>
                                        </tr>
                                    </tfoot>
                                    <tbody><?php
                                        $y=1; ?>
                                        @foreach($type as $types)
                                        <tr>

                                            <td>{{$y}}
                                                @if (auth()->user()->hasPermissionTo('Restore Vehicle Type') OR
                                                    (Gate::allows('Administrator', auth()->user())))
                                                    <a href="{{route('vehicle.type.undelete', $types->type_id)}}"
                                                        class="btn btn-danger"
                                                        onclick="return(confirmToRestore());" >
                                                    <i class="fa fa-trash-o"></i></a>
                                                @endif
                                            </td>
                                            <td>{{$types->type_name}}</td>

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
