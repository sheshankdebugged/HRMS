@include('template.admin_header')
<div class="main-section">
	<div class="container">
		<div class="row">
			<div class="inner-main-section">
				<div class="col-md-12 col-sm-12">
					<div class="left-bar-request nopadding">
						<div class="sidebar-menu">
                     @include('template.recruitment_nav_icon')
                  </div>
               </div>
               <div class="right-bar-request">
                  <div class="request-section">
                     <div class="main-heading">
                        <div class="inner-heading-request">
                           <h2>{{$pageTitle}}</h2>
                        </div>
                        <!-- <div class="settings-buttons"><ul><li><a href="#" alt="Dashboard"><i class="fa fa-cog"></i></a></li><li><a href="#" alt="Dashboard"><i class="fa fa-question-circle"></i></a></li></ul></div> -->
                     </div>
                     <div class="request-inner-table">
                        <div class="upper-header-request">
                           <div class="col-md-12 nopadding">
                              <div class="back-button">
                                 <div class="add-record-btn">
                                    <a href="{{ url('jobinterviews') }}">
                                    <i class="fa fa-angle-left"></i>Back
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="inner-form-main">
                           <div class="form-heading-space">
                              <h3>{{$Addform}}</h3>
                           </div>
                           <div class="form-upper-main">
                              <h4>Job Interview Information</h4>
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
                              <form method="post" action="{{ url('jobinterviews/save') }}">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">
                                 <div class="form-field-inner">
                                    <div class="form-group">
                                       <label>Job Post:</label>
                                       <select id="job_post_id" class="WebHRForm1 chosen-select" style="width:180px;" name="job_post_id">
                                       @foreach($master['JobPosts'] as $val)
                                       <option  value="{{$val['id']}}" @php if(isset($result->job_post_id) && $result->job_post_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['job_title']}}</option>
                                       @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <label>Interview Date:</label>
                                       <input type="text" placeholder="" class="form-control-spacial date" id="interviews_date" name="interviews_date" value="{{isset($result->interviews_date)?$result->interviews_date:''}}">
                                    </div>
                                    <div class="form-group">
                                       <label>Interview Time:</label>
                                       <input type="time" placeholder="" class="form-control-spacial" id="interviews_time" name="interviews_time" value="{{isset($result->interviews_time)?$result->interviews_time:''}}">
                                    </div>
                                    <div class="form-group">
                                       <label>Interviewers (Employees):</label>
                                       <select id="interviewers_employees_id" class="WebHRForm1 chosen-select" style="width:180px;" name="interviewers_employees_id">
                                       @foreach($master['Employees'] as $val)
                                       <option  value="{{$val['id']}}" @php if(isset($result->interviewers_employees_id) && $result->interviewers_employees_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
                                       @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <label>Interviewees (Candidates):</label>
                                       <select id="Interviewees_Candidates_id" class="WebHRForm1 chosen-select" style="width:180px;" name="Interviewees_Candidates_id">
                                       @foreach($master['JobCandidates'] as $val)
                                       <option  value="{{$val['id']}}" @php if(isset($result->Interviewees_Candidates_id) && $result->Interviewees_Candidates_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['first_name']}}</option>
                                       @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <label>Place Of Interview:</label>
                                       <input type="text" class="form-control-spacial" id="place_of_interviews" name="place_of_interviews" value="{{isset($result->place_of_interviews)?$result->place_of_interviews:''}}" placeholder="Place Of Interview">
                                       <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
                                    </div>
                                    {{-- Job Test Description --}}
                                    <div class="form-upper-main">
                                       <h4>Job Interview Description</h4>
                                    </div>
                                    <div class="form-group">
                                       <textarea class="tinyeditorclass" name="job_test_description" id="job_test_description">{{isset($result->job_test_description)?$result->job_test_description:''}}</textarea>
                                    </div>
                                    {{-- End of Job Test Description --}}
                                    {{-- Additional Information --}}
                                    <div class="form-upper-main">
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
                                    {{-- End ofAdditional Information --}}
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