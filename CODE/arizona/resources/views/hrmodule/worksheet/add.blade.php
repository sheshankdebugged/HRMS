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
												<a href="{{ url('worksheet') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Worksheet Information</h4>
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

                                        <form method="post" action="{{ url('worksheet/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">


											<div class="form-group">
													<label>Employee:</label>

													<select id="employee" name="employee" class="WebHRForm1 chosen-select" style="width:180px;"><option style="" value="Head Office">employee</option></select>
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>

												 <div class="form-group">
													<label>Project:</label>
													<select id="project" name="project" class="WebHRForm1 chosen-select" style="width:180px;"><option style="" value="Head Office">project</option></select>



												 </div>
												 <div class="form-group">
												 <label>Task:</label>
												 <input type="text" placeholder="Task" class="form-control-spacial" id="task" name="task" value="{{isset($result->task)?$result->task:''}}">
												</div>

												 <div class="form-group">
													<label>Date:</label>
													<!-- <input type="text" placeholder="" class="form-control-spacial date" id="Worksheet_date" name="Worksheet_date" value="{{isset($result->travel_start_date)?$result->Worksheet_date:''}}"> -->
													<input type="text" placeholder="" class="form-control-spacial date" id="worksheet_date" name="worksheet_date" value="{{isset($result->worksheet_date)?$result->worksheet_date:''}}">

												 </div>

												 <!-- <ADD TIME PICKER HERE --> 

												 <div class="form-group">
													<label>Start Time:</label>

													<input type="text" placeholder="" class="form-control-spacial time" id="start_time" name="start_time" value="{{isset($result->start_time)?$result->start_time:''}}">
												 </div>

												  <!-- <ADD TIME PICKER HERE -->
												 <div class="form-group">
													<label>End Time:</label>

													<input type="text" placeholder="" class="form-control-spacial time" id="end_time" name="end_time" value="{{isset($result->end_time)?$result->end_time:''}}">


		 


											 

												<div class="form-group">
													<h4>Worksheet Description</h4>
												</div>
												<div class="form-group">
												 <label>Notes:</label>
													<textarea class="tinyeditorclass" name="worksheet_description" id="worksheet_description">{{isset($result->notes)?$result->worksheet_description:''}}</textarea>
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
