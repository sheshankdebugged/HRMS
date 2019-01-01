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
												<a href="{{ url('memos') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Memo Information</h4>
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
                                        
                                        <form method="post" action="{{ url('memos/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">
												
											<div class="form-group">
													<label>Memo From:</label>
													<select id="memo_from" name="memo_from"" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Memo From </option></select>
													<!-- <input type="text" placeholder="Contact Person" class="form-control-spacial" id="registration_name" name="contact_person" value="{{isset($result->contact_person)?$result->contact_person:''}}"> -->
                                                   
												 </div>


												 <div class="form-group">
												   <label>Memo Subject:</label>
												   <!-- <select id="forward_application_to" name="forward_application_to" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Forward Application To: 1</option></select> -->
													<input type="text" placeholder="Memo Subject" class="form-control-spacial" id="memo_subject" name="memo_subject" value="{{isset($result->memo_subject)?$result->memo_subject:''}}">
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>

												 
												 <div class="form-group">
												   <label>Memo Date:</label>
												   <!-- <select id="Memo Date" name="employee_category" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Employee Category 1</option></select> -->
													<!-- <input type="text" placeholder="Memo Date" class="form-control-spacial" id="memo_date" name="memo_date" value="{{isset($result->memo_date)?$result->memo_date:''}}"> -->
													<input type="text" placeholder="" class="form-control-spacial date" id="memo_date" name="memo_date" value="{{isset($result->memo_date)?$result->memo_date:''}}">
												 </div>
												 <div class="form-group">
													<h4>Memo To</h4>
												 </div>
												 <div class="form-group">
													<label>Memo To:</label>
													<select id="memo_to" name="memo_to"" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Memo To</option></select>
													<!-- <input type="text" placeholder="Contact Person" class="form-control-spacial" id="registration_name" name="contact_person" value="{{isset($result->contact_person)?$result->contact_person:''}}"> -->
                                                   
												 </div>
										 
												 
												

												 
												 <div class="form-group">
													<h4>Memo Description</h4>
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
