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
												<a href="{{ url('holidays') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Holiday Information</h4>
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
                                        
                                        <form method="post" action="{{ url('holidays/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">
												
												 <div class="form-group">
													<label>Company:</label>
													<select id="company" name="company" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Company Name-</option></select>

												 </div>
												 
												 <div class="form-group">
													<label>Station:</label>
													<select id="station" name="station" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Station</option></select>

												 </div>

												  
												 <div class="form-group">
													<label>Department:</label>
													<select id="department" name="department" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Department</option></select>

												 </div>

												  
												 <div class="form-group">
													<label>Employee Type:</label>
													<select id="employee_type" name="employee_type" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Employee Type</option></select>

												 </div>

												  
												 <div class="form-group">
													<label>Employee Category:</label>
													<select id="employee_category" name="employee_category" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Employee Category</option></select>

												 </div>
												 
												 </div>
												 <div class="form-group">
												   <label>Title:</label>
												   <input type="text" placeholder="Title" class="form-control-spacial" id="holiday_title" name="holiday_title" value="{{isset($result->holiday_title)?$result->holiday_title:''}}">
												   <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
												 </div>

												 <div class="form-group">
													<label>Holiday Start Date:</label>
													<input type="text" placeholder="" class="form-control-spacial date" id="holiday_start_date" name="holiday_start_date" value="{{isset($result->holiday_start_date)?$result->holiday_start_date:''}}">
												 </div>								 

												 	<div class="form-group">
													<label>Holiday End Date:</label>
													<input type="text" placeholder="" class="form-control-spacial date" id="holiday_end_date" name="holiday_end_date" value="{{isset($result->holiday_end_date)?$result->holiday_end_date:''}}">
												 </div>
												 <div class="form-group">
													<label>Status:</label>
													<select id="holiday_status" name="holiday_status" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">holiday_status</option></select>

												 </div>

												 <div class="form-group">
													<h4>Description</h4>
												 </div>

                                                 <div class="form-group">
												 <label>Notes:</label>
													<textarea class="tinyeditorclass" name="holiday_description" id="holiday_description">{{isset($result->holiday_description)?$result->holiday_description:''}}</textarea>
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
