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

												<select  name ="employee" id="employee" class="form-control-select" >

													<option style="" value="0"> - </option>
													<option style="" value="1">Corporation</option>
													<option style="" value="2">Exempt Organization</option>
													<option style="" value="3">Partnership</option>
													<option style="" value="4">Private Foundation</option>
													<option style="" value="5">S Corporation</option>
													<option style="" value="6">Sole Proprietor</option>
													<option style="" value="7">Limited Liability Company</option>
													<option style="" value="8">Trading LLC</option>
													<option style="" value="9">Private Limited</option>
													<option style="" value="10">General Partnership</option>
													<option style="" value="11">Limited Partnership</option>
													<option style="" value="12">Non Profit Organization</option>
													<option style="" value="13">Trust</option>
													<option style="" value="14">Joint Venture</option>
													<option style="" value="15">Association</option>
													<option style="" value="16">Free Zone</option>				        
												</select>
												<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>


											</div>

												 
                                                  <div class="form-group">
													<label>Exit Date:</label>
													<input type="text" placeholder="" class="form-control-spacial date" id="exit_date" name="exit_date" value="{{isset($result->employee)?$result->employee:''}}">
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>
												 <div class="form-group">
													<label>Type of Exit:</label>

													<select  name ="type_of_exit" class="form-control-select">
													<option style="" value="0"> - </option>
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
													<label>Conducted Exit Interview:</label>

													<select  name ="conducted_exit_interview" id="conducted_exit_interview" form-control-select">

													<option value="0"> - </option>
													<option value="1"> 1 </option>
													<option value="2"> 2 </option>
													<option value="3"> 3 </option>


													</select>


												 </div>											


												 
												 <div class="form-group">
													<label>Exit Interviewer::</label>
													<input type="text" placeholder="" class="form-control-spacial" id="	exit_interviewer" name="exit_interviewer" value="{{isset($result->exit_interviewer)?$result->exit_interviewer:''}}">

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
