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
												<a href="{{ url('contracts') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Contract Information</h4>
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
                                        
                                        <form method="post" action="{{ url('contracts/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">
												
												 <div class="form-group">
													<label>Employee:</label>
													<select id="employee" name="employee" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Employee</option></select>
                                                    <!-- <input type="text" class="form-control-spacial" id="employee" name="employee" value="{{isset($result->employee)?$result->employee:''}}" placeholder="Employee"> -->
                                                    <!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fal fa-asterisk"></i> -->
                                                    <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fal fa-asterisk"></i>

												 </div>
												 
												 <div class="form-group">
													<label>Contract Type:</label>
													<!-- <input type="text" class="form-control-spacial" id="contract_type" value="{{isset($result->contract_type)?$result->contract_type:''}}" name="contract_type" placeholder="Contract Type">  -->
													<select id="contract_type" name="contract_type" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Contract Type</option></select>

												 </div>

                                                 <div class="form-group">
													<label>Contract Title:</label>
													<input type="text" class="form-control-spacial" id="contract_title" value="{{isset($result->contract_title)?$result->contract_title:''}}" name="contract_title" placeholder="Contract Title"> 
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fal fa-asterisk"></i>

												 </div>

                                                 <div class="form-group">
													<label>Contract Start Date:</label>
													<!-- <input type="text" placeholder="Contract Start Date" class="form-control-spacial" id="contract_start_date" name="contract_start_date" value="{{isset($result->contract_start_date)?$result->contract_start_date:''}}"> -->
													<input type="text" placeholder="" class="form-control-spacial date" id="contract_start_date" name="contract_start_date" value="{{isset($result->contract_start_date)?$result->contract_start_date:''}}">
												 </div>
												 <div class="form-group">
													<label>Contract End Date:</label>
													<!-- <input type="text" placeholder="Contract End Date" class="form-control-spacial" id="contract_end_date" name="contract_end_date" value="{{isset($result->contract_end_date)?$result->contract_end_date:''}}"> -->
													<input type="text" placeholder="" class="form-control-spacial date" id="contract_end_date" name="contract_end_date" value="{{isset($result->contract_end_date)?$result->contract_end_date:''}}">

												 </div>


												 <div class="form-group">
													<h4>Contact Details</h4>
												 </div>


												 <div class="form-group">
													<label>Employee Designation:</label>
													<select id="employee_designation" name="employee_designation" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Employee Designation 1</option></select>
													<!-- <input type="text" placeholder="Contact Person" class="form-control-spacial" id="registration_name" name="contact_person" value="{{isset($result->contact_person)?$result->contact_person:''}}"> -->
                                                   
												 </div>


												 <div class="form-group">
												   <label>Employee Type:</label>
												   <select id="employee_type" name="employee_type" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Employee Type 1</option></select>
													<!-- <input type="text" placeholder="Contact Person Designation" class="form-control-spacial" id="contact_person_designation" name="contact_person_designation" value="{{isset($result->contact_person_designation)?$result->contact_person_designation:''}}"> -->
                                
												 </div>

												 
												 <div class="form-group">
												   <label>Employee Category:</label>
												   <select id="employee_category" name="employee_category" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Employee Category 1</option></select>
													<!-- <input type="text" placeholder="Contact Number" class="form-control-spacial" id="contact_number" name="contact_number" value="{{isset($result->contact_number)?$result->contact_number:''}}"> -->
                                
												 </div>

												 <div class="form-group">
												   <label>Employee Grade:</label>
												   <select id="employee_grade" name="employee_grade" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Employee Grade 1</option></select>
													<!-- <input type="text" placeholder="Fax Number" class="form-control-spacial" id="fax_number" name="fax_number" value="{{isset($result->fax_number)?$result->fax_number:''}}"> -->
                                
												 </div>

												 <div class="form-group">
												   <label>Station:</label>
												   <select id="station" name="station" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Station 1</option></select>
													<!-- <input type="text" placeholder="Email Address" class="form-control-spacial" id="email_address" name="email_address" value="{{isset($result->email_address)?$result->email_address:''}}"> -->
                                
												 </div>

												 <div class="form-group">
												   <label>Department:</label>
													<!-- <input type="text" placeholder="Department" class="form-control-spacial" id="website" name="website" value="{{isset($result->website)?$result->website:''}}"> -->
													<select id="department" name="department" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Department 1</option></select>
												 </div>

												 <div class="form-group">
													<h4>Performance Review</h4>
												 </div>


												 <div class="form-group">
												   <label>Performance:</label>
													<!-- <input type="text" placeholder="National Tax Number" class="form-control-spacial" id="government_tax_number" name="government_tax_number" value="{{isset($result->government_tax_number)?$result->government_tax_number:''}}"> -->
                                                    <select id="performance" name="performance" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office"> -</option></select>
												 </div>

												 
												 <div class="form-group">
													<h4>Contract Description</h4>
												 </div>

                                                 <div class="form-group">
												 <label>Notes:</label>
													<textarea class="tinyeditorclass" name="additonal_information" id="additonal_information">{{isset($result->additonal_information)?$result->additonal_information:''}}</textarea>
												</div> 

												 											 

												 <div class="form-group">
													<h4>Additional Information</h4>
												 </div>
												 <div class="form-group">
												 <label>Notes:</label>
													<textarea class="tinyeditorclass" name="additonal_information" id="additonal_information">{{isset($result->additonal_information)?$result->additonal_information:''}}</textarea>
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
