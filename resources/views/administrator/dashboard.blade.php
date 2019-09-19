@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
            @include('partials._message')
            @if(( Auth::user()->email_verified_at) == "")
                <div class="card mt-12 gradient-orange" style="color:white">
                    <div class="media-body" align="center">

                        <span class="text-white" align="center">You Have Not Verify Your Account,<br>
                             Please Kindly Visit Your E-Mail for the verification link</span>
                    </div>

                </div>
            @else
                @if (Gate::allows('Administrator', auth()->user()) OR (auth()->user()->hasRole('Admin')))
                    <div class="card mt-3 gradient-dusk">
                        <div class="card-content">
                            <div class="row row-group m-0"  style="cursor: pointer">
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" onclick="location.href=''">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white">0</h4>
                                                <span class="text-white">System <br>Users</span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="icon-basket-loaded text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:50%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" onclick="location.href=''">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white">0</h4>
                                                <span class="text-white">Vehicle<br> MGT</span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="icon-user text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:50%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" onclick="location.href=''">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white">0</h4>
                                                <span class="text-white">Owners  <br>MGT</span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="icon-pie-chart text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:50%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" onclick="location.href=''">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white">0</h4>
                                                <span class="text-white">Operators <br> MGT</span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="icon-bell text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:50%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3 gradient-army">
                        <div class="card-content">
                            <div class="row row-group m-0"  style="cursor: pointer">
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" onclick="location.href=''">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white">0</h4>
                                                <span class="text-white">Total <br>Revenue</span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="icon-basket-loaded text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:50%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" onclick="location.href=''">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white">0</h4>
                                                <span class="text-white">Total<br> Customers</span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="icon-user text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:50%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" onclick="location.href=''">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white">0</h4>
                                                <span class="text-white">Offence  <br>Categories</span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="icon-pie-chart text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:50%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" onclick="location.href=''">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white">0</h4>
                                                <span class="text-white">Customer <br> Wallet</span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="icon-bell text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:50%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3 gradient-forest">
                        <div class="card-content">
                            <div class="row row-group m-0"  style="cursor: pointer">
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" onclick="location.href=''">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white">0</h4>
                                                <span class="text-white">Total <br>Revenue</span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="icon-basket-loaded text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:50%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" onclick="location.href=''">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white">0</h4>
                                                <span class="text-white">Total<br> Transactions</span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="icon-user text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:50%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" onclick="location.href=''">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white">0</h4>
                                                <span class="text-white">  <br></span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="icon-pie-chart text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:50%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" onclick="location.href=''">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white">0</h4>
                                                <span class="text-white"> <br> </span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="icon-bell text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:50%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif (auth()->user()->hasRole('Customer'))
                    <div class="row mt-3">

                        <div class="col-12 col-lg-6 col-xl-3">
                            <div class="card gradient-yoda">
                                <div class="card-body">
                                    <h5 class="text-white mb-0">
                                        @if(count($balance) ==0)
                                            0
                                        @else
                                            {{number_format($single->total_amount)}}
                                        @endif
                                        <span class="float-right"> &#8358;</span>
                                    </h5>
                                    <div class="progress my-3" style="height:3px;">
                                        <div class="progress-bar" style="width:100%"></div>
                                    </div>
                                    <p class="mb-0 text-white small-font">{{$customer->customer_number}}
                                    <span class="float-right"> <i class="fa fa-vcard"></i></span></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 col-xl-3">
                            <div class="card gradient-ohhappiness">
                                <div class="card-body">
                                    <h5 class="text-white mb-0">{{count($fundTransfer)}} <span class="float-right"><i class="fa fa-eye"></i></span></h5>
                                    <div class="progress my-3" style="height:3px;">
                                        <div class="progress-bar" style="width:100%"></div>
                                    </div>
                                <p class="mb-0 text-white small-font">Fund Transfer <span class="float-right">
                                    <i class="fa fa-money"></i></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-3">
                            <div class="card gradient-ibiza">
                                <div class="card-body">
                                    <h5 class="text-white mb-0">{{count($payment)}} <span class="float-right"><i class="fa fa-bank"></i></span></h5>
                                    <div class="progress my-3" style="height:3px;">
                                        <div class="progress-bar" style="width:100%"></div>
                                    </div>
                                <p class="mb-0 text-white small-font">Transactions <span class="float-right"><i class="fa fa-barcode"></i></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-3">
                            <div class="card gradient-orange">
                                <div class="card-body">
                                    <h5 class="text-white mb-0">0 <span class="float-right"><i class="fa fa-car"></i></span></h5>
                                    <div class="progress my-3" style="height:3px;">
                                        <div class="progress-bar" style="width:100%"></div>
                                    </div>
                                <p class="mb-0 text-white small-font">Total Trips <span class="float-right">
                                    <i class="fa fa-grav"></i></span></p>
                                </div>
                            </div>
                        </div>
                    </div><!--End Row-->

                    <div class="card mt-3 gradient-forest">
                        <div class="card-content">
                            <div class="row row-group m-0"  style="cursor: pointer">
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" onclick="location.href=''">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white">0</h4>
                                                <span class="text-white">Total Money</span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="icon-user text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:50%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" onclick="location.href=''">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white">0</h4>
                                                <span class="text-white">My Wallet</span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="icon-basket-loaded text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:50%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" onclick="location.href=''">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white">0</h4>
                                                <span class="text-white">My Transactions</span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="icon-pie-chart text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:50%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" onclick="location.href=''">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white">0</h4>
                                                <span class="text-white">My Details </span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="icon-bell text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:50%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif
            @endif
        </div>

    </div>
@endsection
