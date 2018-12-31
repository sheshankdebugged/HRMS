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
										<h4>Leave Information</h4>
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
                                        
                                        <form method="post" action="{{ url('leaves/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">
												
											<div class="form-group">
													<label>Employee:</label>
													<select id="employee" name="employee" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">1</option></select>
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
													<!-- <input type="text" placeholder="Contact Person" class="form-control-spacial" id="registration_name" name="contact_person" value="{{isset($result->contact_person)?$result->contact_person:''}}"> -->
                                                   
												 </div>


												 <div class="form-group">
												   <label>Forward Application To:</label>
												   <select id="forward_application_to" name="forward_application_to" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">forward 2</option></select>
												   <!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->
													<!-- <input type="text" placeholder="Contact Person Designation" class="form-control-spacial" id="contact_person_designation" name="contact_person_designation" value="{{isset($result->contact_person_designation)?$result->contact_person_designation:''}}"> -->
                                
												 </div>
												 <div class="form-group">
												   <label>Leave Type:</label>
												   <select id="leave_type" name="leave_type" class="WebHRForm1" style="width:180px;"><option style="" value="{{isset($result->leave_type)?$result->leave_type:''}}">-</option></select>
													<!-- <input type="text" placeholder="Fax Number" class="form-control-spacial" id="fax_number" name="fax_number" value="{{isset($result->fax_number)?$result->fax_number:''}}"> -->

																								 										 
												 <div class="form-group">
												   <label>Reason:</label>
												   <input type="text" class="form-control-spacial" placeholder="Reason" id="reason" name="reason" value="{{isset($result->reason)?$result->reason:''}}" >
												   <!-- <select id="regular_hours" name="regular_hours" class="WebHRForm1" style="width:180px;"><option style="" value="{{isset($result->regular_hours)?$result->regular_hours:''}}">10</option></select> -->
												   <!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->
													<!-- <input type="text" placeholder="Contact Number" class="form-control-spacial" id="contact_number" name="contact_number" value="{{isset($result->contact_number)?$result->contact_number:''}}"> -->
                                
												 </div>

												<div class="form-upper-main">
										            <h4>Leave Duration</h4>
									              </div>
												  <div class="form-group">
												   <label>Leave Duration:</label>
												   <select id="leave_duration" name="leave_duration" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">forward 2</option></select>
												   <!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->
													<!-- <input type="text" placeholder="Contact Person Designation" class="form-control-spacial" id="contact_person_designation" name="contact_person_designation" value="{{isset($result->contact_person_designation)?$result->contact_person_designation:''}}"> -->
                                
												 </div>

												 <div class="form-group">
												   <label>Leave From:</label>
												   <!-- <select id="Transfer Date" name="employee_category" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Employee Category 1</option></select> -->
													<!-- <input type="text" placeholder="Transfer Date" class="form-control-spacial" id="transfer_date" name="transfer_date" value="{{isset($result->transfer_date)?$result->transfer_date:''}}"> -->
													<input type="text" placeholder="" class="form-control-spacial date" id="leave_from" name="leave_from" value="{{isset($result->leave_from)?$result->leave_from:''}}">
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->
												 </div>

												 <div class="form-group">
												   <label>Leave To:</label>
												   <!-- <select id="Transfer Date" name="employee_category" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Employee Category 1</option></select> -->
													<!-- <input type="text" placeholder="Transfer Date" class="form-control-spacial" id="transfer_date" name="transfer_date" value="{{isset($result->transfer_date)?$result->transfer_date:''}}"> -->
													<input type="text" placeholder="" class="form-control-spacial date" id="leave_to" name="leave_to" value="{{isset($result->leave_to)?$result->leave_to:''}}">
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->
												 </div>
												 <div class="form-upper-main">
										            <h4>Alternate</h4>
									              </div>
												  <div class="form-group">
												   <label>Alternate Contact Number:</label>
												   <input type="text" class="form-control-spacial" placeholder="" id="alternate_contact_number" name="alternate_contact_number" value="{{isset($result->alternate_contact_number)?$result->alternate_contact_number:''}}" >
												   <!-- <select id="regular_hours" name="regular_hours" class="WebHRForm1" style="width:180px;"><option style="" value="{{isset($result->regular_hours)?$result->regular_hours:''}}">10</option></select> -->
												   <!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->
													<!-- <input type="text" placeholder="Contact Number" class="form-control-spacial" id="contact_number" name="contact_number" value="{{isset($result->contact_number)?$result->contact_number:''}}"> -->
                                
												 </div>
												 <div class="form-group">
													<label>Alternate Employee:</label>
													<select id="alternate_employee" name="alternate_employee" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">1</option></select>
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->
													<!-- <input type="text" placeholder="Contact Person" class="form-control-spacial" id="registration_name" name="contact_person" value="{{isset($result->contact_person)?$result->contact_person:''}}"> -->
                                                   
												 </div>

												 
                                
												 <div class="form-group">
													<h4>Leave Description</h4>
												 </div>
												 
												 <div class="form-group">
												 <textarea class="tinyeditorclass" name="leave_description" id="leave_description">{{isset($result->leave_description)?$result->detailleave_descriptions:''}}</textarea>
												</div>	

												<div class="form-group">
													<h4>Leave Document (Optional)</h4>
												 </div>

												 			 <!--Add Attachment Button  -->
										
											 
											 											 											 

												 <div class="form-group">
													<h4>Additional Information</h4>
												 </div>
												 
												 <div class="form-group">
												 <label>Notes:</label>
													<textarea class="tinyeditorclass" name="additional_information" id="additional_information">{{isset($result->notes)?$result->additional_information:''}}</textarea>
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
