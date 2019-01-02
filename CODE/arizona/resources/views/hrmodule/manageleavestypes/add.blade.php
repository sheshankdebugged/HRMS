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
									<h2>{{$pageTitle}}</h2>
								</div>
								<!-- <div class="settings-buttons">
									<ul>
										<li>
											<a href="#" alt="Dashboard"><i class="fa fa-cog"></i></a>
										</li>
										<li>
											<a href="#" alt="Dashboard"><i class="fa fa-question-circle"></i></a>
										</li>
								</div> -->
							</div>
							<div class="request-inner-table">
								<div class="upper-header-request">
									<div class="col-md-12 nopadding">
										<div class="back-button">
											<div class="add-record-btn">
												<a href="{{ url('manageleavestypes') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Leave Type Information</h4>
									</div>
									<div class="form-subsets">

                                    @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <form method="post" action="{{ url('manageleavestypes/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">

											<div class="form-group">
												   <label>Title:</label>
												   <input type="text" class="form-control-spacial" placeholder="" id="title" name="title" value="{{isset($result->title)?$result->title:''}}" >
												   <a href="#" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="What would you like to call this Leave Type. For example: Annual Leaves, Paid Time Off (PTO), Sick Leaves, Maternity Leaves, Paternity Leaves, etc." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>

												   <!-- <select id="regular_hours" name="regular_hours" class="WebHRForm1 chosen-select"><option style="" value="{{isset($result->regular_hours)?$result->regular_hours:''}}">10</option></select> -->
												   <!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->
													<!-- <input type="text" placeholder="Contact Number" class="form-control-spacial" id="contact_number" name="contact_number" value="{{isset($result->contact_number)?$result->contact_number:''}}"> -->

												 </div>
												 <div class="form-group">
													<label>Leave Type:</label>
													<select id="st" class="WebHRForm1" style="width:180px;" name="leave_type_id">
													@foreach($master['LeaveTypesMaster'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->leave_type_id) && $result->leave_type_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
													@endforeach
													</select>
													<!-- <select id="request_approval_method" name="request_approval_method" class="WebHRForm1">
													<option style="" value="Head Office">Unpaid Leave</option>
													<option style="" value="Head Office">Paid Leave</option>
													<option style="" value="Head Office">Half Day Paid Leave</option>
													<option style="" value="Head Office">25% Paid Leave</option>
													<option style="" value="Head Office">75% Paid Leave</option>
													</select> -->
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>
												 <div class="form-group">
												   <label>Leaves Allowed Per Year:</label>
												   <input type="text" class="form-control-spacial" style="width: 50px" placeholder="1" id="leave_allowed" name="leave_allowed" value="{{isset($result->leave_allowed)?$result->leave_allowed:''}}" >
												   <a href="#" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="What would you like to set as the default Leaves Quota for each employee for this Leave Type. Please note that Leaves Quota for each Employee can be updated separately by going to Leaves Quota screen." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>

												   <!-- <select id="regular_hours" name="regular_hours" class="WebHRForm1 chosen-select"><option style="" value="{{isset($result->regular_hours)?$result->regular_hours:''}}">10</option></select> -->
												   <!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->
													<!-- <input type="text" placeholder="Contact Number" class="form-control-spacial" id="contact_number" name="contact_number" value="{{isset($result->contact_number)?$result->contact_number:''}}"> -->

												 </div>
												 <div class="form-group">
													<label>Leaves Duration Type:</label>
													<select id="st" class="WebHRForm1" style="width:180px;" name="leaves_duration_type_id">
													@foreach($master['LeaveDuration'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->leaves_duration_type_id) && $result->leaves_duration_type_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
													@endforeach
													</select>
													<!-- <option style="" value="Head Office">Half Day Paid Leave</option> -->
													<!-- <option style="" value="Head Office">25% Paid Leave</option> -->
													<!-- <option style="" value="Head Office">75% Paid Leave</option> -->
													</select>
													<a href="#" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Please select carry over limit as either number (e.g. 10), or percentage (e.g. 50)" data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>

													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>
											    <div class="form-upper-main">
										           <h4>Leave Quota Assignment</h4>
									            </div>
												<div class="form-group">
											<label>Leaves Quota Reset:</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox" id="leaves_quota_reset" name="leaves_quota_reset" value="{{isset($result->leaves_quota_reset)?$result->leaves_quota_reset:''}}">
		                                           <span class="slider round"></span>
												   </label>
												   <a href="#" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Reset Leaves Quota every year on a specific date. If enabled, Leaves Quota will reset each year and unused leaves from previous year will be carried over, if disabled, then Leaves will not reset on a specific date and leaves quota will be used from Joining Date onwards based on number of leaves allocated per year on accrual basis." data-original-title="" title="">
												   <i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i>
												   </a>

                                            </div>
												 <div class="form-group">
													<label>Leaves Quota Reset Date</label>
													<select id="st" class="WebHRForm1" style="width:180px;" name="leaves_quota_reset_date_id">
													<option style="" value="0">-</option>
													@foreach($master['LeavesQuotaResetDate'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->leaves_quota_reset_date_id) && $result->leaves_quota_reset_date_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
													@endforeach
													</select>
													<!-- <option style="" value="Head Office">-</option> -->

													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>
												 <div class="form-group">
											     <label>Allow Future Leaves:</label>
                                                 <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox" id="allow_future_leaves" name="allow_future_leaves" value="{{isset($result->allow_future_leaves)?$result->allow_future_leaves:''}}">
		                                           <span class="slider round"></span>
												   </label>
												   <a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Whether to allow employees to take leaves in future or not." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>

                                                </div>

												<div class="form-group">
											     <label>Per Year Quota Assignment:</label>
                                                 <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox" id="per_year_quota_assignment" name="per_year_quota_assignment" value="{{isset($result->per_year_quota_assignment)?$result->per_year_quota_assignment:''}}">
		                                           <span class="slider round"></span>
												   </label>
												   <a href="#" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Assign different leaves quota based on the number of years since employee's joining date. For example: assign 5 leaves quota in year 1, 10 in year 2 and so on. Up to 25 years of quota can be assigned." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
												   <a style="cursor:pointer" onclick="$('#divPerYearLeavesQuotaAssignment').toggle();">Show Options</a>
												   <div id="divPerYearLeavesQuotaAssignment" style="display: none;">
													<table id="tWebHR" style="width:60px;">
													<thead>
													<tr><td>Year</td><td>Quota Assignment</td></tr>
													</thead>
													<tbody><tr>
														<td>Year 1</td>
														<td><input type="text" id="pylqa_y1" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 1. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr><tr>
														<td>Year 2</td>
														<td><input type="text" id="pylqa_y2" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 2. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr><tr>
														<td>Year 3</td>
														<td><input type="text" id="pylqa_y3" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 3. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr><tr>
														<td>Year 4</td>
														<td><input type="text" id="pylqa_y4" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 4. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr><tr>
														<td>Year 5</td>
														<td><input type="text" id="pylqa_y5" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 5. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr><tr>
														<td>Year 6</td>
														<td><input type="text" id="pylqa_y6" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 6. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr><tr>
														<td>Year 7</td>
														<td><input type="text" id="pylqa_y7" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 7. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr><tr>
														<td>Year 8</td>
														<td><input type="text" id="pylqa_y8" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 8. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr><tr>
														<td>Year 9</td>
														<td><input type="text" id="pylqa_y9" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 9. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr><tr>
														<td>Year 10</td>
														<td><input type="text" id="pylqa_y10" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 10. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr><tr>
														<td>Year 11</td>
														<td><input type="text" id="pylqa_y11" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 11. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr><tr>
														<td>Year 12</td>
														<td><input type="text" id="pylqa_y12" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 12. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr><tr>
														<td>Year 13</td>
														<td><input type="text" id="pylqa_y13" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 13. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr><tr>
														<td>Year 14</td>
														<td><input type="text" id="pylqa_y14" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 14. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr><tr>
														<td>Year 15</td>
														<td><input type="text" id="pylqa_y15" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 15. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr><tr>
														<td>Year 16</td>
														<td><input type="text" id="pylqa_y16" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 16. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr><tr>
														<td>Year 17</td>
														<td><input type="text" id="pylqa_y17" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 17. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr><tr>
														<td>Year 18</td>
														<td><input type="text" id="pylqa_y18" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 18. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr><tr>
														<td>Year 19</td>
														<td><input type="text" id="pylqa_y19" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 19. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr><tr>
														<td>Year 20</td>
														<td><input type="text" id="pylqa_y20" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 20. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr><tr>
														<td>Year 21</td>
														<td><input type="text" id="pylqa_y21" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 21. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr><tr>
														<td>Year 22</td>
														<td><input type="text" id="pylqa_y22" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 22. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr><tr>
														<td>Year 23</td>
														<td><input type="text" id="pylqa_y23" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 23. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr><tr>
														<td>Year 24</td>
														<td><input type="text" id="pylqa_y24" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 24. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr><tr>
														<td>Year 25</td>
														<td><input type="text" id="pylqa_y25" class="WebHRForm1" value="" placeholder="" style="width:40px;">&nbsp;&nbsp;&nbsp;<a href="#noanchor" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum Leaves Quota Assignment for Year 25. To allow all leaves, please either leave this field blank or put the same value as Leaves Allowed Per Year" data-original-title="" title=""><i style="font-size:14px; color:#0c64ae;" class="fa fa-info-circle"></i></a></td>
														</tr>
														</tbody>
														</table>
														</div>
                                                </div>
												<div class="form-upper-main">
										           <h4>Leave Accrual</h4>
									            </div>

												 <div class="form-group">
													<label>Leaves Accrual:</label>
													<select id="st" class="WebHRForm1" style="width:180px;" name="leaves_accrual_id">
													<option style="" value="0">-</option>
													@foreach($master['LeavesAccrual'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->leaves_accrual_id) && $result->leaves_accrual_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
													@endforeach
													</select>
													<a href="#" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="This option defines how leaves quota is assigned to the employees. Click help icon after selecting each value to see what it does." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>

													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>

												 <div class="form-upper-main">
										           <h4>Leave Carry Over</h4>
									            </div>
												<div class="form-group">
											     <label>Leaves Carry Over:</label>
                                                 <label style="width:60px; !important" class="switch">
												 <input type="checkbox" id="leaves_carry_over" name="leaves_carry_over" value="{{isset($result->leaves_carry_over)?$result->leaves_carry_over:''}}">
		                                           <span class="slider round"></span>
												   </label>
												   <a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Carry over remaining leaves for this Leave Type to the next year on Leaves Quota Start Date." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>

                                                </div>


												 </div>
												 <div class="form-group">
													<label>Leaves Carry Over Limit:</label>
													<input type="text" class="form-control-spacial" style="width: 50px" placeholder="0" id="leaves_carryover_limit" name="leaves_carryover_limit" value="{{isset($result->leaves_carryover_limit)?$result->leaves_carryover_limit:''}}" >
													<select id="st" class="WebHRForm1" style="width:180px;" name="leaves_carry_typ_id">
													<!-- <option style="" value="0">-</option> -->
													@foreach($master['LeavesCarryOverLimit'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->leaves_carry_typ_id) && $result->leaves_carry_typ_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
													@endforeach
													</select>
												 </div>

												 <div class="form-upper-main">
										           <h4>Negative Leaves Quota</h4>
									            </div>
											<div class="form-group">
											<label>Negative Leaves Quota:</label>
                                                <label style="width:60px; !important" class="switch">
												<input type="checkbox" id="negative_leaves_quota" name="negative_leaves_quota" value="{{isset($result->negative_leaves_quota)?$result->negative_leaves_quota:''}}">
		                                           <span class="slider round"></span>
												   </label>
												   <a href="#" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Whether to allow Negative Leaves Quota for this Leave Type or not. This will allow Employees to request for a Leave, even when they don't have enough Leaves Quota available." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>

                                            </div>

											<div class="form-group">
												   <label>Negative Leaves Quota Limit:</label>
												   <input type="text" class="form-control-spacial" style="width: 50px" placeholder="0" id="negative_leaves_limit" name="negative_leaves_limit" value="{{isset($result->negative_leaves_limit)?$result->negative_leaves_limit:''}}" >
												   <a href="#" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum number of Negative Leaves an employee can apply for this leave. If set as 0 an employee can apply unlimited of nagative leaves." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>

												   <!-- <select id="regular_hours" name="regular_hours" class="WebHRForm1 chosen-select"><option style="" value="{{isset($result->regular_hours)?$result->regular_hours:''}}">10</option></select> -->
												   <!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->
													<!-- <input type="text" placeholder="Contact Number" class="form-control-spacial" id="contact_number" name="contact_number" value="{{isset($result->contact_number)?$result->contact_number:''}}"> -->

												 </div>
												 <div class="form-upper-main">
										           <h4>
												   Leaves Restrictions
												   <a href="#" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Restrictions to be applied on this Leave Type." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                                   </h4>
									            </div>
												<div class="form-group">
												   <label>Leaves Days Limit:</label>
												   <input type="text" class="form-control-spacial" style="width: 50px" placeholder="0" id="leaves_days_limit" name="leaves_days_limit" value="{{isset($result->leaves_days_limit)?$result->leaves_days_limit:''}}" >
												   <a href="#" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Number of days after which an employee can apply for this leave. If set as 0, then employees will be able to apply for this leave immediately. If set as 10, then employees will be able to apply for this leave 10 days after their joining date." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>

												   <!-- <select id="regular_hours" name="regular_hours" class="WebHRForm1 chosen-select"><option style="" value="{{isset($result->regular_hours)?$result->regular_hours:''}}">10</option></select> -->
												   <!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->
													<!-- <input type="text" placeholder="Contact Number" class="form-control-spacial" id="contact_number" name="contact_number" value="{{isset($result->contact_number)?$result->contact_number:''}}"> -->
												 </div>
												 <div class="form-group">
												   <label>Maximum Leave Days Allowed:</label>
												   <input type="text" class="form-control-spacial" style="width: 50px" placeholder="0" id="maximum_leave_allowed" name="maximum_leave_allowed" value="{{isset($result->maximum_leave_allowed)?$result->maximum_leave_allowed:''}}" >
												   <a href="#" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Maximum number of days can an employee request for this Leave Type in one leave request (at one instance). Default value is 0, that means, employees can take as many leaves depending upon their leaves quota." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>

												   <!-- <select id="regular_hours" name="regular_hours" class="WebHRForm1 chosen-select"><option style="" value="{{isset($result->regular_hours)?$result->regular_hours:''}}">10</option></select> -->
												   <!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->
													<!-- <input type="text" placeholder="Contact Number" class="form-control-spacial" id="contact_number" name="contact_number" value="{{isset($result->contact_number)?$result->contact_number:''}}"> -->
												 </div>
												 <div class="form-group">
													<label>Gender Restriction:</label>
													<select id="st" class="WebHRForm1" style="width:180px;" name="gender_restriction">
													<option style="" value="0">-</option>
													@foreach($master['GenderRestriction'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->gender_restriction) && $result->gender_restriction == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
													@endforeach
													</select>
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>
													<!-- <select id="employee" name="employee" class="WebHRForm1 chosen-select"><option style="" value="Head Office">1</option></select> -->
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->
													<!-- <input type="text" placeholder="Contact Person" class="form-control-spacial" id="registration_name" name="contact_person" value="{{isset($result->contact_person)?$result->contact_person:''}}"> -->

												 </div>
												 <div class="form-upper-main">
										           <h4>Additional Options</h4>
									            </div>
												<div class="form-group">
											 <label>Exclude Non Working Days:</label>
                                                <label style="width:60px; !important" class="switch">
												<input type="checkbox" id="exclude_non_working" name="exclude_non_working" value="{{isset($result->exclude_non_working)?$result->exclude_non_working:''}}">
		                                           <span class="slider round"></span>
											    </label>
												   <a href="#" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Exclude non working days (such as Saturday / Sunday) ? Working days are determined from Work Shift assigned to each employee. If this option is Enabled, then non-working days will not be counted towards leaves quota. For example, if an employee takes a leave from Friday to Monday, then only two days will be counted, instead of four (excluding Saturday and Sunday as non-working days.)" data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>

                                            </div>

											<div class="form-group">
											<label>Exclude Holidays:</label>
                                                <label style="width:60px; !important" class="switch">
												<input type="checkbox" id="exclude_holidays" name="exclude_holidays" value="{{isset($result->exclude_holidays)?$result->exclude_holidays:''}}">
		                                           <span class="slider round"></span>
	                                            </label>
												<a href="#" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Exclude Holidays from Leaves Quota ? Holidays are defined in Timesheet / Holidays module. If this option is Enabled, then holidays days will not be counted towards leaves quota." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>

                                            </div>
											<div class="form-group">
											<label>Prorata Quota Assignment:</label>
                                                <label style="width:60px; !important" class="switch">
												<input type="checkbox" id="prorata_quota" name="prorata_quota" value="{{isset($result->prorata_quota)?$result->prorata_quota:''}}">
		                                           <span class="slider round"></span>
	                                            </label>
												<a href="#" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Quota assignment will be pro-rata based. For example if 24 leaves are given in a calendar year starting from January 01, and an employee joins in the month of November, then 04 leaves will be assigned instead of 24 (2 for November and 2 for December)" data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>


                                            </div>
											<div class="form-group">
											<label>Disable Half Day Leaves</label>
                                                <label style="width:60px; !important" class="switch">
												<input type="checkbox" id="disable_half_day" name="disable_half_day" value="{{isset($result->disable_half_day)?$result->disable_half_day:''}}">
		                                           <span class="slider round"></span>
	                                            </label>
												<a href="#" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Disable option to allow employees to take Half Day Leaves" data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>

                                            </div>
											<div class="form-group">
											<label>Disable Hourly Leaves</label>
                                                <label style="width:60px; !important" class="switch">
												<input type="checkbox" id="disable_hourly_leaves" name="disable_hourly_leaves" value="{{isset($result->disable_hourly_leaves)?$result->disable_hourly_leaves:''}}">
		                                           <span class="slider round"></span>
	                                            </label>
												<a href="#" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Disable option to allow employees to take Hourly Leaves" data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>


                                            </div>
											<div class="form-group">
											<label>Disable Full Day Leaves</label>
                                                <label style="width:60px; !important" class="switch">
												<input type="checkbox" id="disable_full_day" name="disable_full_day" value="{{isset($result->disable_full_day)?$result->disable_full_day:''}}">
		                                           <span class="slider round"></span>
	                                            </label>
												<a href="#" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Disable option to allow employees to take Past Dates Leaves" data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>


                                            </div>
											<div class="form-group">
											<label>Show In Summary</label>
                                                <label style="width:60px; !important" class="switch">
												<input type="checkbox" id="show_in_summary" name="show_in_summary" value="{{isset($result->show_in_summary)?$result->show_in_summary:''}}">
		                                           <span class="slider round"></span>
	                                            </label>
												<a href="#" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Show this Leave Type in Summary Widget on Dashboard and while applying for a leave." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>


                                            </div>
											 <div class="form-group">
												   <label>Order:</label>
												   <input type="text" class="form-control-spacial" style="width: 50px" placeholder="0" id="order_no" name="order_no" value="{{isset($result->order_no)?$result->order_no:''}}" >
												   <a href="#" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Order in which this Leave Type should appear in Leaves Summary and Widgets. Default value is 0." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>

												   <!-- <select id="regular_hours" name="regular_hours" class="WebHRForm1 chosen-select"><option style="" value="{{isset($result->regular_hours)?$result->regular_hours:''}}">10</option></select> -->
												   <!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->
													<!-- <input type="text" placeholder="Contact Number" class="form-control-spacial" id="contact_number" name="contact_number" value="{{isset($result->contact_number)?$result->contact_number:''}}"> -->

												 </div>
												 <div class="form-group">
													<label>Status:</label>
													<select id="status_act" name="status_act" class="WebHRForm1">
													<option style="" value="1">Active</option>
													<option style="" value="0">Inactive</option>
													<!-- <option style="" value="Head Office">Employee's Joining Date</option> -->
													</select>
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>
                                             	<div class="form-upper-main">
										           <h4>Leaves Summary Widget</h4>
									            </div>
												<div class="form-group">
													<label>Company:</label>
													<select id="st" class="WebHRForm1" style="width:180px;" name="company_id">
													<!-- <option style="" value="0">-</option> -->
													@foreach($master['Companies'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->company_id) && $result->company_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['company_name']}}</option>
													@endforeach
													</select>
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>
												 <div class="form-group">
													<label>Division:</label>
													<select id="st" class="WebHRForm1" style="width:180px;" name="division_id">
													<!-- <option style="" value="0">-</option> -->
													@foreach($master['Divisions'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->division_id) && $result->division_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['division_name']}}</option>
													@endforeach
													</select>
													<!-- <option style="" value="Head Office">Employee's Joining Date</option> -->
													</select>
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>
												 <div class="form-group">
													<label>Station:</label>
													<select id="st" class="WebHRForm1" style="width:180px;" name="station_id">
													<!-- <option style="" value="0">-</option> -->
													@foreach($master['Stations'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->station_id) && $result->station_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['station_name']}}</option>
													@endforeach
													</select>
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>
												 <div class="form-group">
													<label>Department:</label>
													<select id="st" class="WebHRForm1" style="width:180px;" name="department_id">
													<!-- <option style="" value="0">-</option> -->
													@foreach($master['Departments'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->department_id) && $result->department_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['department_name']}}</option>
													@endforeach
													</select>
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>
												 <div class="form-group">
													<label>Employee Type:</label>
													<select id="st" class="WebHRForm1" style="width:180px;" name="employee_type_id">
													<!-- <option style="" value="0">-</option> -->
													@foreach($master['EmployeeType'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->employee_type_id) && $result->employee_type_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['name']}}</option>
													@endforeach
													</select>
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>
												 <div class="form-group">
													<label>Employee Category:</label>
													<select id="st" class="WebHRForm1" style="width:180px;" name="employee_category_id">
													<!-- <option style="" value="0">-</option> -->
													@foreach($master['EmployeeCategory'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->employee_category_id) && $result->employee_category_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['name']}}</option>
													@endforeach
													</select>
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>
												 <div class="form-group">
													<label>Employee Grade:</label>
													<select id="st" class="WebHRForm1" style="width:180px;" name="employee_category_id">
													<!-- <option style="" value="0">-</option> -->
													@foreach($master['EmployeeCategory'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->employee_category_id) && $result->employee_category_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['name']}}</option>
													@endforeach
													</select>
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>
												 <div class="form-group">
													<label>Employee Nationality:</label>
													<select id="request_approval_method" name="request_approval_method" class="WebHRForm1 chosen-select">
													<option style="" value="Head Office">-</option>
													<option style="" value="Head Office">--</option>
													<!-- <option style="" value="Head Office">Employee's Joining Date</option> -->
													</select>
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>

												 <div class="form-group">
													<label>Employee Religion:</label>
													<select id="request_approval_method" name="request_approval_method" class="WebHRForm1 chosen-select">
													<option style="" value="Head Office">-</option>
													<option style="" value="Head Office">--</option>
													<!-- <option style="" value="Head Office">Employee's Joining Date</option> -->
													</select>
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>

												 <div class="form-group">
													<label>Employee Marital Status:</label>
													<select id="request_approval_method" name="request_approval_method" class="WebHRForm1 chosen-select">
													<option style="" value="Head Office">-</option>
													<option style="" value="Head Office">--</option>
													<!-- <option style="" value="Head Office">Employee's Joining Date</option> -->
													</select>
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>


											<div class="form-upper-main">
										           <h4>Default Leave Reasons </h4>
									            </div>
												<div class="form-group">
												 <label>Reasons:</label>
													<textarea class="tinyeditorclass" name="additional_information" id="additional_information">{{isset($result->notes)?$result->additional_information:''}}</textarea>
												</div>


												<div class="form-upper-main">
										           <h4>Approval Method </h4>
									            </div>
												<div class="form-group">
													<label>Approval Method:</label>
													<select id="request_approval_method" name="request_approval_method" class="WebHRForm1 chosen-select">
													<option style="" value="Head Office">-</option>
													<option style="" value="Head Office">Multi Level Approval</option>
													<!-- <option style="" value="Head Office">Employee's Joining Date</option> -->
													</select>
													</div>
												 	<div class="form-group">
													<label>Approval Levels:</label>
													<select id="request_approval_method" name="request_approval_method" class="WebHRForm1 chosen-select">
													<!-- <option style="" value="Head Office">-</option> -->
													<option style="" value="Head Office">Auto Approved</option>
													<option style="" value="Head Office">One level</option>
													<option style="" value="Head Office">Two Level</option>
													<option style="" value="Head Office">Three Level</option>
													<option style="" value="Head Office">Four Level</option>
													<option style="" value="Head Office">Five Level</option>
													</select>
													</div>
													<div class="form-group">
													<label>Approval Method for Joining Back from Leave:</label>
													<select id="request_approval_method" name="request_approval_method" class="WebHRForm1 chosen-select">
													<option style="" value="Head Office">-</option>
													<option style="" value="Head Office">Multi Level Approval</option>
													</select>
													</div>
													<div class="form-group">
													<label>Approval Levels:</label>
													<select id="request_approval_method" name="request_approval_method" class="WebHRForm1 chosen-select">
													<!-- <option style="" value="Head Office">-</option> -->
													<option style="" value="Head Office">Auto Approved</option>
													<option style="" value="Head Office">One level</option>
													<!-- <option style="" value="Head Office">Two Level</option>
													<option style="" value="Head Office">Three Level</option>
													<option style="" value="Head Office">Four Level</option>
													<option style="" value="Head Office">Five Level</option> -->
													</select>
													</div>

												<div class="form-upper-main">
										           <h4>Notifications </h4>
									            </div>
												<div class="form-group">
													<label>Notifications upon Submission:</label>
													<select id="request_approval_method" name="request_approval_method" class="WebHRForm1 chosen-select">
													<!-- <option style="" value="Head Office">-</option> -->
													<!-- <option style="" value="Head Office">Multi Level Approval</option> -->
													<!-- <option style="" value="Head Office">Employee's Joining Date</option> -->
													</select>
													</div>
													<div class="form-group">
													<label>Notifications upon Approval:</label>
													<select id="request_approval_method" name="request_approval_method" class="WebHRForm1 chosen-select">
													<!-- <option style="" value="Head Office">-</option> -->
													<!-- <option style="" value="Head Office">Multi Level Approval</option> -->
													<!-- <option style="" value="Head Office">Employee's Joining Date</option> -->
													</select>
													</div>
													<div class="form-group">
													<label>Join Back Notifications upon Approval:</label>
													<select id="request_approval_method" name="request_approval_method" class="WebHRForm1 chosen-select">
													<!-- <option style="" value="Head Office">-</option> -->
													<!-- <option style="" value="Head Office">Multi Level Approval</option> -->
													<!-- <option style="" value="Head Office">Employee's Joining Date</option> -->
													</select>
													</div>
												<div class="form-field-inner">

												 <!-- <div class="form-group">
													<label>Delete</label>
													<a href="{{url('#')}}" style="font-size:18px;color:yellow"><i class="fa fa-times"></i>&nbsp;&nbsp;Delete Multiple Leaves</a>
												    <select id="employee_name" name="employee_name" class="WebHRForm1"><option style="" value="Head Office">employee_name</option></select>
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div> -->



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
													<input class="submit-office" type="submit" value="Add Leave Type">
												</div>
											</div>
										</form>
									</div>
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
