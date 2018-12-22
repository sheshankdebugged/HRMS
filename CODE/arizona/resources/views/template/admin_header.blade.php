<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon.ico">
    <title>Web HR - Dashboard</title>
    <!-- Bootstrap -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('/admin/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/admin/css/custome.css') }}">
    <link href="{{ url('/admin/css/datepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
</head>
<body>

<!-- header start -->
<header>
    <div class="header-top">
        <div class="container">
            <div class="row">

                <div class="col">
                    <div class="logo">
                        <img src="{{ url('admin/images/WebHR.svg') }}" style="">
                    </div>
                </div>

                <div class="col d-none d-sm-block" align="center">
                    <!--img src="images/demo_OdCFED.png" border="0" class="img-fluid" style="height:64px;"-->
				  <h1 style="font-size:18px;margin-top: 20px;">Arizona National Software</h1>

                </div>

                <div class="col rtl2">
                    <div class="header-top-right navbar">

                        <div class="comment">
                            <a href="#" style="text-decoration:none;"><i class="fa fa-comment-o" aria-hidden="true"></i></a>
                        </div>

                        <div class="notification" style="margin-left:26px; margin-right:26px;">
                            <a href="#noanchor" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <i class="fa fa-bell-o" aria-hidden="true"></i>
                            </a>
                        </div>



                        <div class="profile_link dropdown">
                          <a class="dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ url('admin/images/user.jpg') }}" alt="{{ Auth::user()->name }}" width="40" />
                          </a>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                            <a class="dropdown-item" href="setting.html"><i class="material-icons">perm_identity</i> My Profile</a>
                            <a class="dropdown-item" href="setting.html"><i class="material-icons">settings</i> Account Setting</a>
                            <a class="dropdown-item"  href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="material-icons">power_settings_new</i> Logout</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                          </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-expand-sm sticky header-section">
        <div class="container navbar-collapse d-none d-sm-block header-main">
            <ul class="rtl navbar-nav mr-auto header-menu">
                <li>   
                    <a href="#" class="nav-link">
                        <i id="navHome_Icon" class="fa fa-home"></i>
                    </a>  
                </li>
                <li class="dropdown">
                    <a href="#" class="nav-link">
                        <i class="fa fa-id-card-o"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left">
                        <div class="sub-menu-title">Organization</div>

                        <div class="d-block menu-list">
                           <div class="row">
                              <div class="col-sm-6 list-unstyled">
                                 <a href="#"><i class="fa fa-dashboard"></i>Companies</a>
                                 <a href="#"><i class="fa fa-desktop" style="margin-right:12px; font-size:18px;"></i>Stations</a>
                                 <a href="#noanchor"><i class="fa fa-envelope-open"></i>Job Requests</a>
                                 <a href="#noanchor"><i class="fa fa-envelope-o"></i>Job Posts</a>
                                 <a href="#noanchor"><i class="fa fa-male"></i>Job Candidates</a>
                              </div>
                              <div class="col-sm-6 list-unstyled">
                                    <a href="#noanchor"><i class="fa fa-clipboard"></i>Job Tests</a>
                                    <a href="#noanchor"><i class="fa fa-comments"></i>Job Interviews</a>
                              </div>
                           </div>
                        </div>

                    </div>
                </li>

                <li class="dropdown">
                    <a href="#" class="nav-link">
                        <i class="fa fa-id-card-o"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left">
                        <div class="sub-menu-title">Recruitment</div>

                        <div class="d-block menu-list">
                           <div class="row">
                              <div class="col-sm-6 list-unstyled">
                                 <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
                                 <a href="#"><i class="fa fa-desktop" style="margin-right:12px; font-size:18px;"></i>Screening</a>
                                 <a href="#noanchor"><i class="fa fa-envelope-open"></i>Job Requests</a>
                                 <a href="#noanchor"><i class="fa fa-envelope-o"></i>Job Posts</a>
                                 <a href="#noanchor"><i class="fa fa-male"></i>Job Candidates</a>
                              </div>
                              <div class="col-sm-6 list-unstyled">
                                    <a href="#noanchor"><i class="fa fa-clipboard"></i>Job Tests</a>
                                    <a href="#noanchor"><i class="fa fa-comments"></i>Job Interviews</a>
                              </div>
                           </div>
                        </div>

                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>


<!-- header end -->