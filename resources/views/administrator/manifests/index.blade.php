@extends('layouts.app')

@section('content')

<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row pt-2 pb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('manifest.index')}}">Manifest</a></li>
                    <li class="breadcrumb-item active" aria-current="page">List of Manifest</li>

                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    @if(count($manifest) ==0)
                        <div class="card-header" align="center" style="color: red"><i class="fa fa-table"></i>
                            Manifest List is Empty
                        </div>

                    @else
                        <div class="card-header"><i class="fa fa-table"></i>
                            @if(auth()->user()->hasRole('Administrator'))
                                List of All Customers Manifests

                            @elseif(auth()->user()->hasRole('Operator'))
                                My Vehicle Manifests
                            @elseif(auth()->user()->hasRole('Owner'))
                                My Vehicle Manifests
                            @else
                                My Manifests
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="default-datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>From</th>
                                            <th>Destination </th>
                                            <th>Amount</th>
                                            <th>Customer</th>
                                            <th>Vehicle</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S/N</th>
                                            <th>From</th>
                                            <th>Destination </th>
                                            <th>Amount</th>
                                            <th>Customer</th>
                                            <th>Vehicle</th>

                                        </tr>
                                    </tfoot>
                                    <tbody><?php
                                        $y=1; ?>

                                        @foreach($manifest as $manifests)
                                            <tr>

                                                <td>{{$y}}

                                                </td>
                                                <td>{{$manifests->nego->from_destination}}</td>
                                                <td>{{$manifests->nego->to_destination}}</td>
                                                <td>&#8358;{{number_format($manifests->amount)}}</td>
                                                <td>{{$manifests->cos->email}}</td>
                                                <td>{{$manifests->nego->car->plate_number}}</td>


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
