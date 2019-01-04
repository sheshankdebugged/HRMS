@include('template.admin_header')
<div class="main-section">
	<div class="container">
        <div class="row">
			<div class="inner-main-section">
				<div class="col-md-12 col-sm-12">
					<div class="left-bar-request nopadding">
						<div class="sidebar-menu">
                        @include('template.timesheet_nav_icon')
						</div>
					</div>

					<div class="right-bar-request">
						<div class="request-section">
							<div class="main-heading">
								<div class="inner-heading-request">
									<h2>{{ $pageTitle }}</h2>
								</div>

								<!-- <div class="settings-buttons">
									<ul>
										<li>
											<a href="#" alt="Dashboard"><i class="fa fa-cog"></i></a>
										</li>
										<li>
											<a href="#" alt="Dashboard"><i class="fa fa-question-circle"></i></a>
										</li>
									</ul>
								</div> -->
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
												<input type="text" placeholder="Search..."  name="search" class="search" id="search" value="{{isset($_GET['search'])?$_GET['search']:''}} "/>
												<button style="cursor:pointer"><i class="fa fa-search"></i></button>
											</div>
											</form>
											<div class="filter-btn-request">
												<a href="{{ url('multipleattendance') }}" alt="Dashboard"><i class="fa fa-refresh"></i></a>
											</div>
											<!-- <div style="">&nbsp;&nbsp;<button id="" type="button" onclick="jsOpenWindow('#', 800, 600);" class="add-record-btn" style="">Time Clock</button>&nbsp;&nbsp;<button id="" type="button" onclick="AjaxPage('', 'divContainerMain');" class="add-record-btn" style="">Multiple Attendance</button></div> -->
											<div class="add-record-btn">
												<a href="{{ url('attendance') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>

										</div>

									</div>
								</div>
								<div class="inner-table-main" style="min-height:590px;">
								<div class="inner-table-main" style="min-height:590px;">
									<table id="requesttab" border="0" cellspacing="0" cellpadding="3" width="100%" align="center">
									 <thead>
									  <tr>
										  <td style="background-color:#0c64ae;" class="thbackgroud">
										  <input id ="checkAll" type="checkbox">
										  </td>
										  <td style="background-color:#0c64ae; " class="thbackgroud"><a style="color:#fff; " href="#">User Name</a></td>
										  <td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">Employee Name</a></td>
										  <td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">Designation</a></td>
										  <td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">Department</a></td>
										  <td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">Station</a></td>
										  <td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">Company</a></td>
									  </tr>
									</thead>
										<tbody>
                                        @foreach($listData as $list)
											<tr id="second" class="context-requst-one selected">
												<td class="datainner" style=""><input id ="{{$list->id}}" type="checkbox"></td>
												<td class="datainner" style="">{{$list->user_name}}</td>
												<td class="datainner" style="">{{$list->employee_name}}</td>
												<td class="datainner" style="">{{$list->employee_designation_id}}</td>
												<td class="datainner" style="">{{$list->department_id}}</td>
												<td class="datainner" style="">{{$list->station_id}}</td>
												<td class="datainner" style="">{{$list->company_id}}</td>
											</tr>
                                        @endforeach

                                        <!-- <tr>
                     <td colspan="6"> <div class="pull-right"> {{ $listData->links() }} </div> </td>
                     </tr> -->
										</tbody>
												</table>
								</div>
							</div>
							<div class="form-group">
												   <label>Attendance Start Date:</label>
												   <!-- <select id="Transfer Date" name="employee_category" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Employee Category 1</option></select> -->
													<!-- <input type="text" placeholder="Transfer Date" class="form-control-spacial" id="transfer_date" name="transfer_date" value="{{isset($result->transfer_date)?$result->transfer_date:''}}"> -->
													<input type="text" placeholder="" class="form-control-spacial date" id="attendance_date" name="attendance_date" value="{{isset($result->attendance_date)?$result->attendance_date:''}}">
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->
												 </div>
												 <div class="form-group">
												   <label>Attendance End Date:</label>
												   <!-- <select id="Transfer Date" name="employee_category" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Employee Category 1</option></select> -->
													<!-- <input type="text" placeholder="Transfer Date" class="form-control-spacial" id="transfer_date" name="transfer_date" value="{{isset($result->transfer_date)?$result->transfer_date:''}}"> -->
													<input type="text" placeholder="" class="form-control-spacial date" id="attendance_date" name="attendance_date" value="{{isset($result->attendance_date)?$result->attendance_date:''}}">
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->
												 </div>
												 <div class="form-group">
												   <label>Sign In Time:</label>
												   <input type="time" placeholder="" class="form-control-spacial" id="sign_in_time" name="sign_in_time" value="{{isset($result->sign_in_time)?$result->sign_in_time:''}}">
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>

												 <div class="form-group">

												   <label>Sign Out Time:</label>
												   <input type="time" placeholder="" class="form-control-spacial" id="sign_out_time" name="sign_out_time" value="{{isset($result->sign_out_time)?$result->sign_out_time:''}}">
												 </div>
												  <div class="form-group">
												   <label>Lunch Break Out Time:</label>
												   <input type="time" placeholder="" class="form-control-spacial" id="lunch_break_out_time" name="lunch_break_out_time" value="{{isset($result->lunch_break_out_time)?$result->lunch_break_out_time:''}}">
												 </div>
												 <div class="form-group">
												    <label>Lunch Break In Time:</label>
													<input type="time" placeholder="" class="form-control-spacial" id="lunch_break_in_time" name="lunch_break_in_time" value="{{isset($result->lunch_break_in_time)?$result->lunch_break_in_time:''}}">
												 </div>
												 <div class="form-group">
												   <label>Additional Break Out Time:</label>
												   <input type="time" placeholder="" class="form-control-spacial" id="additional_break_out_time" name="additional_break_out_time" value="{{isset($result->additional_break_out_time)?$result->additional_break_out_time:''}}">
												 </div>
												 <div class="form-group">
												   <label>Additional Break In Time:</label>
												   <input type="time" id="datetimepicker3" placeholder="" class="form-control-spacial" id="additional_break_in_time" name="additional_break_in_time" value="{{isset($result->additional_break_in_time)?$result->additional_break_in_time:''}}">
												  </div>
												   <div class="form-group">
												   <label>Extra Break Out Time:</label>
												   <input type="time" placeholder="" class="form-control-spacial" id="extra_break_out_time" name="extra_break_out_time" value="{{isset($result->extra_break_out_time)?$result->extra_break_out_time:''}}">
 												 </div>
												 <div class="form-group">
												   <label>Extra Break In Time:</label>
												   <input type="time" placeholder="" class="form-control-spacial" id="extra_break_in_time" name="extra_break_in_time" value="{{isset($result->extra_break_in_time)?$result->extra_break_in_time:''}}">
												 </div>

										<div class="form-group">
												 <label>Record Added By:</label>
												System Administrator
												</div>


												<div class="form-group">
												 <label>Record Added On:</label>

												 @php
												 $date  = date("F j, Y, g:i a");

												 @endphp
												 {{$date}}
												</div>
												<div class="form-group">
													<input class="add-record-btn" type="submit" value="Add Multiple Attendance">
												</div>
												<div class="back-button">
											<div class="add-record-btn">
												<a href="{{ url('attendance') }}"><i class="fa fa-angle-left"></i>Back</a>
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
