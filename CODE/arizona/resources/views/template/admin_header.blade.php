<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon.ico">
    <title>Arizona HR - Dashboard</title>
    <!-- Bootstrap -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('/admin/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/admin/css/custome.css') }}">
    <link href="{{ url('/admin/css/datepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=a57gf21fw3xkb4vsipclijy1rlihz8b4rz5un8vg1n7xzbbq"></script>
    <script>tinymce.init({ selector:'.tinyeditorclass' });</script>

    <!--
Username: debug86d
Password: @7tN$i2cF5~5
    -->
</head>
<body>

<!-- header start -->
<header class="an-header-main">
    <div class="header-top">
        <div class="container">
            <div class="row">

                <div class="col">
                    <div class="logo">
                       <a href="{{url('dashboard')}}"> <img src="{{ url('admin/images/Arizona-original-Logo.png') }}" style="width: 85px"> </a>
                    </div>
                </div>

                <div class="col d-none d-sm-block" align="center">
                    <!--img src="images/demo_OdCFED.png" border="0" class="img-fluid" style="height:64px;"-->
				  <h1 style="font-size:18px;margin-top: 40px;">Arizona National Software</h1>

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
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog" style="background-color:#205275"> 
                            <a class="dropdown-item" href="{{url('setting')}}"><i class="material-icons">perm_identity</i> My Profile</a>
                            <a class="dropdown-item" href="{{url('setting')}}"><i class="material-icons">settings</i> Account Setting</a>
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
                    <a href="{{url('dashboard')}}" class="nav-link">
                        <i id="navHome_Icon" class="fa fa-home"></i>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="nav-link">
                        <i class="fa  fa-cog"></i>
                    </a>
                    
                    <div class="dropdown-menu dropdown-menu-left">
                        <div class="sub-menu-title">Organization</div>

                        <div class="d-block menu-list">
                           <div class="row">
                              <div class="col-sm-6 list-unstyled">
                                 <a href="{{url('companies')}}"><i class="fa fa-clone"></i>Companies</a>
                                 <a href="{{url('stations')}}"><i class="fa fa-building" style="margin-right:12px; font-size:18px;"></i>Stations</a>
                                 <a href="{{url('departments')}}"><i class="fa fa-sitemap"></i>Departments</a>
                                 <a href="{{url('projects')}}"><i class="fa fa-archive"></i>Projects</a>
                                 <a href="{{url('organizationnews')}}"><i class="fa fa-newspaper-o"></i>Organization News</a>
                              </div>
                              <div class="col-sm-6 list-unstyled">
                                  
                                  
                                    <a href="{{url('setting')}}"><i class="fa fa-cogs"></i>System Settings</a>
                                    <a href="#noanchor"><i class="fa fa-file-o"></i>System Logs</a>
                                    
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
                                 <a href="{{url('jobrequests')}}"><i class="fa fa-envelope-open"></i>Job Requests</a>
                                 <a href="{{url('jobposts')}}"><i class="fa fa-envelope-o"></i>Job Posts</a>
                                 <a href="{{url('jobcandidates')}}"><i class="fa fa-male"></i>Job Candidates</a>
                              </div>
                              <div class="col-sm-6 list-unstyled">
                                    <a href="{{url('jobtests')}}"><i class="fa fa-clipboard"></i>Job Tests</a>
                                    <a href="{{url('jobinterviews')}}"><i class="fa fa-comments"></i>Job Interviews</a>
                              </div>
                           </div>
                        </div>

                    </div>
                </li>

                <li class="dropdown">
                    <a href="#" class="nav-link">
                        <i class="fa fa-group"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left">
                        <div class="sub-menu-title">Employees</div>

                        <div class="d-block menu-list">
                           <div class="row">
                              <div class="col-sm-6 list-unstyled">
                                 <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
                                 <a href="{{url('employees')}}"><i class="fa fa-group"></i>Employees</a>
                                 <a href="{{url('onboarding')}}"><i class="fa fa-sign-in"></i>Onboarding</a>
                                 <a href="{{url('contracts')}}"><i class="fa fa-file"></i>Contracts</a>
                                 <a href="{{url('assignments')}}"><i class="fa fa-briefcase"></i>Assignments</a>
                                 <a href="{{url('transfers')}}"><i class="fa fa-refresh"></i>Transfers</a>
                                 <a href="{{url('resignations')}}"><i class="fa fa-edit"></i>Resignations</a>
                                 <a href="{{url('polls')}}"><i class="fa fa-pie-chart"></i>Polls</a>
                                 <a href="{{url('employeesexit')}}"><i class="fa fa-sign-out"></i>Employees Exit</a>
                                                                  
                              </div>
                              <div class="col-sm-6 list-unstyled">
                                    <a href="{{url('achievements')}}"><i class="fa fa-trophy"></i>Achievements</a>
                                    <a href="{{url('travels')}}"><i class="fa fa-plane"></i>Travels</a>
                                    <a href="{{url('promotions')}}"><i class="fa fa-star"></i>Promotions</a>
                                    <a href="{{url('complaints')}}"><i class="fa fa-exclamation-circle"></i>Complaints</a>
                                    <a href="{{url('warnings')}}"><i class="fa fa-exclamation-triangle"></i>Warnings</a>
                                    <a href="{{url('memos')}}"><i class="fa fa-edit"></i>Memos</a>
                                    <a href="{{url('terminations')}}"><i class="fa fa-times"></i>Terminations</a>
                              </div>
                           </div>
                        </div>

                    </div>
                </li>



                <li class="dropdown">
                    <a href="#" class="nav-link">
                    <i class="fa fa-adjust"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left">
                        <div class="sub-menu-title">Time Sheet</div>

                        <div class="d-block menu-list">
                           <div class="row">
                              <div class="col-sm-6 list-unstyled">
                                 <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
                                 <a href="{{url('scheduler')}}"><i class="fa fa-group"></i>Scheduler</a>
                                 <a href="{{url('attendance')}}"><i class="fa fa-sign-in"></i>Attendance</a>
                                 <a href="{{url('employeehours')}}"><i class="fa fa-file"></i>Employee Hours</a>
                                 <a href="{{url('leaves')}}"><i class="fa fa-briefcase"></i>Leaves</a>
                                
                                                                  
                              </div>
                              <div class="col-sm-6 list-unstyled">
                                    <a href="{{url('worksheet')}}"><i class="fa fa-trophy"></i>Worksheet</a>
                                    <a href="{{url('workshifts')}}"><i class="fa fa-plane"></i>Work Shifts</a>
                                    <a href="{{url('holidays')}}"><i class="fa fa-star"></i>Holidays</a>
                                   
                              </div>
                           </div>
                        </div>

                    </div>
                </li>

                <li class="dropdown">
                    <a href="#" class="nav-link">
                    <i class="fa fa-calculator"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left">
                        <div class="sub-menu-title">Payroll</div>

                        <div class="d-block menu-list">
                           <div class="row">
                              <div class="col-sm-6 list-unstyled">
                                 <a href="#"><i class="fa fa-columns"></i></i>Dashboard</a>
                                 <a href="{{url('salary')}}"><i class="fa fa-bitcoin"></i>Salary</a>
                                 <a href="{{url('salarypayslips')}}"><i class="fa fa-bitcoin"></i>Salary Payslips</a>
                                 <a href="{{url('payrollsetup')}}"><i class="fa fa-coins"></i>Payroll Setup</a>
                                 <a href="{{url('hourlywages')}}"><i class="fa fa-briefcase"></i>Hourly Wages</a>
                                 <a href="{{url('overtimes')}}"><i class="fa fa-briefcase"></i>Overtimes</a>
                                 <a href="{{url('providentfunds')}}"><i class="fa fa-briefcase"></i>Provident Fund</a>
                                 <a href="{{url('advancesalary')}}"><i class="fa fa-briefcase"></i>Advance Salary</a>
                                 <a href="{{url('loans')}}"><i class="fa fa-briefcase"></i>Loans</a>
                                 <a href="{{url('insurance')}}"><i class="fa fa-briefcase"></i>Insurance</a>
                                
                                                                  
                              </div>
                              <div class="col-sm-6 list-unstyled">
                                    <a href="{{url('deductions')}}"><i class="fa fa-trophy"></i>Deductions</a>
                                    <a href="{{url('bonuses')}}"><i class="fa fa-plane"></i>Bonuses</a>
                                    <a href="{{url('commissions')}}"><i class="fa fa-star"></i>Commissions</a>
                                    <a href="{{url('adjustments')}}"><i class="fa fa-star"></i>Adjustments</a>
                                    <a href="{{url('reimbursements')}}"><i class="fa fa-star"></i>Reimbursements</a>

                                   
                              </div>
                           </div>
                        </div>

                    </div>
                </li>

                <li class="dropdown">
                    <a href="#" class="nav-link">
                    <i class="fa fa-file"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left">
                        <div class="sub-menu-title">Reports</div>

                        <div class="d-block menu-list">
                           <div class="row">
                              <div class="col-sm-6 list-unstyled">
                                 <a href="{{url('hrreports')}}"><i class="fa fa-columns"></i></i>HR Reports</a>
                                 <a href="{{url('recruitmentreports')}}"><i class="fa fa-bitcoin"></i>Recruitment Reports</a>
                                 <a href="{{url('employeesreports')}}"><i class="fa fa-bitcoin"></i>Employees Reports</a>
                                 <a href="{{url('timesheetreports')}}"><i class="fa fa-coins"></i>Timesheet Reports</a>
                                 <a href="{{url('payrollreports')}}"><i class="fa fa-briefcase"></i>Payroll Reports</a>
                                                               
                                                                  
                              </div>
                              <div class="col-sm-6 list-unstyled">
                                    <a href="{{url('trainingsreports')}}"><i class="fa fa-trophy"></i>Trainings Reports/a>
                                    <a href="{{url('graphs')}}"><i class="fa fa-plane"></i>Graphs</a>
                                    <a href="{{url('reportsgenerator')}}"><i class="fa fa-star"></i>Reports Generator</a>
                                    <a href="{{url('addonmodulesreports')}}"><i class="fa fa-star"></i>Add On Modules Reports</a>

                                   
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
