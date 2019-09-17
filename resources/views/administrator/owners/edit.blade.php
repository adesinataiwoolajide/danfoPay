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
                        <a href="{{route('owner.edit',$own->owner_id)}}">Edit Owners</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('owner.create')}}">View Owners</a>
                    </li>
                    @if(auth()->user()->hasRole('Administrator'))
                        <li class="breadcrumb-item"><a href="{{route('owner.restore')}}">Recycle Bin</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">List of Saved Owners </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> Please Fill The Below Form To Add A New Owner</div>
                    <div class="card-body">
                        @include('partials._message')
                        <form action="{{route('owner.update', $own->owner_id)}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group row ">
                                <div class="col-sm-4">
                                    <label>Owner Name</label>
                                    <input type="text" name="name" class="form-control form-control-rounded" required
                                    placeholder="Enter The Owner Name" value="{{$own->name}}">
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
                                    <label>Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control form-control-rounded" required
                                    placeholder="Enter The Owner's Phone Number" readonly value="{{$own->phone_number}}">
                                    <span style="color: red">** This Field is Required **</span>
                                    @if ($errors->has('phone_number'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <div class="alert-icon contrast-alert">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="alert-message">
                                                <span><strong>Error!</strong> {{ $errors->first('phone_number') }} !</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-sm-4">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control form-control-rounded" required
                                    placeholder="Enter The Owner's Address">{{$own->address}}</textarea>
                                    <span style="color: red">** This Field is Required **</span>
                                    @if ($errors->has('address'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <div class="alert-icon contrast-alert">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="alert-message">
                                                <span><strong>Error!</strong> {{ $errors->first('address') }} !</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <input type="hidden" name="owner_number" value="{{$own->owner_number}}">
                                <input type="hidden" name="owner_id" value="{{$own->owner_id}}">



                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success btn-lg btn-block" style="border:none">
                                        UPDATE THE OWNER</button>
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
                    @if(count($owner) ==0)
                        <div class="card-header" align="center" style="color: red"><i class="fa fa-table"></i>
                            The List is Empty
                        </div>

                    @else
                        <div class="card-header"><i class="fa fa-table"></i> List of Saved Owners</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="default-datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Owner Name</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Owner Name</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                        </tr>
                                    </tfoot>
                                    <tbody><?php
                                        $y=1; ?>
                                        @foreach($owner as $owners)
                                        <tr>

                                            <td>{{$y}}
                                                <a href="{{route('owner.delete', $owners->owner_id)}}" class="btn btn-danger"
                                                     onclick="return(confirmToDelete());">
                                                <i class="fa fa-trash-o"></i>
                                                </a>
                                                <a href="{{route('owner.edit', $owners->owner_id)}}" class="btn btn-success"
                                                    onclick="return(confirmToEdit());">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            </td>
                                            <td>{{$owners->name}}</td>
                                            <td>{{$owners->phone_number}}</td>
                                            <td>{{$owners->address}}</td>

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
