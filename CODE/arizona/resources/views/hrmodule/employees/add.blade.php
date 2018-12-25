@include('template.admin_header')
<div class="main-section">
	<div class="container">
        <div class="row">
			<div class="inner-main-section">
				<div class="col-md-12 col-sm-12">
					<div class="left-bar-request nopadding">
						<div class="sidebar-menu">
                        @include('template.employee_nav_icon')
						</div>
					</div>
					<div class="right-bar-request">
						<div class="request-section">
							<div class="main-heading">
								<div class="inner-heading-request">
									<h2>{{$pageTitle}}</h2>
								</div>
								<div class="settings-buttons">
									<ul>
										<li>
											<a href="#" alt="Dashboard"><i class="fa fa-cog"></i></a>
										</li>
										<li>
											<a href="#" alt="Dashboard"><i class="fa fa-question-circle"></i></a>
										</li>
									</ul>
								</div>
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

										<div style="position:relative;"><div style="position:absolute; right:0px; width:400px;"><div align="right"><img id="imgEmployeePhoto" title="" src="https://cdn.webhr.co/images/Photo/NoPhotoM.png" style="background-repeat: no-repeat; background-position: 50%; border-radius: 50%; width: 200px; height: 200px;"><br>
			 <div style="" id="fileEmployeePhoto"><div class="ajax-file-upload" style="position: relative; overflow: hidden; cursor: default;">Upload Photo<form method="POST" action="../pages/?page=Upload&amp;type=UploadFile&amp;n=1&amp;m=Upload&amp;t=&amp;type2=EmployeePhoto" enctype="multipart/form-data" style="margin: 0px; padding: 0px;"><input type="file" id="ajax-upload-id-1545737415618" name="fileEmployeePhoto" accept="image/*" style="position: absolute; cursor: pointer; top: 0px; width: 100%; height: 100%; left: 0px; z-index: 100; opacity: 0;"></form></div><div></div></div><div class="ajax-file-upload-container"></div>
		<script>
		$(document).ready(function() {
			// $("#fileEmployeePhoto").uploadFile({ 
			// 	url:"../pages/?page=Upload&type=UploadFile&n=1&m=Upload&t=&type2=EmployeePhoto", 
			// 	fileName:"fileEmployeePhoto", 
			// 	acceptFiles:"image/*",
			// 	dragDrop:false, 
			// 	maxFileCount:1, 
			// 	uploadStr:"Upload Photo",
			// 	maxFileSize:100*1024*10*20,		// 20 MB
			// 	afterUploadAll:function(obj) {
			// 		var sResponse = $.parseJSON(obj.getResponses());
			// 		$("#ephoto").val(sResponse["FileName"]); $("#imgEmployeePhoto").attr("src", "../include/image.php?org=t&img=" + sResponse["FileName"]);
			// 	} 
			// }); 
		});
		</script>
		     
		    </div></div></div>
                                        <form method="post" action="{{ url('employees/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">
												 <div class="form-group">
													<label>Company:</label>
													<!-- <input type="text" class="form-control-spacial" id="employee_name" name="employee_name" value="{{isset($result->employee_name)?$result->employee_name:''}}"> -->
													<select id="st" name="company_name" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Company 1</option></select>
                                                    <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
												 </div>

                                                 <div class="form-group">
													<label>Division:</label>
													<select id="st" name="division" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Division 1</option></select>
													<!-- <input type="text" class="form-control-spacial" id="designation" value="{{isset($result->designation)?$result->designation:''}}" name="designation"> -->

												 </div>

                                                 <div class="form-group">
													<label>Station:</label>
													<select id="st" name="station" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Station 1</option></select>
													<!-- <input type="text" class="form-control-spacial" id="department" name="department" value="{{isset($result->department)?$result->department:''}}"> -->

												 </div>
												 
												 <div class="form-group">
													<label>Department:</label>
													<!-- <input type="text" class="form-control-spacial" id="station" name="station" value="{{isset($result->station)?$result->station:''}}"> -->
													<select id="st" name="department" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Department 1</option></select>

												 </div>

												 <div class="form-group">
													<label>Employee Type:</label>
													<!-- <input type="text" class="form-control-spacial" id="user_name" name="user_name" value="{{isset($result->user_name)?$result->user_name:''}}"> -->
													<select id="st" name="employee_type" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Employee Type 1</option></select>

												 </div>

												 <div class="form-group">
													<label>Employee Category:</label>
													<!-- <input type="text" class="form-control-spacial" id="access_code" name="access_code" value="{{isset($result->access_code)?$result->access_code:''}}"> -->
													<select id="st" name="employee_category" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Employee Category 1</option></select>

												 </div>

												 <div class="form-group">
													<label>Designation / Job Title:</label>
													<!-- <input type="text" class="form-control-spacial" id="joining_date" name="joining_date" value="{{isset($result->joining_date)?$result->joining_date:''}}"> -->
													<select id="st" name="employee_designation" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Employee Designation 1</option></select>
												 </div>

												 <div class="form-group">
													<label>Grade:</label>
													<select id="st" name="grade" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">1</option></select>

												 </div>

												 <div class="form-group">
													<label>Work Shift:</label>
													<select id="st" name="work_shift" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Work Shift 1</option></select>

												 </div>
												<div class="form-upper-main">
													<h4>Employee Information</h4>
												</div>

												<div class="form-group">
													<label>Allow Employee Login:</label>
													<span class="switch switch-sm"><input class="switch" id="al" checked="true" type="checkbox"><label for="al" class="label-primary"></label></span>
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
													<select id="st" name="roles_template" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Roles Template 1</option></select>

												 </div>

												 <div class="form-group">
													<label>Email Address:</label>
													<input type="text" class="form-control-spacial" id="email_address" name="email_address" value="{{isset($result->email_address)?$result->email_address:''}}">

												 </div>

												 <div class="form-group">
													<label>GSuite User:</label>
													<span class="switch switch-sm"><input class="switch" id="al" checked="true" type="checkbox"><label for="al" class="label-primary"></label></span>
												 </div>

												 <div class="form-group">
													<label>Show In Organogram:</label>
													<span class="switch switch-sm"><input class="switch" id="al" checked="true" type="checkbox"><label for="al" class="label-primary"></label></span>
												 </div>
												 <div class="form-upper-main">
													<h4>Employee Access Code</h4>
												</div>
												<div class="form-group">
													<label>Access Code (Optional):</label>
													<input type="text" class="form-control-spacial" id="email_address" name="email_address" value="{{isset($result->email_address)?$result->email_address:''}}">
												 </div>
												 <div class="form-upper-main">
													<h4>Employee Notifications</h4>
												</div>
												<div class="form-group">
													<label>Notifications By Email:</label>
													<span class="switch switch-sm"><input class="switch" id="al" checked="true" type="checkbox"><label for="al" class="label-primary"></label></span>
												 </div>
												 <div class="form-upper-main">
													<h4>Employee Reporting</h4>
												</div>
												<div class="form-group">
													<label>Reports To:</label>
													<select id="st" name="company_name" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Senier 1</option></select>
												 </div>
												 <div class="form-group">
													<label>Reports To (Indirect Reporting):</label>
													<select id="st" name="company_name" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Senier 1</option></select>
												 </div>
												 <div class="form-group">
													<label>Supervisor:</label>
													<select id="st" name="company_name" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Senier 1</option></select>
												 </div>
												 <div class="form-upper-main">
													<h4>Employee Specific Approvals</h4>
												</div>
												<div class="form-group">
													<label>Approval Levels:</label>
													<select id="st" name="company_name" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Auto Approved</option></select>
												 </div>
												 <div class="form-upper-main">
													<h4>Employee Personal Information</h4>
												</div>
												<div class="form-group">
													<label>Salutation:</label>
													<select id="st" name="salutation" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Mr.</option></select>
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
													<input type="date" class "form-control-spacial date" id="dob" name="dob">
												 </div>
												 <div class="form-group">
													<label>Gender:</label>
													<select id="st" name="company_name" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Male</option></select>
												 </div>
												 <div class="form-group">
													<label>Blood Group:</label>
													<select id="st" name="company_name" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">O+</option></select>
												 </div>
												 <div class="form-group">
													<label>Nationality:</label>
													<select id="st" name="company_name" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Indian</option></select>
												 </div>
												 <div class="form-group">
													<label>Religion:</label>
													<select id="st" name="company_name" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Hinduism</option></select>
												 </div>
												 <div class="form-group">
													<label>Marital Status:</label>
													<select id="st" name="company_name" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Single</option></select>
												 </div>
												 <div class="form-upper-main">
													<h4>Employee Additional Information</h4>
												</div>
												<div class="form-group">
													<label>Joining Date:</label>
													<input type="date" class "form-control-spacial date" id="dob" name="dob">
												 </div>
												<div class="form-group">
													<label>Government Id / Social Security:</label>
													<input type="text" class="form-control-spacial" id="nick_name" name="nick_name" value="{{isset($result->nick_name)?$result->nick_name:''}}">
												 </div>
												 <div class="form-group">
													<label>Employee Tax Number:</label>
													<input type="text" class="form-control-spacial" id="nick_name" name="nick_name" value="{{isset($result->nick_name)?$result->nick_name:''}}">
												 </div>
												 <div class="form-upper-main">
													<h4>Employee Driving License</h4>
												</div>
												<div class="form-group">
													<label>Driving License Number:</label>
													<input type="text" class="form-control-spacial" id="nick_name" name="nick_name" value="{{isset($result->nick_name)?$result->nick_name:''}}">
												 </div>
												 <div class="form-group">
													<label>Driving License Expiration:</label>
													<input type="text" class="form-control-spacial" id="nick_name" name="nick_name" value="{{isset($result->nick_name)?$result->nick_name:''}}">
												 </div>
												 <div class="form-upper-main">
													<h4>Employee Passport</h4>
												</div>
												<div class="form-group">
													<label>Passport Number:</label>
													<input type="text" class="form-control-spacial" id="nick_name" name="nick_name" value="{{isset($result->nick_name)?$result->nick_name:''}}">
												 </div>
												 <div class="form-group">
													<label>Passport Expiration:</label>
													<input type="text" class="form-control-spacial" id="nick_name" name="nick_name" value="{{isset($result->nick_name)?$result->nick_name:''}}">
												 </div>
												 <div class="form-group">
													<label>Passport Issuance Country:</label>
													<select id="st" name="company_name" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">India</option></select>
												 </div>
												 <div class="form-upper-main">
													<h4>Permanent Contact Information</h4>
												</div>
												<div class="form-group">
													<label>Address:</label>
													<input type="text" style="width:500px" class="form-control-spacial" id="nick_name" name="nick_name" value="{{isset($result->nick_name)?$result->nick_name:''}}">
												 </div>
												 <div class="form-group">
													<label>City:</label>
													<input type="text" class="form-control-spacial" id="nick_name" name="nick_name" value="{{isset($result->nick_name)?$result->nick_name:''}}">
												 </div>
												 <div class="form-group">
													<label>State / Province:</label>
													<input type="text" class="form-control-spacial" id="nick_name" name="nick_name" value="{{isset($result->nick_name)?$result->nick_name:''}}">
												 </div>
												 <div class="form-group">
													<label>Zip Code / Postal Code:</label>
													<input type="text" class="form-control-spacial" id="nick_name" name="nick_name" value="{{isset($result->nick_name)?$result->nick_name:''}}">
												 </div>
												 <div class="form-group">
													<label>Country:</label>
													<select id="st" name="company_name" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">India</option></select>
												 </div>
												 <div class="form-group">
													<label>Contact Number:</label>
													<input type="text" class="form-control-spacial" id="nick_name" name="nick_name" value="{{isset($result->nick_name)?$result->nick_name:''}}">
												 </div>

												 <div class="form-upper-main">
													<h4>Present Contact Information</h4>
												</div>
												<div class="form-group">
													<label>Same as Permanent Contact:</label>
													<span class="switch switch-sm"><input class="switch" id="sap" type="checkbox"><label for="sap" class="label-primary"></label></span>
												 </div>
												 <div class="form-group">
													<label>Address:</label>
													<input type="text" class="form-control-spacial" id="nick_name" name="nick_name" value="{{isset($result->nick_name)?$result->nick_name:''}}">
												 </div>
												 <div class="form-group">
													<label>City:</label>
													<input type="text" class="form-control-spacial" id="nick_name" name="nick_name" value="{{isset($result->nick_name)?$result->nick_name:''}}">
												 </div>
												 <div class="form-group">
													<label>State / Province:</label>
													<input type="text" class="form-control-spacial" id="nick_name" name="nick_name" value="{{isset($result->nick_name)?$result->nick_name:''}}">
												 </div>
												 <div class="form-group">
													<label>Zip Code / Postal Code:</label>
													<input type="text" class="form-control-spacial" id="nick_name" name="nick_name" value="{{isset($result->nick_name)?$result->nick_name:''}}">
												 </div>
												 <div class="form-group">
													<label>Country:</label>
													<select id="st" name="company_name" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">India</option></select>
												 </div>
												 <div class="form-group">
													<label>Contact Number:</label>
													<input type="text" class="form-control-spacial" id="nick_name" name="nick_name" value="{{isset($result->nick_name)?$result->nick_name:''}}">
												 </div>


												 <div class="form-upper-main">
													<h4>Phone Number</h4>
												</div>
												<div class="form-group">
													<label>Home Phone Number:</label>
													<input type="text" class="form-control-spacial" id="nick_name" name="nick_name" value="{{isset($result->nick_name)?$result->nick_name:''}}">
												 </div>
												 <div class="form-group">
													<label>Office Phone Number:</label>
													<input type="text" class="form-control-spacial" id="nick_name" name="nick_name" value="{{isset($result->nick_name)?$result->nick_name:''}}">
												 </div>
												 <div class="form-group">
													<label>Mobile Number:</label>
													<input type="text" class="form-control-spacial" id="nick_name" name="nick_name" value="{{isset($result->nick_name)?$result->nick_name:''}}">
												 </div>


												 <div class="form-upper-main">
													<h4>Emergency Contact</h4>
												</div>
												<div class="form-group">
													<label>Emergency Contact Person:</label>
													<input type="text" placeholder="Emergency Contact Person" class="form-control-spacial" id="nick_name" name="nick_name" value="{{isset($result->nick_name)?$result->nick_name:''}}">
												 </div>
												 <div class="form-group">
													<label>Relationship:</label>
													<input type="text" placeholder="Relationship" class="form-control-spacial" id="nick_name" name="nick_name" value="{{isset($result->nick_name)?$result->nick_name:''}}">
												 </div>
												 <div class="form-group">
													<label>Phone Number:</label>
													<input type="text" placeholder="Phone Number" class="form-control-spacial" id="nick_name" name="nick_name" value="{{isset($result->nick_name)?$result->nick_name:''}}">
												 </div>


												 <div class="form-upper-main">
													<h4>Additional Information</h4>
												</div>
												<div class="form-group">
													<label>Notes:</label>
													<textarea id="notes" class="form-control-spacial"></textarea>
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
													<span class="switch switch-sm"><input class="switch" id="sec" type="checkbox"><label for="sec" class="label-primary"></label></span>
												 </div>
												 <div class="form-group">
													<label>Employee must change password on next login:</label>
													<span class="switch switch-sm"><input class="switch" id="sec" type="checkbox"><label for="sec" class="label-primary"></label></span>
												 </div>

												 <div class="form-upper-main">
													<h4>Employee Contract</h4>
												</div>
												<div class="form-group">
													<label>Create Employee Auto Contract:</label>
													<span class="switch switch-sm"><input class="switch" id="sec" type="checkbox"><label for="sec" class="label-primary"></label></span>
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
