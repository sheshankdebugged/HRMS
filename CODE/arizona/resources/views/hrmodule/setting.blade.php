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
                        <h2>System Settings</h2>
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
                  @if(Session::get('message'))
                  <div class="alert alert-success alert-dismissible">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                     Success! {{Session::get('message')}}
                  </div>
                  @endif
                  <div class="request-inner-table">
                     <div class="upper-header-request">
                        <div class="col-md-12 nopadding">
                           <div class="dash-board-bd">
                              <!-- Nav tabs -->
                              <ul class="nav nav-tabs" role="tablist">
                                 <li role="presentation"><a href="#home" class="active" aria-controls="home" role="tab" data-toggle="tab">System Settings</a></li>
                                 <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Custom Fields</a></li>
                                 <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Notifications</a></li>
                                 <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Reminders</a></li>
                              </ul>
                              <div class="tab-content">
                                 <div role="tabpanel" class="tab-pane active" id="home">
                                    <div class="inner-setting-db">
                                       <div class="col-md-12">
                                          <div class="row">
                                             <div class="col-md-3">
                                                <ul class="nav nav-pills nav-stacked" id="myTabs">
                                                   <li><a class="active" href="#organization" aria-controls="organization" role="tab" data-toggle="tab">Organization Details</a></li>
                                                   <li><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General Settings</a></li>
                                                   <li><a href="#system" aria-controls="system" role="tab" data-toggle="tab">System Administrators</a></li>
                                                   <li><a href="#interface" aria-controls="interface" role="tab" data-toggle="tab">Interface Language</a></li>
                                                   <li><a href="#constants" aria-controls="constants" role="tab" data-toggle="tab">Constants</a></li>
                                                   <li><a href="#restrictions" aria-controls="restrictions" role="tab" data-toggle="tab">IP Restrictions</a></li>
                                                   <li><a href="#security" aria-controls="security" role="tab" data-toggle="tab">Security</a></li>
                                                   <li><a href="#backup" aria-controls="backup" role="tab" data-toggle="tab">Data Backup</a></li>
                                                </ul>
                                             </div>
                                             <div class="col-md-9">
                                                <div class="tab-content">
                                                   <div role="tabpanel" class="tab-pane active" id="organization">
                                                      <div class="inner-org">
                                                         <form method="post" action="{{ url('setting/save') }}">
                                                            <h2>Organization Details</h2>
                                                            <div class="form-field-an">
                                                               <div class="field-group">
                                                                  <div class="file-title-an">
                                                                     <label>Organization Code:</label>
                                                                  </div>
                                                                  <div class="field-value-an">
                                                                     <p>{{$listData->organization_code}}</p>
                                                                  </div>
                                                               </div>
                                                               <div class="field-group">
                                                                  <div class="file-title-an">
                                                                     <label>Organization Url:</label>
                                                                  </div>
                                                                  <div class="field-value-an">
                                                                     <p>{{$listData->organization_url}}</p>
                                                                  </div>
                                                               </div>
                                                               <div class="field-group">
                                                                  <div class="file-title-an">
                                                                     <label>Organization Name:</label>
                                                                  </div>
                                                                  <div class="field-value-an">
                                                                     <input type="text" name="organization_code" id="organization_code" placeholder="{{$listData->organization_code}}" value="{{isset($result->organization_name)?$result->organization_name:''}}">
                                                                  </div>
                                                               </div>
                                                               <div class="field-group">
                                                                  <div class="file-title-an">
                                                                     <label>Organization Starting Year:</label>
                                                                  </div>
                                                                  <div class="field-value-an">
                                                                     <input type="text" name="organization_starting_year" id="organization_starting_year" placeholder="{{$listData->organization_starting_year}}" value="{{isset($result->organization_starting_year)?$result->organization_starting_year:''}}">
                                                                  </div>
                                                               </div>
                                                            </div>
                                                            <h2>Contact Person</h2>
                                                            <div class="form-field-an">
                                                               <div class="field-group">
                                                                  <div class="file-title-an">
                                                                     <label>First Name:</label>
                                                                  </div>
                                                                  <div class="field-value-an">
                                                                     <p>{{$listData->contact_person_first_name}}</p>
                                                                  </div>
                                                               </div>
                                                               <div class="field-group">
                                                                  <div class="file-title-an">
                                                                     <label>Last Name:</label>
                                                                  </div>
                                                                  <div class="field-value-an">
                                                                     <p>{{$listData->contact_person_last_name}}</p>
                                                                  </div>
                                                               </div>
                                                               <div class="field-group">
                                                                  <div class="file-title-an">
                                                                     <label>Email Address:</label>
                                                                  </div>
                                                                  <div class="field-value-an">
                                                                     <input type="text" name="contact_person_email_address" id="contact_person_email_address" placeholder="{{$listData->contact_person_email_address}}" value="{{isset($result->contact_person_email_address)?$result->contact_person_email_address:''}}">
                                                                  </div>
                                                               </div>
                                                               <div class="field-group">
                                                                  <div class="file-title-an">
                                                                     <label>Country:</label>
                                                                  </div>
                                                                  <div class="field-value-an">
                                                                     <select id="country_id" class="WebHRForm1" style="width:180px;" name="country_id">
                                                                     @foreach($master['Countries'] as $val)
                                                                     <option  value="{{$val['id']}}" @php if(isset($result->country_id) && $result->country_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
                                                                     @endforeach
                                                                     </select>
                                                                  </div>
                                                               </div>
                                                               <div class="field-group">
                                                                  <div class="file-title-an">
                                                                     <label>Phone Number:</label>
                                                                  </div>
                                                                  <div class="field-value-an">
                                                                     <input type="text" name="contact_person_phone_number" id="contact_person_phone_number" placeholder="{{$listData->contact_person_phone_number}}" value="{{isset($result->contact_person_phone_number)?$result->contact_person_phone_number:''}}">
                                                                  </div>
                                                               </div>
                                                               <h2>Organization Logo</h2>
                                                               <div class="field-group-select">
                                                                  <div class="field-vamue-an">
                                                                     <input type="file" name="organization_logo" value="">
                                                                  </div>
                                                                  <div class="image-an-company">
                                                                     <!-- <img src="https://s3.amazonaws.com/a.webhr.co/logo/demo_OdCFED.png"> -->
                                                                  </div>
                                                               </div>
                                                               <input type="submit" value="save" class="submit-buttton-an">
                                                            </div>
                                                         </form>
                                                      </div>
                                                   </div>
                                                   <div role="tabpanel" class="tab-pane" id="general">
                                                      <div class="inner-org">
                                                         <form method="post" action="{{ url('setting/savegeneral') }}">
                                                            <h2>Date & Time</h2>
                                                            <div class="form-field-an">
                                                               <div class="field-group">
                                                                  <div class="file-title-an">
                                                                     <label>Default Time Zone:</label>
                                                                  </div>
                                                                  <div class="field-value-an">
                                                                     <select class="form-control-spacial" id="default_time_zone_id" name="default_time_zone_id">
                                                                     @foreach($timezone['TimeZone'] as $val)
                                                                     <option  value="{{$val['id']}}" @php if(isset($result->default_time_zone_id) && $result->default_time_zone_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
                                                                     @endforeach
                                                                     </select>
                                                                  </div>
                                                               </div>
                                                               <div class="field-group">
                                                                  <div class="file-title-an">
                                                                     <label>Date Format:</label>
                                                                  </div>
                                                                  <div class="field-value-an">
                                                                     <select class="form-control-spacial" id="date_format_id" name="date_format_id">
                                                                     @foreach($dateformat['DateFormat'] as $val)
                                                                     <option  value="{{$val['id']}}" @php if(isset($result->date_format_id) && $result->date_format_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
                                                                     @endforeach
                                                                     </select>
                                                                  </div>
                                                               </div>
                                                               <div class="field-group">
                                                                  <div class="file-title-an">
                                                                     <label>Time Format:</label>
                                                                  </div>
                                                                  <div class="field-value-an">
                                                                     <select class="form-control-spacial" id="time_format_id" name="time_format_id">
                                                                     @foreach($timeformat['TimeFormat'] as $val)
                                                                     <option  value="{{$val['id']}}" @php if(isset($result->time_format_id) && $result->time_format_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
                                                                     @endforeach
                                                                     </select>
                                                                  </div>
                                                               </div>
                                                               <!-- <div class="field-group">
                                                                  <div class="file-title-an">
                                                                    <label>Show Total Time as Decimals:</label>
                                                                  </div>
                                                                  <div class="field-value-an">
                                                                    <input type="radio" class="an-check-box" value="Yes">
                                                                    <input type="radio" class="an-check-box" value="No">
                                                                  </div>
                                                                  </div> -->
                                                               <input type="submit" name="" value="save" class="submit-buttton-an">
                                                            </div>
                                                         </form>
                                                      </div>
                                                   </div>
                                                   <div role="tabpanel" class="tab-pane" id="system">
                                                      <div class="inner-org">
                                                         <h2>System Administrators</h2>
                                                         <div class="emply-table">
                                                            <table border="0" cellspacing="0" cellpadding="3" width="400px">
                                                               <tbody>
                                                                  <tr>
                                                                     <td class="webhr-tab" style="width:30px;" align="center">S#</td>
                                                                     <td class="webhr-tab">Employee Name</td>
                                                                     <td class="webhr-tab">User Name</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td><i class=""></i></td>
                                                                     <td>System Administrator</td>
                                                                     <td>admin</td>
                                                                  </tr>
                                                               </tbody>
                                                            </table>
                                                         </div>
                                                         <input type="submit" name="" value="Add System Administrator" class="submit-buttton-an">
                                                      </div>
                                                   </div>
                                                   <div role="tabpanel" class="tab-pane" id="interface">
                                                      <div class="inner-org">
                                                         <h2>Application Interface Language</h2>
                                                         <div class="form-field-an">
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Application Interface Language:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select>
                                                                     <option>English</option>
                                                                     <option>Hindi</option>
                                                                  </select>
                                                               </div>
                                                            </div>
                                                            <input type="submit" name="" value="save" class="submit-buttton-an">
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div role="tabpanel" class="tab-pane" id="constants">
                                                      <div class="inner-org">
                                                         <h2>Constants</h2>
                                                         <div class="form-field-an">
                                                            <!-- <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Languages:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <p>Manage Languages</p>
                                                               </div>
                                                               </div> -->
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Skills</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                               <a href="{{url('manageskills')}}">Manage Skills</a>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Qualification Degrees</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                               <a href="{{url('managequalificationdegrees')}}">Manage Qualification Degrees</a>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Contract Types</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                               <a href="{{url('managecontracttypes')}}">Manage Contract Types</a>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Job Types</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                               <a href="{{url('managejobtypes')}}">Manage Job Types</a>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                <label>Job Fields</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                               <a href="{{url('managejobfields')}}">Manage Job Fields</a>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Division Types</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                               <a href="{{url('managedivisiontypes')}}">Manage Division Types</a>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Station Types</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                               <a href="{{url('managestationtypes')}}">Manage Station Types</a>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Policy Types</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                               <a href="{{url('managepolicytypes')}}">Manage Policy Types</a>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Employee Types</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                               <a href="{{url('manageemployeetypes')}}">Manage Employee Types</a>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Employee Categories</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <a href="{{url('manageemployeecategories')}}">Manage Employee Categories</a>                                                    
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Insurance Types</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <a href="{{url('manageinsurancetypes')}}">Manage Insurance Types</a>                                                    
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Training Types</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <a href="{{url('managetrainingtypes')}}">Manage Training Types</a>                                                    
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Training Subjects</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <a href="{{url('managetrainingsubjects')}}">Manage Training Subjects</a>                                                    
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Reimbursement Categories</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <a href="{{url('managereimbursementcategories')}}">Manage Reimbursement Categories</a>                                                    
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Recruitment Screening Parameters</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <a href="{{url('managerecruitmentscreeningparameters')}}">Manage Recruitment Screening Parameters</a>                                                    
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Recruitment Sources</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <a href="{{url('managerecruitmentsources')}}">Manage Recruitment Sources</a>                                                    
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div role="tabpanel" class="tab-pane" id="restrictions">restrictions</div>
                                                   <div role="tabpanel" class="tab-pane" id="security">security</div>
                                                   <div role="tabpanel" class="tab-pane" id="backup">backup</div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div role="tabpanel" class="tab-pane" id="profile">
                                    <div class="col-md-12">
                                       <div class="row" style="width: 100%">
                                          <div class="inner-wrapper-an">
                                             <div class="custon-field-header">
                                                <h2>Custom Fields </h2>
                                                <div class="right-button">
                                                   <div class="add-record-btn">
                                                      <a href="#"><i class="fa fa-plus"></i>Add Custom Field</a>
                                                   </div>
                                                   <div class="search-area-request">
                                                      <input type="text" placeholder="Search...">
                                                      <button><i class="fa fa-search"></i></button>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="inner-table-main" style="min-height:590px;">
                                                <table id="requesttab" border="0" cellspacing="0" cellpadding="3" width="100%" align="center">
                                                   <thead>
                                                      <tr>
                                                         <td><a style="color:#fff; " href="#">S#</a></td>
                                                         <td><a style="color:#fff; " href="#">Component name</a></td>
                                                         <td><a style="color:#fff; " href="#">Custom Field Category</a></td>
                                                         <td><a style="color:#fff; " href="#">Custom Field Name</a></td>
                                                         <td><a style="color:#fff; " href="#">Custom Field Type</a></td>
                                                         <td><a style="color:#fff; " href="#">Custom Field Order</a></td>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <tr>
                                                         <td>1</td>
                                                         <td>bkanwasi21@mail.com</td>
                                                         <td>google.com</td>
                                                         <td>google.com</td>
                                                         <td>google.com</td>
                                                         <td>google.com</td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div role="tabpanel" class="tab-pane" id="messages">
                                    <div class="col-md-12">
                                       <div class="row" style="width: 100%">
                                          <div class="inner-wrapper-an">
                                             <div class="custon-field-header">
                                                <h2>Notifications </h2>
                                                <div class="right-button">
                                                   <div class="add-record-btn">
                                                      <a href="#"><i class="fa fa-plus"></i>Add Notification</a>
                                                   </div>
                                                   <div class="search-area-request">
                                                      <input type="text" placeholder="Search...">
                                                      <button><i class="fa fa-search"></i></button>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="inner-table-main" style="min-height:590px;">
                                                <table id="requesttab" border="0" cellspacing="0" cellpadding="3" width="100%" align="center">
                                                   <thead>
                                                      <tr>
                                                         <td><a style="color:#fff; " href="#">S#</a></td>
                                                         <td><a style="color:#fff; " href="#">Notification Type</a></td>
                                                         <td><a style="color:#fff; " href="#">Send To</a></td>
                                                         <td><a style="color:#fff; " href="#">Days to Send Notification</a></td>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <tr>
                                                         <td>1</td>
                                                         <td>email</td>
                                                         <td>Sheshank</td>
                                                         <td>2R</td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div role="tabpanel" class="tab-pane" id="settings">
                                    <div class="col-md-12">
                                       <div class="row" style="width: 100%">
                                          <div class="inner-wrapper-an">
                                             <div class="custon-field-header">
                                                <h2>Reminders</h2>
                                                <div class="right-button">
                                                   <div class="add-record-btn">
                                                      <a href="#"><i class="fa fa-plus"></i>Add Reminder</a>
                                                   </div>
                                                   <div class="search-area-request">
                                                      <input type="text" placeholder="Search...">
                                                      <button><i class="fa fa-search"></i></button>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="inner-table-main" style="min-height:590px;">
                                                <table id="requesttab" border="0" cellspacing="0" cellpadding="3" width="100%" align="center">
                                                   <thead>
                                                      <tr>
                                                         <td><a style="color:#fff; " href="#">S#</a></td>
                                                         <td><a style="color:#fff; " href="#">Reminder Title</a></td>
                                                         <td><a style="color:#fff; " href="#">Reminder Date</a></td>
                                                         <td><a style="color:#fff; " href="#">Status</a></td>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <tr>
                                                         <td>1</td>
                                                         <td>bkanwasi21@mail.com</td>
                                                         <td>google.com</td>
                                                         <td>google.com</td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="inner-table-main" style="min-height:590px;">
                        <div class="inner-table-main" style="min-height:590px;">
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