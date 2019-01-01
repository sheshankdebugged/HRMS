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
												<a href="{{ url('insurance') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Insurance Information</h4>
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

                                        <form method="post" action="{{ url('insurance/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">


											<div class="form-group">
													<label>Employee Name:</label>

													<select  name ="employee_id" id="employee_id" class="form-control-select" >
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}">{{$val['employee_name']}}</option>
													@endforeach													
											        </select>
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>

												 <div class="form-group">
													<label>Insurance Type:</label>
													<select id ="insurance_type"  name ="insurance_type" class="form-control-select">
													<option style="" value="0">Life Insurance</option>
													<option style="" value="1">Health Insurance</option>
													</select>
												 </div>
												 <div class="form-group">
												   <label>Insurance Title:</label>
												   <input type="text" class="form-control-spacial" placeholder="Insurance Title" id="insurance_title" name="insurance_title" value="{{isset($result->insurance_title)?$result->insurance_title:''}}" >
												   <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
												   <div class="form-group">
												   <label>Employee Amount (Per Month):</label>
												   <input type="text" class="form-control-spacial" placeholder="" id="employee_amount" name="employee_amount" value="{{isset($result->employee_amount)?$result->employee_amount:''}}" >
												   <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
												   <div class="form-group">
												   <label>Organization Share (Per Month):</label>
												   <input type="text" class="form-control-spacial" placeholder="" id="organization_share" name="organization_share" value="{{isset($result->organization_share)?$result->organization_share:''}}" >
												   <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 <!-- <div class="form-group">
													<label>Notice Date:</label>
													<input type="text" placeholder="" class="form-control-spacial date" id="notice_date" name="notice_date" value="{{isset($result->notice_date)?$result->notice_date:''}}">

												 </div> -->

												 <div class="form-group">
													<label>Expiry Date:</label>
													<input type="text" placeholder="" class="form-control-spacial date" id="expiry_date" name="expiry_date" value="{{isset($result->expiry_date)?$result->expiry_date:''}}">
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
												 </div>




												 </div>



												 <div class="form-group">
													<h4>Insurance Description:</h4>
												 </div>
												 <div class="form-group">
												 <label>Description:</label>
													<textarea class="tinyeditorclass" name="insurance_description" id="insurance_description">{{isset($result->insurance_description)?$result->insurance_description:''}}</textarea>
												</div>


												<div class="form-group">
													<h4>Additional Information</h4>
												 </div>
												 <div class="form-group">
												 <label>Notes:</label>
													<textarea class="tinyeditorclass" name="additional_information" id="additional_information">{{isset($result->additional_information)?$result->additional_information:''}}</textarea>
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
