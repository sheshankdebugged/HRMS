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
												<a href="{{ url('employees') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Employee Information</h4>
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




                                        <form method="post" action="{{ url('employees/save') }}" enctype='multipart/form-data' >
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">
												 <div class="form-group">
													<label>Company:</label>
													<select id="company_id" class="WebHRForm1 chosen-select" style="width:180px;" name="company_id">

													<!-- <option value="ALL"> All </option> -->
													@foreach($master['Companies'] as $val)
														<option value="{{$val['id']}}" @php if(isset($result->company_id) && $result->company_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['company_name']}}</option>
													@endforeach
													</select>
                                                    <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
												 </div>

                                                 <div class="form-group">
													<label>Division:</label>
													<select id="division_id" class="WebHRForm1 chosen-select" style="width:180px;" name="division_id">
													@foreach($master['Divisions'] as $val)
														<option value="{{$val['id']}}" @php if(isset($result->division_id) && $result->division_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['division_name']}}</option>
													@endforeach
													</select>
												 </div>


												 <div class="form-group">
													<label>profile pic:</label>
												    <input type="file" name="employee_profile" id="employee_profile" />
												 </div>


                                                 <div class="form-group">
													<label>Station:</label>
													<select id="st" class="WebHRForm1 chosen-select" style="width:180px;" name="station_id">
													@foreach($master['Stations'] as $val)
														<option  value="{{$val['id']}}" @php if(isset($result->station_id) && $result->station_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['station_name']}}</option>
													@endforeach
													</select>
												 </div>

												 <div class="form-group">
													<label>Department:</label>
													<select id="st" class="WebHRForm1 chosen-select" style="width:180px;" name="department_id">
													@foreach($master['Departments'] as $val)
														<option  value="{{$val['id']}}" @php if(isset($result->department_id) && $result->department_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['department_name']}}</option>
													@endforeach
													</select>

												 </div>

												 <div class="form-group">
													<label>Employee Type:</label>
													<!-- <input type="text" class="form-control-spacial" id="user_name" name="user_name" value="{{isset($result->user_name)?$result->user_name:''}}"> -->
													<select id="employee_type_id" class="WebHRForm1 chosen-select" style="width:180px;" name="employee_type_id">
													@foreach($master['EmployeeType'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->employee_type_id) && $result->employee_type_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['name']}}</option>
													@endforeach
													</select>
												 </div>

												 <div class="form-group">
													<label>Employee Category:</label>
													<select id="employee_category_id" class="WebHRForm1 chosen-select" style="width:180px;" name="employee_category_id">
													@foreach($master['EmployeeCategory'] as $val)
														<option  value="{{$val['id']}}" @php if(isset($result->employee_category_id) && $result->employee_category_id == $val['name']  ) { echo "selected";  } @endphp >{{$val['name']}}</option>
													@endforeach
													</select>
												 </div>

												 <div class="form-group">
													<label>Designation / Job Title:</label>
													<select id="employee_designation_id" class="WebHRForm1 chosen-select" name="employee_designation_id">
													@foreach($master['EmployeeDesignation'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->employee_designation_id) && $result->employee_designation_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['name']}}</option>
													@endforeach
													</select>
												 </div>

												 <div class="form-group">
													<label>Grade:</label>
													<!-- <select id="grade_id" name="grade_id" class="WebHRForm1 chosen-select" style="width:180px;"><option style="" value="1">1</option></select> -->
													<select id="grade_id" class="WebHRForm1 chosen-select" style="width:180px;" name="grade_id">
														@foreach($master['Grades'] as $val)
															<option  value="{{$val['id']}}" @php if(isset($result->grade_id) && $result->grade_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
														@endforeach
													</select>
												 </div>

												 <div class="form-group">
													<label>Work Shift:</label>
													<!-- <select id="work_shift_id" name="work_shift_id" class="WebHRForm1 chosen-select" style="width:180px;"><option style="" value="1">Work Shift 1</option></select> -->
													<select id="work_shift_id" class="WebHRForm1 chosen-select" style="width:180px;" name="work_shift_id">
													<!-- <option  value="0">-</option> -->
														@foreach($master['WorkShifts'] as $val)
															<option  value="{{$val['id']}}" @php if(isset($result->work_shift_id) && $result->work_shift_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
														@endforeach
													</select>
												 </div>
												<div class="form-upper-main">
													<h4>Employee Information</h4>
												</div>

												<div class="form-group">
													<label>Allow Employee Login:</label>
													<label style="width:60px; !important" class="switch">
														<input id ="allow_employee_login" name="allow_employee_login" type="checkbox" value="{{isset($result->allow_employee_login)?$result->allow_employee_login:''}}">
														<span class="slider round"></span>
													</label>
												 </div>
                                                 <div class="form-group">
													<label>User Name:</label>
													<input type="text" class="form-control-spacial" id="user_name" value="{{isset($result->user_name)?$result->user_name:''}}" name="user_name">

												 </div>

                                                 <div class="form-group">
													<label>Password:</label>
													<input type="text" class="form-control-spacial" id="user_name" value="{{isset($result->password)?$result->password:''}}" name="password">
												 </div>

												 <div class="form-group">
													<label>Roles Template:</label>
													<select id="st" name="role_template_id" class="WebHRForm1 chosen-select" style="width:180px;"><option style="" value="1">Roles Template 1</option></select>
												 </div>

												 <div class="form-group">
													<label>Email Address:</label>
													<input type="text" class="form-control-spacial" id="email_address" name="email_address" value="{{isset($result->email_address)?$result->email_address:''}}">

												 </div>

												 <div class="form-group">
													<label>GSuite User:</label>
													<label style="width:60px; !important" class="switch">
														<input id ="is_gsuit_user" name="is_gsuit_user" type="checkbox" value="{{isset($result->is_gsuit_user)?$result->is_gsuit_user:''}}">
														<span class="slider round"></span>
													</label>
												 </div>

												 <!-- <div class="form-group">
													<label>Show In Organogram:</label>
													<span class="switch switch-sm"><input class="switch" id="al" checked="true" type="checkbox"><label for="al" class="label-primary"></label></span>
												 </div> -->
												 <div class="form-upper-main">
													<h4>Employee Access Code</h4>
												</div>
												<div class="form-group">
													<label>Access Code (Optional):</label>
													<input type="text" class="form-control-spacial" id="employee_access_code" name="employee_access_code" value="{{isset($result->employee_access_code)?$result->employee_access_code:''}}">
												 </div>
												 <div class="form-upper-main">
													<h4>Employee Notifications</h4>
												</div>
												<div class="form-group">
													<label>Notifications By Email:</label>
													<label style="width:60px; !important" class="switch">
														<input id ="is_notify_by_email" name="is_notify_by_email" type="checkbox" value="{{isset($result->is_notify_by_email)?$result->is_notify_by_email:''}}">
														<span class="slider round"></span>
													</label>
												 </div>
												 <div class="form-upper-main">
													<h4>Employee Reporting</h4>
												</div>
												<div class="form-group">
													<label>Reports To:</label>
													<!-- <select id="st" name="company_name" class="WebHRForm1 chosen-select" style="width:180px;"><option style="" value="Head Office">Senier 1</option></select> -->
													<select id="st" class="WebHRForm1 chosen-select" style="width:180px;" name="report_to_employee_id">
													@foreach($master['Employees'] as $val)
														<option  value="{{$val['id']}}" @php if(isset($result->report_to_employee_id) && $result->report_to_employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
												 </div>
												 <div class="form-group">
													<label>Reports To (Indirect Reporting):</label>
													<!-- <select id="st" name="company_name" class="WebHRForm1 chosen-select" style="width:180px;"><option style="" value="Head Office">Senier 1</option></select> -->
													<select id="st" class="WebHRForm1 chosen-select" style="width:180px;" name="report_to_indirect_employee_id">
													@foreach($master['Employees'] as $val)
														<option  value="{{$val['id']}}" @php if(isset($result->report_to_indirect_employee_id) && $result->report_to_indirect_employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
												 </div>
												 <div class="form-group">
													<label>Supervisor:</label>
													<!-- <select id="st" name="company_name" class="WebHRForm1 chosen-select" style="width:180px;"><option style="" value="Head Office">Senier 1</option></select> -->
													<select id="st" class="WebHRForm1 chosen-select" style="width:180px;" name="supervisior_id">
													@foreach($master['Employees'] as $val)
														<option  value="{{$val['id']}}" @php if(isset($result->supervisior_id) && $result->supervisior_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
												 </div>
												 <div class="form-upper-main">
													<h4>Employee Specific Approvals</h4>
												</div>
												<div class="form-group">
													<label>Approval Levels:</label>
													<select id="approval_level_id" name="approval_level_id" class="WebHRForm1 chosen-select"><option style="" value="1">Auto Approved</option></select>
												 </div>
												 <div class="form-upper-main">
													<h4>Employee Personal Information</h4>
												</div>
												<div class="form-group">
													<label>Salutation:</label>
													<!-- <select id="st" name="salutation" class="WebHRForm1 chosen-select" style="width:180px;"><option style="" value="Head Office">Mr.</option></select> -->
													<select id="st" class="WebHRForm1 chosen-select" style="width:180px;" name="salutation_id">
													@foreach($master['Salutations'] as $val)
														<option  value="{{$val['id']}}" @php if(isset($result->salutation_id) && $result->salutation_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['name']}}</option>
													@endforeach
													</select>
												 </div>
												 <div class="form-group">
													<label>First Name:</label>
													<input type="text" class="form-control-spacial" id="first_name" name="first_name" value="{{isset($result->first_name)?$result->first_name:''}}">
                                                    <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
												 </div>
												 <div class="form-group">
													<label>Last Name:</label>
													<input type="text" class="form-control-spacial" id="last_name" name="last_name" value="{{isset($result->last_name)?$result->last_name:''}}">
                                                    <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
												 </div>
												 <div class="form-group">
													<label>Nickname (Optional):</label>
													<input type="text" class="form-control-spacial" id="nick_name" name="nick_name" value="{{isset($result->nick_name)?$result->nick_name:''}}">
												 </div>
												 <div class="form-group">
													<label>Date of Birth:</label>
													<input type="date" class "form-control-spacial date" id="dob" name="dob" value="{{isset($result->dob)?$result->dob:''}}">
												 </div>
												 <div class="form-group">
													<label>Gender:</label>
													<!-- <select id="st" name="company_name" class="WebHRForm1 chosen-select" style="width:180px;"><option style="" value="Head Office">Male</option></select> -->
													<select id="st" class="WebHRForm1 chosen-select" style="width:180px;" name="gender_id">
													@foreach($master['Genders'] as $val)
														<option  value="{{$val['id']}}" @php if(isset($result->gender_id) && $result->gender_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
													@endforeach
													</select>
												 </div>
												 <div class="form-group">
													<label>Blood Group:</label>
													<!-- <select id="st" name="company_name" class="WebHRForm1 chosen-select" style="width:180px;"><option style="" value="Head Office">O+</option></select> -->
													<select id="blood_group_id" class="WebHRForm1 chosen-select" name="blood_group_id">
													@foreach($master['BloodGroups'] as $val)
														<option  value="{{$val['id']}}" @php if(isset($result->blood_group_id) && $result->blood_group_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
													@endforeach
													</select>
												 </div>
												 <div class="form-group">
													<label>Nationality:</label>
													<select id="nationality_id" class="WebHRForm1 chosen-select" style="width:180px;" name="nationality_id">
													@foreach($master['Nationalities'] as $val)
														<option  value="{{$val['id']}}" @php if(isset($result->nationality_id) && $result->nationality_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
													@endforeach
													</select>
												 </div>
												 <div class="form-group">
													<label>Religion:</label>
													<select id="religion_id" class="WebHRForm1 chosen-select" style="width:180px;" name="religion_id">
													@foreach($master['Religions'] as $val)
														<option  value="{{$val['id']}}" @php if(isset($result->religion_id) && $result->religion_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
													@endforeach
													</select>
												 </div>
												 <div class="form-group">
													<label>Marital Status:</label>
													<select id="marital_status_id" class="WebHRForm1 chosen-select" style="width:180px;" name="marital_status_id">
													@foreach($master['MaritalStatus'] as $val)
														<option  value="{{$val['id']}}" @php if(isset($result->marital_status_id) && $result->marital_status_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
													@endforeach
													</select>
												 </div>
												 <div class="form-upper-main">
													<h4>Employee Additional Information</h4>
												</div>
												<div class="form-group">
													<label>Joining Date:</label>
													<input type="date" class "form-control-spacial date" id="joining_date" name="joining_date" value="{{isset($result->joining_date)?$result->joining_date:''}}">
												 </div>
												<div class="form-group">
													<label>Government Id / Social Security:</label>
													<input type="text" class="form-control-spacial" id="government_id" name="government_id" value="{{isset($result->government_id)?$result->government_id:''}}">
												 </div>
												 <div class="form-group">
													<label>Employee Tax Number:</label>
													<input type="text" class="form-control-spacial" id="employee_tax_number" name="employee_tax_number" value="{{isset($result->employee_tax_number)?$result->employee_tax_number:''}}">
												 </div>
												 <div class="form-upper-main">
													<h4>Employee Driving License</h4>
												</div>
												<div class="form-group">
													<label>Driving License Number:</label>
													<input type="text" class="form-control-spacial" id="driving_license_number" name="driving_license_number" value="{{isset($result->driving_license_number)?$result->driving_license_number:''}}">
												 </div>
												 <div class="form-group">
													<label>Driving License Expiration:</label>
													<input type="date" class "form-control-spacial date" id="driving_expiration_date" name="driving_expiration_date" value="{{isset($result->driving_expiration_date)?$result->driving_expiration_date:''}}">
												 </div>
												 <div class="form-upper-main">
													<h4>Employee Passport</h4>
												</div>
												<div class="form-group">
													<label>Passport Number:</label>
													<input type="text" class="form-control-spacial" id="passport_number" name="passport_number" value="{{isset($result->passport_number)?$result->passport_number:''}}">
												 </div>
												 <div class="form-group">
													<label>Passport Expiration:</label>
													<input type="date" class "form-control-spacial date" id="passport_expiration_date" name="passport_expiration_date" value="{{isset($result->passport_expiration_date)?$result->passport_expiration_date:''}}">
												 </div>
												 <div class="form-group">
													<label>Passport Issuance Country:</label>
													<select id="passport_issuance_country_id" class="WebHRForm1 chosen-select" name="passport_issuance_country_id">
													@foreach($master['Countries'] as $val)
														<option  value="{{$val['id']}}" @php if(isset($result->passport_issuance_country_id) && $result->passport_issuance_country_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
													@endforeach
													</select>
												 </div>
												 <div class="form-upper-main">
													<h4>Permanent Contact Information</h4>
												</div>
												<div class="form-group">
													<label>Address:</label>
													<input type="text" class="form-control-spacial" id="permanent_contact_address" name="permanent_contact_address" value="{{isset($result->permanent_contact_address)?$result->permanent_contact_address:''}}">
												 </div>
												 <div class="form-group">
													<label>City:</label>
													<input type="text" class="form-control-spacial" id="permanent_contact_city" name="permanent_contact_city" value="{{isset($result->permanent_contact_city)?$result->permanent_contact_city:''}}">
												 </div>
												 <div class="form-group">
													<label>State / Province:</label>
													<input type="text" class="form-control-spacial" id="permanent_contact_state" name="permanent_contact_state" value="{{isset($result->permanent_contact_state)?$result->permanent_contact_state:''}}">
												 </div>
												 <div class="form-group">
													<label>Zip Code / Postal Code:</label>
													<input type="text" class="form-control-spacial" id="permanent_contact_zip_code" name="permanent_contact_zip_code" value="{{isset($result->permanent_contact_zip_code)?$result->permanent_contact_zip_code:''}}">
												 </div>
												 <div class="form-group">
													<label>Country:</label>
													<select id="permanent_contact_country_id" class="WebHRForm1 chosen-select" name="permanent_contact_country_id">
													@foreach($master['Countries'] as $val)
														<option  value="{{$val['id']}}" @php if(isset($result->permanent_contact_country_id) && $result->permanent_contact_country_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
													@endforeach
													</select>
												 </div>
												 <div class="form-group">
													<label>Contact Number:</label>
													<input type="text" class="form-control-spacial" id="permanent_contact_number" name="permanent_contact_number" value="{{isset($result->permanent_contact_number)?$result->permanent_contact_number:''}}">
												 </div>

												 <div class="form-upper-main">
													<h4>Present Contact Information</h4>
												</div>
												<!-- <div class="form-group">
													<label>Same as Permanent Contact:</label>
													<span class="switch switch-sm"><input class="switch" id="sap" type="checkbox"><label for="sap" class="label-primary"></label></span>
												 </div> -->
												 <div class="form-group">
													<label>Address:</label>
													<input type="text" class="form-control-spacial" id="present_contact_address" name="present_contact_address" value="{{isset($result->present_contact_address)?$result->present_contact_address:''}}">
												 </div>
												 <div class="form-group">
													<label>City:</label>
													<input type="text" class="form-control-spacial" id="present_contact_city" name="present_contact_city" value="{{isset($result->present_contact_city)?$result->present_contact_city:''}}">
												 </div>
												 <div class="form-group">
													<label>State / Province:</label>
													<input type="text" class="form-control-spacial" id="present_contact_state" name="present_contact_state" value="{{isset($result->present_contact_state)?$result->present_contact_state:''}}">
												 </div>
												 <div class="form-group">
													<label>Zip Code / Postal Code:</label>
													<input type="text" class="form-control-spacial" id="present_contact_zip_code" name="present_contact_zip_code" value="{{isset($result->present_contact_zip_code)?$result->present_contact_zip_code:''}}">
												 </div>
												 <div class="form-group">
													<label>Country:</label>
													<select id="present_contact_country_id" class="WebHRForm1 chosen-select" name="present_contact_country_id">
													@foreach($master['Countries'] as $val)
														<option  value="{{$val['id']}}" @php if(isset($result->present_contact_country_id) && $result->present_contact_country_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
													@endforeach
													</select>
												 </div>
												 <div class="form-group">
													<label>Contact Number:</label>
													<input type="text" class="form-control-spacial" id="present_contact_number" name="present_contact_number" value="{{isset($result->present_contact_number)?$result->present_contact_number:''}}">
												 </div>

												 <div class="form-upper-main">
													<h4>Phone Number</h4>
												</div>
												<div class="form-group">
													<label>Home Phone Number:</label>
													<input type="text" class="form-control-spacial" id="home_phone_number" name="home_phone_number" value="{{isset($result->home_phone_number)?$result->home_phone_number:''}}">
												 </div>
												 <div class="form-group">
													<label>Office Phone Number:</label>
													<input type="text" class="form-control-spacial" id="office_phone_number" name="office_phone_number" value="{{isset($result->office_phone_number)?$result->office_phone_number:''}}">
												 </div>
												 <div class="form-group">
													<label>Mobile Number:</label>
													<input type="text" class="form-control-spacial" id="mobile_number" name="mobile_number" value="{{isset($result->mobile_number)?$result->mobile_number:''}}">
												 </div>


												 <div class="form-upper-main">
													<h4>Emergency Contact</h4>
												</div>
												<div class="form-group">
													<label>Emergency Contact Person:</label>
													<input type="text" placeholder="Emergency Contact Person" class="form-control-spacial" id="emergency_contact_person" name="emergency_contact_person" value="{{isset($result->emergency_contact_person)?$result->emergency_contact_person:''}}">
												 </div>
												 <div class="form-group">
													<label>Relationship:</label>
													<input type="text" placeholder="Relationship" class="form-control-spacial" id="relationship" name="relationship" value="{{isset($result->relationship)?$result->relationship:''}}">
												 </div>
												 <div class="form-group">
													<label>Phone Number:</label>
													<input type="text" placeholder="Phone Number" class="form-control-spacial" id="emergency_phone_number" name="emergency_phone_number" value="{{isset($result->emergency_phone_number)?$result->emergency_phone_number:''}}">
												 </div>


												 <div class="form-upper-main">
													<h4>Additional Information</h4>
												</div>
												<div class="form-group">
													<label>Notes:</label>
													<textarea id="notes" name="notes" class="form-control-spacial">{{isset($result->notes)?$result->notes:''}}</textarea>
												 </div>
												 <div class="form-group">
													<label>Record Added By:</label>
													<div class="FieldValue">System Administrator</div>
												 </div>
												 <div class="form-group">
													<label>Record Added On:</label>
													<div class="FieldValue">System Administrator</div>
												 </div>
												 <div class="form-group">
													<label>Record Update History:</label>
													<div class="FieldValue"></div>
												 </div>


												 <div class="form-upper-main">
													<h4>Send Employee Credentials</h4>
												</div>
												<div class="form-group">
													<label>Send Login Credentials by Email:</label>
													<!-- <span class="switch switch-sm"><input class="switch" id="sec" type="checkbox"><label for="sec" class="label-primary"></label></span> -->
													<label style="width:60px; !important" class="switch">
														<input id ="send_employee_credential" name="send_employee_credential" type="checkbox" value="{{isset($result->send_employee_credential)?$result->send_employee_credential:''}}">
														<span class="slider round"></span>
													</label>
												 </div>
												 <!-- <div class="form-group">
													<label>Employee must change password on next login:</label>
													<span class="switch switch-sm"><input class="switch" id="sec" type="checkbox"><label for="sec" class="label-primary"></label></span>
												 </div> -->

												 <!-- <div class="form-upper-main">
													<h4>Employee Contract</h4>
												</div>
												<div class="form-group">
													<label>Create Employee Auto Contract:</label>
													<span class="switch switch-sm"><input class="switch" id="sec" type="checkbox"><label for="sec" class="label-primary"></label></span>
												 </div> -->
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
