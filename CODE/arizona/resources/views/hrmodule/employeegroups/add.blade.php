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
												<a href="{{ url('employeegroups') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Group Information</h4>
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




                                        <form method="post" action="{{ url('employeegroups/save') }}" enctype='multipart/form-data' >
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">
												 <div class="form-group">
													
                                                 <div class="form-group">
													<label>Group Name:</label>
														<input type="text" class="form-control-spacial" id="group_name" name="group_name" value="{{isset($result->group_name)?$result->group_name:''}}">
												 </div>


												<div class="form-group">
													<label>Group Status:</label>
												    <select  name ="is_active" id="is_active" class="form-control-select chosen-select" >
													<option  value="1">Active</option>
													<option  value="0">Inactive</option>
													</select>
												 </div>

												 <div class="form-upper-main">
													<h4>Group Employees</h4>
													</div>
												 <div class="form-group">
													<label>Employees:</label>
													<select multiple id="employee_id" name="employee_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Employees'] as $val)
														<option  value="{{$val['id']}}"  @php if(isset($result->employee_id) && $result->employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}} [{{$val['user_name']}}]</option>
													@endforeach
													</select>
												</div>
												<div class="form-group">
													<label>External Email Addresses:</label>
														<input type="text" class="form-control-spacial" id="email_addresses" name="email_addresses" value="{{isset($result->email_addresses)?$result->email_addresses:''}}">
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
