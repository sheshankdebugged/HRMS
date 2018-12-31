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
                                    <a href="{{ url('jobrequests') }}"><i class="fa fa-angle-left"></i>Back</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="inner-form-main">
                           <div class="form-heading-space">
                              <h3>{{$Addform}}</h3>
                           </div>
                           <div class="form-upper-main">
                              <h4>Job Request Information</h4>
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
                              <form method="post" action="{{ url('jobrequests/save') }}">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">
                                 <div class="form-field-inner">
                                    <div class="form-group">
									   <label>Forward Application To:</label>
									   <select  name ="forward_application" id="forward_application" class="form-control-select">
											<option style="" value="0"> - </option><option style="" value="1">Corporation</option><option style="" value="2">Exempt Organization</option><option style="" value="3">Partnership</option><option style="" value="4">Private Foundation</option><option style="" value="5">S Corporation</option><option style="" value="6">Sole Proprietor</option><option style="" value="7">Limited Liability Company</option><option style="" value="8">Trading LLC</option><option style="" value="9">Private Limited</option><option style="" value="10">General Partnership</option><option style="" value="11">Limited Partnership</option><option style="" value="12">Non Profit Organization</option><option style="" value="13">Trust</option><option style="" value="14">Joint Venture</option><option style="" value="15">Association</option><option style="" value="16">Free Zone</option>
										</select>
                                    </div>
                                    <div class="form-group">
                                       <label>Job Title:</label>
                                       <input type="text" class="form-control-spacial" id="job_title" name="job_title" value="{{isset($result->job_title)?$result->job_title:''}}" placeholder="Job Title">
										<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
									</div>
									<div class="form-group">
									   <label>Job Request Type:</label>
									   <select  name ="job_request_type" id="job_request_type" class="form-control-select">
											<option style="" value="0"> - </option><option style="" value="1">Corporation</option><option style="" value="2">Exempt Organization</option><option style="" value="3">Partnership</option><option style="" value="4">Private Foundation</option><option style="" value="5">S Corporation</option><option style="" value="6">Sole Proprietor</option><option style="" value="7">Limited Liability Company</option><option style="" value="8">Trading LLC</option><option style="" value="9">Private Limited</option><option style="" value="10">General Partnership</option><option style="" value="11">Limited Partnership</option><option style="" value="12">Non Profit Organization</option><option style="" value="13">Trust</option><option style="" value="14">Joint Venture</option><option style="" value="15">Association</option><option style="" value="16">Free Zone</option>
										</select>
									</div>
									<div class="form-group">
                                       <label>Company:</label>
                                       <input type="text" class="form-control-spacial" id="company" name="company" value="{{isset($result->company)?$result->company:''}}" >
									</div>
									<div class="form-group">
                                       <label>Station:</label>
                                       <input type="text" class="form-control-spacial" id="station" name="station" value="{{isset($result->station)?$result->station:''}}" >
									</div>
									<div class="form-group">
									   <label>Department:</label>
									   <select  name ="department" id="department" class="form-control-select">
											<option style="" value="0"> - </option><option style="" value="1">Corporation</option><option style="" value="2">Exempt Organization</option><option style="" value="3">Partnership</option><option style="" value="4">Private Foundation</option><option style="" value="5">S Corporation</option><option style="" value="6">Sole Proprietor</option><option style="" value="7">Limited Liability Company</option><option style="" value="8">Trading LLC</option><option style="" value="9">Private Limited</option><option style="" value="10">General Partnership</option><option style="" value="11">Limited Partnership</option><option style="" value="12">Non Profit Organization</option><option style="" value="13">Trust</option><option style="" value="14">Joint Venture</option><option style="" value="15">Association</option><option style="" value="16">Free Zone</option>
										</select>
									</div>
									<div class="form-group">
									   <label>Job Type:</label>
									   <select  name ="job_type" id="job_type" class="form-control-select">
											<option style="" value="0"> - </option><option style="" value="1">Corporation</option><option style="" value="2">Exempt Organization</option><option style="" value="3">Partnership</option><option style="" value="4">Private Foundation</option><option style="" value="5">S Corporation</option><option style="" value="6">Sole Proprietor</option><option style="" value="7">Limited Liability Company</option><option style="" value="8">Trading LLC</option><option style="" value="9">Private Limited</option><option style="" value="10">General Partnership</option><option style="" value="11">Limited Partnership</option><option style="" value="12">Non Profit Organization</option><option style="" value="13">Trust</option><option style="" value="14">Joint Venture</option><option style="" value="15">Association</option><option style="" value="16">Free Zone</option>
										</select>
									</div>
									<div class="form-group">
                                       <label>Number of Positions:</label>
                                       <input type="text" class="form-control-spacial" id="number_of_positions" name="number_of_positions" value="{{isset($result->number_of_positions)?$result->number_of_positions:''}}" >
										<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
									</div>
									<div class="form-group">
									   <label>Candidate Age Range (Start):</label>
									   <select  name ="candidate_age_range_start" id="candidate_age_range_start" class="form-control-select">
											<option style="" value="0"> - </option><option style="" value="1">Corporation</option><option style="" value="2">Exempt Organization</option><option style="" value="3">Partnership</option><option style="" value="4">Private Foundation</option><option style="" value="5">S Corporation</option><option style="" value="6">Sole Proprietor</option><option style="" value="7">Limited Liability Company</option><option style="" value="8">Trading LLC</option><option style="" value="9">Private Limited</option><option style="" value="10">General Partnership</option><option style="" value="11">Limited Partnership</option><option style="" value="12">Non Profit Organization</option><option style="" value="13">Trust</option><option style="" value="14">Joint Venture</option><option style="" value="15">Association</option><option style="" value="16">Free Zone</option>
										</select>
									</div>
									<div class="form-group">
									   <label>Candidate Age Range (End):</label>
									   <select  name ="candidate_age_range_end" id="candidate_age_range_end" class="form-control-select">
											<option style="" value="0"> - </option><option style="" value="1">Corporation</option><option style="" value="2">Exempt Organization</option><option style="" value="3">Partnership</option><option style="" value="4">Private Foundation</option><option style="" value="5">S Corporation</option><option style="" value="6">Sole Proprietor</option><option style="" value="7">Limited Liability Company</option><option style="" value="8">Trading LLC</option><option style="" value="9">Private Limited</option><option style="" value="10">General Partnership</option><option style="" value="11">Limited Partnership</option><option style="" value="12">Non Profit Organization</option><option style="" value="13">Trust</option><option style="" value="14">Joint Venture</option><option style="" value="15">Association</option><option style="" value="16">Free Zone</option>
										</select>
									</div>
									<div class="form-group">
                                       <label>Salary Start Range</label>
                                       <input type="text" class="form-control-spacial" id="salary_start_range" name="salary_start_range" value="{{isset($result->forward_application)?$result->forward_application:''}}" >
									</div>
									<div class="form-group">
                                       <label>Salary End Range:</label>
                                       <input type="text" class="form-control-spacial" id="salary_end_range" name="salary_end_range" value="{{isset($result->forward_application)?$result->forward_application:''}}" >
									</div>
									{{-- Candidate Qualification --}}
									<div class="form-upper-main">
										<h4>Candidate Qualification</h4>
									</div>
									<div class="form-group">
										<textarea class="tinyeditorclass" name="candidate_qualification" id="candidate_qualification">{{isset($result->candidate_qualification)?$result->candidate_qualification:''}}</textarea>
									</div>
									{{-- End of Candidate Qualification --}}

									{{-- Candidate Experience --}}
									<div class="form-upper-main">
										<h4>Candidate Experience</h4>
									</div>
									<div class="form-group">
										<textarea class="tinyeditorclass" name="candidate_experience" id="candidate_experience">{{isset($result->candidate_experience)?$result->candidate_experience:''}}</textarea>
									</div>
									{{-- End of Candidate Experience --}}

									{{-- Job Post Description --}}
									<div class="form-upper-main">
										<h4>Job Post Description</h4>
									</div>
									<div class="form-group">
										<textarea class="tinyeditorclass" name="job_post_description" id="job_post_description">{{isset($result->job_post_description)?$result->job_post_description:''}}</textarea>
									</div>
									{{-- End of Job Post Description --}}

									{{-- Job Request Document (Optional) --}}
									<div class="form-upper-main">
										<h4>Job Request Document (Optional)</h4>
										<input class="submit-office" type="file" name="job_request_document" id="job_request_document">
									</div>

									{{-- End of Job Request Document (Optional) --}}

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
