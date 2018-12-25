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
												<a href="{{ url('projects') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Project  Information</h4>
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
                                        <form method="post" action="{{ url('saveprojects') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">
											<div class="form-field-inner">
												<div class="form-group">
													<label>Project Category:</label>
													<select  name ="company_type" class="form-control-select">
													<option style="" value="0"> - </option><option style="" value="1">Corporation</option><option style="" value="2">Exempt Organization</option><option style="" value="3">Partnership</option><option style="" value="4">Private Foundation</option><option style="" value="5">S Corporation</option><option style="" value="6">Sole Proprietor</option><option style="" value="7">Limited Liability Company</option><option style="" value="8">Trading LLC</option><option style="" value="9">Private Limited</option><option style="" value="10">General Partnership</option><option style="" value="11">Limited Partnership</option><option style="" value="12">Non Profit Organization</option><option style="" value="13">Trust</option><option style="" value="14">Joint Venture</option><option style="" value="15">Association</option><option style="" value="16">Free Zone</option>
												 	</select>												</div>
												 <div class="form-group">
													<label>Project Title:</label>
													<input type="text" class="form-control-spacial" id="project_title" name="project_title" value="{{isset($result->project_title)?$result->project_title:''}}" placeholder="Company name">
                                                    <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fal fa-asterisk"></i>
												 </div>
												 <div class="form-group">
													<label>Client Name:</label>
													<select  name ="client_name" id="client_name" class="form-control-select">
													<option style="" value="0"> - </option><option style="" value="1">Corporation</option><option style="" value="2">Exempt Organization</option><option style="" value="3">Partnership</option><option style="" value="4">Private Foundation</option><option style="" value="5">S Corporation</option><option style="" value="6">Sole Proprietor</option><option style="" value="7">Limited Liability Company</option><option style="" value="8">Trading LLC</option><option style="" value="9">Private Limited</option><option style="" value="10">General Partnership</option><option style="" value="11">Limited Partnership</option><option style="" value="12">Non Profit Organization</option><option style="" value="13">Trust</option><option style="" value="14">Joint Venture</option><option style="" value="15">Association</option><option style="" value="16">Free Zone</option>
												 	</select>
												 </div>
												 <div class="form-group">
													<label>Client Name (Old):</label>
													<input type="text"  id="client_name_old" name="client_name_old"  placeholder="Client Name">
                                                    <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fal fa-asterisk"></i>
												 </div>
												 <div class="form-group">
													<label>Project Start Date:</label>
													<input type="date" class "form-control-spacial date" id="created_at" name="created_at">
                                                    <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fal fa-asterisk"></i>
												 </div>
												<div class="form-group">
													<label>Project End Date:</label>
													<input type="date" class "form-control-spacial date" id="updated_at" name="updated_at" value="{{isset($result->updated_at)?$result->updated_at:''}}">
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fal fa-asterisk"></i>
												</div>
												<div class="form-group">
													<h4>Project Audience</h4>
												 </div>
												 <div class="form-group">
													<label>Company:</label>
													<select  name ="company_type" id="company_type" class="form-control-select">
													<option style="" value="0"> - </option><option style="" value="1">Corporation</option><option style="" value="2">Exempt Organization</option><option style="" value="3">Partnership</option><option style="" value="4">Private Foundation</option><option style="" value="5">S Corporation</option><option style="" value="6">Sole Proprietor</option><option style="" value="7">Limited Liability Company</option><option style="" value="8">Trading LLC</option><option style="" value="9">Private Limited</option><option style="" value="10">General Partnership</option><option style="" value="11">Limited Partnership</option><option style="" value="12">Non Profit Organization</option><option style="" value="13">Trust</option><option style="" value="14">Joint Venture</option><option style="" value="15">Association</option><option style="" value="16">Free Zone</option>
												 	</select>
												 </div>
												 <div class="form-group">
													<label>Station:</label>
													<select  name ="station" id="station" class="form-control-select">
													<option style="" value="0"> - </option><option style="" value="1">Corporation</option><option style="" value="2">Exempt Organization</option><option style="" value="3">Partnership</option><option style="" value="4">Private Foundation</option><option style="" value="5">S Corporation</option><option style="" value="6">Sole Proprietor</option><option style="" value="7">Limited Liability Company</option><option style="" value="8">Trading LLC</option><option style="" value="9">Private Limited</option><option style="" value="10">General Partnership</option><option style="" value="11">Limited Partnership</option><option style="" value="12">Non Profit Organization</option><option style="" value="13">Trust</option><option style="" value="14">Joint Venture</option><option style="" value="15">Association</option><option style="" value="16">Free Zone</option>
												 	</select>
												 </div>
												 <div class="form-group">
													<label>Department:</label>
													<select  name ="department" id="department" class="form-control-select">
													<option style="" value="0"> - </option><option style="" value="1">Corporation</option><option style="" value="2">Exempt Organization</option><option style="" value="3">Partnership</option><option style="" value="4">Private Foundation</option><option style="" value="5">S Corporation</option><option style="" value="6">Sole Proprietor</option><option style="" value="7">Limited Liability Company</option><option style="" value="8">Trading LLC</option><option style="" value="9">Private Limited</option><option style="" value="10">General Partnership</option><option style="" value="11">Limited Partnership</option><option style="" value="12">Non Profit Organization</option><option style="" value="13">Trust</option><option style="" value="14">Joint Venture</option><option style="" value="15">Association</option><option style="" value="16">Free Zone</option>
												 	</select>
												 </div>
												 <div class="form-group">
													<h4>Project Employees</h4>
												 </div>
												 <div class="form-group">
													<label>Project Employees:</label>
													<input type="text" class="project_employees" id="project_employees" placeholder="" role="combobox">
												 </div>
												 <div class="form-group">
													<label>Project Manager:</label>
													<select  name ="project_manager" id="project_manager" class="form-control-select">
													<option style="" value="0"> - </option><option style="" value="1">Corporation</option><option style="" value="2">Exempt Organization</option><option style="" value="3">Partnership</option><option style="" value="4">Private Foundation</option><option style="" value="5">S Corporation</option><option style="" value="6">Sole Proprietor</option><option style="" value="7">Limited Liability Company</option><option style="" value="8">Trading LLC</option><option style="" value="9">Private Limited</option><option style="" value="10">General Partnership</option><option style="" value="11">Limited Partnership</option><option style="" value="12">Non Profit Organization</option><option style="" value="13">Trust</option><option style="" value="14">Joint Venture</option><option style="" value="15">Association</option><option style="" value="16">Free Zone</option>
												 	</select>
												 </div>
												 <div class="form-group">
													<label>Project Coordinator:</label>
													<select  name ="project_coordinator" id="project_coordinator" class="form-control-select">
													<option style="" value="0"> - </option><option style="" value="1">Corporation</option><option style="" value="2">Exempt Organization</option><option style="" value="3">Partnership</option><option style="" value="4">Private Foundation</option><option style="" value="5">S Corporation</option><option style="" value="6">Sole Proprietor</option><option style="" value="7">Limited Liability Company</option><option style="" value="8">Trading LLC</option><option style="" value="9">Private Limited</option><option style="" value="10">General Partnership</option><option style="" value="11">Limited Partnership</option><option style="" value="12">Non Profit Organization</option><option style="" value="13">Trust</option><option style="" value="14">Joint Venture</option><option style="" value="15">Association</option><option style="" value="16">Free Zone</option>
												 	</select>
												 </div>
												 <div class="form-group">
													<h4>Project Description</h4>
												 </div>
												 <div class="form-group">
													<h4>Additional Information</h4>
												 </div>
												 <div class="form-group">
												 <label>Notes:</label>
												 <textarea class="notes" name="notes" id="notes" id="notes">{{isset($result->notes)?$result->notes:''}}</textarea>
												</div>

												 <div class="form-group">
												 <label>Record Added By:</label>
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
