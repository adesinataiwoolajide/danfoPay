<div id="wrapper">
    @if(auth()->user()->hasRole('Customer'))
        <div id="sidebar-wrapper" class="bg-theme gradient-forest" data-simplebar="" data-simplebar-auto-hide="true">
    @elseif(auth()->user()->hasRole('Administrator'))
        <div id="sidebar-wrapper" class="bg-theme bg-theme4" data-simplebar="" data-simplebar-auto-hide="true">
    @else
        <div id="sidebar-wrapper" class="bg-theme bg-theme4" data-simplebar="" data-simplebar-auto-hide="true">
    @endif
        <div class="brand-logo">
            <a href="{{route('administrator.dashboard')}}">
                <h5 class="logo-text">DanfoPay <i class="fa fa-car"></i></h5>
            </a>
        </div>

        <ul class="sidebar-menu do-nicescrol">
            <li class="sidebar-header">MAIN NAVIGATION</li>
            @if(( Auth::user()->email_verified_at) == ""))
                <li>
                    <a href="{{ route('verification.resend') }}" class="waves-effect">
                        <i class="zmdi zmdi-view-dashboard text-danger"></i> <span>Resend Link </span>
                        <small class="badge float-right badge-light">
                            <i class="zmdi zmdi-long-arrow-right"></i>
                        </small>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.logout') }}" class="waves-effect">
                        <i class="zmdi zmdi-lock text-danger"></i> <span>Log Out</span>
                        <small class="badge float-right badge-light"><i class="zmdi zmdi-long-arrow-right"></i></small>
                    </a>
                </li>

            @else
                @if (Gate::allows('Administrator', auth()->user()) OR (auth()->user()->hasRole('Admin')))
                    <li class="active">
                        <a href="{{route('administrator.dashboard')}}" class="waves-effect">
                            <i class="zmdi zmdi-view-dashboard text-success"></i> <span>Dashboard</span>
                            <small class="badge float-right badge-light">
                                <i class="zmdi zmdi-long-arrow-right"></i>
                            </small>
                        </a>
                    </li>

                    <li class="active">
                        <a href="{{route('user.create')}}" class="waves-effect">
                            <i class="fa fa-user text-success"></i> <span>Users</span>
                            <small class="badge float-right badge-success">
                                {{-- @if(count($user) == 0)
                                    0
                                @else
                                    {{count($user)}}
                                @endif --}}
                            </small>
                        </a>
                    </li>
                    <li class="active">
                        <a href="javaScript:void();" class="waves-effect">
                            <i class="fa fa-car text-success"></i>
                            <span>Vehicle Mgt</span>
                            <i class="fa fa-angle-left pull-right text-danger"></i>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{route('vehicle.type.create')}}"><i class="zmdi zmdi-long-arrow-right"></i> Types
                                <small class="badge float-right badge-success">
                                    {{-- @if(count($type) == 0)
                                        0
                                    @else
                                        {{count($type)}}
                                    @endif --}}
                                </small></a>
                            </li>
                            <li><a href="{{route('owner.create')}}">
                                <i class="zmdi zmdi-long-arrow-right"></i>Owner <small class="badge float-right badge-success">
                                    {{-- @if(count($owner) == 0)
                                        0
                                    @else
                                        {{count($owner)}}
                                    @endif --}}
                                </small>
                            </a></li>
                            <li><a href="{{route('vehicle.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> Cars
                                <small class="badge float-right badge-success">
                                    {{-- @if(count($vehicle) == 0)
                                        0
                                    @else
                                        {{count($vehicle)}}
                                    @endif --}}
                                </small>
                            </a></li>
                            <li><a href="{{route('operator.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> Operators
                                <small class="badge float-right badge-success">
                                    {{-- @if(count($operator) == 0)
                                        0
                                    @else
                                        {{count($operator)}}
                                    @endif --}}
                                </small>
                            </a></li>

                        </ul>
                    </li>
                    <li class="active">
                        <a href="javaScript:void();" class="waves-effect">
                            <i class="fa fa-users text-success"></i>
                            <span>Customer Mgt</span>
                            <i class="fa fa-angle-left pull-right text-danger"></i>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{route('customer.index')}}"><i class="fa fa-plus"></i> Registration
                                <small class="badge float-right badge-success">
                                    {{-- {{count($customer)}} --}}
                                </small>
                            </a></li>
                            <li><a href="{{route('payment.index')}}"><i class="fa fa-credit-card"></i> Transaction
                                <small class="badge float-right badge-success">
                                    {{-- {{count($payment)}} --}}
                                </small>
                            </a></li>
                            <li><a href="{{route('balance.index')}}"><i class="fa fa-money"></i> Balances
                                <small class="badge float-right badge-success">
                                    {{-- {{count($balance)}} --}}
                                </small>
                            </a></li>
                            <li><a href="{{route('balance.index')}}"><i class="fa fa-bank"></i> Fund Transfer
                                <small class="badge float-right badge-success">
                                    {{-- {{count($fundTransfer)}} --}}
                                </small>
                            </a></li>

                        </ul>
                    </li>


                    <li class="active">
                        <a href="{{ route('admin.logout') }}" class="waves-effect">
                            <i class="zmdi zmdi-lock text-success"></i> <span>Log Out</span>
                            <small class="badge float-right badge-light"><i class="fa fa-lock" align="center"></i></small>
                        </a>
                    </li>
                @elseif (auth()->user()->hasRole('Customer'))
                    <li class="active">
                        <a href="{{route('customer.index')}}" class="waves-effect">
                            <i class="fa fa-user text-success"></i> <span>My Details</span>
                            <small class="badge float-right badge-light">
                                <i class="fa fa-address-card-o"></i>
                            </small>
                        </a>
                    </li>

                    <li class="active">
                        <a href="{{route('balance.index')}}" class="waves-effect">
                            <i class="fa fa-money text-success"></i> <span>Add Money </span>
                            <small class="badge float-right badge-success">1</small>
                        </a>
                    </li >
                    <li class="active">
                        <a href="{{route('payment.index')}}" class="waves-effect">
                            <i class="fa fa-credit-card text-success"></i> <span>Transactions</span>
                            <small class="badge float-right badge-success">

                                {{-- @if(count($payment) == 0)
                                    0
                                @else
                                    {{count($payment)}}
                                @endif --}}
                            </small>
                        </a>
                    </li>

                    <li class="active">
                        <a href="{{route('fund.transfer.index')}}" class="waves-effect">
                            <i class="fa fa-bank text-success"></i> <span>Fund Transfer</span>
                            <small class="badge float-right badge-success">

                                {{-- @if(count($fundTransfer) == 0)
                                    0
                                @else
                                    {{count($fundTransfer)}}
                                @endif --}}
                            </small>
                        </a>
                    </li>


                    <li class="active">
                        <a href="{{route('customer.index')}}" class="waves-effect">
                            <i class="fa fa-car text-success"></i> <span>My Trip</span>
                            <small class="badge float-right badge-success">0</small>
                        </a>
                    </li>

                    <li class="active">
                        <a href="{{ route('admin.logout') }}" class="waves-effect">
                            <i class="zmdi zmdi-lock text-danger"></i> <span>Log Out</span>
                            <small class="badge float-right badge-light"><i class="fa fa-lock" align="center"></i></small>
                        </a>
                    </li>



                @else
                <li class="active">
                    <a href="{{ route('admin.logout') }}" class="waves-effect">
                        <i class="zmdi zmdi-lock text-danger"></i> <span>Log Out</span>
                        <small class="badge float-right badge-light"><i class="zmdi zmdi-long-arrow-right"></i></small>
                    </a>
                </li>

                @endif

            @endif

        </ul>

    </div>

    <header class="topbar-nav">
        <nav class="navbar navbar-expand fixed-top">
            <ul class="navbar-nav mr-auto align-items-center">
                <li class="nav-item">
                        <a class="nav-link toggle-menu" href="">
                        <i class="icon-menu menu-icon"></i>
                        </a>
                </li>

                <h4 align="center"><p >DANFOPAY <i class="fa fa-car"></i></p></h4>
            </ul>
            <ul class="navbar-nav align-items-center right-nav-link">

                <li class="nav-item">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                        <span class="user-profile"><img src="{{asset('styling/assets/logo.png')}}" class="img-circle" alt="user avatar"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-item user-details">
                            <a href="">
                            <div class="media">
                                <div class="avatar"><img class="align-self-start mr-3" src="{{asset('styling/assets/logo.png')}}" alt="user avatar"></div>
                                <div class="media-body">
                                <h6 class="mt-2 user-title"><?php $name = Auth::user()->name; ?> {{ $name }}</h6>
                                <p class="user-subtitle"><?php $email = Auth::user()->email; ?> {{ $email }}</p>
                                </div>
                            </div>
                            </a>
                        </li>

                        <li class="dropdown-item"><a href="{{route('user.profile')}}"><i class="icon-user"></i>  My Profile</a></li>
                        <li class="dropdown-item"><a href="{{route('change.pasword')}}"><i class="icon-lock"></i> Change Password</a></li>
                        <li class="dropdown-item"><a href="{{ route('admin.logout') }}"><i class="icon-power"></i> Logout</a></li>

                    </ul>
                </li>
            </ul>


        </nav>
    </header>
    <div class="clearfix"></div>
