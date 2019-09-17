<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<title>Glorious Homes</title>
<link rel="stylesheet" type="text/css" href="{{asset('design/css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('design/css/font-awesome.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('design/css/reality-icon.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('design/css/bootsnav.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('design/css/cubeportfolio.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('design/css/jquery.fancybox.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('design/css/owl.carousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('design/css/owl.transitions.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('design/css/settings.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('design/css/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('design/css/range-Slider.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('design/css/search.css')}}">
<link rel="icon" href="{{asset('house.png')}}">
</head>
    <body>
        
        <header class="layout_default">
            <div class="topbar grey">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <p>We are Best in Town With 40 years of Experience.</p>
                        </div>
                        <div class="col-md-7 text-right">
                            <ul class="breadcrumb_top text-right">
                                {{-- <li><a href="favorite_properties.html"><i class="icon-icons43"></i>Favorites</a></li> --}}
                                <li><a href="{{route('request.property')}}"><i class="icon-icons215"></i>Request Property</a></li>
                                {{-- <li><a href="my_properties.html"><i class="icon-icons215"></i>My Property</a></li>
                                <li><a href="profile.html"><i class="icon-icons230"></i>Profile</a></li> --}}
                                <li><a href="{{route('user.login')}}"><i class="icon-icons179"></i>Login / Register</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-upper">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 col-sm-12" style="margin-top:5px">
                            <div class="logo"><a href="">
                                <img title="" alt="" src="{{asset('house.png')}}" 
                                style="height:50px; width:100px"></a>
                            </div>
                        </div>
                        <!--Info Box-->
                        <div class="col-md-10 col-sm-12 right">
                            <div class="info-box first">
                                <div class="icons"><i class="icon-telephone114"></i></div>
                                <ul>
                                    <li><strong>Phone Number</strong></li>
                                    <li>+1 900 234 567 - 68</li>
                                </ul>
                            </div>
                            <div class="info-box">
                                <div class="icons"><i class="icon-icons74"></i></div>
                                <ul>
                                    <li><strong>Manhattan Hall,</strong></li>
                                    <li>Castle Melbourne, australia</li>
                                </ul>
                            </div>
                            <div class="info-box">
                                <div class="icons"><i class="icon-icons142"></i></div>
                                <ul>
                                    <li><strong>Email Address</strong></li>
                                    <li><a href="">info@realtyhomes.com</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-default navbar-sticky bootsnav">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="attr-nav">
                                <ul class="social_share clearfix">
                                    <li><a href="" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="google" href=""><i class="icon-google4"></i></a></li>
                                </ul>
                            </div>
                            <!-- Start Header Navigation -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                                <i class="fa fa-bars"></i>
                                </button>
                                <a class="navbar-brand sticky_logo" href="{{route('web.index')}}">
                                    <img src="{{asset('house.png')}}" class="logo" alt="" style="height:50px">
                                </a>
                            </div> <!-- End Header Navigation -->
                            <div class="collapse navbar-collapse" id="navbar-menu">
                                <ul class="nav navbar-nav" data-in="fadeIn" data-out="fadeOut">
                                    <li><a href="{{route('web.index')}}">Home</a></li>
                                    
                                    <li class="dropdown megamenu-fw">
                                        <a href="" class="dropdown-toggle" data-toggle="dropdown">Buy</a>
                                        <ul class="dropdown-menu megamenu-content" role="menu">
                                            <li>
                                                <div class="row">
                                                    <div class="col-menu col-md-3">
                                                        <h5 class="title">Commercial</h5>
                                                        <div class="content">
                                                            <ul class="menu-col">
                                                                @foreach(propcategories() as $propcategories)
                                                                    <li><a href="{{route('web.prop.buy', $propcategories->property_category_name)}}">
                                                                        {{ucwords($propcategories->property_category_name)}}</a></li>
                                                                @endforeach
                                                                {{-- <li><a href="">New Construction</a></li>
                                                                <li><a href="">Renovated House</a></li>
                                                                <li><a href="">Under Construction</a></li>
                                                                <li><a href="">Search by Category</a></li>
                                                                <li><a href="">Search by Type</a></li> --}}
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-menu col-md-9">
                                                        <h5 class="title bottom20">Commercial Properties for sales</h5>
                                                        <div class="row">
                                                            <div id="nav_slider" class="owl-carousel">
                                                                
                                                                @foreach(buy() as $buys)
                                                                    <div class="item">
                                                                        <div class="image bottom15"> 
                                                                            <img src="{{asset('property_cover_images/'.$buys->cover_image)}}" 
                                                                            style="height: 150px" alt=""> 
                                                                            <span class="nav_tag yellow text-uppercase">for Buy</span>
                                                                        </div>
                                                                        <h4><a href="{{route('web.prop.details', $buys->property_number)}}">{{$buys->property_name}}</a></h4>
                                                                        <p>{{$buys->state. ' State, '. $buys->lga . ' LGA'}}</p>
                                                                    </div>
                                                                @endforeach
                                                                
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown megamenu-fw">
                                        <a href="" class="dropdown-toggle" data-toggle="dropdown">Lease</a>
                                        <ul class="dropdown-menu megamenu-content" role="menu">
                                            <li>
                                                <div class="row">
                                                    <div class="col-menu col-md-3">
                                                        <h5 class="title">Residential</h5>
                                                        <div class="content">
                                                            <ul class="menu-col">
                                                                @foreach(propcategories() as $propcategories)
                                                                    <li><a href="{{route('web.prop.lease', $propcategories->property_category_name)}}">
                                                                        {{ucwords($propcategories->property_category_name)}}</a></li>
                                                                @endforeach
                                                                {{-- <li><a href="">New Construction</a></li>
                                                                <li><a href="">Renovated House</a></li>
                                                                <li><a href="">Under Construction</a></li>
                                                                <li><a href="">Search by Category</a></li>
                                                                <li><a href="">Search by Type</a></li> --}}
                                                            </ul>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="col-menu col-md-9">
                                                        <h5 class="title bottom20">List of Properties for Lease</h5>
                                                        <div class="row">
                                                            <div id="nav_slider" class="owl-carousel">
                                                                @foreach(lease() as $lease)
                                                                    <div class="item">
                                                                        <div class="image bottom15"> 
                                                                            <img src="{{asset('property_cover_images/'.$lease->cover_image)}}" 
                                                                            style="height: 150px" alt=""> 
                                                                            <span class="nav_tag yellow text-uppercase">for Lease</span>
                                                                        </div>
                                                                        <h4><a href="{{route('web.prop.details', $lease->property_number)}}">{{$lease->property_name}}</a></h4>
                                                                        <p>{{$lease->state. ' State, '. $lease->lga . ' LGA'}}</p>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown megamenu-fw">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Rent</a>
                                        <ul class="dropdown-menu megamenu-content bg" role="menu">
                                            <li>
                                                <div class="row">
                                                    
                                                    <div class="col-menu col-md-3">
                                                        <h5 class="title">PROPERTY CATEGORY</h5>
                                                        <div class="content">
                                                            <ul class="menu-col">
                                                                @foreach(propcategories() as $propcategories)
                                                                    <li><a href="{{route('web.prop.rent', $propcategories->property_category_name)}}">
                                                                    {{ucwords($propcategories->property_category_name)}}</a></li>
                                                                @endforeach
                                                                {{-- <li><a href="">Commercial</a></li>
                                                                <li><a href="">Residential</a></li>
                                                                <li><a href="">Land</a></li>
                                                                <li><a href="">Ware House</a></li> --}}
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-menu col-md-9">
                                                        <h5 class="title bottom20">List of Properties for Rent</h5>
                                                        <div class="row">
                                                            <div id="nav_slider" class="owl-carousel">
                                                                @foreach(rent() as $rent)
                                                                    <div class="item">
                                                                        <div class="image bottom15"> 
                                                                            <img src="{{asset('property_cover_images/'.$rent->cover_image)}}" style="height: 150px" alt=""> 
                                                                            <span class="nav_tag yellow text-uppercase">for Rent</span>
                                                                        </div>
                                                                        <h4><a href="{{route('web.prop.details', $rent->property_number)}}">{{$rent->property_name}}</a></h4>
                                                                        <p>{{$rent->state. ' State, '. $rent->lga. ' LGA'}}</p>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown megamenu-fw">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sell</a>
                                        <ul class="dropdown-menu megamenu-content bg" role="menu">
                                            <li>
                                                <div class="row">
                                                    <div class="col-menu col-md-3">
                                                        <h5 class="title">PROPERTY LISTINGS</h5>
                                                        <div class="content">
                                                            <ul class="menu-col">
                                                                @foreach(propcategories() as $propcategories)
                                                                    <li><a href="{{route('web.prop.sell', $propcategories->property_category_name)}}">
                                                                        {{ucwords($propcategories->property_category_name)}}</a></li>
                                                                @endforeach
                                                                {{-- <li><a href="">New Construction</a></li>
                                                                <li><a href="">Renovated House</a></li>
                                                                <li><a href="">Under Construction</a></li>
                                                                <li><a href="">Commercial</a></li>
                                                                <li><a href="">Residential</a></li>
                                                                <li><a href="">Land</a></li>
                                                                <li><a href="">Ware House</a></li> --}}
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-menu col-md-9">
                                                        <h5 class="title bottom20">List of Properties for Sale</h5>
                                                        <div class="row">
                                                            <div id="nav_slider" class="owl-carousel">
                                                                @foreach(sell() as $sell)
                                                                    <div class="item">
                                                                        <div class="image bottom15"> 
                                                                            <img src="{{asset('property_cover_images/'.$sell->cover_image)}}" style="height: 150px" alt=""> 
                                                                            <span class="nav_tag yellow text-uppercase">for Sell</span>
                                                                        </div>
                                                                        <h4><a href="{{route('web.prop.details', $sell->property_number)}}">{{$sell->property_name}}</a></h4>
                                                                        <p>{{$sell->state. ' State, '. $sell->lga . ' LGA'}}</p>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown megamenu-fw">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Agent</a>
                                        <ul class="dropdown-menu megamenu-content bg" role="menu">
                                            <li>
                                                <div class="row">
                                                    <div class="col-menu col-md-3">
                                                        <h5 class="title">OUR AGENTS</h5>
                                                        <div class="content">
                                                            <ul class="menu-col">
                                                                <li><a href="{{route('agent')}}">View Agents</a></li>
                                                                <li><a href="{{route('agent.finder')}}">Agent Finder</a></li>
                                                                {{-- <li><a href="">Register</a></li>
                                                                <li><a href="{{route('user.login')}}">Sign In</a></li> --}}
                                                                @foreach(agentlistcategories() as $cate)
                                                                    <li><a href="">{{ucwords($cate->agent_category_name)}}</a></li>
                                                                @endforeach
                                                                {{-- <li><a href="">FAQ</a></li>
                                                                <li><a href="">Subscription</a></li>
                                                                <li><a href="">Terms and Condition</a></li>
                                                                <li><a href="">Agent Categories</a></li> --}}
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-menu col-md-3">
                                                        <h5 class="title">OUR AGENTS</h5>
                                                        <div class="content">
                                                            <ul class="menu-col">
                                                                @foreach(agentcategories() as $cat)
                                                                    <li><a href="">{{ucwords($cat->agent_category_name)}}</a></li>
                                                                @endforeach
                                                                
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-menu col-md-6">
                                                        <h5 class="title bottom20">List of Our Verified Agent</h5>
                                                        <div class="row">
                                                            <div id="nav_slider" class="owl-carousel">
                                                                @foreach(listagent() as $list)
                                                                    <div class="item">
                                                                        <div class="image bottom15"> 
                                                                            <img src="{{asset('agent-passport/'.$list->passport)}}" 
                                                                            style="height:100px; " alt=""> 
                                                                            {{-- <span class="nav_tag yellow text-uppercase">Agent</span> --}}
                                                                        </div>
                                                                        <h4><a href="{{route('agent.details', $list->email)}}">
                                                                            {{substr($list->agent_name, 0, 15)}}..</a></h4>
                                                                        <p>{{$list->email}}</p>
                                                                    </div>
                                                                @endforeach
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown megamenu-fw">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Properties</a>
                                        <ul class="dropdown-menu megamenu-content bg" role="menu">
                                            <li>
                                                <div class="row">
                                                    <div class="col-menu col-md-3">
                                                        <h5 class="title">PROPERTY LISTINGS</h5>
                                                        <div class="content">
                                                            <ul class="menu-col">
                                                                <li><a href="{{route('web.property')}}">All Properties</a></li>
                                                                @foreach(propcategories() as $propcategories)
                                                                    <li><a href="{{route('web.prop.cate', $propcategories->property_category_name)}}">
                                                                        {{ucwords($propcategories->property_category_name)}}</a></li>
                                                                @endforeach
                                                                {{-- <li><a href="">Sold</a></li>
                                                                <li><a href="">Booked</a></li>
                                                                <li><a href="">Feature Properties</a></li>
                                                                <li><a href="">Search By Localtion</a></li> --}}
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-menu col-md-9">
                                                        <h5 class="title bottom20">List of all Properties for Sale, Lease, Rent and Sell</h5>
                                                        <div class="row">
                                                            <div id="nav_slider" class="owl-carousel">
                                                                @foreach(prop() as $ogun)
                                                                    <div class="item">
                                                                        <div class="image bottom15"> 
                                                                            <img src="{{asset('property_cover_images/'.$ogun->cover_image)}}" 
                                                                            style="height: 150px" alt=""> 
                                                                            <span class="nav_tag yellow text-uppercase">for {{$ogun->purpose}}</span>
                                                                        </div>
                                                                        <h4><a href="{{route('web.prop.details', $ogun->property_number)}}">{{$ogun->property_name}}</a></h4>
                                                                        <p>{{$ogun->state. ' State, '. $ogun->lga . ' LGA '}}</p>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    
                                    <li><a href="">About Us</a></li>
                                    <li><a href="contact.html">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <div id="">
            
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    
        <!--Partners-->
        <section id="logos">
            <div class="container partner2 padding">
                <div class="row">
                    <div class="col-sm-10">
                        <h2 class="uppercase">Our Partners</h2>
                        <p class="heading_space">Aliquam nec viverra erat. Aenean elit tellus mattis quis maximus.</p>
                    </div>
                </div>
                <div class="row">
                    <div id="partner-slider" class="owl-carousel">
                        <div class="item">
                            <img src="{{asset('design/images/logo1.png')}}" alt="Featured Partner">
                        </div>
                        <div class="item">
                            <img src="{{asset('design/images/logo2.png')}}" alt="Featured Partner">
                        </div>
                        <div class="item">
                            <img src="{{asset('design/images/logo3.png')}}" alt="Featured Partner">
                        </div>
                        <div class="item">
                            <img src="{{asset('design/images/logo4.png')}}" alt="Featured Partner">
                        </div>
                        <div class="item">
                            <img src="{{asset('design/images/logo5.png')}}" alt="Featured Partner">
                        </div>
                        <div class="item">
                            <img src="{{asset('design/images/logo1.png')}}" alt="Featured Partner">
                        </div>
                        <div class="item">
                            <img src="{{asset('design/images/logo2.png')}}" alt="Featured Partner">
                        </div>
                        <div class="item">
                            <img src="{{asset('design/images/logo3.png')}}" alt="Featured Partner">
                        </div>
                        <div class="item">
                            <img src="{{asset('design/images/logo4.png')}}" alt="Featured Partner">
                        </div>
                        <div class="item">
                            <img src="{{asset('design/images/logo5.png')}}" alt="Featured Partner">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Partner Ends-->
        <footer class="footer_third">
            <div class="container contacts">
              <div class="row">
                <div class="col-sm-4 text-center">
                  <div class="info-box first">
                    <div class="icons"><i class="icon-telephone114"></i></div>
                    <ul class="text-center">
                      <li><strong>Phone Number</strong></li>
                      <li>+1 900 234 567 - 68</li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-4 text-center">
                  <div class="info-box">
                    <div class="icons"><i class="icon-icons74"></i></div>
                    <ul class="text-center">
                      <li><strong>Manhattan Hall,</strong></li>
                      <li>Castle Melbourne, australia</li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-4 text-center">
                  <div class="info-box">
                    <div class="icons"><i class="icon-icons142"></i></div>
                    <ul class="text-center">
                      <li><strong>Email Address</strong></li>
                      <li><a href="#.">info@castle.com</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="container padding_top">
              <div class="row">
                <div class="col-md-3 col-sm-6">
                  <div class="footer_panel bottom30">
                    <a href="#." class="logo bottom30"><img src="images/logo-white.png" alt="logo"></a>
                    <p class="bottom15">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh 
                      tempor cum consectetuer 
                      adipiscing.
                    </p>
                    <p class="bottom15">If you are interested in castle do not wait and <a href="#.">BUY IT NOW!</a></p>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6">
                  <div class="footer_panel bottom30">
                    <h4 class="bottom30 heading">Search by Area</h4>
                    <table style="width:100%;">
                      <tbody>
                        <tr>
                          <td>
                            <ul class="links">
                              <li><a href="#."><i></i>About</a></li>
                              <li class="active"><a href="#."><i></i>News</a></li>
                              <li><a href="#."> <i></i>Contacts</a></li>
                              <li><a href="#."><i></i>Testimonials</a></li>
                              <li><a href="#."><i></i>Typography</a></li>
                            </ul>
                          </td>
                          <td class="text-right">
                            <ul class="links text-left">
                              <li><a href="#."><i></i>Services</a></li>
                              <li class="active"><a href="#."><i></i>Careers</a></li>
                              <li><a href="#."><i></i>Our team</a></li>
                              <li><a href="#."><i></i>Shop</a></li>
                              <li><a href="#."><i></i>Our approach</a></li>
                            </ul>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6">
                  <div class="footer_panel bottom30">
                    <h4 class="bottom30 heading">Latest News</h4>
                    <div class="media bottom30">
                      <div class="media-body">
                        <a href="#.">Nearest mall in high tech Goes google map your villa</a>
                        <span><i class="icon-clock5"></i>Feb 22, 2017</span>
                      </div>
                    </div>
                    <div class="media">
                      <div class="media-body">
                        <a href="#.">Nearest mall in high tech Goes google map your villa</a>
                        <span><i class="icon-clock5"></i>Feb 22, 2017</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6">
                  <div class="footer_panel bottom30">
                    <h4 class="bottom30 heading">Subscribe</h4>
                    <p>Sign up with your email to get latest updates and offers</p>
                    <form class="top30">
                      <input class="search" placeholder="Enter your Email" type="search">
                      <a class="button_s" href="#">
                      <i class="icon-mail-envelope-open"></i>
                      </a>
                    </form>
                  </div>
                </div>
              </div>
              <!--CopyRight-->
              <div class="copyright_simple">
                <div class="row">
                  <div class="col-md-6 col-sm-5 top20 bottom20">
                    <p>Copyright &copy; <?php echo date('Y'); ?> <span>Glorious Empire Estate</span>. All rights reserved.</p>
                  </div>
                  <div class="col-md-6 col-sm-7 text-right top15 bottom10">
                    <ul class="social_share">
                      <li><a href="#." class="facebook"><i class="icon-facebook-1"></i></a></li>
                      <li><a href="#." class="twitter"><i class="icon-twitter-1"></i></a></li>
                      <li><a href="#." class="google"><i class="icon-google4"></i></a></li>
                      <li><a href="#." class="linkden"><i class="fa fa-linkedin"></i></a></li>
                      <li><a href="#." class="vimo"><i class="icon-vimeo3"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </footer>
        <!--Footer-->
        
        <!--CopyRight-->
        
        <script src="{{asset('design/js/jquery-2.1.4.js')}}"></script> 
        <script src="{{asset('design/js/bootstrap.min.js')}}"></script> 
        <script src="{{asset('design/js/bootsnav.js')}}"></script>
        <script src="{{asset('design/js/jquery.parallax-1.1.3.js')}}"></script>
        <script src="{{asset('design/js/jquery.appear.js')}}"></script>
        <script src="{{asset('design/js/jquery-countTo.js')}}"></script>
        <script src="{{asset('design/js/masonry.pkgd.min.js')}}"></script>
        <script src="{{asset('design/js/jquery.cubeportfolio.min.js')}}"></script>
        <script src="{{asset('design/js/range-Slider.min.js')}}"></script>
        <script src="{{asset('design/js/owl.carousel.min.js')}}"></script> 
        <script src="{{asset('design/js/selectbox-0.2.min.js')}}"></script>
        <script src="{{asset('design/js/zelect.js')}}"></script>
        <script src="{{asset('design/js/jquery.fancybox.js')}}"></script>
        <script src="{{asset('design/js/jquery.themepunch.tools.min.js')}}"></script>
        <script src="{{asset('design/js/jquery.themepunch.revolution.min.js')}}"></script>
        <script src="{{asset('design/js/revolution.extension.layeranimation.min.js')}}"></script>
        <script src="{{asset('design/js/revolution.extension.navigation.min.js')}}"></script>
        <script src="{{asset('design/js/revolution.extension.parallax.min.js')}}"></script>
        <script src="{{asset('design/js/revolution.extension.slideanims.min.js')}}"></script>
        <script src="{{asset('design/js/revolution.extension.video.min.js')}}"></script>
        <script src="{{asset('styling/assets/js/localgovernments.js') }}"></script>
        <script src="{{asset('design/js/neary-by-place.js')}}"></script> 
        <script src="{{asset('design/js/editor.js')}}"></script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAOBKD6V47-g_3opmidcmFapb3kSNAR70U&amp;libraries=places"></script> 
<script src="{{asset('design/js/google-map.js')}}"></script> 
        <script src="{{asset('design/js/functions.js')}}"></script>
        <script src="{{asset('design/js/custom.js')}}"></script>
    </body>

</html>
      
      

    <script>
      function confirmToDelete(){
          return confirm("Click Okay to Delete Details and Cancel to Stop");
      }
    </script>

    <script>
      function confirmToEdit(){
          return confirm("Click Okay to Edit and Cancel to Stop");
      }
    </script>

    <script>
      function confirmToRestore(){
          return confirm("Click Okay to Restore The Deleted Data and Cancel to Stop");
      }
    </script>
    <script>
      function confirmToProp(){
          return confirm("Click Okay to View The Agent Property and Cancel to Stop");
      }
    </script>

    <script>
      function confirmToDetails(){
          return confirm("Click Okay to View More Details and Cancel to Stop");
      }
    </script>



    
    
  </body>
</html>