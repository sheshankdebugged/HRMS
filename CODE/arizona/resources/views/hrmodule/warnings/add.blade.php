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
												<a href="{{ url('warnings') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Warning Information</h4>
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

                                        <form method="post" action="{{ url('warnings/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">


											<div class="form-group">
													<label>Warning To:</label>

													<select  name ="employee_id" id="employee_id" class="form-control-select chosen-select" >													
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}"  @php if(isset($result->employee_id) && $result->employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>


												 </div>

												 <div class="form-group">
													<label>Forward Application To:</label>

													<!-- <select  name ="forward_application_to" class="form-control-select chosen-select"> -->
													<select  name ="forward_employee_id" id="forward_employee_id" class="form-control-select chosen-select" >													
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}"  @php if(isset($result->forward_employee_id) && $result->forward_employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>

												 </div>
												 <div class="form-group">
													<label>Warning By:</label>

													<select  name ="warning_by_id" id ="warning_by_id" class="form-control-select chosen-select">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}"  @php if(isset($result->warning_by_id) && $result->warning_by_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>


												 </div>

												 <div class="form-group">
													<label>Warning Date:</label>
													<input type="date" placeholder="" id="warning_date" name="warning_date" value="{{isset($result->warning_date)?$result->warning_date:''}}">

												 </div>

												 <div class="form-group">
													<label>Type of Warning:</label>

													<select  name ="type_of_warning_id" id ="type_of_warning_id" class="form-control-select chosen-select">
													@foreach($master['WarningType'] as $val)
													<option  value="{{$val['id']}}"  @php if(isset($result->type_of_warning_id) && $result->type_of_warning_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
													@endforeach

													</select>


												 </div>
                                                 <div class="form-group">
													<label>Subject:</label>
													<input type="text" class="form-control-spacial" placeholder="" id="subject" name="subject" value="{{isset($result->subject)?$result->subject:''}}" >
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>





												<div class="form-group">
													<h4>Description</h4>
												</div>
												<div class="form-group">
												 <label>Notes:</label>
													<textarea class="tinyeditorclass" name="description" id="description">{{isset($result->notes)?$result->description:''}}</textarea>
												</div>

												<div class="form-group">
													<h4>Additional Information</h4>
												</div>
												<div class="form-group">
												 <label>Notes:</label>
													<textarea class="tinyeditorclass" name="additional_information" id="additional_information">{{isset($result->notes)?$result->additional_information:''}}</textarea>
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
