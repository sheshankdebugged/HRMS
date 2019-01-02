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
												<a href="{{ url('deductions') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Deduction Information</h4>
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
                                        
                                        <form method="post" action="{{ url('deductions/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">
												
												 <div class="form-group">
													<label>Employee Name:</label>
													<select  name ="employee_id" id="employee_id" class="form-control-select chosen-select" >
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}">{{$val['employee_name']}}</option>
													@endforeach													
											        </select>
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>
												 <div class="form-group">
													<label>Forward Application To:</label>
													<select  name ="forward_employee_id" id="forward_employee_id" class="form-control-select chosen-select" >
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}">{{$val['employee_name']}}</option>
													@endforeach													
											        </select>
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>
												 <div class="form-group">
													<label>Title:</label>
													<input type="text" placeholder="Deductions Title" class="form-control-spacial" id="deductions_title" name="deductions_title" value="{{isset($result->deductions_title)?$result->deductions_title:''}}">
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>
												 <div class="form-group">
													<label>Amount:</label>
													<input type="text" placeholder="Deductions Amount" class="form-control-spacial" id="deductions_amount" name="deductions_amount" value="{{isset($result->deductions_amount)?$result->deductions_amount:''}}">
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>
												 <div class="form-group">
													<label>Date:</label>
													<input type="text" placeholder="" class="form-control-spacial date" id="deductions_date" name="deductions_date" value="{{isset($result->deductions_date)?$result->deductions_date:''}}">
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												
												 <div class="form-group">
													<h4>Deduction Description</h4>
												 </div>

                                                 <div class="form-group">
												 <label>Notes:</label>
													<textarea class="tinyeditorclass" name="deduction_description" id="deduction_description">{{isset($result->deduction_description)?$result->deduction_description:''}}</textarea>
												</div> 
												<div class="form-group">
													<h4>Deduction Document (Optional)</h4>
												 </div>
												 <div class="back-button">
													<div class="add-record-btn">
													<a href="#">Add Attachment</a>
													</div>
												</div>
												 

																								
												<div class="form-group">
													<h4>Additional Information</h4>
												 </div>
												 <div class="form-group">
												 <label>Notes:</label>
													<textarea  name="additonal_information" id="additonal_information">{{isset($result->additonal_information)?$result->additonal_information:''}}</textarea>
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
