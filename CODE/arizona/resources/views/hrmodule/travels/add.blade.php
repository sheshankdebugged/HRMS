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
												<a href="{{ url('travels') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Travel Information</h4>
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

                                        <form method="post" action="{{ url('travels/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">


											<div class="form-group">
													<label>Employee:</label>

													<select  name ="employee" id="employee" class="form-control-select" >

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
													<label>Travel Type:</label>

													<select  name ="travel_type" class="form-control-select">
													<option style="" value="0"> - </option>
													<option style="" value="1">1</option>
													<option style="" value="2">2</option>

													</select>


												 </div>
												 <div class="form-group">
													<label>Forward Application To:</label>
													<select  name ="forward_application_to" class="form-control-select">
													<option style="" value="0">-</option>
													<option style="" value="1">-</option>
													<option style="" value="2">-</option>
													</select>
												 </div>
                                                 <div class="form-group">
													<label>Purpose of Visit:</label>
													<input type="text" class="form-control-spacial" placeholder="Purpose of Visit:" id="purpose_of_visit" name="purpose_of_visit" value="{{isset($result->purpose_of_visit)?$result->purpose_of_visit:''}}" >
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>
												 <div class="form-group">
													<h4>Travel Dates</h4>
												 </div>
												 <div class="form-group">
													<label>Travel Start Date:</label>
													<input type="text" placeholder="" class="form-control-spacial date" id="travel_start_date" name="travel_start_date" value="{{isset($result->travel_start_date)?$result->travel_start_date:''}}">

												 </div>

												 <div class="form-group">
													<label>Travel End Date:</label>
													<input type="text" placeholder="" class="form-control-spacial date" id="travel_end_date" name="travel_end_date" value="{{isset($result->travel_end_date)?$result->travel_end_date:''}}">

												 </div>
												 </div>
												<div class="form-group">
													<h4>Travel Budget</h4>
												</div>


												<div class="form-group">
													<label>Expected Travel Budget:</label>
													<input type="text" class="form-control-spacial" placeholder="$" id="expected_travel_budget" name="expected_travel_budget" value="{{isset($result->expected_travel_budget)?$result->expected_travel_budget:''}}" >

												</div>
												<div class="form-group">
													<label>Actual Travel Budget:</label>
													<input type="text" class="form-control-spacial" placeholder="$" id="actual_travel_budget" name="actual_travel_budget" value="{{isset($result->actual_travel_budget)?$result->actual_travel_budget:''}}" >

												</div>
												 <div class="form-group">
													<h4>Travel Destinations</h4>
												 </div>

												 <!-- Add table -->





												<div class="form-group">
													<h4>Travel Description</h4>
												 </div>
												  <div class="form-group">
											      <textarea class="tinyeditorclass" name="travel_description" id="travel_description" value="{{isset($result->notes)?$result->travel_description:''}}"></textarea>
										        </div>

												<div class="form-group">
													<h4>Travel Documents (Optional)</h4>
												 </div>


												 <!-- Add Attachment button -->


												 <div class="form-group">
													<h4>Additional Information</h4>
												 </div>
												  <div class="form-group">
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
