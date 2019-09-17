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
                        <li class="breadcrumb-item"><a href="{{route('owner.restore')}}">Recycle Bin</a></li>
                    @endif
                    <li class="breadcrumb-item">
                        <a href="{{route('owner.create')}}">View Owners</a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">List of Deleted Owners </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                @include('partials._message')
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
                                                <a href="{{route('owner.undelete', $owners->owner_id)}}"
                                                    onclick="return(confirmToRestore());" class="btn btn-danger">
                                                    <i class="fa fa-trash-o"></i>
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
