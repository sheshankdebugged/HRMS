@include('template.admin_header')
<div class="main-section">
	<div class="container">
        <div class="row">
			<div class="inner-main-section">
				<div class="col-md-12 col-sm-12">
					<div class="left-bar-request nopadding">
						<div class="sidebar-menu">
                        @include('template.payroll_nav_icon')
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
												<a href="{{ url('overtimes') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Overtime Information</h4>
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
                                        
                                        <form method="post" action="{{ url('overtimes/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">
												
												 <div class="form-group">
													<label>Employee Name:</label>
													<select id="employee_id" name="employee_id" class="WebHRForm1 chosen-select" style="width:180px;">
													<!-- <option value="ALL"> All </option> -->
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}">{{$val['employee_name']}}</option>
													@endforeach
													</select>
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>
												 <div class="form-group">
													<label>Forward Application To:</label>
													<select id="forward_employee_id" name="forward_employee_id" class="WebHRForm1 chosen-select" style="width:180px;">
													<!-- <option value="ALL"> All </option> -->
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}">{{$val['employee_name']}}</option>
													@endforeach
													</select>

												 </div>
												 <div class="form-group">
													<label>Title:</label>
													<input type="text" placeholder="overtimes Title" class="form-control-spacial" id="overtimes_title" name="overtimes_title" value="{{isset($result->overtimes_title)?$result->overtimes_title:''}}">
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>
												 <div class="form-group">
													<label>Date:</label>
													<input type="text" placeholder="" class="form-control-spacial date" id="overtimes_date" name="overtimes_date" value="{{isset($result->overtimes_date)?$result->overtimes_date:''}}">
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>
												 
												 <div class="form-group">
												   <label>Overtime Hours:</label>
												   <input type="text" placeholder="Overtime Hours" class="form-control-spacial" id="overtime_hours" name="overtime_hours" value="{{isset($result->overtime_hours)?$result->overtime_hours:''}}">
												   <!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->
												 </div>
												 												
												<div class="form-group">
													<h4>Overtime Time In / Out </h4>
												 </div>
												 <div class="form-group">
													<label>Time In (Optional):</label>
													<input type="time" placeholder="" class="form-control-spacial time" id="time_in" name="time_in" value="{{isset($result->time_in)?$result->time_in:''}}">

												 </div>
												 <div class="form-group">
													<label>Time Out (Optional):</label>
													<input type="time" placeholder="" class="form-control-spacial time" id="time_out" name="time_out" value="{{isset($result->time_out)?$result->time_out:''}}">

												 </div>

												

												 <div class="form-group">
													<h4>Overtime Description</h4>
												 </div>

                                                 <div class="form-group">
												 <label>Notes:</label>
													<textarea class="tinyeditorclass" name="overtime_description" id="overtime_description">{{isset($result->overtime_description)?$result->overtime_description:''}}</textarea>
												</div> 
												<div class="form-group">
													<h4>Overtime Document (Optional)</h4>
												 </div>
												 <div class="back-button">
													<div class="add-record-btn">
													<a href="#"></i>Add Attachment</a>
													</div>
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
