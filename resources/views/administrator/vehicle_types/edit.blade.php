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
                        <a href="{{route('vehicle.type.edit',$type->type_id)}}">Edit Vehicle Type</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('vehicle.type.create')}}">View Vehicle Type</a>
                    </li>
                    @if(auth()->user()->hasRole('Administrator'))
                        <li class="breadcrumb-item"><a href="{{route('vehicle.type.restore')}}">Recycle Bin</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">List of Saved Vehicle Types </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> Please Fill The Below Form To Add A Vehicle Type</div>
                    <div class="card-body">
                        @include('partials._message')
                        <form action="{{route('vehicle.type.update',$type->type_id)}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group row ">
                                <div class="col-sm-12">
                                    <label>Vehicle Type Name</label>
                                    <input type="text" name="type_name" class="form-control form-control-rounded" required
                                    placeholder="Enter The Vehicle Type Name" value="{{$type->type_name}}">
                                    <span style="color: red">** This Field is Required **</span>
                                    @if ($errors->has('type_name'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <div class="alert-icon contrast-alert">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="alert-message">
                                                <span><strong>Error!</strong> {{ $errors->first('type_name') }} !</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success btn-lg btn-block" style="border:none">
                                        UPDATE THE VEHICLE TYPE</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if(count($typo) ==0)
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
                                        @foreach($typo as $types)
                                        <tr>

                                            <td>{{$y}}
                                                <a href="{{route('vehicle.type.delete', $types->type_id)}}" class="btn btn-danger" onclick="return(confirmToDelete());">
                                                <i class="fa fa-trash-o"></i>
                                                </a>
                                                <a href="{{route('vehicle.type.edit', $types->type_id)}}" class="btn btn-success" onclick="return(confirmToEdit());">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
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
