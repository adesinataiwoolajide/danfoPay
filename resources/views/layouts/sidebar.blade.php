<div id="wrapper">
    <div id="sidebar-wrapper" class="bg-theme bg-theme4" data-simplebar="" data-simplebar-auto-hide="true">
        <div class="brand-logo">
            <a href="{{route('administrator.dashboard')}}">
                <h5 class="logo-text">Danfo Pay</h5>
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
                    <li>
                        <a href="{{route('administrator.dashboard')}}" class="waves-effect">
                            <i class="zmdi zmdi-view-dashboard text-success"></i> <span>Dashboard</span>
                            <small class="badge float-right badge-light">
                                <i class="zmdi zmdi-long-arrow-right"></i>
                            </small>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('user.create')}}" class="waves-effect">
                            <i class="fa fa-user text-success"></i> <span>Users</span>
                            <small class="badge float-right badge-light">
                                <i class="zmdi zmdi-long-arrow-right"></i>
                            </small>
                        </a>
                    </li>
                    <li>
                        <a href="javaScript:void();" class="waves-effect">
                            <i class="fa fa-car text-success"></i>
                            <span>Vehicle Mgt</span>
                            <i class="fa fa-angle-left pull-right text-danger"></i>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{route('vehicle.type.create')}}"><i class="zmdi zmdi-long-arrow-right"></i> Types</a></li>
                            <li><a href="{{route('owner.create')}}"><i class="zmdi zmdi-long-arrow-right"></i> Owners</a></li>
                            <li><a href="{{route('vehicle.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> Cars</a></li>
                            <li><a href="{{route('operator.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> Operators</a></li>

                        </ul>
                    </li>
                    <li>
                        <a href="javaScript:void();" class="waves-effect">
                            <i class="fa fa-users text-success"></i>
                            <span>Customer Mgt</span>
                            <i class="fa fa-angle-left pull-right text-danger"></i>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{route('customer.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> Customer</a></li>
                            <li><a href="{{route('customer.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> Wallet</a></li>
                            <li><a href="{{route('balance.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> Balances</a></li>

                        </ul>
                    </li>
                    <li>
                        <a href="{{route('payment.index')}}" class="waves-effect">
                            <i class="fa fa-money text-success"></i> <span>Transactions</span>
                            <small class="badge float-right badge-light">
                                <i class="zmdi zmdi-long-arrow-right"></i>
                            </small>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('balance.index')}}" class="waves-effect">
                            <i class="fa fa-list text-success"></i> <span> Balances</span>
                            <small class="badge float-right badge-light">
                                <i class="zmdi zmdi-long-arrow-right"></i>
                            </small>
                        </a>
                    </li>

                    <li>
                        <a href="" class="waves-effect">
                            <i class="fa fa-cloud text-success"></i> <span>My Log</span>
                            <small class="badge float-right badge-light"><i class="zmdi zmdi-long-arrow-right"></i></small>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.logout') }}" class="waves-effect">
                            <i class="zmdi zmdi-lock text-success"></i> <span>Log Out</span>
                            <small class="badge float-right badge-light"><i class="zmdi zmdi-long-arrow-right"></i></small>
                        </a>
                    </li>
                @elseif (auth()->user()->hasRole('Customer'))
                    <li>
                        <a href="{{route('customer.index')}}" class="waves-effect">
                            <i class="fa fa-users text-success"></i> <span>My Details</span>
                            <small class="badge float-right badge-light">
                                <i class="zmdi zmdi-long-arrow-right"></i>
                            </small>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('balance.index')}}" class="waves-effect">
                            <i class="fa fa-money text-success"></i> <span>My Balance</span>
                            <small class="badge float-right badge-light">
                                <i class="zmdi zmdi-long-arrow-right"></i>
                            </small>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('payment.index')}}" class="waves-effect">
                            <i class="fa fa-table text-success"></i> <span>Transactions</span>
                            <small class="badge float-right badge-light">
                                <i class="zmdi zmdi-long-arrow-right"></i>
                            </small>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('fund.transfer.index')}}" class="waves-effect">
                            <i class="fa fa-users text-success"></i> <span>Fund Transfer</span>
                            <small class="badge float-right badge-light">
                                <i class="zmdi zmdi-long-arrow-right"></i>
                            </small>
                        </a>
                    </li>


                    <li>
                        <a href="{{route('customer.index')}}" class="waves-effect">
                            <i class="fa fa-car text-success"></i> <span>My Trip</span>
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
                <li>
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

                <h4 align="center"><p >DANFOPAY</p></h4>
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
