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
												<a href="{{ url('promotions') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Promotion Information</h4>
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
                                        
                                        <form method="post" action="{{ url('promotions/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">
												
												 <div class="form-group">
													<label>Promotion For:</label>
													<select id="promotion_for_employee_id" name="promotion_for_employee_id" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Employee Name-</option></select>
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>
												 
												 <div class="form-group">
													<label>Forward Application To:</label>
													<select id="forward_application_to" name="forward_application_to" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Forward Application To</option></select>

												 </div>
												 
												 </div>
												 <div class="form-group">
												   <label>Promotion Title:</label>
												   <input type="text" placeholder="Promotion Title" class="form-control-spacial" id="promotion_title" name="promotion_title" value="{{isset($result->promotion_title)?$result->promotion_title:''}}">
												   <!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->
												 </div>

												 <div class="form-group">
													<label>Promotion Designation From:</label>
													<select id="promotion_designation_from" name="promotion_designation_from" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Promotion Designation From</option></select>

												 </div>

												 <div class="form-group">
													<label>Promotion Designation To:</label>
													<select id="promotion_designation_to" name="promotion_designation_to" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Promotion Designation To</option></select>

												 </div>

												 <div class="form-group">
													<label>Promotion Grade From:</label>
													<select id="promotion_grade_from" name="promotion_grade_from" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Promotion Grade From</option></select>

												 </div>

												 <div class="form-group">
													<label>Promotion Grade To:</label>
													<select id="promotion_grade_to" name="promotion_grade_to" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Promotion Grade To</option></select>

												 </div>

												 <div class="form-group">
													<label>Promotion Date:</label>
													<!-- <input type="text" placeholder="" class="form-control-spacial date" id="promotion_date" name="promotion_date" value="{{isset($result->promotion_date)?$result->promotion_date:''}}"> -->
													<input type="text" placeholder="" class="form-control-spacial date" id="promotion_date" name="promotion_date" value="{{isset($result->promotion_date)?$result->promotion_date:''}}">
												 </div>

												 <div class="form-group">
													<h4>Promotion Description</h4>
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
