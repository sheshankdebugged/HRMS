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
                  @if(Session::get('message'))
                  <div class="alert alert-success alert-dismissible">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                     Success! {{Session::get('message')}}
                  </div>
                  @endif
                  <div class="request-inner-table">
                     <div class="upper-header-request">
                        <div class="inner-heading-request">
                           <h2>{{$title}}</h2>
                        </div>
                        <div class="col-md-12 nopadding">
                           <div class="dash-board-bd">
                              <!-- Nav tabs -->
                              <ul class="nav nav-tabs" role="tablist">
                                 <li role="presentation"><a href="#generalsettings" class="active" aria-controls="generalsettings" role="tab" data-toggle="tab">General Settings</a></li>
                                 <li role="presentation"><a href="#notifications" aria-controls="notifications" role="tab" data-toggle="tab">Notifications</a></li>
                                 <li role="presentation"><a href="#checklist" aria-controls="checklist" role="tab" data-toggle="tab">checklist</a></li>
                                 <li role="presentation"><a href="#employeetasks" aria-controls="employeetasks" role="tab" data-toggle="tab">Employee Tasks</a></li>
                              </ul>
                              <div class="tab-content">
                                 <div role="tabpanel" class="tab-pane active" id="generalsettings">
                                    <div class="inner-setting-db">
                                       <div class="col-md-12">
                                          <div class="row">
                                             <div class="col-md-9">
                                                <div class="tab-content">
                                                   <div role="tabpanel" class="tab-pane active" id="organization">
                                                      <div class="inner-org">
                                                         <form method="post" action="{{ url('setting/save') }}">
                                                            <h2>Onboarding Settings</h2>
                                                            <div>
                                                            </div>
                                                            <h2>Onboarding Steps</h2>
                                                            <div class="form-field-an">
                                                               <div class="field-group">
                                                                  <div class="file-title-an">
                                                                     <label>Employee Salary:</label>
                                                                  </div>
                                                                  <div class="field-value-an">
                                                                     <label class="switch">
                                                                     <input type="checkbox" checked>
                                                                     <span class="slider round"></span>
                                                                     </label>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                            <h2>Disallow Employee Fields</h2>
                                                            <div class="form-field-an">
                                                               <div class="field-value-an">
                                                                  <p>{{isset($listData->contact_person_last_name)?$listData->contact_person_last_name:''}}</p>
                                                               </div>
                                                               <div class="field-group">
                                                                  <div class="file-title-an">
                                                                     <label>Disallow Following Employee Fields:</label>
                                                                  </div>
                                                                  <div class="field-value-an">
                                                                     <input type="text" name="contact_person_email_address" id="contact_person_email_address" placeholder="" value="{{isset($result->contact_person_email_address)?$result->contact_person_email_address:''}}">
                                                                  </div>
                                                               </div>
                                                               <h2>Disallow Custom Fields</h2>
                                                               <div class="field-group">
                                                                  <div class="file-title-an">
                                                                     <label>Disallow Following Custom Fields:</label>
                                                                  </div>
                                                                  <div class="field-value-an">
                                                                     <input type="text" name="contact_person_phone_number" id="contact_person_phone_number" placeholder="" value="{{isset($result->contact_person_phone_number)?$result->contact_person_phone_number:''}}">
                                                                  </div>
                                                               </div>
                                                               <div class="text-center">
                                                                  <input type="submit" value="Save Settings" class="submit-buttton-an">
                                                               </div>
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
                                                                  </div>
                                                               </div>
                                                               <div class="field-group">
                                                                  <div class="file-title-an">
                                                                     <label>Date Format:</label>
                                                                  </div>
                                                                  <div class="field-value-an">
                                                                  </div>
                                                               </div>
                                                               <div class="field-group">
                                                                  <div class="file-title-an">
                                                                     <label>Time Format:</label>
                                                                  </div>
                                                                  <div class="field-value-an">
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
                                 <div role="tabpanel" class="tab-pane" id="notifications">
                                    <div class="col-md-12">
                                       <div class="row" style="width: 100%">
                                          <div class="inner-wrapper-an">
                                             <div class="custon-field-header">
                                                <h2>Manage Onboarding Notification </h2>
                                                <div class="right-button">
                                                   <div class="add-record-btn">
                                                      <a href="#" id="addnotifications"><i class="fa fa-plus"></i>New Notification</a>
                                                   </div>
                                                </div>
                                             </div>
                                             <div id="notification" class="inner-table-main" style="min-height:590px;">
                                                <table id="requesttab" border="0" cellspacing="0" cellpadding="3" width="100%" align="center">
                                                   <thead>
                                                      <tr>
                                                         <td><a style="color:#fff; " href="#">S#</a></td>
                                                         <td><a style="color:#fff; " href="#">Title</a></td>
                                                         <td><a style="color:#fff; " href="#">Notification Type</a></td>
                                                         <td><a style="color:#fff; " href="#">Send To</a></td>
                                                         <td><a style="color:#fff; " href="#"></a></td>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      @php $i=1; @endphp
                                                      @foreach($notificationlist as $list)
                                                      <tr>
                                                         <td>{{$i}}</td>
                                                         <td>{{$list->title}}</td>
                                                         <td>{{$list->email_subject}}</td>
                                                         <td>{{$list->send_to_employees_id}}</td>
                                                         <td align="right">
                                                            <div class="dropdown action-drop">
                                                               <a href="javascript:void(0);" class="dropdown-custom"><i style="font-size:16px;" class="fa fa-cog"></i></a>
                                                               <ul class="dropdown-menu">
                                                                  <!-- <li><a href="#"><i class="fa fa-folder-open"></i>View Record</a></li> -->
                                                                  <li><a href="{{url('/onboardingsettings/editnotification')}}/{{$list->id}}"><i class="fa fa-edit"></i>Edit Record</a></li>
                                                                  <!-- <li><a href="#"><i class="fa fa-sticky-note"></i>Notes</a></li> -->
                                                                  <li><a href="{{url('/onboardingsettings/deletenotification/')}}/{{$list->id}}" onclick="return confirm('Are you sure to want delete this?')"><i class="fa fa-times"></i>Delete Record</a></li>
                                                               </ul>
                                                            </div>
                                                         </td>
                                                      </tr>
                                                      @endforeach
                                                      @php $i++; @endphp
                                                   </tbody>
                                                </table>
                                             </div>
                                             <div  id="newnotifications" style="display:none;" class="inner-form-main">
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
                                                   <form method="post" action="{{ url('onboardingsettings/savenotification')}}">
                                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                      <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">
                                                      <div class="form-field-inner">
                                                         <div class="form-group">
                                                            <label>Title</label>
                                                            <input type="text" class="form-control-spacial" id="title" name="title" value="{{isset($result->title)?$result->title:''}}">
                                                            
                                                            <a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Type a Job Title / Designation / Position Name." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                                         </div>
                                                         <div class="form-group">
                                                            <label>Notification Type</label>
                                                            <select class="form-control-spacial " id="notification_type_id" name="notification_type_id">
                                                            @foreach($master['NotificationType'] as $val)
                                                            <option value="{{$val['id']}}" <?php if (isset($result->notification_type_id)) {echo ($country['notification_type_id'] == $result->approval_levels_id) ? "selected" : "";}?> >{{$val['title']}}</option>
                                                            @endforeach
                                                            </select>
                                                            <a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Type a Job Title / Designation / Position Name." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                                         </div>
                                                         <div class="form-group">
                                                            <label>Send To (Employees)</label>
                                                               <select id="send_to_employees_id" multiple class="WebHRForm1 chosen-select" style="width:180px;" name="send_to_employees_id">
                                                               @foreach($master['Employees'] as $val)
                                                                  <option value="{{$val['id']}}" @php if(isset($result->send_to_employees_id) && $result->send_to_employees_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['user_name']}}</option>
                                                               @endforeach
                                                               </select>
                                                            <a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Type a Job Title / Designation / Position Name." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                                         </div>
                                                         <div class="form-group">
                                                            <label>Send To (Externals)</label>
                                                            <input type="text" class="form-control-spacial" id="send_to_externals" name="send_to_externals" value="{{isset($result->send_to_externals)?$result->send_to_externals:''}}">
                                                            
                                                            <a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Type a Job Title / Designation / Position Name." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                                         </div>
                                                         <div class="form-group">
                                                            <label>Email Subject</label>
                                                            <input type="text" class="form-control-spacial" id="email_subject" name="email_subject" value="{{isset($result->email_subject)?$result->email_subject:''}}">
                                                            
                                                            <a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Type a Job Title / Designation / Position Name." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                                         </div>
                                                         <div class="form-group">
                                                            <label>Email Message</label>
                                                            <textarea class="tinyeditorclass" name="email_message" id="email_message">{{isset($result->email_message)?$result->email_message:''}}</textarea>
                                                         </div>
                                                         <div class="form-group text-center">
                                                            <input class="submit-office" type="submit" value="Add Notification">
                                                         </div>
                                                      </div>
                                                   </form>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div role="tabpanel" class="tab-pane" id="checklist">
                                    <div class="col-md-12">
                                       <div class="row" style="width: 100%">
                                          <div class="inner-wrapper-an">
                                             <div class="custon-field-header">
                                                <h2>Manage Onboarding checklist </h2>
                                                <div class="right-button">
                                                   <div class="add-record-btn">
                                                      <a href="#" id="addchecklist"><i class="fa fa-plus"></i>New checklist Item</a>
                                                   </div>
                                                </div>
                                             </div>
                                             <div id ="checklist" class="inner-table-main" style="min-height:590px;">
                                                <table id="requesttab" border="0" cellspacing="0" cellpadding="3" width="100%" align="center">
                                                   <thead>
                                                      <tr>
                                                         <td><a style="color:#fff; " href="#">S#</a></td>
                                                         <td><a style="color:#fff; " href="#">checklist Item</a></td>
                                                         <td><a style="color:#fff; " href="#"> </a></td>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      @php $i=1; @endphp
                                                      @foreach($listData as $list)
                                                      <tr>
                                                         <td>{{$i}}</td>
                                                         <td>email</td>
                                                         <td align="right">
                                                            <div class="dropdown action-drop">
                                                               <a href="javascript:void(0);" class="dropdown-custom"><i style="font-size:16px;" class="fa fa-cog"></i></a>
                                                               <ul class="dropdown-menu">
                                                                  <!-- <li><a href="#"><i class="fa fa-folder-open"></i>View Record</a></li> -->
                                                                  <li><a href="{{url('/onboardingsettings/edit')}}/{{$list->id}}"><i class="fa fa-edit"></i>Edit Record</a></li>
                                                                  <!-- <li><a href="#"><i class="fa fa-sticky-note"></i>Notes</a></li> -->
                                                                  <li><a href="{{url('/onboardingsettings/deletenotification/')}}/{{$list->id}}" onclick="return confirm('Are you sure to want delete this?')"><i class="fa fa-times"></i>Delete Record</a></li>
                                                               </ul>
                                                            </div>
                                                         </td>
                                                      </tr>
                                                      @endforeach
                                                      @php $i++; @endphp
                                                   </tbody>
                                                </table>
                                             </div>
                                             <div  id="newchecklist" style="display:none;" class="inner-form-main">
                                                <div class="form-heading-space">
                                                   <h3>{{$checklist}}</h3>
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
                                                         <div class="form-group">
                                                            <label>checklist Item:</label>
                                                            <input type="text" class="form-control-spacial" id="city" name="city" value="{{isset($result->city)?$result->city:''}}">
                                                         </div>
                                                         <div class="form-group text-center">
                                                            <input class="submit-office" type="submit" value="Add checklist Item">
                                                         </div>
                                                      </div>
                                                   </form>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div role="tabpanel" class="tab-pane" id="employeetasks">
                                    <div class="col-md-12">
                                       <div class="row" style="width: 100%">
                                          <div class="inner-wrapper-an">
                                             <div class="custon-field-header">
                                                <h2>Manage Employee Onboarding Tasks </h2>
                                                <div class="right-button">
                                                   <div class="add-record-btn">
                                                      <a href="#" id ="addemployeetask"><i class="fa fa-plus"></i>New Employee Task</a>
                                                   </div>
                                                </div>
                                             </div>
                                             <div  id="employeetask"class="inner-table-main" style="min-height:590px;">
                                                <table id="requesttab" border="0" cellspacing="0" cellpadding="3" width="100%" align="center">
                                                   <thead>
                                                      <tr>
                                                         <td><a style="color:#fff; " href="#">S#</a></td>
                                                         <td><a style="color:#fff; " href="#">Employee Task</a></td>
                                                         <td><a style="color:#fff; " href="#"></a></td>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      @php $i=1; @endphp
                                                      @foreach($listData as $list)
                                                      <tr>
                                                         <td>{{$i}}</td>
                                                         <td>email</td>
                                                         <td align="right">
                                                            <div class="dropdown action-drop">
                                                               <a href="javascript:void(0);" class="dropdown-custom"><i style="font-size:16px;" class="fa fa-cog"></i></a>
                                                               <ul class="dropdown-menu">
                                                                  <!-- <li><a href="#"><i class="fa fa-folder-open"></i>View Record</a></li> -->
                                                                  <li><a href="{{url('/jobrequests/edit')}}/{{$list->id}}"><i class="fa fa-edit"></i>Edit Record</a></li>
                                                                  <!-- <li><a href="#"><i class="fa fa-sticky-note"></i>Notes</a></li> -->
                                                                  <li><a href="{{url('/jobrequests/delete/')}}/{{$list->id}}" onclick="return confirm('Are you sure to want delete this?')"><i class="fa fa-times"></i>Delete Record</a></li>
                                                               </ul>
                                                            </div>
                                                         </td>
                                                      </tr>
                                                      @endforeach
                                                      @php $i++; @endphp
                                                   </tbody>
                                                </table>
                                             </div>
                                             <div  id="newemployeetask" style="display:none;" class="inner-form-main">
                                                <div class="form-heading-space">
                                                   <h3>{{$employeetask}}</h3>
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
                                                         <div class="form-group">
                                                            <label>Task:</label>
                                                            <input type="text" class="form-control-spacial" id="job_title" name="job_title" value="{{isset($result->job_title)?$result->job_title:''}}">
                                                            
                                                            <a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Type a Job Title / Designation / Position Name." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                                         </div>
                                                         <div class="form-group">
                                                            <label>Task Type:</label>
                                                            <input type="text" class="form-control-spacial" id="job_title" name="job_title" value="{{isset($result->job_title)?$result->job_title:''}}">
                                                            
                                                            <a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Type a Job Title / Designation / Position Name." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                                         </div>
                                                         <div class="form-group">
                                                            <label>Task Type Item:</label>
                                                            <input type="text" class="form-control-spacial" id="job_title" name="job_title" value="{{isset($result->job_title)?$result->job_title:''}}">
                                                            
                                                            <a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Type a Job Title / Designation / Position Name." data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
                                                         </div>
                                                         <div class="form-group">
                                                            <label>Instructions:</label>
                                                            <textarea class="notes" name="notes" id="nproject_descriptionotes" id="project_description">{{isset($result->notes)?$result->project_description:''}}</textarea>
                                                         </div>
                                                         <div class="form-group text-center">
                                                            <input class="submit-office" type="submit" value="Add Task">
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
<script>
   $(document).ready(function(){
    
    var id =0;
     $("#addnotifications").click(function(){
        if($("#addnotifications")[0].innerHTML =='<i class="fa fa-plus"></i>New Notification'){
            $("#addnotifications")[0].innerHTML = '<i class="fa fa-angle-left"></i>Back';
        }else{
         $("#addnotifications")[0].innerHTML ='<i class="fa fa-plus"></i>New Notification';
        }
      $("#notification").toggle();
      $("#newnotifications").toggle();
     });
   
     $("#addchecklist").click(function(){
        if($("#addchecklist")[0].innerHTML =='<i class="fa fa-plus"></i>New checklist Item'){
            $("#addchecklist")[0].innerHTML = '<i class="fa fa-angle-left"></i>Back';
        }else{
         $("#addchecklist")[0].innerHTML ='<i class="fa fa-plus"></i>New checklist Item';
        }
      $("#checklist").toggle();
      $("#newchecklist").toggle();
     });
     $("#addemployeetask").click(function(){
        if($("#addemployeetask")[0].innerHTML =='<i class="fa fa-plus"></i>New Employee Task'){
            $("#addemployeetask")[0].innerHTML = '<i class="fa fa-angle-left"></i>Back';
        }else{
         $("#addemployeetask")[0].innerHTML ='<i class="fa fa-plus"></i>New Employee Task';
        }
      $("#employeetask").toggle();
      $("#newemployeetask").toggle();
     });
   
   });
   
</script>