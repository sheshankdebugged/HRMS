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
                     </div>
                     <div class="request-inner-table">
                        <div class="upper-header-request">
                           <div class="col-md-12 nopadding">
                              <div class="back-button">
                                 <div class="add-record-btn">
                                    <a href="{{ url('jobcandidates') }}">
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
                              <h4>Candidate Information</h4>
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
                              <form method="post" action="{{ url('jobcandidates/save') }}">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">
                                 <div class="form-field-inner">
                                    <div class="form-group">
                                       <label>Job Field:</label>
                                       <select id="job_field_id" class="WebHRForm1" style="width:180px;" name="job_field_id">
                                       @foreach($master['JobField'] as $val)
                                       <option  value="{{$val['id']}}" @php if(isset($result->job_field_id) && $result->job_field_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['job_field_title']}}</option>
                                       @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <label>First Name:</label>
                                       <input type="text" placeholder="First Name" class="form-control-spacial " id="first_name" name="first_name" value="{{isset($result->first_name)?$result->first_name:''}}">
									   <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
                                    </div>
                                    <div class="form-group">
                                       <label>Last Name:</label>
                                       <input type="text" placeholder="Last Name" class="form-control-spacial " id="last_name" name="last_name" value="{{isset($result->last_name)?$result->last_name:''}}">
									   <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
                                    </div>
                                    <div class="form-group">
                                       <label>Date of Birth:</label>
                                       <input type="text" placeholder="" class="form-control-spacial date" id="date_of_birth" name="date_of_birth" value="{{isset($result->date_of_birth)?$result->date_of_birth:''}}">
                                    </div>
                                    <div class="form-group">
                                       <label>Gender:</label>
                                       <select id="gender_id" class="WebHRForm1" style="width:180px;" name="gender_id">
                                       @foreach($master['Gender'] as $val)
                                       <option  value="{{$val['id']}}" @php if(isset($result->gender_id) && $result->gender_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
                                       @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <label>Nationality:</label>
                                       <select id="nationality_id" class="WebHRForm1" style="width:180px;" name="nationality_id">
                                       @foreach($master['Nationality'] as $val)
                                       <option  value="{{$val['id']}}" @php if(isset($result->nationality_id) && $result->nationality_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
                                       @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <h4>Contact Information</h4>
                                    </div>
                                    <div class="form-group">
                                       <label>Address:</label>
                                       <input type="text" placeholder="Address" class="form-control-spacial " id="address" name="address" value="{{isset($result->address)?$result->address:''}}">

                                    </div>
                                    <div class="form-group">
                                       <label>City:</label>
                                       <input type="text" placeholder="City" class="form-control-spacial " id="city" name="city" value="{{isset($result->city)?$result->city:''}}">

                                    </div>
                                    <div class="form-group">
                                       <label>State / Province:</label>
                                       <input type="text" placeholder="State / Province" class="form-control-spacial " id="state_province" name="state_province" value="{{isset($result->state_province)?$result->state_province:''}}">

                                    </div>
                                    <div class="form-group">
                                       <label>Zip Code / Postal Code:</label>
                                       <input type="text" placeholder="Zip Code / Postal Code" class="form-control-spacial " id="zip_code_postal_code" name="zip_code_postal_code" value="{{isset($result->zip_code_postal_code)?$result->zip_code_postal_code:''}}">

                                    </div>
                                    <div class="form-group">
                                       <label>Country:</label>
                                       <select id="country_id" class="WebHRForm1" style="width:180px;" name="country_id">
                                       @foreach($master['Countries'] as $val)
                                       <option  value="{{$val['id']}}" @php if(isset($result->country_id) && $result->country_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
                                       @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <label>Email Address:</label>
                                       <input type="text" placeholder="Email Address" class="form-control-spacial " id="email_address" name="email_address" value="{{isset($result->email_address)?$result->email_address:''}}">

                                    </div>
                                    <div class="form-group">
                                       <label>Phone Number:</label>
                                       <input type="text" placeholder="Phone Number" class="form-control-spacial " id="phone_number" name="phone_number" value="{{isset($result->phone_number)?$result->phone_number:''}}">

                                    </div>
                                    <div class="form-group">
                                       <label>Mobile Number:</label>
                                       <input type="text" placeholder="Mobile Number" class="form-control-spacial " id="mobile_number" name="mobile_number" value="{{isset($result->mobile_number)?$result->mobile_number:''}}">

                                    </div>
                                    <div class="form-group">
                                       <h4>Interests</h4>
                                    </div>
                                    <div class="form-group">
                                       <textarea class="tinyeditorclass" name="Interests" id="Interests">{{isset($result->Interests)?$result->Interests:''}}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <h4>Achievements</h4>
                                    </div>
                                    <div class="form-group">
                                       <textarea class="tinyeditorclass" name="Achievements" id="Achievements">{{isset($result->Achievements)?$result->Achievements:''}}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <h4>Qualifications</h4>
                                    </div>
                                    <div class="form-upper-main">
                                       <h4>Work Experience</h4>
                                    </div>
                                    <div class="form-upper-main">
                                       <h4>Memberships</h4>
                                    </div>
                                    <div class="form-upper-main">
                                       <h4>Trainings</h4>
                                    </div>
                                    <div class="form-upper-main">
                                       <h4>Languages</h4>
                                    </div>
                                    <div class="form-upper-main">
                                       <h4>Skills</h4>
                                    </div>
                                    <div class="form-upper-main">
                                       <h4>References</h4>
                                    </div>
                                    <div class="form-upper-main">
                                       <h4>Recruitment Source</h4>
                                    </div>
                                    <div class="form-group">
                                       <label>Source:</label>
                                       <select id="source_id" class="WebHRForm1" style="width:180px;" name="source_id">
                                       @foreach($master['Source'] as $val)
                                       <option  value="{{$val['id']}}" @php if(isset($result->source_id) && $result->source_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
                                       @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <label>Source Details:</label>
                                       <input type="text" placeholder="Recruitment Source Details" class="form-control-spacial " id="source_details" name="source_details" value="{{isset($result->source_details)?$result->source_details:''}}">

                                    </div>
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
COPY TO CLIPBOARD	 SELECT ALL
© FreeFormatter.com - FREEFORMATTER is a d/b/a of 10174785 Canada Inc. - Copyright N