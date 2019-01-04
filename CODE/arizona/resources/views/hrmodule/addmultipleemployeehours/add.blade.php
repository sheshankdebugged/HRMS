@include('template.admin_header')

<div class="main-section">
	<div class="container">
		<div class="row">
			<div class="inner-main-section">
				<div class="col-md-12 col-sm-12">
					<div class="left-bar-request nopadding">
						<div class="sidebar-menu">
                        @include('template.recruitment_nav_icon')
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
											<a href="{{ url('#') }}" alt="Dashboard">
												<i class="fa fa-cog"></i>
											</a>
										</li>
										<!-- <li><a href="#" alt="Dashboard"><i class="fa fa-question-circle"></i></a></li> -->
									</ul>
								</div>
							</div>
							<div class="request-inner-table">
								<div class="upper-header-request">
									<div class="col-md-12 nopadding">
										<div class="back-button">
											<div class="add-record-btn">
												<a href="{{ url('employeehours') }}">
													<i class="fa fa-angle-left"></i>Back
												</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
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

                                        
										<form method="post" action="{{ url('jobposts/save') }}">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">
													<div class="form-field-inner">
														<div class="form-upper-main">
															<h4>Select Employees</h4>
														</div>
														<div class="form-group">
															<label>Company:</label>
															<select id="company_id" multiple class="WebHRForm1 chosen-select" style="width:180px;" name="company_id">
													@foreach($master['Companies'] as $val)
														
																<option value="{{$val['id']}}" @php if(isset($result->company_id) && $result->company_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['company_name']}}</option>
													@endforeach
													
															</select>
														</div>
														<div class="form-group">
															<label>Station:</label>
															<select id="st" multiple class="WebHRForm1 chosen-select" style="width:180px;" name="station_id">
													@foreach($master['Stations'] as $val)
														
																<option  value="{{$val['id']}}" @php if(isset($result->station_id) && $result->station_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['station_name']}}</option>
													@endforeach
													
															</select>
														</div>
														<div class="form-group">
															<label>Department:</label>
															<!-- <input type="text" class="form-control-spacial" id="departments" name="department" value="{{isset($result->departments)?$result->departments:''}}"> -->
															<select id="st" multiple class="WebHRForm1 chosen-select" style="width:180px;" name="department_id">
													@foreach($master['Departments'] as $val)
														
																<option  value="{{$val['id']}}" @php if(isset($result->department_id) && $result->department_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['department_name']}}</option>
													@endforeach
													
															</select>
														</div>
														<div class="form-group">
															<label>Employees:</label>
															<select id ="employees_id" name ="employees_id" multiple class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Employees'] as $val)
													
																<option  value="{{$val['id']}}" @php if(isset($result->employees_id) && $result->employees_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													
															</select>
														</div>
														<div class="form-upper-main">
															<h4>Select Dates</h4>
														</div>
														<div class="form-group">
															<label>Date (From):</label>
															<input type="text" class="form-control-spacial date" id="date_from" name="date_from" value="{{isset($result->date_from)?$result->date_from:''}}">
															</div>
															<div class="form-group">
																<label>Date (To):</label>
																<input type="text" class="form-control-spacial date" id="date_to" name="date_to" value="{{isset($result->date_to)?$result->date_to:''}}">
																</div>
															</div>
															<div class="form-upper-main">
																<h4>Project (Optional)</h4>
															</div>
															<div class="form-group">
																<label>Project:</label>
																<select  name ="project_id" id="project_id" class="form-control-select chosen-select">
													@foreach($master['Projects'] as $val)
													
																	<option  value="{{$val['id']}}" @php if(isset($result->project_id) && $result->project_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['project_title']}}</option>
													@endforeach
													
																</select>
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

                                                
															<div class="button">
																<div class="btn">
																	<a href="{{ url('#') }}">
																		<i class="fa fa-search "></i>Find Employees
																	</a>
																</div>
															</div>
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
