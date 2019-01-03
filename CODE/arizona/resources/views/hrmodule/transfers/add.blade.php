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
												<a href="{{ url('transfers') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Transfer Information</h4>
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
                                        
                                        <form method="post" action="{{ url('transfers/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">
												
											<div class="form-group">
													<label>Employee to Transfer:</label>
													<select  name ="employee_id" id="employee_id" class="form-control-select chosen-select" >													
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}"  @php if(isset($result->employee_id) && $result->employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
												 </div>


												 <div class="form-group">
												   <label>Forward Application To:</label>
												   <select  name ="employee_id" id="employee_id" class="form-control-select chosen-select" >													
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}"  @php if(isset($result->employee_id) && $result->employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
												 </div>

												 
												 <div class="form-group">
												   <label>Transfer Date:</label>
												   <!-- <select id="Transfer Date" name="employee_category" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Employee Category 1</option></select> -->
													<!-- <input type="text" placeholder="Transfer Date" class="form-control-spacial" id="transfer_date" name="transfer_date" value="{{isset($result->transfer_date)?$result->transfer_date:''}}"> -->
													<input type="text" placeholder="" class="form-control-spacial date" id="transfer_date" name="transfer_date" value="{{isset($result->transfer_date)?$result->transfer_date:''}}">
												 </div>
												 <div class="form-group">
													<h4>Transfer To</h4>
												 </div>
										 
												 <div class="form-group">
												   <label>Transfer To (Company):</label>
												   <select id="transfer_to_company" name="transfer_to_company" class="WebHRForm1 chosen-select" style="width:180px;">
												   @foreach($master['Companies'] as $val)
													<option  value="{{$val['id']}}"  @php if(isset($result->transfer_to_company) && $result->transfer_to_company == $val['id']  ) { echo "selected";  } @endphp >{{$val['company_name']}}</option>
													@endforeach
													</select>
												 </div>

												 <div class="form-group">
												   <label>Transfer To (Station):</label>
												   <select id="transfer_to_station" name="transfer_to_station" class="WebHRForm1 chosen-select" style="width:180px;">
												    @foreach($master['Stations'] as $val)
													<option  value="{{$val['id']}}"  @php if(isset($result->transfer_to_station) && $result->transfer_to_station == $val['id']  ) { echo "selected";  } @endphp >{{$val['station_name']}}</option>
													@endforeach
													</select>
												 </div>

												 <div class="form-group">
												   <label>Transfer To (Department):</label>
												   <select id="transfer_to_department" name="transfer_to_department" class="WebHRForm1 chosen-select" style="width:180px;"> 
												   @foreach($master['Departments'] as $val)
													<option  value="{{$val['id']}}"  @php if(isset($result->transfer_to_department) && $result->transfer_to_department == $val['id']  ) { echo "selected";  } @endphp >{{$val['department_name']}}</option>
													@endforeach
													</select>
                                
												 </div>

												 <div class="form-group">
												   <label>Transfer To (Line Manager):</label>
													<select id="transfer_to_line_manager" name="transfer_to_line_manager" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}"  @php if(isset($result->transfer_to_line_manager) && $result->transfer_to_line_manager == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
												 </div>

												

												 
												 <div class="form-group">
													<h4>Transfer Description</h4>
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
