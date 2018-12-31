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
									</ul>
								</div> -->
							</div>
							<div class="request-inner-table">
								<div class="upper-header-request">
									<div class="col-md-12 nopadding">
										<div class="back-button">
											<div class="add-record-btn">
												<a href="{{ url('attendance') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Employee Attendance Information</h4>
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
                                        
                                        <form method="post" action="{{ url('attendance/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">
												
											<div class="form-group">
													<label>Employee Name:</label>
													<select id="st" class="WebHRForm1" style="width:180px;" name="employee_name">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->employee_name) && $result->id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
													<!-- <select id="employee_name" name="employee_name" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">1</option></select> -->
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
													<!-- <input type="text" placeholder="Contact Person" class="form-control-spacial" id="registration_name" name="contact_person" value="{{isset($result->contact_person)?$result->contact_person:''}}"> -->
                                                   
												 </div>


												 <div class="form-group">
												   <label>Forward Application To:</label>
												   <select id="st" class="WebHRForm1" style="width:180px;" name="employee_name">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->employee_name) && $result->id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
												   <!-- <select id="forward_application_to" name="forward_application_to" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">forward 2</option></select> -->
												   <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
													<!-- <input type="text" placeholder="Contact Person Designation" class="form-control-spacial" id="contact_person_designation" name="contact_person_designation" value="{{isset($result->contact_person_designation)?$result->contact_person_designation:''}}"> -->
                                
												 </div>

												 
												 <div class="form-group">
												   <label>Attendance Date:</label>
												   <!-- <select id="Transfer Date" name="employee_category" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Employee Category 1</option></select> -->
													<!-- <input type="text" placeholder="Transfer Date" class="form-control-spacial" id="transfer_date" name="transfer_date" value="{{isset($result->transfer_date)?$result->transfer_date:''}}"> -->
													<input type="text" placeholder="" class="form-control-spacial date" id="attendance_date" name="attendance_date" value="{{isset($result->attendance_date)?$result->attendance_date:''}}">
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
												 </div>
												 <div class="form-group">
													<h4>Regular Work Hours</h4>
												 </div>
										 
												 <div class="form-group">
												 <!-- Add Timepicker here -->
												   <label>Sign In Time:</label>
												   <select id="sign_in_time" name="sign_in_time" class="WebHRForm1" style="width:180px;"><option style="" value="{{isset($result->sign_in_time)?$result->sign_in_time:''}}">-</option></select>
													<!-- <input type="text" placeholder="Contact Number" class="form-control-spacial" id="contact_number" name="contact_number" value="{{isset($result->contact_number)?$result->contact_number:''}}"> -->
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
                                
												 </div>

												 <div class="form-group">
												 <!-- Add Timepicker here -->
												   <label>Sign Out Time:</label>
												   <select id="sign_out_time" name="sign_out_time" class="WebHRForm1" style="width:180px;"><option style="" value="{{isset($result->sign_out_time)?$result->sign_out_time:''}}">-</option></select>
													<!-- <input type="text" placeholder="Fax Number" class="form-control-spacial" id="fax_number" name="fax_number" value="{{isset($result->fax_number)?$result->fax_number:''}}"> -->
                                
												 </div>
												 <div class="form-group">
													 <h4>Lunch Break Hours</h4>
												  </div>

												 <div class="form-group">
												 <!-- Add Timepicker here -->
												   <label>Lunch Break Out Time:</label>
												   <select id="lunch_break_out_time" name="lunch_break_out_time" class="WebHRForm1" style="width:180px;"><option style="" value="{{isset($result->lunch_break_out_time)?$result->lunch_break_out_time:''}}">transfer_to_department 1</option></select>
													<!-- <input type="text" placeholder="Email Address" class="form-control-spacial" id="email_address" name="email_address" value="{{isset($result->email_address)?$result->email_address:''}}"> -->
                                
												 </div>

												 <div class="form-group">
												 <!-- Add Timepicker Here -->
												   <label>Lunch Break In Time:</label>
													<!-- <input type="text" placeholder="Department" class="form-control-spacial" id="website" name="website" value="{{isset($result->website)?$result->website:''}}"> -->
													<select id="lunch_break_in_time" name="lunch_break_in_time" class="WebHRForm1" style="width:180px;"><option style="" value="{{isset($result->lunch_break_in_time)?$result->lunch_break_in_time:''}}">-</option></select>
												 </div>

												 <div class="form-group">
													 <h4>Additional Break Hours</h4>
												  </div>

												 <div class="form-group">
												 <!-- Add Timepicker here -->
												   <label>Additional Break Out Time:</label>
												   <select id="additional_break_out_time" name="additional_break_out_time" class="WebHRForm1" style="width:180px;"><option style="" value="{{isset($result->additional_break_out_time)?$result->additional_break_out_time:''}}">transfer_to_department 1</option></select>
													<!-- <input type="text" placeholder="Email Address" class="form-control-spacial" id="email_address" name="email_address" value="{{isset($result->email_address)?$result->email_address:''}}"> -->
                                
												 </div>

												 <div class="form-group">
												 <!-- Add Timepicker Here -->
												   <label>Additional Break In Time:</label>
													<!-- <input type="text" placeholder="Department" class="form-control-spacial" id="website" name="website" value="{{isset($result->website)?$result->website:''}}"> -->
													<select id="additional_break_in_time" name="additional_break_in_time" class="WebHRForm1" style="width:180px;"><option style="" value="{{isset($result->additional_break_in_time)?$result->additional_break_in_time:''}}">-</option></select>
												 </div>
												 <div class="form-group">
													 <h4>Extra Break Hours</h4>
												  </div>

												 <div class="form-group">
												 <!-- Add Timepicker here -->
												   <label>Extra Break Out Time:</label>
												   <select id="extra_break_out_time" name="extra_break_out_time" class="WebHRForm1" style="width:180px;"><option style="" value="{{isset($result->extra_break_out_time)?$result->extra_break_out_time:''}}">transfer_to_department 1</option></select>
													<!-- <input type="text" placeholder="Email Address" class="form-control-spacial" id="email_address" name="email_address" value="{{isset($result->email_address)?$result->email_address:''}}"> -->
                                
												 </div>

												 <div class="form-group">
												 <!-- Add Timepicker Here -->
												   <label>Extra Break In Time:</label>
													<!-- <input type="text" placeholder="Department" class="form-control-spacial" id="website" name="website" value="{{isset($result->website)?$result->website:''}}"> -->
													<select id="extra_break_in_time" name="extra_break_in_time" class="WebHRForm1" style="width:180px;"><option style="" value="{{isset($result->extra_break_in_time)?$result->extra_break_in_time:''}}">-</option></select>
												 </div>
												 										 
										
											 
											 											 											 

												 <div class="form-group">
													<h4>Additional Information</h4>
												 </div>
												 <div class="form-group">
												   <label>Attendance Station:</label>
												   <select id="attendance_station_id" class="WebHRForm1" style="width:180px;" name="attendance_station_id">
													@foreach($master['Stations'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->	attendance_station_id) && $result->attendance_station_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['station_name']}}</option>
													@endforeach
													</select>
												   <!-- <select id="attendance_station" name="attendance_station" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">transfer_to_department 1</option></select> -->
													                                
												 </div>

												 <div class="form-group">
												 	<label>Attendance Project:</label>
													 <select id="attendance_project_id" class="WebHRForm1" style="width:180px;" name="attendance_project_id">
													@foreach($master['Projects'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->attendance_project_id) && $result->attendance_project_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['project_title']}}</option>
													@endforeach
													</select>
													<!-- <input type="text" placeholder="Department" class="form-control-spacial" id="website" name="website" value="{{isset($result->website)?$result->website:''}}">
													<select id="attendance_project" name="attendance_project" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">-</option></select> -->
												 </div>
												 <div class="form-group">
												 <label>Notes:</label>
													<textarea class="tinyeditorclass" name="notes" id="notes">{{isset($result->notes)?$result->additonal_information:''}}</textarea>
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
													<input class="submit-office" type="submit" value="Save">
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
