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
												<a href="{{ url('employeesexit') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Employee Exit Information</h4>
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

                                        <form method="post" action="{{ url('employeesexit/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">


											<div class="form-group">
													<label>Employee:</label>

													<select  name ="employee_id" id="employee_id" class="form-control-select chosen-select" >													
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}"  @php if(isset($result->employee_id) && $result->employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
												<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>


											</div>

												 
                                                  <div class="form-group">
													<label>Exit Date:</label>
													<input type="date" placeholder="" class"form-control-spacial date" id="exit_date" name="exit_date" value="{{isset($result->exit_date)?$result->exit_date:''}}">
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>
												 <div class="form-group">
													<label>Type of Exit:</label>
													
												 	<select  name ="exit_type_id" class="form-control-select chosen-select">
													 @foreach($master['EmployeeExitType'] as $val)
													<option  value="{{$val['id']}}"  @php if(isset($result->exit_type_id) && $result->exit_type_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['name']}}</option>
													@endforeach

													</select>


												 </div>

												 
												 <div class="form-group">
													<label>Conducted Exit Interview:</label>
													@php $array= ['-','Yes','No']@endphp
													<select  name ="conducted_exit_interview" id="conducted_exit_interview" class="form-control-select chosen-select">
														@foreach($array as $key=>$val):
														 <option value="{{$key}}" @php if(isset($result->conducted_exit_interview) && $key == $result->conducted_exit_interview)
													     { echo "selected" ; } @endphp  >{{$val}} </option>
													    @endforeach;
													</select>
												 </div>											


												 
												 <div class="form-group">
													<label>Exit Interviewer:</label>
													<!-- <input type="text" placeholder="" class="form-control-spacial" id="	exit_interviewer" name="exit_interviewer" value="{{isset($result->exit_interviewer)?$result->exit_interviewer:''}}"> -->
													<select multiple name ="exit_interviewer_id" id="exit_interviewer_id" class="form-control-select chosen-select" >													
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}"  @php if(isset($result->employee_id) && $result->employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}} [{{$val['user_name']}}]</option>
													@endforeach
													</select>
												 </div>

												 




												 

												<div class="form-group">
													<h4>Exit Reason</h4>
												 </div>
												 <div class="form-group">
												 <label>Notes:</label>
													<textarea class="tinyeditorclass" name="exit_reason" id="exit_reason">{{isset($result->notes)?$result->notes:''}}</textarea>
												</div>
												<div class="form-group">
													<h4>Additional Information</h4>
												 </div>
												 <div class="form-group">
												 <label>Notes:</label>
													<textarea class="tinyeditorclass" name="notes" id="notes">{{isset($result->notes)?$result->notes:''}}</textarea>
												</div>


												<div class="form-group">
												 <label>Record Added By:</label>
												 <div class="FieldValue">System Administrator</div>
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
