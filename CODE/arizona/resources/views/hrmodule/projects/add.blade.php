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
												<a href="{{ url('projects') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Project  Information</h4>
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
                                        <form method="post" action="{{ url('projects/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">
											<div class="form-field-inner">
												<div class="form-group">
													<label>Project Category:</label>
													<select id ="project_cat_id" name ="project_cat_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['ProjectCategories'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->project_cat_id) && $result->project_cat_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['project_category_name']}}</option>
													@endforeach
													</select>
													<a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is an optional field. To add a new category, please go to Project Settings by clicking on Projects Settings icon on top right corner within Projects module" data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>		
												</div>
												 <div class="form-group">
													<label>Project Title:</label>
													<input type="text" class="form-control-spacial" id="project_title" name="project_title" value="{{isset($result->project_title)?$result->project_title:''}}" placeholder="Project Title">
                                                    <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
												 </div>
												 <div class="form-group">
													<label>Client Name:</label>
													<select id ="client_id" name ="client_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Clients'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->client_id) && $result->client_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['name']}}</option>
													@endforeach
													</select>
													<a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is an optional field. To add a new client, please go to Project Settings by clicking on Projects Settings icon on top right corner within Projects module" data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>	
												 </div>
												 <div class="form-group">
													<label>Client Name (Old):</label>
													<input type="text"  id="client_name_old" name="client_name_old"  placeholder="Client Name">
                                                    <!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->
													<a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is an obsolete field, and will be removed from the system soon. Please use the Project Client field above" data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
												 </div>
												 <div class="form-group">
													<label>Project Start Date:</label>
													<input type="date" class "form-control-spacial date" id="start_date" name="start_date" value="{{isset($result->start_date)?$result->start_date:''}}">
                                                    <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
												 </div>
												<div class="form-group">
													<label>Project End Date:</label>
													<input type="date" class "form-control-spacial date" id="end_date" name="end_date" value="{{isset($result->end_date)?$result->end_date:''}}">
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
												</div>
												<div class="form-group">
													<h4>Project Audience</h4>
												 </div>
												 <div class="form-group">
													<label>Company:</label>
													<select id ="company_id" name ="company_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Companies'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->company_id) && $result->company_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['company_name']}}</option>
													@endforeach
													</select>
												 </div>
												 <div class="form-group">
													<label>Station:</label>
													<select id ="station_id" name ="station_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Stations'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->station_id) && $result->station_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['station_name']}}</option>
													@endforeach
													</select>
												 </div>
												 <div class="form-group">
													<label>Department:</label>
													<select id ="station_id" name ="department_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Departments'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->department_id) && $result->department_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['department_name']}}</option>
													@endforeach
													</select>
												 </div>
												 <div class="form-group">
													<h4>Project Employees</h4>
												 </div>
												 <div class="form-group">
													<label>Project Employees:</label>
													<select id ="project_employees" name ="project_employees" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->project_employees) && $result->project_employees == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
												 </div>
												 <div class="form-group">
													<label>Project Manager:</label>
													<select id ="project_manager_employee_id" name ="project_manager_employee_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->project_manager_employee_id) && $result->project_manager_employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
												 </div>
												 <div class="form-group">
													<label>Project Coordinator:</label>
													<select id ="project_coordinator_employee_id" name ="project_coordinator_employee_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->project_coordinator_employee_id) && $result->project_coordinator_employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
												 </div>
												 <div class="form-group">
													<h4>Project Description</h4>
												 </div>
												 <div class="form-group">
												 <label>Description:</label>
												 <textarea class="notes" name="notes" id="nproject_descriptionotes" id="project_description">{{isset($result->notes)?$result->project_description:''}}</textarea>
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
