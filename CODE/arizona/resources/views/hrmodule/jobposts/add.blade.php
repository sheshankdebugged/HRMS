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
												<a href="{{ url('jobposts') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
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

                                        <form method="post" action="{{ url('jobposts/save') }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

                                            <div class="form-field-inner">
                                                <div class="form-upper-main">
                                                    <h4>Job Post Information</h4>
                                                </div>
                                                <div class="form-group">
                                                    <label>Job Title:</label>
                                                    <input type="text" class="form-control-spacial" id="job_title" name="job_title" value="{{isset($result->job_title)?$result->job_title:''}}">
                                                    <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
                                                </div>

                                                <div class="form-group">
                                                    <label>Job Field:</label>
                                                    <select class="form-control-spacial" id="job_field" value="{{isset($result->job_field)?$result->job_field:''}}" name="job_field">
                                                        <option value="">-</option>
                                                        @foreach($jobFields as $key=>$field)
                                                        <option value="{{$key}}" <?php if (isset($result->job_field)) {echo ($key == $result->job_field) ? "selected" : "";}?>>{{$field}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Job Type:</label>
                                                    <select class="form-control-spacial" id="job_type" value="{{isset($result->job_type)?$result->job_type:''}}" name="job_type">
                                                        @foreach($jobTypes as $key=>$list)
                                                        <option value="{{$key}}" <?php if (isset($result->job_field)) {echo ($key == $result->job_type) ? "selected" : "";}?>>{{$list}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Job Post Opening Date:</label>
                                                    <input type="text" class="form-control-spacial date" id="job_post_opening_date" name="job_post_opening_date" value="{{isset($result->job_post_opening_date)?$result->job_post_opening_date:''}}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Job Post Closing Date:</label>
                                                    <input type="text" class="form-control-spacial date" id="job_post_closing_date" name="job_post_closing_date" value="{{isset($result->job_post_closing_date)?$result->job_post_closing_date:''}}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Number of Positions:</label>
                                                    <input type="text" class="form-control-spacial" id="number_of_positions" name="number_of_positions" value="{{isset($result->number_of_positions)?$result->number_of_positions:'1'}}" required style="width: 50px"><i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
                                                </div>

                                                <div class="form-group">
                                                    <label>Publish in Jobs Portal:</label>
                                                    <select class="form-control-spacial" id="publish_in_jobs_portal" value="{{isset($result->publish_in_jobs_portal)?$result->publish_in_jobs_portal:''}}" name="publish_in_jobs_portal">
                                                        <option value="0" <?php if (isset($result->publish_in_jobs_portal)) {echo ($result->publish_in_jobs_portal == 0) ? "selected" : "";}?>>No</option>
                                                        <option value="1" <?php if (isset($result->publish_in_jobs_portal)) {echo (!isset($result->publish_in_jobs_portal) || $result->publish_in_jobs_portal == 1) ? "selected" : "";}?>>Yes</option>
                                                    </select>
                                                </div>

                                                {{--  Job Post Detail  --}}
                                                <div class="form-upper-main">
                                                        <h4>Job Post Details</h4>
                                                </div>
                                                <div class="form-group">
                                                    <label>Company:</label>
                                                    <input type="text" class="form-control-spacial" id="companies" name="company" value="{{isset($result->companies)?$result->companies:''}}" >

                                                </div>
                                                <div class="form-group">
                                                    <label>Station:</label>
                                                    <input type="text" class="form-control-spacial" id="stations" name="station" value="{{isset($result->stations)?$result->stations:''}}" >

                                                </div>
                                                <div class="form-group">
                                                    <label>Department:</label>
                                                    <input type="text" class="form-control-spacial" id="departments" name="department" value="{{isset($result->departments)?$result->departments:''}}">

                                                </div>
                                                {{-- End of Job Post Detail --}}

                                                {{--Recruiters--}}
                                                <div class="form-upper-main">
                                                    <h4>Recruiters</h4>
                                                </div>
                                                <div class="form-group">
                                                    <label>Employees involved in Recruitment Process:</label>
                                                    <input type="text" class="form-control-spacial" id="employees_involved_in" name="employees_involved_in" value="{{isset($result->employees_involved_in)?$result->employees_involved_in:''}}">
                                                </div>
                                                {{--End of Recruiters--}}

                                                {{--Job Location--}}
                                                <div class="form-upper-main">
                                                    <h4>Job Location</h4>
                                                </div>
                                                <div class="form-group">
                                                    <label>City:</label>
                                                    <input type="text" class="form-control-spacial" id="city" name="city" value="{{isset($result->city)?$result->city:''}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>State / Province:</label>
                                                    <input type="text" class="form-control-spacial" id="state" name="state" value="{{isset($result->state)?$result->state:''}}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Zip Code:</label>
                                                    <input type="text" class="form-control-spacial" id="zip_code" name="zip_code" value="{{isset($result->zip_code)?$result->zip_code:''}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Country:</label>
                                                    <select class="form-control-spacial" id="country" name="country">
                                                            @foreach($countries as $country)
                                                            <option value="{{$country['country_id']}}" <?php if (isset($result->country)) {echo ($country['country_id'] == $result->country) ? "selected" : "";}?> >{{$country['title']}}</option>
                                                            @endforeach
                                                        </select>
                                                </div>
                                                {{--End of Job Location--}}

                                                {{--Candidate Age Range--}}
                                                <div class="form-upper-main">
                                                    <h4>Candidate Age Range</h4>
                                                </div>
                                                <div class="form-group">
                                                    <label>Candidate Age Range (Start):</label>
                                                    <select class="form-control-spacial" id="candidate_age_range_start" name="candidate_age_range_start">
                                                            @foreach($countries as $country)
                                                            <option value="{{$country['country_id']}}" <?php if (isset($result->country)) {echo ($country['country_id'] == $result->country) ? "selected" : "";}?> >{{$country['title']}}</option>
                                                            @endforeach
                                                        </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Candidate Age Range (End):</label>
                                                    <select class="form-control-spacial" id="candidate_age_range_end" name="candidate_age_range_end">
                                                            @foreach($countries as $country)
                                                            <option value="{{$country['country_id']}}" <?php if (isset($result->country)) {echo ($country['country_id'] == $result->country) ? "selected" : "";}?> >{{$country['title']}}</option>
                                                            @endforeach
                                                        </select>
                                                </div>

                                                {{--Candidate Age Range end--}}

                                                {{--Salary--}}
                                                <div class="form-upper-main">
                                                    <h4>Salary</h4>
                                                </div>
                                                <div class="form-group">
                                                    <label>Salary Start Range:</label>
                                                    <input type="text" class="form-control-spacial" id="salary_start_range" name="salary_start_range" value="{{isset($result->salary_start_range)?$result->salary_start_range:''}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Salary End Range:</label>
                                                    <input type="text" class="form-control-spacial" id="salary_end_range" name="salary_end_range" value="{{isset($result->salary_end_range)?$result->salary_end_range:''}}">
                                                </div>
                                                {{--Salary End--}}

                                                {{--Job Post Recruitment Parameters--}}
                                                <div class="form-upper-main">
                                                    <h4>Job Post Recruitment Parameters</h4>
                                                </div>
                                                <div class="form-group">
												<label>Recruitment Parameters:</label>
                                                <textarea class="notes" name="recruitment_parameters" id="recruitment_parameters">{{isset($result->recruitment_parameters)?$result->notes:''}}</textarea>
												</div>
                                                {{--Job Post Recruitment Parameters End--}}

                                                {{--Candidate Qualification--}}
                                                <div class="form-upper-main">
                                                    <h4>Candidate Qualification</h4>
                                                </div>
                                                <div class="form-group">
													<textarea class="tinyeditorclass" name="candidate_qualification" id="candidate_qualification">{{isset($result->candidate_qualification)?$result->candidate_qualification:''}}</textarea>
												</div>
                                                {{--Candidate Qualification End--}}

                                                {{--Candidate Experience--}}
                                                <div class="form-upper-main">
                                                    <h4>Candidate Experience</h4>
                                                </div>
                                                <div class="form-group">
													<textarea class="tinyeditorclass" name="candidate_experience" id="candidate_experience">{{isset($result->candidate_experience)?$result->candidate_experience:''}}</textarea>
												</div>
                                                {{--Candidate Experience End--}}

                                                {{--Job Post Description--}}
                                                <div class="form-upper-main">
                                                    <h4>Job Post Description</h4>
                                                </div>
                                                <div class="form-group">
													<textarea class="tinyeditorclass" name="job_post_description" id="job_post_description">{{isset($result->job_post_description)?$result->job_post_description:''}}</textarea>
												</div>
                                                {{--Job Post Description End--}}

                                                {{--Final Approval--}}
                                                <div class="form-upper-main">
                                                    <h4>Final Approval</h4>
                                                </div>
                                                <div class="form-group">
                                                    <label>Approval Levels:</label>
                                                    <select class="form-control-spacial" id="approval_levels" name="approval_levels">
                                                            @foreach($countries as $country)
                                                            <option value="{{$country['country_id']}}" <?php if (isset($result->country)) {echo ($country['country_id'] == $result->country) ? "selected" : "";}?> >{{$country['title']}}</option>
                                                            @endforeach
                                                        </select>
                                                </div>
                                                {{--Final Approval End--}}

                                                {{--Additional Information--}}
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
                                                {{--Additional Information End--}}

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
