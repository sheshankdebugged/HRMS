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
												<a href="{{ url('companies') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Company Information</h4>
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
                                        
                                        <form method="post" action="{{ url('companies/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">
												
												 <div class="form-group">
													<label>Company Name:</label>
													<input type="text" class="form-control-spacial" id="company_name" name="company_name" value="{{isset($result->company_name)?$result->company_name:''}}" placeholder="Company name">
                                                    <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
												 </div>

                                                 <div class="form-group">
													<label>Legal / Trading Name:</label>
													<input type="text" class="form-control-spacial" id="legal_trading_name" value="{{isset($result->legal_trading_name)?$result->legal_trading_name:''}}" name="legal_trading_name" placeholder="Legal / Trading Name"> 
                                                   
												 </div>

                                                 <div class="form-group">
													<label>Registration Number:</label>
													<input type="text" placeholder="Registration Number" class="form-control-spacial" id="registration_name" name="registration_number" value="{{isset($result->registration_number)?$result->registration_number:''}}">
                                                   
												 </div>

												 <div class="form-group">
													<label>Company Type:</label>
													
													<select  name ="company_type" class="form-control-select">
													 
													<option style="" value="0"> - </option><option style="" value="1">Corporation</option><option style="" value="2">Exempt Organization</option><option style="" value="3">Partnership</option><option style="" value="4">Private Foundation</option><option style="" value="5">S Corporation</option><option style="" value="6">Sole Proprietor</option><option style="" value="7">Limited Liability Company</option><option style="" value="8">Trading LLC</option><option style="" value="9">Private Limited</option><option style="" value="10">General Partnership</option><option style="" value="11">Limited Partnership</option><option style="" value="12">Non Profit Organization</option><option style="" value="13">Trust</option><option style="" value="14">Joint Venture</option><option style="" value="15">Association</option><option style="" value="16">Free Zone</option>

													</select>


												 </div>


												 <div class="form-group">
													<h4>Contact Details</h4>
												 </div>


												 <div class="form-group">
													<label>Contact Person:</label>
													<input type="text" placeholder="Contact Person" class="form-control-spacial" id="registration_name" name="contact_person" value="{{isset($result->contact_person)?$result->contact_person:''}}">
                                                   
												 </div>


												 <div class="form-group">
												   <label>Contact Person Designation:</label>
													
													<input type="text" placeholder="Contact Person Designation" class="form-control-spacial" id="contact_person_designation" name="contact_person_designation" value="{{isset($result->contact_person_designation)?$result->contact_person_designation:''}}">
                                
												 </div>

												 
												 <div class="form-group">
												   <label>Contact Number:</label>
													
													<input type="text" placeholder="Contact Number" class="form-control-spacial" id="contact_number" name="contact_number" value="{{isset($result->contact_number)?$result->contact_number:''}}">
                                
												 </div>

												 <div class="form-group">
												   <label>Fax Number:</label>
													
													<input type="text" placeholder="Fax Number" class="form-control-spacial" id="fax_number" name="fax_number" value="{{isset($result->fax_number)?$result->fax_number:''}}">
                                
												 </div>

												 <div class="form-group">
												   <label>Email Address:</label>
													<input type="text" placeholder="Email Address" class="form-control-spacial" id="email_address" name="email_address" value="{{isset($result->email_address)?$result->email_address:''}}">
                                
												 </div>

												 <div class="form-group">
												   <label>Website:</label>
													<input type="text" placeholder="Website" class="form-control-spacial" id="website" name="website" value="{{isset($result->website)?$result->website:''}}">
                                
												 </div>

												 <div class="form-group">
													<h4>Tax Information</h4>
												 </div>


												 <div class="form-group">
												   <label>Government Tax Number / EIN:</label>
													<input type="text" placeholder="National Tax Number" class="form-control-spacial" id="government_tax_number" name="government_tax_number" value="{{isset($result->government_tax_number)?$result->government_tax_number:''}}">
                                
												 </div>

												 <div class="form-group">
												   <label>State / Province Tax Number:</label>
												   <input type="text" placeholder="State Tax Number" class="form-control-spacial" id="province_tax_number" name="province_tax_number" value="{{isset($result->province_tax_number)?$result->province_tax_number:''}}">
                
												 </div>


												 <div class="form-group">
													<h4>Company Postal Address</h4>
												 </div>


												 <div class="form-group">
												    <label>Address:</label>
													<input type="text" placeholder="Address" name="address" class="form-control-spacial" id="address" name="address" value="{{isset($result->address)?$result->address:''}}">
                                
												 </div>

												 <div class="form-group">
												   <label>City:</label>
												   <input type="text"  placeholder="City"  class="form-control-spacial" id="city" name="city" value="{{isset($result->city)?$result->city:''}}">
                
												 </div>

												 <div class="form-group">
												   <label>State / Province:</label>
												   <input type="text"  placeholder="State / Province"  placeholder="State Tax Number" class="form-control-spacial" id="state" name="state" value="{{isset($result->state)?$result->state:''}}">
                
												 </div>

												 <div class="form-group">
												   <label>Zip Code / Postal Code:</label>
												   <input type="text"  placeholder="Zip Code / Postal Code"   placeholder="State Tax Number" class="form-control-spacial" id="zip_code" name="zip_code" value="{{isset($result->zip_code)?$result->zip_code:''}}">
                
												 </div>

												 <div class="form-group">
												   <label>Country:</label>
												   <input type="text"  placeholder="Country" placeholder="State Tax Number" class="form-control-spacial" id="country" name="country" value="{{isset($result->country)?$result->country:''}}">
                
												 </div>


												 <div class="form-group">
													<h4>Company Bank Account</h4>
												 </div>
                                                   

												
												 <div class="form-group">
												   <label>Bank Name:</label>
												   <input type="text"  placeholder="Bank Name"  class="form-control-spacial" id="bank_name" name="bank_name" value="{{isset($result->bank_name)?$result->bank_name:''}}">
                
												 </div>

												 <div class="form-group">
												   <label>Account Title:</label>
												   <input type="text"  placeholder="Account Title" class="form-control-spacial" id="account_title" name="account_title" value="{{isset($result->account_title)?$result->account_title:''}}">
                
												 </div>

												 <div class="form-group">
												   <label>Account Number:</label>
												   <input type="text"  placeholder="Account Number" class="form-control-spacial" id="registration_name" name="account_number" value="{{isset($result->account_number)?$result->account_number:''}}">
                
												 </div>

												 <div class="form-group">
												   <label>Routing Number:</label>
												   <input type="text"  placeholder="Routing Number"  class="form-control-spacial" id="registration_name" name="routing_number" value="{{isset($result->routing_number)?$result->routing_number:''}}">
                
												 </div>

												 <div class="form-group">
												   <label>Account Type:</label>
												   <select id="ba_atype" class="WebHRForm1" style="width:180px;" name="account_type"><option style="" value="0"> - </option><option style="" value="1">Checking</option><option style="" value="2">Saving</option></select>
												 </div>

												 <div class="form-group">
													<h4>Company Vision</h4>
												 </div>
												 <div class="form-group">
												 <label>Company Vision:</label>
													<textarea class="tinyeditorclass" name="company_vision" id="company_vision">{{isset($result->company_vision)?$result->company_vision:''}}</textarea>
												</div> 


												<div class="form-group">
													<h4>Company Mission</h4>
												 </div>
												 <div class="form-group">
												 <label>Company Mission:</label>
												 <textarea class="tinyeditorclass" name="company_mission" id="company_mission">{{isset($result->company_mission)?$result->company_mission:''}}</textarea>
												</div> 


												<div class="form-group">
													<h4>Company Profile</h4>
												 </div>
												 <div class="form-group">
												 <label>Company Profile:</label>
												 <textarea class="tinyeditorclass" name="company_profile" id="company_profile">{{isset($result->company_profile)?$result->company_profile:''}}</textarea>
												</div> 

												<div class="form-group">
													<h4>Additional Information</h4>
												 </div>
												 <div class="form-group">
												 <label>Notes:</label>
													<textarea  name="additonal_information" id="additonal_information">{{isset($result->additonal_information)?$result->additonal_information:''}}</textarea>
												</div> 


												<div class="form-group">
												 <label>Record Added By:</label>
													 
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
