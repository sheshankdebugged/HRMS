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
												<a href="{{ url('employeetrainings') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									@if(Session::get('message'))
                            <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Success! {{Session::get('message')}}
                            </div>
                            @endif
									<div class="form-upper-main">
										<h4>Employee Directory</h4>
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




                                        <form method="post" action="{{ url('employeesdirectorysettings/save') }}" enctype='multipart/form-data' >
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">
												 <div class="form-group">
													
												<div class="form-group">
												<label>Hide Department</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="hide_department" name="hide_department" value="{{isset($result->hide_department)?$result->hide_department:''}}">
		                                           <span class="slider round"></span>
												   </label>
												   <a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="If this option is enabled, Employee's Department will not be displayed in Employees Directory" data-original-title="" title="">
												   <i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                            	</div>
												<div class="form-group">
												<label>Hide Station</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="hide_station" name="hide_station" value="{{isset($result->hide_station)?$result->hide_station:''}}">
		                                           <span class="slider round"></span>
												   </label>
												   <a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="If this option is enabled, Employee's Station will not be displayed in Employees Directory" data-original-title="" title="">
												   <i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                            	</div>
												<div class="form-group">
												<label>Hide Company</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="hide_company" name="hide_company" value="{{isset($result->hide_company)?$result->hide_company:''}}">
		                                           <span class="slider round"></span>
												   </label>
												   <a  data-toggle="popover" data-trigger="hover" data-placement="top" data-content="If this option is enabled, Employee's Company will not be displayed in Employees Directory" data-original-title="" title="">
												   <i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                            	</div>
												<div class="form-group">
												<label>Hide Office Number</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="hide_office_number" name="hide_office_number" value="{{isset($result->hide_office_number)?$result->hide_office_number:''}}">
		                                           <span class="slider round"></span>
												   </label>
												   <a  data-toggle="popover" data-trigger="hover" data-placement="top" data-content="If this option is enabled, Employee's Office Number will not be displayed in Employees Directory" data-original-title="" title="">
												   <i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                            	</div>
												<div class="form-group">
												<label>Hide Email Address</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="hide_office_address" name="hide_office_address" value="{{isset($result->hide_office_address)?$result->hide_office_address:''}}">
		                                           <span class="slider round"></span>
												   </label>
												   <a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="If this option is enabled, Employee's Email Address will not be displayed in Employees Directory" data-original-title="" title="">
												   <i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                            	</div>

												<div class="form-upper-main">
													<h4>Employee Directory</h4>
												</div>
												<div class="form-group">
												<label>Hide Department</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="hide_department" name="hide_department" value="{{isset($result->hide_department)?$result->hide_department:''}}">
		                                           <span class="slider round"></span>
												   </label>
												   <a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="If this option is enabled, Employee's Department will not be displayed in Employees Directory" data-original-title="" title="">
												   <i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                            	</div>
												<div class="form-group">
												<label>Hide Station</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="hide_station" name="hide_station" value="{{isset($result->hide_station)?$result->hide_station:''}}">
		                                           <span class="slider round"></span>
												   </label>
												   <a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="If this option is enabled, Employee's Station will not be displayed in Employees Directory" data-original-title="" title="">
												   <i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                            	</div>
												<div class="form-group">
												<label>Hide Company</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="hide_company" name="hide_company" value="{{isset($result->hide_company)?$result->hide_company:''}}">
		                                           <span class="slider round"></span>
												   </label>
												   <a  data-toggle="popover" data-trigger="hover" data-placement="top" data-content="If this option is enabled, Employee's Company will not be displayed in Employees Directory" data-original-title="" title="">
												   <i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                            	</div>
												<div class="form-group">
												<label>Hide Office Number</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="hide_office_number" name="hide_office_number" value="{{isset($result->hide_office_number)?$result->hide_office_number:''}}">
		                                           <span class="slider round"></span>
												   </label>
												   <a  data-toggle="popover" data-trigger="hover" data-placement="top" data-content="If this option is enabled, Employee's Office Number will not be displayed in Employees Directory" data-original-title="" title="">
												   <i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                            	</div>
												<div class="form-group">
												<label>Hide Email Address</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="hide_office_address" name="hide_office_address" value="{{isset($result->hide_office_address)?$result->hide_office_address:''}}">
		                                           <span class="slider round"></span>
												   </label>
												   <a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="If this option is enabled, Employee's Email Address will not be displayed in Employees Directory" data-original-title="" title="">
												   <i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                            	</div>
												<div class="form-group">
												<label>Hide Access Code</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="hide_access_code" name="hide_access_code" value="{{isset($result->hide_access_code)?$result->hide_access_code:''}}">
		                                           <span class="slider round"></span>
												   </label>
												   <a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="If this option is enabled, Employee's Access Code (Employee Number / Biometrics Id) will not be displayed in Employees Directory" data-original-title="" title="">
												   <i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                            	</div>

												<div class="form-group">
												<label>Hide Reporting Line Manager</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="hide_reporting_line_manager" name="hide_reporting_line_manager" value="{{isset($result->hide_reporting_line_manager)?$result->hide_reporting_line_manager:''}}">
		                                           <span class="slider round"></span>
												   </label>
												   <a  data-toggle="popover" data-trigger="hover" data-placement="top" data-content="If this option is enabled, Employee's Reporting Line Manager will not be displayed in Employees Directory" data-original-title="" title="">
												   <i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                            	</div>
												<div class="form-group">
												<label>Hide Supervisor</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="hide_supervisor" name="hide_supervisor" value="{{isset($result->hide_supervisor)?$result->hide_supervisor:''}}">
		                                           <span class="slider round"></span>
												   </label>
												   <a  data-toggle="popover" data-trigger="hover" data-placement="top" data-content="If this option is enabled, Employee's Supervisor will not be displayed in Employees Directory" data-original-title="" title="">
												   <i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                            	</div>
												<div class="form-group">
												<label>Hide Indirect Reporting Employees</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="indirect_reporting_employees" name="indirect_reporting_employees" value="{{isset($result->indirect_reporting_employees)?$result->indirect_reporting_employees:''}}">
		                                           <span class="slider round"></span>
												   </label>
												   <a  data-toggle="popover" data-trigger="hover" data-placement="top" data-content="If this option is enabled, Employee's Indirect Reporting Line Employee(s) will not be displayed in Employees Directory" data-original-title="" title="">
												   <i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                            	</div>
												
												<div class="form-group">
												<label>Hide Calendar</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="hide_calendar" name="hide_calendar" value="{{isset($result->hide_calendar)?$result->hide_calendar:''}}">
		                                           <span class="slider round"></span>
												   </label>
												   <a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="If this option is enabled, Employee's Calendar will not be displayed in Employees Directory" data-original-title="" title="">
												   <i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                            	</div>

												<div class="form-group">
												<label>Hide Timeline</label>
                                                <label style="width:60px; !important" class="switch">
		                                           <input type="checkbox"  id="hide_timeline" name="hide_timeline" value="{{isset($result->hide_timeline)?$result->hide_timeline:''}}">
		                                           <span class="slider round"></span>
												   </label>
												   <a  data-toggle="popover" data-trigger="hover" data-placement="top" data-content="If this option is enabled, Employee's Timeline will not be displayed in Employees Directory" data-original-title="" title="">
												   <i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                            	</div>
												 
												 <div class="form-group">
													<input class="submit-office" type="submit" value="Save Settings">
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
