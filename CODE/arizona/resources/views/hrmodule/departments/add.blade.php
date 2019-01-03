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
												<a href="{{ url('departments') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Department Information</h4>
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

                                        <form method="post" action="{{ url('departments/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">

												<div class="form-group">
													<label>Station:</label>
													<select id ="station_id" name ="station_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Stations'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->station_id) && $result->station_id == $val['country_id']  ) { echo "selected";  } @endphp >{{$val['station_name']}}</option>
													@endforeach
													</select>
												</div>

                                                <div class="form-group">
                                                    <label>Department Name:</label>
                                                    <input type="text" class="form-control-spacial" id="department_name" name="department_name" value="{{isset($result->department_name)?$result->department_name:''}}">
                                                    <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
                                                </div>

												<div class="form-group">
													<label>Parent Department:</label>
													<select id ="parent_department_id" name ="parent_department_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Departments'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->parent_department_id) && $result->parent_department_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['department_name']}}</option>
													@endforeach
													</select>
												</div>
												<div class="form-upper-main">
													<h4>Head of Department</h4>
                                                </div>
												 <div class="form-group">
													<label>Department Head:</label>
													<select id ="department_head_employee_id" name ="department_head_employee_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->department_head_employee_id) && $result->department_head_employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
												</div>
												<div class="form-group">
													<label>Assistant Department Head:</label>
													<select id ="ass_department_head_employee_id" name ="ass_department_head_employee_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->ass_department_head_employee_id) && $result->ass_department_head_employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
												</div>
												<div class="form-upper-main">
													<h4>Additional Information</h4>
												</div>
												<div class="form-group">
                                                    <label>Department Sorting Order</label>
                                                    <input type="text" class="form-control-spacial" id="department_sorting_order" name="department_sorting_order" value="{{isset($result->job_title)?$result->job_title:''}}">
													<a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Order in which Departments should appear, if all Departments have a sort order of 1, then they will appear in ascending order" data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
												</div>
												<div class="form-group">
												<label>Notes:</label>
													<textarea class="tinyeditorclass" name="notes" id="notes">{{isset($result->additonal_information)?$result->additonal_information:''}}</textarea>
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
