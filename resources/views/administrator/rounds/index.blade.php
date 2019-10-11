@extends('layouts.app')

@section('content')

<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row pt-2 pb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('round.index')}}">Rounds</a></li>
                    <li class="breadcrumb-item active" aria-current="page">List of Rounds</li>

                </ol>
            </div>
        </div>
        @if(auth()->user()->hasRole('Administrator') OR(auth()->user()->hasRole('Customer')) OR (auth()->user()->hasRole('Operator')))
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        @if(count($round) ==0)
                            <div class="card-header" align="center" style="color: red"><i class="fa fa-table"></i>
                                Rounds List is Empty
                            </div>

                        @else
                            <div class="card-header"><i class="fa fa-table"></i>
                                @if(auth()->user()->hasRole('Operator'))
                                    My Vehicle Rounds
                                @elseif(auth()->user()->hasRole('Owner'))
                                    My Vehicle Rounds
                                @else
                                All Vehicle Rounds
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="default-datatable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Plate Number</th>
                                                <th>Vehicle Number</th>
                                                <th>Current Balance</th>

                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Plate Number</th>
                                                <th>Vehicle Number</th>
                                                <th>Current Balance</th>

                                            </tr>
                                        </tfoot>
                                        <tbody><?php
                                            $y=1; ?>

                                            @foreach($round as $rounds)
                                                <tr>

                                                    <td>{{$y}}</td>

                                                    <td>{{$rounds->motto->plate_number}}</td>
                                                    <td>{{$rounds->motto->vehicle_number}}</td>
                                                    <td>
                                                        @if($rounds->current_balance < 1000)
                                                            <p style="color:red">&#8358;{{number_format($rounds->current_balance)}} </p>
                                                        @else
                                                            <p style="color:green">&#8358;{{number_format($rounds->current_balance)}} </p>
                                                        @endif

                                                    </td>
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
        @else
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        @if(count($car) ==0)
                            <div class="card-header" align="center" style="color: red"><i class="fa fa-table"></i>
                                {{$own->name}} No Vehicle Was Found For You
                            </div>

                        @else
                            <div class="card-header"><i class="fa fa-table"></i>

                                All My Vehicle Rounds

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="default-datatable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Plate Number</th>
                                                <th>Vehicle Number</th>
                                                <th>Current Balance</th>

                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Plate Number</th>
                                                <th>Vehicle Number</th>
                                                <th>Current Balance</th>

                                            </tr>
                                        </tfoot>
                                        <tbody><?php
                                            $y=1; ?>

                                            @foreach($car as $cars)
                                                @foreach (dOwnnerRounds($cars->vehicle_id) as $rounds)

                                                    <tr>
                                                        <td>{{$y}}</td>
                                                        @foreach (dOwnnerMoto($rounds->vehicle_id) as $item)
                                                            <td>{{$item->plate_number}}</td>
                                                            <td>{{$item->vehicle_number}}</td>
                                                        @endforeach

                                                        <td>
                                                            @if($rounds->current_balance < 1000)
                                                                <p style="color:red">&#8358;{{number_format($rounds->current_balance)}} </p>
                                                            @else
                                                                <p style="color:green">&#8358;{{number_format($rounds->current_balance)}} </p>
                                                            @endif
                                                        </td>
                                                    </tr><?php $y++; ?>
                                                    @endforeach
                                            @endforeach

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

        @endif

    </div>
</div>

<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
@endsection
