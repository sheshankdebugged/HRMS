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
												<a href="{{ url('terminations') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Termination Information</h4>
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
                                        
                                        <form method="post" action="{{ url('terminations/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">
												
											<div class="form-group">
													<label>Employee Terminated:</label>
													<select id="employee_terminated" name="employee_terminated"" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Employee Terminated</option></select>
													<!-- <input type="text" placeholder="Contact Person" class="form-control-spacial" id="registration_name" name="contact_person" value="{{isset($result->contact_person)?$result->contact_person:''}}"> -->
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
												 </div>


												 <div class="form-group">
												   <label>Forward Application To:</label>
												   <select id="forward_application_to" name="forward_application_to" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Forward Application To:</option></select>
													<!-- <input type="text" placeholder="Termination Subject" class="form-control-spacial" id="Termination_subject" name="Termination_subject" value="{{isset($result->Termination_subject)?$result->Termination_subject:''}}"> -->
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>

												 
												 <div class="form-group">
												   <label>Termination Type:</label>
												   <select id="termination_type" name="termination_type" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Termination Type</option></select>
													<!-- <input type="text" placeholder="Termination Date" class="form-control-spacial" id="Termination_date" name="Termination_date" value="{{isset($result->Termination_date)?$result->Termination_date:''}}"> -->
													<!-- <input type="text" placeholder="" class="form-control-spacial date" id="Termination_date" name="Termination_date" value="{{isset($result->Termination_date)?$result->Termination_date:''}}"> -->
												 </div>
												 <div class="form-group">
												   <label>Termination Date:</label>
												   <input type="text" placeholder="" class="form-control-spacial date" id="termination_date" name="termination_date" value="{{isset($result->termination_date)?$result->termination_date:''}}">
												 </div>

												 <div class="form-group">
												   <label>Notice Date:</label>
												   <input type="text" placeholder="" class="form-control-spacial date" id="notice_date" name="notice_date" value="{{isset($result->notice_date)?$result->notice_date:''}}">
												 </div>

												 
												 
												

												 
												   <div class="form-group">
													<h4>Termination Description</h4>
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
