@include('template.admin_header')
<div class="main-section">
	<div class="container">
        <div class="row">
			<div class="inner-main-section">
				<div class="col-md-12 col-sm-12">
					<div class="left-bar-request nopadding">
						<div class="sidebar-menu">
                        @include('template.organisation_nav_icon')
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
										<!-- <li>
											<a href="#" alt="Dashboard"><i class="fa fa-cog"></i></a>
										</li>
										<li>
											<a href="#" alt="Dashboard"><i class="fa fa-question-circle"></i></a>
										</li> -->
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
								 <form id="search" name="search" method="get">
											<div class="search-area-request">
												<input type="text" placeholder="Quick Search..."  name="search" class="search" id="search" value="{{isset($_GET['search'])?$_GET['search']:''}} "/>
												<button style="cursor:pointer"><i class="fa fa-search"></i></button>
											</div>
											</form>
											<div class="filter-btn-request">
												<!-- <a href="#" alt="Dashboard"><i class="fa fa-filter"></i></a> -->
												<a href="{{ url('manageleavestypes') }}" alt="Dashboard"><i class="fa fa-refresh"></i></a>
											</div>
											<div class="add-record-btn">
												<a href="{{ url('leavessettings/add') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
											<div class="add-record-btn">
												<a href="{{ url('manageleavestypes/add') }}"><i class="fa fa-plus"></i>Add Leave Type</a>
											</div>
											
										</div>
										
									</div>
								</div>
								<div class="inner-table-main" style="min-height:590px;">
								<div class="inner-table-main" style="min-height:590px;">
									<table id="requesttab" border="0" cellspacing="0" cellpadding="3" width="100%" align="center">
									 <thead>
									  <tr>
										  <!-- <td style="background-color:#0c64ae; " class="thbackgroud"><a style="color:#fff; " href="#">S#</a></td> -->
										  <td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">Title</a></td>
										  <td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">Leave Type</a></td>
										  <td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">Leaves Allowed Per Year</a></td>
										  <td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">	Station</a></td>
										  <td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">	Company</a></td>
										  <!-- <td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">	Approval Status</a></td> -->

										  <td style="background-color:#0c64ae; width:1%;"></td>
									  </tr>
									</thead>
										<tbody>
                                        @foreach($listData as $list)
											<tr id="second" class="context-requst-one selected">
											<!-- <td class="datainner" style="">{{$list->title}}</td> -->
											<td class="datainner" style="">{{$list->title}}</td>
											<td class="datainner" style="">{{$list->leave_type_id}}</td>  
											<td class="datainner" style="">{{$list->leave_allowed}}</td>
											<td class="datainner" style="">{{$list->station_id}}</td>
											<td class="datainner" style="">{{$list->company_id}}</td>
											<!-- <td class="datainner" style="">{{$list->approval_status}}</td> -->
											                      
											<td align="right">
												<div class="dropdown action-drop">
													<a href="javascript:void(0);" class="dropdown-custom"><i style="font-size:16px;" class="fa fa-cog"></i></a>
													<ul class="dropdown-menu">
														<!-- <li><a href="#"><i class="fa fa-folder-open"></i>View Record</a></li> -->
														<li><a href="{{url('/manageleavestypes/edit')}}/{{$list->id}}"><i class="fa fa-edit"></i>Edit Record</a></li>
														<!-- <li><a href="#"><i class="fa fa-sticky-note"></i>Notes</a></li> -->
														<li><a href="{{url('/manageleavestypes/delete/')}}/{{$list->id}}" onclick="return confirm('Are you sure to want delete this?')"><i class="fa fa-times"></i>Delete Record</a></li>
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
