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
												<a href="{{ url('contracts') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Contract Information</h4>
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
                                        
                                        <form method="post" action="{{ url('contracts/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">
												
												 <div class="form-group">
													<label>Employee:</label>
													<select id="employee_id" name="employee_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}">{{$val['employee_name']}}</option>
													@endforeach
														</select>
                                                    <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>
												 
												 <div class="form-group">
													<label>Contract Type:</label>
													<select id="contract_type_id" name="contract_type_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['ContractType'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->contract_type_id) && $result->contract_type_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['contract_type']}}</option>
													@endforeach
														</select>

												 </div>

                                                 <div class="form-group">
													<label>Contract Title:</label>
													<input type="text" class="form-control-spacial" id="contract_title" value="{{isset($result->contract_title)?$result->contract_title:''}}" name="contract_title" placeholder="Contract Title"> 
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>

                                                 <div class="form-group">
													<label>Contract Start Date:</label>
													<!-- <input type="text" placeholder="Contract Start Date" class="form-control-spacial" id="contract_start_date" name="contract_start_date" value="{{isset($result->contract_start_date)?$result->contract_start_date:''}}"> -->
													<input type="text" placeholder="" class="form-control-spacial date" id="contract_start_date" name="contract_start_date" value="{{isset($result->contract_start_date)?$result->contract_start_date:''}}">
												 </div>
												 <div class="form-group">
													<label>Contract End Date:</label>
													<!-- <input type="text" placeholder="Contract End Date" class="form-control-spacial" id="contract_end_date" name="contract_end_date" value="{{isset($result->contract_end_date)?$result->contract_end_date:''}}"> -->
													<input type="text" placeholder="" class="form-control-spacial date" id="contract_end_date" name="contract_end_date" value="{{isset($result->contract_end_date)?$result->contract_end_date:''}}">

												 </div>


												 <div class="form-group">
													<h4>Contact Details</h4>
												 </div>


												 <div class="form-group">
													<label>Employee Designation:</label>
													<select id="employee_designation_id" name="employee_designation_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['EmployeeDesignation'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->employee_designation_id) && $result->employee_designation_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['name']}}</option>
													@endforeach
													</select>
													
                                                   
												 </div>


												 <div class="form-group">
												   <label>Employee Type:</label>
												   <select id="employee_type_id" name="employee_type_id" class="WebHRForm1 chosen-select" style="width:180px;">
												   @foreach($master['EmployeeDesignation'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->employee_designation_id) && $result->employee_designation_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['name']}}</option>
													@endforeach
												   </select>
                                
												 </div>

												 
												 <div class="form-group">
												   <label>Employee Category:</label>
												   <select id="employee_category_id" name="employee_category_id" class="WebHRForm1 chosen-select" style="width:180px;">
												   @foreach($master['EmployeeCategory'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->employee_category_id) && $result->employee_category_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['name']}}</option>
													@endforeach
												   </select>
                               
												 </div>

												 <div class="form-group">
												   <label>Employee Grade:</label>
												   <select id="employee_grade_id" name="employee_grade_id" class="WebHRForm1 chosen-select" style="width:180px;">
												   @foreach($master['Grade'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->employee_grade_id) && $result->employee_grade_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
													@endforeach
													</select>                             
												 </div>

												 <div class="form-group">
												   <label>Station:</label>
												   <select id="station_id" name="station_id" class="WebHRForm1 chosen-select" style="width:180px;">
												   @foreach($master['Stations'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->station_id) && $result->station_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['station_name']}}</option>
													@endforeach
												   </select>
													                               
												 </div>

												 <div class="form-group">
												   <label>Department:</label>
													<select id="department_id" name="department_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Departments'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->department_id) && $result->department_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['department_name']}}</option>
													@endforeach
													</select>
												 </div>

												 <div class="form-group">
													<h4>Performance Review</h4>
												 </div>


												 <div class="form-group">
												   <label>Performance:</label>
													<select id="performance" name="performance" class="WebHRForm1 chosen-select" style="width:180px;"><option style="" value="Head Office"> -</option></select>
												 </div>

												 
												 <div class="form-group">
													<h4>Contract Description</h4>
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
