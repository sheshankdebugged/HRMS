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
												<a href="{{ url('employeetrainings') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Training Information</h4>
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




                                        <form method="post" action="{{ url('employeetrainings/save') }}" enctype='multipart/form-data' >
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">
												 <div class="form-group">
													
												 <div class="form-group">
													<label>Training Type:</label>
													<select  id="training_type_id" name="training_type_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['TrainingTypes'] as $val)
														<option  value="{{$val['id']}}"  @php if(isset($result->training_type_id) && $result->training_type_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['value']}} </option>
													@endforeach
													</select>
													</div>
													
													<div class="form-group">
													<label>Training Subject:</label>
												    <select  name ="training_subject_id" id="training_subject_id" class="form-control-select chosen-select" >
													@foreach($master['TrainingSubjects'] as $val)
														<option  value="{{$val['id']}}"  @php if(isset($result->training_subject_id) && $result->training_subject_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['value']}} </option>
													@endforeach
													</select>
													<a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="To change Training Subjects, please go to Organization - System Settings - Constants" data-original-title="" title="">
													<i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
												 </div>


												<div class="form-group">
													<label>Nature of Training:</label>
												    <select  name ="training_nature" id="training_nature" class="form-control-select chosen-select" >
													<option  value="1">External</option>
													<option  value="0">Internal</option>
													</select>
												 </div>
												 <div class="form-group">
													<label>Training Title:</label>
														<input type="text"  placeholder="Training Title" class="form-control-spacial" id="training_title" name="training_title" value="{{isset($result->training_title)?$result->training_title:''}}">
														<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
												 </div>

												 <div class="form-upper-main">
													<h4>Group Employees</h4>
													</div>
													<div class="form-upper-main">
														<h4>Employees</h4>
													</div>
												 <div class="form-group">
													<label>Employees:</label>
													<select multiple id="employee_id" name="employee_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Employees'] as $val)
														<option  value="{{$val['id']}}"  @php if(isset($result->employee_id) && $result->employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}} [{{$val['user_name']}}]</option>
													@endforeach
													</select>
												</div>
												<div class="form-upper-main">
														<h4>Training Details</h4>
													</div>

													<div class="form-group">
													<label>Trainer:</label>
														<input type="text"  placeholder="Trainer" class="form-control-spacial" id="trainer_name" name="trainer_name" value="{{isset($result->trainer_name)?$result->trainer_name:''}}">
													 </div>
													 <div class="form-group">
													<label>Training Location:</label>
														<input type="text"  placeholder="Trainer Location" class="form-control-spacial" id="training_location" name="training_location" value="{{isset($result->training_location)?$result->training_location:''}}">
													 </div>
													 <div class="form-group">
													<label>Training Sponsored By:</label>
														<input type="text"  placeholder="Training Sponsored By" class="form-control-spacial" id="training_sponsor" name="training_sponsor" value="{{isset($result->training_sponsor)?$result->training_sponsor:''}}">
													 </div>
													 <div class="form-group">
													<label>Training Organized By:</label>
														<input type="text"  placeholder="Training Organized By" class="form-control-spacial" id="training_organizer" name="training_organizer" value="{{isset($result->training_organizer)?$result->training_organizer:''}}">
													 </div>

													 <div class="form-upper-main">
														<h4>Training Dates</h4>
													</div>

													<div class="form-group">
                                                    <label>Training From:</label>
                                                    <input type="date"  id="training_start_date" name="training_start_date" value="{{isset($result->training_start_date)?$result->training_start_date:''}}">
                                                    <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
                                                </div>
												<div class="form-group">
                                                    <label>Training To:</label>
                                                    <input type="date"  id="training_end_date" name="training_end_date" value="{{isset($result->training_end_date)?$result->training_end_date:''}}">
                                                    <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
                                                </div>

												<div class="form-upper-main">
														<h4>Training Time (Optional)</h4>
													</div>

													<div class="form-group">
                                                    <label>Start Time:</label>
                                                    <input type="time"  id="start_time" name="start_time" value="{{isset($result->start_time)?$result->start_time:''}}">
                                                </div>
												<div class="form-group">
                                                    <label>End Time:</label>
                                                    <input type="time"  id="end_time" name="end_time" value="{{isset($result->end_time)?$result->end_time:''}}">
                                                </div>


												<!-- <div class="form-group">
													<label>External Email Addresses:</label>
														<input type="text" class="form-control-spacial" id="email_addresses" name="email_addresses" value="{{isset($result->email_addresses)?$result->email_addresses:''}}">
												 </div> -->

												 <div class="form-upper-main">
														<h4>Training Hours (Optional)</h4>
													</div>
													<div class="form-group">
													<label>Training Hours:</label>
														<input type="text"  placeholder="Training Hours" class="form-control-spacial" id="training_hours" name="training_hours" value="{{isset($result->training_hours)?$result->training_hours:''}}">
													 </div>

													 <div class="form-upper-main">
                                                    <h4>Training Description</h4>
                                                </div>
                                                <div class="form-group">
													<textarea class="tinyeditorclass" name="training_description" id="training_description">{{isset($result->training_description)?$result->training_description:''}}</textarea>
												</div>

												<div class="form-upper-main">
                                                    <h4>Employee Additional Information</h4>
                                                </div>
												<div class="form-group">
												<label>Create Employee Trainings in Employee Additional Information:</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="employeea_additional_information" name="employeea_additional_information" value="{{isset($result->employeea_additional_information)?$result->employeea_additional_information:''}}">
		                                           <span class="slider round"></span>
												   </label>
                                            	</div>
												<div class="form-group">
													<h4>Additional Information</h4>
												 </div>
												<div class="form-group">
												 <label>Notes:</label>
												 <textarea class="notes" name="notes" id="notes" id="notes">{{isset($result->notes)?$result->notes:''}}</textarea>
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
                                                {{--Additional Information End--}}

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
