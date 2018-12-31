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
										<!-- <li>
											<a href="#" alt="Dashboard"><i class="fa fa-cog"></i></a>
										</li>
										<li>
											<a href="#" alt="Dashboard"><i class="fa fa-question-circle"></i></a>
										</li> -->
									</ul>
								</div>
							</div>
							<div class="request-inner-table">
								<div class="upper-header-request">
									<div class="col-md-12 nopadding">
										<div class="back-button">
											<div class="add-record-btn">
												<a href="{{ url('hourlywages') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Hourly Wage Information</h4>
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
                                        
                                        <form method="post" action="{{ url('hourlywages/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">
												
												 <div class="form-group">
													<label>Employee Name:</label>
    												<select id="employee_id" name="employee_id" class="WebHRForm1" style="width:180px;">
													<!-- <option value="ALL"> All </option> -->
													@foreach($master['Employees'] as $val)
													  <option  value="{{$val['id']}}" @php if(isset($result->employee_id) && $result->employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>
												 <div class="form-group">
													<label>Date:</label>
													<input type="text" placeholder="" class="form-control-spacial date" id="hourlywages_date" name="hourlywages_date" value="{{isset($result->hourlywages_date)?$result->hourlywages_date:''}}">
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>
												 												
												<div class="form-group">
													<h4>Hourly Wages Information </h4>
												 </div>
												 
												 <div class="form-group">
													<label>Title:</label>
													<input type="text" placeholder="Hourlywages Title" class="form-control-spacial" id="hourlywages_title" name="hourlywages_title" value="{{isset($result->hourlywages_title)?$result->hourlywages_title:''}}">
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>
												 
												 </div>
												 <div class="form-group">
												   <label>Regular Hours:</label>
												   <input type="text" placeholder="Regular Hours" class="form-control-spacial" id="regular_hours" name="regular_hours" value="{{isset($result->regular_hours)?$result->regular_hours:''}}">
												   <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
												 </div>

												 <div class="form-group">
												   <label>Overtime Hours:</label>
												   <input type="text" placeholder="Overtime Hours" class="form-control-spacial" id="overtime_hours" name="overtime_hours" value="{{isset($result->overtime_hours)?$result->overtime_hours:''}}">
												   <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
												 </div>
												

												 <div class="form-group">
													<h4>Hourly Wages Description</h4>
												 </div>

                                                 <div class="form-group">
												 <label>Notes:</label>
													<textarea class="tinyeditorclass" name="hourly_wages_description" id="hourly_wages_description">{{isset($result->hourly_wages_description)?$result->hourly_wages_description:''}}</textarea>
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
