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
												<a href="{{ url('employeedesignations') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Employee Designations</h4>
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

                                        <form method="post" action="{{ url('employeedesignations/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">

												<div class="form-group">
													<label>Employee Designation Name:</label>
													<input type="text" placeholder="" class="form-control-spacial" id="name" name="name" value="{{isset($result->name)?$result->name:''}}">
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
												</div>

												 <div class="form-group">
													<label>Parent Designation:</label>
													<select id="parent_designation_id" name="parent_designation_id" class="WebHRForm1 chosen-select" style="width:180px;">
													<!-- <option value="ALL"> All </option> -->
													@foreach($master['ParentDesignations'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->parent_designation_id) && $result->parent_designation_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['name']}}</option>
													@endforeach
													</select>
												 </div>
												 <div class="form-group">
													<h4>Job Description</h4>
												 </div>
                                                 <div class="form-group">
												 <label>Notes:</label>
													<textarea class="tinyeditorclass" name="job_description" id="job_description">{{isset($result->job_description)?$result->job_description:''}}</textarea>
												</div>
												 <div class="form-group">
													<input class="submit-office" type="submit" value="Add Designation">
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
