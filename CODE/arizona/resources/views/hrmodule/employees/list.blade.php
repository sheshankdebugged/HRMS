@include('template.admin_header')
<div class="main-section">
	<div class="container">
        <div class="row">
			<div class="inner-main-section">
				<div class="col-md-12 col-sm-12">
					<div class="left-bar-request nopadding">
						<div class="sidebar-menu">
                        @include('template.employees_nav_icon')
						</div>
					</div>
            
					<div class="right-bar-request">
						<div class="request-section">
							<div class="main-heading">
								<div class="inner-heading-request">
									<h2>{{ $pageTitle }}</h2>
								</div>
								<div class="settings-buttons">
									<ul>
										<li>
											<a href="{{ url('employeessettings') }}" alt="Dashboard"><i class="fa fa-cog"></i></a>
										</li>
										
									</ul>
								</div>
                            
							</div>

                            @if(Session::get('message'))
                            <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Success! {{Session::get('message')}}
                            </div>
                            @endif
							<div class="request-inner-table">
								<div class="upper-header-request">
									<div class="col-md-12 nopadding">
										<div class="col-md-4 nopadding">
											<h3>{{ $pageTitle }}</h3>
										</div>
                             	<div class="col-md-8 nopadding">
											<!-- <div class="search-area-request">
												<input type="text" placeholder="Quick Search...">
												<button><i class="fa fa-search"></i></button>
											</div> -->
											<form id="search" name="search" method="get" />
											<div class="search-area-request">
												<input type="text" placeholder="Quick Search..."  name="search" class="search" id="search" value="{{isset($_GET['search'])?$_GET['search']:''}} "/>
												<button style="cursor:pointer"><i class="fa fa-search"></i></button>
											</div>
									
											<div class="filter-btn-request"> 
											 <a href="{{ url('employees') }}" alt="Dashboard"><i class="fa fa-refresh"></i></a>
										    </div>
											<div class="add-record-btn">
												<a href="{{ url('employees/add') }}"><i class="fa fa-plus"></i>Add Record</a>
											</div>
											
											<div class="add-record-btn">
												<a href="{{ url('#') }}">Employee Roles</a>
											</div>
											<div class="add-record-btn">
												<a href="{{ url('employeegroups') }}">Employee Groups</a>
											</div>
										</div>
										
										
									</div>
								</div>
								<div class="inner-table-main" style="min-height:590px;">
								<div class="inner-table-main" style="min-height:590px;">
									<table id="requesttab" border="0" cellspacing="0" cellpadding="3" width="100%" align="center">
									 <thead>
									  <tr>
										  <td style="background-color:#0c64ae; " class="thbackgroud"><a style="color:#fff; " href="#">Employee name</a></td>
										  <td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">Designation</a></td>
										  <td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">Department</a></td>
										  <td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">Station</a></td>
										  <td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">User Name</a></td>
										  <td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">Access Code</a></td>
										  <td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">Joining Date</a></td>
									      <td style="background-color:#0c64ae; width:1%;"></td>
									  </tr>
									</thead>
										<tbody>
                                        @foreach($listData as $list)
											<tr id="second" class="context-requst-one selected">
											<td class="datainner" style="">{{$list->employee_name}}</td>
											<td class="datainner" style="">{{$list->designation}}</td>
											<td class="datainner" style="">{{$list->department}}</td>                       
											<td class="datainner" style="">{{$list->station}}</td>                       
											<td class="datainner" style="">{{$list->user_name}}</td>                       
											<td class="datainner" style="">{{$list->access_code}}</td>                       
											<td class="datainner" style="">{{$list->joining_date}}</td>                       
											<td align="right">
												<div class="dropdown action-drop">
													<a href="javascript:void(0);" class="dropdown-custom"><i style="font-size:16px;" class="fa fa-cog"></i></a>
													<ul class="dropdown-menu">
														<!-- <li><a href="#"><i class="fa fa-folder-open"></i>View Record</a></li> -->
														<li><a href="{{url('/employees/edit')}}/{{$list->id}}"><i class="fa fa-edit"></i>Edit Record</a></li>
														<!-- <li><a href="#"><i class="fa fa-sticky-note"></i>Notes</a></li> -->
														<li><a href="{{url('/employees/delete/')}}/{{$list->id}}" onclick="return confirm('Are you sure to want delete this?')"><i class="fa fa-times"></i>Delete Record</a></li>
													</ul>
												</div>
											</td> 
										</tr>
                                        @endforeach

                                        <!-- <tr>
                     <td colspan="6"> <div class="pull-right"> {{ $listData->links() }} </div> </td>
                     </tr> -->
										</tbody>
												</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@include('template.admin_footer')
