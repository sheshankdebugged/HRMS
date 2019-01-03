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
											<a alt="Dashboard"><i class="fa fa-cog"></i></a>
										</li>
										<li>
											<a alt="Dashboard"><i class="fa fa-question-circle"></i></a>
										</li>
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
										<div class="back-button">
											<div class="add-record-btn">
												<a href="{{ url('leaves') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Leaves Types</h4>
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
                                        <form method="post" action="{{ url('leavessettings/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">

												 <div class="form-group">
													<label>Leaves Types:</label>
													<a href="{{ url('manageleavestypes') }}" style="font-size:18px;color:yellow"><i class="fa fa-cog"></i>&nbsp;&nbsp;Manage Leaves Types</a>
													<!-- <select id="employee_name" name="employee_name" class="WebHRForm1 chosen-select" style="width:180px;"><option style="" value="Head Office">employee_name</option></select> -->
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>
											    <div class="form-upper-main">
										           <h4>Leaves Forwarding</h4>
									            </div>
												 <div class="form-group">
													<label>Request Approval Method:</label>
													<select id="request_approval_method" name="request_approval_method" class="WebHRForm1 chosen-select" style="width:180px;">
													<option style="" value="Standrad One Employee Approval">Standrad One Employee Approval</option>
													<option style="" value="Multi-Level Approval">Multi-Level Approval</option>
													</select>
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>
												 <div class="form-group">
													<label>Forward Leaves To:</label>
													<select id="st" class="WebHRForm1 chosen-select" style="width:180px;" name="forward_to_emp_id">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->forward_to_emp_id) && $result->forward_to_emp_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>
												 <div class="form-upper-main">
										           <h4>Leaves Quota Settings</h4>
									            </div>
												<div class="form-group">
													<label>Leaves Quota Reset Date:</label>
													<select id="st" class="WebHRForm1 chosen-select" style="width:180px;" name="leaves_quota_reset_id">
													@foreach($master['LeavesQuotaResetDate'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->leaves_quota_reset_id) && $result->leaves_quota_reset_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
													@endforeach
													</select>
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>
												 <div class="form-group">
													<label>Allow Editing of Taken/Pending in Leaves Quota:</label>
													<select id="allow_editing_of_taken_pending" name="allow_editing_of_taken_pending" class="WebHRForm1 chosen-select" style="width:180px;">
													<option style="" value="0">No</option>
													<option style="" value="1">Yes</option>

													</select>
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>
												 <div class="form-group">
													<label>Carry Forward Leaves on Leaves Quota Reset Date:</label>
													<select id="carry_forward_leaves" name="carry_forward_leaves" class="WebHRForm1 chosen-select" style="width:180px;">
													<option style="" value="0">No</option>
													<option style="" value="1">Yes</option>
													</select>
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>
												 <div class="form-group">
													<label>Pro-Rata Based Leaves Quota Assignment:</label>
													<select id="pro_rata_based_eaves" name="pro_rata_based_eaves" class="WebHRForm1 chosen-select" style="width:180px;">
													<option style="" value="0">No</option>
													<option style="" value="1">Yes</option>
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->
													</select>
												 </div>
												 <div class="form-group">
													<label>Allow Future Leaves (pro-Rata Based Leaves Only):</label>
													<select id="allow_future_leaves" name="allow_future_leaves" class="WebHRForm1 chosen-select" style="width:180px;">
													<option style="" value="0">No</option>
													<option style="" value="1">Yes</option>
													</select>
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>
												 <div class="form-group">
													<label>Leaves Quota Decimal Places:</label>
													<select id="leaves_quota_decimal" name="leaves_quota_decimal" class="WebHRForm1 chosen-select" style="width:180px;">
													<option style="" value="0">0</option>
													<option style="" value="1">1</option>
													<option style="" value="2">2</option>
													<option style="" value="3">3</option>
													<option style="" value="4">4</option>
													<option style="" value="5">5</option>
													<option style="" value="6">6</option>
													</select>

													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>
												 <div class="form-group">
													<label>Disable Leave Quota Deletion:</label>
													<select id="disable_leave_quota" name="disable_leave_quota" class="WebHRForm1 chosen-select" style="width:180px;">
													<option style="" value="0">No</option>
													<option style="" value="1">Yes</option>
													</select>
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>
												 <div class="form-upper-main">
										           <h4>Other Leaves Settings</h4>
									            </div>
											<div class="form-group">
											<label>Include Unapproved Leaves in Leaves Quota</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="include_unapproved_leaves" name="include_unapproved_leaves" value="{{isset($result->include_unapproved_leaves)?$result->include_unapproved_leaves:''}}">
		                                           <span class="slider round"></span>
												   </label>
												   <a  data-toggle="popover" data-trigger="hover" data-placement="top" data-content="If this option is selected, it will allow your employees to edit leaves that have been approved" data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>

                                            </div>
											<div class="form-group">
											<label>Show All Employees in Alternate Employees List</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="show_all_employees_in_alternate" name="show_all_employees_in_alternate" value="{{isset($result->show_all_employees_in_alternate)?$result->show_all_employees_in_alternate:''}}">
		                                           <span class="slider round"></span>
	                                            </label>
												<a  data-toggle="popover" data-trigger="hover" data-placement="top" data-content="If enabled, employee will be able to select any employee in Alternate Employees field while applyling for a leave request." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>

                                            </div>
											<div class="form-group">
											<label>Allow Join Back from Leaves</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="allow_join_back" name="allow_join_back" value="{{isset($result->allow_join_back)?$result->allow_join_back:''}}">
		                                           <span class="slider round"></span>
	                                            </label>
												<a  data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Allow employees to Join Back from Leaves." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>

                                            </div>
											<div class="form-group">
											<label>Can edit Approved Leaves</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="can_edit_approved_leaves" name="can_edit_approved_leaves" value="{{isset($result->can_edit_approved_leaves)?$result->can_edit_approved_leaves:''}}">
		                                           <span class="slider round"></span>
	                                            </label>
												<a  data-toggle="popover" data-trigger="hover" data-placement="top" data-content="If this option is selected, it will allow your employees to edit leaves that have been approved" data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>


                                            </div>
											<div class="form-group">
											<label>Disable Half Day Leaves</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="disable_half_day_leaves" name="disable_half_day_leaves" value="{{isset($result->disable_half_day_leaves)?$result->disable_half_day_leaves:''}}">
		                                           <span class="slider round"></span>
	                                            </label>
												<a  data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Disable option to allow employees to take Half Day Leaves" data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>

                                            </div>
											<div class="form-group">
											<label>Disable Hourly Leaves</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="disable_hourly_leaves" name="disable_hourly_leaves" value="{{isset($result->disable_hourly_leaves)?$result->disable_hourly_leaves:''}}">
		                                           <span class="slider round"></span>
	                                            </label>
												<a  data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Disable option to allow employees to take Hourly Leaves" data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>


                                            </div>
											<div class="form-group">
											<label>Disable Past Leaves</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="disable_past_leaves" name="disable_past_leaves" value="{{isset($result->disable_past_leaves)?$result->disable_past_leaves:''}}">
		                                           <span class="slider round"></span>
	                                            </label>
												<a  data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Disable option to allow employees to take Past Dates Leaves" data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>


                                            </div>
											<div class="form-group">
											<label>Hide Inactive Employees Leaves</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="hide_inactive_employees" name="hide_inactive_employees" value="{{isset($result->hide_inactive_employees)?$result->hide_inactive_employees:''}}">
		                                           <span class="slider round"></span>
	                                            </label>
												<a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="This will hide all Inactive Employees from Leaves / Leaves module data grid." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>


                                            </div>
											<div class="form-group">
											<label>Round Off Leave Balance</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="round_off_leave" name="round_off_leave" value="{{isset($result->round_off_leave)?$result->round_off_leave:''}}">
		                                           <span class="slider round"></span>
	                                            </label>
												<a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="This will round off the leave balance." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>


                                            </div>
											<div class="form-group">
											<label>Leaves Reference Number</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="leaves_reference_no" name="leaves_reference_no" value="{{isset($result->leaves_reference_no)?$result->leaves_reference_no:''}}">
		                                           <span class="slider round"></span>
	                                            </label>
												<a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Assign a Reference Number to each leave request." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>

												<div class="form-upper-main">
										           <h4>Leaves Summary Widget</h4>
									            </div>

                                            </div>
											<div class="form-group">
											<label>Hide leaves types with all zero values</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="hide_leaves_types_with_all_zero" name="hide_leaves_types_with_all_zero" value="{{isset($result->hide_leaves_types_with_all_zero)?$result->hide_leaves_types_with_all_zero:''}}">
		                                           <span class="slider round"></span>
	                                            </label>
												<a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Inside Leaves Summary don't show a leave type if all of the following values are zero (Entitled, Taken, Pending, Balance)" data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>


                                            </div>
											<div class="form-group">
											<label>Hide Year Column</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="hide_year_column" name="hide_year_column" value="{{isset($result->hide_year_column)?$result->hide_year_column:''}}">
		                                           <span class="slider round"></span>
	                                            </label>
												<a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Hide Year column in Leaves Widget Summary on Dashboard and Apply for Leaves screen." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>


                                            </div>
											<div class="form-group">
											<label>Hide Entitled Column</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="hide_entitled_column" name="hide_entitled_column" value="{{isset($result->hide_entitled_column)?$result->hide_entitled_column:''}}">
		                                           <span class="slider round"></span>
	                                            </label>
												<a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Hide Entitled column in Leaves Widget Summary on Dashboard and Apply for Leaves screen." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>


                                            </div>
											<div class="form-group">
											<label>Hide Accrued Column</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="hide_accrued_column" name="hide_accrued_column" value="{{isset($result->hide_accrued_column)?$result->hide_accrued_column:''}}">
		                                           <span class="slider round"></span>
	                                            </label>
												<a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Hide Accrued column in Leaves Widget Summary on Dashboard and Apply for Leaves screen." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>


                                            </div>
											<div class="form-group">
											<label>Hide Additional Leaves Column</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="hide_additional_leaves" name="hide_additional_leaves" value="{{isset($result->hide_additional_leaves)?$result->hide_additional_leaves:''}}">
		                                           <span class="slider round"></span>
	                                            </label>
												<a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Hide Additional Leaves Column in Leaves Widget Summary on Dashboard and Apply for Leaves screen." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>


                                            </div>
											<div class="form-group">
											<label>Hide Carried Over Column</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="hide_carried_over_column" name="hide_carried_over_column" value="{{isset($result->hide_carried_over_column)?$result->hide_carried_over_column:''}}">
		                                           <span class="slider round"></span>
	                                            </label>
												<a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Hide Carried Over column in Leaves Widget Summary on Dashboard and Apply for Leaves screen." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>


                                            </div>
											<div class="form-group">
											<label>Hide Balance Column</label>
                                                <label style="width:60px; !important" class="switch">
												<input type="checkbox"  id="hide_balance_column" name="hide_balance_column" value="{{isset($result->hide_balance_column)?$result->hide_balance_column:''}}">

		                                           <span class="slider round"></span>
	                                            </label>
												<a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Hide Balance column in Leaves Widget Summary on Dashboard and Apply for Leaves screen." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>


                                            </div>

											<!-- <div class="form-upper-main">
										           <h4>Data Grid</h4>
									            </div>
												<div class="form-group">
													<label>Data Grid Columns</label>
													<select id="st" class="WebHRForm1 chosen-select" style="width:180px;" name="data_grid_columns">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->data_grid_columns) && $result->id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
													 <select id="employee" name="employee" class="WebHRForm1 chosen-select" style="width:180px;"><option style="" value="Head Office">1</option></select>
													 <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
													 <input type="text" placeholder="Contact Person" class="form-control-spacial" id="registration_name" name="contact_person" value="{{isset($result->contact_person)?$result->contact_person:''}}">

												 </div>

												<div class="form-upper-main">
										           <h4>Leaves Notifications</h4>
									            </div>
												<div class="form-group">
													<label>Notify upon Submission</label>
													<select id="st" class="WebHRForm1 chosen-select" style="width:180px;" name="notify_upon_submission">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->notify_upon_submission) && $result->id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
													 <select id="employee" name="employee" class="WebHRForm1 chosen-select" style="width:180px;"><option style="" value="Head Office">1</option></select>
													 <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
													 <input type="text" placeholder="Contact Person" class="form-control-spacial" id="registration_name" name="contact_person" value="{{isset($result->contact_person)?$result->contact_person:''}}">

												 </div>
												 <div class="form-group">
													<label>Notify upon Approval</label>
													<select id="st" class="WebHRForm1 chosen-select" style="width:180px;" name="notify_upon_approval">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->notify_upon_approval) && $result->id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
													 <select id="employee" name="employee" class="WebHRForm1 chosen-select" style="width:180px;"><option style="" value="Head Office">1</option></select>
													 <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
													 <input type="text" placeholder="Contact Person" class="form-control-spacial" id="registration_name" name="contact_person" value="{{isset($result->contact_person)?$result->contact_person:''}}">

												 </div> -->

												 <div class="form-upper-main">
										           <h4>Leaves Options</h4>
									            </div>
												<div class="form-field-inner">

												<div class="form-group">
													<label>Delete</label>
													<a href="{{url('delmultipleleaves')}}" style="font-size:18px;color:yellow"><i class="fa fa-times"></i>&nbsp;&nbsp;Delete Multiple Leaves</a>
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
													<input class="submit-office" type="submit" value="Save Settings">
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
