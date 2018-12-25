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
								<div class="settings-buttons">
									<ul>
										<li>
											<a href="#" alt="Dashboard"><i class="fa fa-cog"></i></a>
										</li>
										<li>
											<a href="#" alt="Dashboard"><i class="fa fa-question-circle"></i></a>
										</li>
									</ul>
								</div>
							</div>
							<div class="request-inner-table">
								<div class="upper-header-request">
									<div class="col-md-12 nopadding">
										<div class="back-button">
											<div class="add-record-btn">
												<a href="{{ url('assignments') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Assignment Information</h4>
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

                                        <form method="post" action="{{ url('assignments/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">


											<div class="form-group">
													<label>Assigned To:</label>

													<select  name ="assigned_to" id="assigned_to" class="form-control-select" >

													<option style="" value="0"> 0 </option>
													<option style="" value="1">1</option>
													<option style="" value="2">2</option>
													<option style="" value="3">3</option>
													<option style="" value="4">4</option>
													<option style="" value="5">5</option>
													<option style="" value="6">6</option>
													<option style="" value="7">7</option>
													<option style="" value="8">8</option>


													</select>


												 </div>

												 <div class="form-group">
													<label>Project:</label>

													<select  name ="project" class="form-control-select">
													<option style="" value="0"> - </option>
													<option style="" value="1">WebHR Job Portal</option>
													<option style="" value="2">WebHumanResourse</option>

													</select>


												 </div>
                                                 <div class="form-group">
													<label>Assignment Name:</label>
													<input type="text" class="form-control-spacial" placeholder="Assignment Name" id="assignment_name" name="assignment_name" value="{{isset($result->assignment_name)?$result->assignment_name:''}}" >

												 </div>
												 <div class="form-group">
													<label>Start Date:</label>
													<input type="text" placeholder="" class="form-control-spacial date" id="start_date" name="start_date" value="{{isset($result->assignment_employees)?$result->assignment_employees:''}}">

												 </div>

												 <div class="form-group">
													<label>Due Date:</label>
													<input type="text" placeholder="" class="form-control-spacial date" id="due_date" name="due_date" value="{{isset($result->assignment_employees)?$result->assignment_employees:''}}">

												 </div>


												 <div class="form-group">
													<label>Priority:</label>

													<select  name ="priority" id="priority" form-control-select">

													<option value="0"> 0 </option>
													<option value="1"> 1 </option>
													<option value="2"> 2 </option>
													<option value="3"> 3 </option>


													</select>


												 </div>
												


												 <div class="form-group">
													<h4>Additional Employees</h4>
												 </div>


												 <div class="form-group">
													<label>Assignment Employees:</label>
													<input type="text" placeholder="" class="form-control-spacial" id="assignment_employees" name="assignment_employees" value="{{isset($result->assignment_employees)?$result->assignment_employees:''}}">

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
