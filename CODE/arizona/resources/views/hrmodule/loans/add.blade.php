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
												<a href="{{ url('loans') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Loan Information</h4>
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
                                        
                                        <form method="post" action="{{ url('loans/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">
												
													<div class="form-group">
													<label>Employee Name:</label>
													<select id="employee_id" name="employee_id" class="WebHRForm1 chosen-select" style="width:180px;">
													<!-- <option value="ALL"> All </option> -->
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}">{{$val['employee_name']}}</option>
													@endforeach
													</select>
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>
												 <div class="form-group">
													<label>Forward Application To:</label>
													<select id="forward_employee_id" name="forward_employee_id" class="WebHRForm1 chosen-select" style="width:180px;">
													<!-- <option value="ALL"> All </option> -->
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}">{{$val['employee_name']}}</option>
													@endforeach
													</select>

												 </div>
												 <div class="form-group">
													<label>Title:</label>
													<input type="text" placeholder="loans Title" class="form-control-spacial" id="loans_title" name="loans_title" value="{{isset($result->loans_title)?$result->loans_title:''}}">
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>
												 <div class="form-group">
													<label>Loan Date:</label>
													<input type="text" placeholder="" class="form-control-spacial date" id="loans_date" name="loans_date" value="{{isset($result->loans_date)?$result->loans_date:''}}">
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>
												 <div class="form-group">
													<h4>Loan Amount</h4>
												 </div>
												 
												 <div class="form-group">
												   <label>Loan Amount:</label>
												   <input type="text" placeholder="$" class="form-control-spacial" id="loan_amount" name="loan_amount" value="{{isset($result->loan_amount)?$result->loan_amount:''}}">
												   <!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->
												 </div>
												 <div class="form-group">
													<label>Include Loan Amount in Payslip:</label>
													<label style="width:60px; !important" class="switch">
														<input type="checkbox">
														<span class="slider round"></span>
														</label>
												 </div> 
												 												
												<div class="form-group">
													<h4>Loan Repayment</h4>
												 </div>
												 <div class="form-group">
													<label>Repayment Type:</label>
													<select id="repayment_type" name="repayment_type" class="WebHRForm1 chosen-select" style="width:180px;" onchange="RepaymentsType();" class="FieldValue">
													<option style="" value="Head Office">Specific Amount</option><option style="" value="1">Monthly</option></select>
													<div style="clear:both;"></div>		
												 </div>
												 <!-- <div class="form-group">
													<label>Repayment Months:</label>
													<select id="repayment_months" name="repayment_months" class="WebHRForm1 chosen-select" style="width:180px;" onchange="RepaymentsMonths();" class="FieldValue">
													<div style="clear:both;"></div>

												 </div>
												  -->
												 <div class="form-group">
													<label>Monthly Repayment Amount:</label>
													<input type="text" placeholder="" class="form-control-spacial time" id="monthly_repayment_amount" name="monthly_repayment_amount" value="{{isset($result->monthly_repayment_amount)?$result->monthly_repayment_amount:''}}">
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>
												 <div class="form-group">
													<label>Repayment Start Date:</label>
													<input type="text" placeholder="" class="form-control-spacial date" id="repayment_start_date" name="repayment_start_date" value="{{isset($result->repayment_start_date)?$result->repayment_start_date:''}}">
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>

												

												 <div class="form-group">
													<h4>Loan Description</h4>
												 </div>

                                                 <div class="form-group">
												 <label>Notes:</label>
													<textarea class="tinyeditorclass" name="loan_description" id="loan_description">{{isset($result->loan_description)?$result->loan_description:''}}</textarea>
												</div> 
												<div class="form-group">
													<h4>Loan Document (Optional)</h4>
												 </div>
												 <div class="back-button">
													<div class="add-record-btn">
													<a href="#"></i>Add Attachment</a>
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
