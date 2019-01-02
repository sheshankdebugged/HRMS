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
                              <a href="#" alt="Dashboard">
                              <i class="fa fa-cog"></i>
                              </a>
                           </li>
                           <li>
                              <a href="#" alt="Dashboard">
                              <i class="fa fa-question-circle"></i>
                              </a>
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
                              <div class="tab-content">
                                 <div role="tabpanel" class="tab-pane active" id="home">
                                    <div class="inner-setting-db">
                                       <div class="col-md-12">
                                          <div class="row">
                                             <div class="col-md-3">
                                                <ul class="nav nav-pills nav-stacked" id="myTabs">
                                                   <li>
                                                      <a class="active" href="#hrSummary" aria-controls="hrSummary" role="tab" data-toggle="tab"><i class="fa fa-bar-chart"></i> HR Summary</a>
                                                   </li>
                                                   <li>
                                                      <a href="#organogram" aria-controls="organogram" role="tab" data-toggle="tab"> <i class="fa fa-sitemap"></i> Organogram</a>
                                                   </li>
                                                   <li>
                                                      <a href="#payrollSummary" aria-controls="payrollSummary" role="tab" data-toggle="tab"><i class="fa fa-line-chart"></i></i>  Payroll Summary</a>
                                                   </li>
                                                   <li>
                                                      <a href="#hrTimeline" aria-controls="hrTimeline" role="tab" data-toggle="tab"> <i class="fa fa-ellipsis-h"></i> HR Timeline</a>
                                                   </li>
                                                   <li>
                                                      <a href="#stationsList" aria-controls="stationList" role="tab" data-toggle="tab"><i class="fa fa-building"></i> Stations List</a>
                                                   </li>
                                                   <li>
                                                      <a href="#departmentsList" aria-controls="departmentList" role="tab" data-toggle="tab"><i class="fa fa-sitemap"></i> Departments List</a>
                                                   </li>
                                                   <li>
                                                      <a href="#designationsList" aria-controls="designationsList" role="tab" data-toggle="tab"><i class="fa fa-address-card"></i> Designations List</a>
                                                   </li>
                                                   <li>
                                                      <a href="#employeesList" aria-controls="employeesList" role="tab" data-toggle="tab"><i class="fa fa-users"></i> Employees List</a>
                                                   </li>
                                                   <li>
                                                      <a href="#holidaysCalendar" aria-controls="holidaysCalendar" role="tab" data-toggle="tab"><i class=" fa fa-calendar-check-o"></i> Holidays Calendar</a>
                                                   </li>
                                                   <li>
                                                      <a href="#birthdaysCalendar" aria-controls="birthdaysCalendar" role="tab" data-toggle="tab"><i class="fa fa-birthday-cake"></i> Birthdays Calendar</a>
                                                   </li>
                                                   <li>
                                                      <a href="#leavesCalendar" aria-controls="leavesCalendar" role="tab" data-toggle="tab"><i class="fa fa-calendar"></i> Leaves Calendar</a>
                                                   </li>
                                                   <li>
                                                      <a href="#employeesTurnover" aria-controls="employeesTurnover" role="tab" data-toggle="tab"><i class="fa fa-user"></i> Employees Turnover</a>
                                                   </li>
                                                   <li>
                                                      <a href="#employeesRetention" aria-controls="employeesRetention" role="tab" data-toggle="tab"><i class="fa fa-user-plus"></i> Employees Retention</a>
                                                   </li>
                                                   <li>
                                                      <a href="#projectsReport" aria-controls="projectsReport" role="tab" data-toggle="tab"><i class="fa fa-archive"></i> Projects Report</a>
                                                   </li>
                                                   <li>
                                                      <a href="#projectEmployees" aria-controls="projectEmployees" role="tab" data-toggle="tab"><i class="fa fa-archive"></i> Project Employees</a>
                                                   </li>
                                                   <li>
                                                      <a href="#documents" aria-controls="documents" role="tab" data-toggle="tab"><i class="fa fa-folder"></i> Documents</a>
                                                   </li>
                                                </ul>
                                             </div>
                                             <div class="col-md-9">
                                                <div class="tab-content">
                                                   <div role="tabpanel" class="tab-pane active" id="hrSummary">
                                                      <div class="inner-org">
                                                         <h2>HR Summary</h2>
                                                         <h4>Report Filters</h4>
                                                         <div class="form-field-an">
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Company:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Station:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Department:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <h4>Report Options</h4>
                                                            <div class="field-group-select">
                                                               <div class="field-vamue-an">
                                                                  <input type="submit" name="" value="Generate Report" class="submit-buttton-an">
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div role="tabpanel" class="tab-pane" id="organogram">
                                                      <div class="inner-org">
                                                         <h2>Organogram</h2>
                                                         <h4>Report Filters</h4>
                                                         <div class="form-field-an">
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Company:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Station:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Department:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Employee Type:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Employee Category:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Employee Status:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Additional Organogram Employees:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <h4>Report Options</h4>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Show Department Name:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <label class="switch">
                                                                  <input type="checkbox" checked>
                                                                  <span class="slider round"></span>
                                                                  </label>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Show Designation:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <label class="switch">
                                                                  <input type="checkbox" checked>
                                                                  <span class="slider round"></span>
                                                                  </label>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Show Employee Photos:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <label class="switch">
                                                                  <input type="checkbox" checked>
                                                                  <span class="slider round"></span>
                                                                  </label>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Show Employee Grades:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <label class="switch">
                                                                  <input type="checkbox" checked>
                                                                  <span class="slider round"></span>
                                                                  </label>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Show Filter Names:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <label class="switch">
                                                                  <input type="checkbox" checked>
                                                                  <span class="slider round"></span>
                                                                  </label>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Organogram Type:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Print Orientation:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <input type="submit" name="" value="Generate Report" class="submit-buttton-an">
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div role="tabpanel" class="tab-pane" id="payrollSummary">
                                                      <div class="inner-org">
                                                         <h2>Payroll Summary</h2>
                                                         <h4>Report Filters</h4>
                                                         <h4>Report Options</h4>
                                                          <div class="field-group-select">
                                                               <div class="field-vamue-an">
                                                                  <input type="submit" name="" value="Generate Report" class="submit-buttton-an">
                                                               </div>
                                                          </div>
                                                      </div>
                                                   </div>
                                                   <div role="tabpanel" class="tab-pane" id="hrTimeline">
                                                      <div class="inner-org">
                                                         <h2>HR Timeline</h2>
                                                         <h4>Report Filters</h4>
                                                         <div class="form-field-an">
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Station:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Department:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <h4>Report Options</h4>
                                                            <div class="field-group-select">
                                                               <div class="field-vamue-an">
                                                                  <input type="submit" name="" value="Generate Report" class="submit-buttton-an">
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div role="tabpanel" class="tab-pane" id="stationsList">
                                                      <div class="inner-org">
                                                        <h2>Stations List</h2>
                                                        <h4>Report Filters</h4>
                                                         <div class="form-field-an">
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Company:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <h4>Report Options</h4>
                                                            <div class="field-group-select">
                                                               <div class="field-vamue-an">
                                                                  <input type="submit" name="" value="Generate Report" class="submit-buttton-an">
                                                               </div>
                                                            </div>
                                                          </div>
                                                      </div>
                                                   </div>
                                                   <div role="tabpanel" class="tab-pane" id="departmentsList">
                                                      <div class="inner-org">
                                                         <h2>Departments List</h2>
                                                         <h4>Report Filters</h4>
                                                        <div class="form-field-an">
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Company:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Station:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <h4>Report Options</h4>
                                                            <div class="field-group-select">
                                                               <div class="field-vamue-an">
                                                                  <input type="submit" name="" value="Generate Report" class="submit-buttton-an">
                                                               </div>
                                                            </div>
                                                        </div>
                                                      </div>
                                                   </div>
                                                   <div role="tabpanel" class="tab-pane" id="designationsList">
                                                      <div class="inner-org">
                                                          <h2>Designations List</h2>
                                                          <h4>Report Filters</h4>
                                                          <h4>Report Options</h4>
                                                            <div class="field-group-select">
                                                                <div class="field-vamue-an">
                                                                    <input type="submit" name="" value="Generate Report" class="submit-buttton-an">
                                                                </div>
                                                            </div>
                                                      </div>
                                                   </div>
                                                   <div role="tabpanel" class="tab-pane" id="employeesList">
                                                      <div class="inner-org">
                                                         <h2>Employees List</h2>
                                                         <h4>Report Filters</h4>
                                                         <div class="form-field-an">
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Company:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Station:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Department:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Designation:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Employee Type:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Employee Category:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Employee Status:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Joining Date:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                               <input type="text" class="form-control-spacial date" id="" name="" value="">-
                                                               <input type="text" class="form-control-spacial date" id="" name="" value="">

                                                               </div>
                                                            </div>
                                                            <h4>Report Options</h4>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Additional Data Fields:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select name="cars" multiple>
                                                                    <option value="volvo">Volvo</option>
                                                                    <option value="saab">Saab</option>
                                                                    <option value="opel">Opel</option>
                                                                    <option value="audi">Audi</option>
                                                                  </select>                                                               
                                                                </div>
                                                            </div>
                                                            <h4>Sort By</h4>
                                                            <div class="field-group">
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <input type="submit" name="" value="Generate Report" class="submit-buttton-an">
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div role="tabpanel" class="tab-pane" id="holidaysCalendar">
                                                      <div class="inner-org">
                                                         <h2>Holidays Calendar</h2>
                                                         <h4>Report Filters</h4>
                                                         <div class="form-field-an">
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Station:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Year:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <h4>Report Options</h4>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Include Custom Fields:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <label class="switch">
                                                                  <input type="checkbox" checked>
                                                                  <span class="slider round"></span>
                                                                  </label>
                                                               </div>
                                                            </div>
                                                            <div class="field-group-select">
                                                               <div class="field-vamue-an">
                                                                  <input type="submit" name="" value="Generate Report" class="submit-buttton-an">
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div role="tabpanel" class="tab-pane" id="birthdaysCalendar">
                                                      <div class="inner-org">
                                                         <h2>Birthdays Calendar</h2>
                                                         <h4>Report Filters</h4>
                                                         <div class="form-field-an">
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Company:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Station:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Department:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <h4>Report Options</h4>
                                                            <div class="field-group-select">
                                                               <div class="field-vamue-an">
                                                                  <input type="submit" name="" value="Generate Report" class="submit-buttton-an">
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div role="tabpanel" class="tab-pane" id="leavesCalendar">
                                                      <div class="inner-org">
                                                         <h2>Leaves Calendar</h2>
                                                         <h4>Report Filters</h4>
                                                         <div class="form-field-an">
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Company:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Station:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Department:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Year:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Approval Status:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <h4>Report Options</h4>
                                                            <div class="field-group-select">
                                                               <div class="field-vamue-an">
                                                                  <input type="submit" name="" value="Generate Report" class="submit-buttton-an">
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div role="tabpanel" class="tab-pane" id="employeesTurnover">
                                                      <div class="inner-org">
                                                         <h2>Employees Turnover</h2>
                                                         <h4>Report Filters</h4>
                                                         <div class="form-field-an">
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Company:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Station:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Department:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <h4>Report Options</h4>
                                                            <div class="field-group-select">
                                                               <div class="field-vamue-an">
                                                                  <input type="submit" name="" value="Generate Report" class="submit-buttton-an">
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div role="tabpanel" class="tab-pane" id="employeesRetention">
                                                      <div class="inner-org">
                                                         <h2>Employees Retention</h2>
                                                         <h4>Report Filters</h4>
                                                         <div class="form-field-an">
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Company:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Station:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Department:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Employee Type:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Employee Category:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <h4>Report Options</h4>
                                                            <div class="field-group-select">
                                                               <div class="field-vamue-an">
                                                                  <input type="submit" name="" value="Generate Report" class="submit-buttton-an">
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div role="tabpanel" class="tab-pane" id="projectsReport">
                                                      <div class="inner-org">
                                                         <h2>Projects Report</h2>
                                                         <h4>Report Filters</h4>
                                                         <div class="form-field-an">
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Project Category:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Project:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <h4>Report Options</h4>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Show Project Employees:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <label class="switch">
                                                                  <input type="checkbox" checked>
                                                                  <span class="slider round"></span>
                                                                  </label>
                                                               </div>
                                                            </div>
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Show Project Custom Fields:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <label class="switch">
                                                                  <input type="checkbox" checked>
                                                                  <span class="slider round"></span>
                                                                  </label>
                                                               </div>
                                                            </div>
                                                            <div class="field-group-select">
                                                               <div class="field-vamue-an">
                                                                  <input type="submit" name="" value="Generate Report" class="submit-buttton-an">
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div role="tabpanel" class="tab-pane" id="projectEmployees">
                                                      <div class="inner-org">
                                                          <h2>Project Employees</h2>
                                                          <h4>Report Filters</h4>
                                                          <h4>Report Options</h4>
                                                            <div class="field-group-select">
                                                                <div class="field-vamue-an">
                                                                    <input type="submit" name="" value="Generate Report" class="submit-buttton-an">
                                                                </div>
                                                            </div>
                                                      </div>
                                                   </div> 
                                                   <div role="tabpanel" class="tab-pane" id="documents">
                                                      <div class="inner-org">
                                                          <h2>Documents</h2>
                                                          <h4>Report Filters</h4>
                                                          <div class="form-field-an">
                                                            <div class="field-group">
                                                               <div class="file-title-an">
                                                                  <label>Modules:</label>
                                                               </div>
                                                               <div class="field-value-an">
                                                                  <select></select>
                                                               </div>
                                                            </div>
                                                            <h4>Report Options</h4>
                                                            <div class="field-group-select">
                                                                <div class="field-vamue-an">
                                                                    <input type="submit" name="" value="Generate Report" class="submit-buttton-an">
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
                                 </div>
                                 <div role="tabpanel" class="tab-pane" id="profile">
                                    <div class="col-md-12">
                                       <div class="row" style="width: 100%">
                                          <div class="inner-wrapper-an">
                                             <div class="custon-field-header">
                                                <h2>Custom Fields </h2>
                                                <div class="right-button">
                                                   <div class="add-record-btn">
                                                      <a href="#">
                                                      <i class="fa fa-plus"></i>Add Custom Field
                                                      </a>
                                                   </div>
                                                   <div class="search-area-request">
                                                      <input type="text" placeholder="Search...">
                                                      <button>
                                                      <i class="fa fa-search"></i>
                                                      </button>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="inner-table-main" style="min-height:590px;">
                                                <table id="requesttab" border="0" cellspacing="0" cellpadding="3" width="100%" align="center">
                                                   <thead>
                                                      <tr>
                                                         <td>
                                                            <a style="color:#fff; " href="#">S#</a>
                                                         </td>
                                                         <td>
                                                            <a style="color:#fff; " href="#">Component name</a>
                                                         </td>
                                                         <td>
                                                            <a style="color:#fff; " href="#">Custom Field Category</a>
                                                         </td>
                                                         <td>
                                                            <a style="color:#fff; " href="#">Custom Field Name</a>
                                                         </td>
                                                         <td>
                                                            <a style="color:#fff; " href="#">Custom Field Type</a>
                                                         </td>
                                                         <td>
                                                            <a style="color:#fff; " href="#">Custom Field Order</a>
                                                         </td>
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
                                                      <a href="#">
                                                      <i class="fa fa-plus"></i>Add Notification
                                                      </a>
                                                   </div>
                                                   <div class="search-area-request">
                                                      <input type="text" placeholder="Search...">
                                                      <button>
                                                      <i class="fa fa-search"></i>
                                                      </button>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="inner-table-main" style="min-height:590px;">
                                                <table id="requesttab" border="0" cellspacing="0" cellpadding="3" width="100%" align="center">
                                                   <thead>
                                                      <tr>
                                                         <td>
                                                            <a style="color:#fff; " href="#">S#</a>
                                                         </td>
                                                         <td>
                                                            <a style="color:#fff; " href="#">Notification Type</a>
                                                         </td>
                                                         <td>
                                                            <a style="color:#fff; " href="#">Send To</a>
                                                         </td>
                                                         <td>
                                                            <a style="color:#fff; " href="#">Days to Send Notification</a>
                                                         </td>
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
                                                      <a href="#">
                                                      <i class="fa fa-plus"></i>Add Reminder
                                                      </a>
                                                   </div>
                                                   <div class="search-area-request">
                                                      <input type="text" placeholder="Search...">
                                                      <button>
                                                      <i class="fa fa-search"></i>
                                                      </button>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="inner-table-main" style="min-height:590px;">
                                                <table id="requesttab" border="0" cellspacing="0" cellpadding="3" width="100%" align="center">
                                                   <thead>
                                                      <tr>
                                                         <td>
                                                            <a style="color:#fff; " href="#">S#</a>
                                                         </td>
                                                         <td>
                                                            <a style="color:#fff; " href="#">Reminder Title</a>
                                                         </td>
                                                         <td>
                                                            <a style="color:#fff; " href="#">Reminder Date</a>
                                                         </td>
                                                         <td>
                                                            <a style="color:#fff; " href="#">Status</a>
                                                         </td>
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
                        <div class="inner-table-main" style="min-height:590px;"></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@include('template.admin_footer')
