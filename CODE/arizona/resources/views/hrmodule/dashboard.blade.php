@include('template.admin_header')


<div class="main-section">
	<div class="container">
        <div class="row">
			<div class="inner-main-section">
				<div class="col-md-12 col-sm-12">
					
					<div class="dashboard-bar-request">
						<div class="request-section">
							<div class="main-heading">
								<div class="inner-heading-request">
									<h2>My Dashboard</h2>
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
							<div class="main-dashboard-out">
								<div class="dash-board-bd">

	  <!-- Nav tabs -->
	  <ul class="nav nav-tabs" role="tablist">
	    <li role="presentation"><a href="#home" class="active" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
	    <li role="presentation"><a href="#hrdashboard" aria-controls="hrdashboard" role="tab" data-toggle="tab">HR Dashboard</a></li>
	    <li role="presentation"><a href="#hrdata" aria-controls="hrdata" role="tab" data-toggle="tab">HR Data</a></li>
	    <li role="presentation"><a href="#organogram" aria-controls="organogram" role="tab" data-toggle="tab">Organogram</a></li>
	  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
    	<div class="inner-home-db">
    		<div class="upper-profile-db">
    			<div class="col-md-12">
            <div class="row">
        				<div class="col-md-2 col-xs-12 nopadding">
        					<div class="user-profile-dp">
        						<img src="{{ url('admin/images/user.jpg') }}">
        					</div>
        				</div>
        				<div class="col-md-7 col-xs-12 nopadding">
        					<div class="inner-profilr-data">
        						<h2>System Administrator</h2>
        						<div class="user-role">
        								<span>Administrator</span>
        						</div>
        						<span><i class="fa fa-user-circle"></i>My Info</span>
        						<span><i class="fa fa-cog"></i>Account Settings</span>
        					</div>
        				</div>
              </div>
    			</div>
    		</div>
    		<div class="bottom-area-db">
    				<div class="col-md-12">
              <div class="row">
    						<div class="col-md-8 nopadding">
    								<div class="post-status">	
    										<div class="post-editor-db">
    											<h3>Post Status Updates </h3>
    											<textarea>	</textarea>
    											<div class="bottom-update">	
    													<ul>
    														<li><a href="#"><i class="fa fa-camera"></i></a></li>
    														<li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
    														<li><a href="#"><i class="fa fa-star-half-o"></i></a></li>
    														<li><a href="#"><i class="fa fa-smile-o"></i></a></li>
    													</ul>
    													<input type="submit" value="Post" class="an-theme-btn submit-post-db">
    											</div>	
    										</div>
                        <div class="an-published-posts">
                            <div class="an-single-published">
                                <div class="an-published-header">
                                    <div class="an-bio-name">
                                        <div class="an-published-img">
                                          <img src="{{ url('admin/images/user.jpg') }}">
                                        </div>
                                        <div class="an-published-name">
                                          <h3>System Administrator</h3>
                                          <p>Administrator, Administration</p>
                                        </div>
                                    </div>
                                    <div class="an-edit-info">
                                        <a href="#"><i class="fa fa-pencil"></i></a><a href="#"><i class="fa fa-times"></i></a><p>2 years, 4 months ago</p>
                                    </div>
                                </div>
                                <div class="an-published-content">
                                  <div class="an-published-text">
                                      <p>Status Update now supports images and videos</p>
                                  </div>
                                  <div class="an-published-image">
                                    <img src="{{ url('admin/images/demo_post.jpg') }}">
                                  </div>
                                </div>
                                <div class="an-published-footer">
                                    <div class="an-like-comment">
                                        <a href="#"><i class="fa fa-thumbs-up"></i> Like</a>
                                        <a href="#"><i class="fa fa-comments"></i> Comments</a>
                                    </div>
                                </div>
                            </div>
                            <div class="an-single-published">
                                <div class="an-published-header">
                                    <div class="an-bio-name">
                                        <div class="an-published-img">
                                          <img src="https://s3.amazonaws.com/a.webhr.co/ep/demo_WoDScW.jpg">
                                        </div>
                                        <div class="an-published-name">
                                          <h3>Elizabeth Brown</h3>
                                          <p>HR Manager, Human Resource</p>
                                        </div>
                                    </div>
                                    <div class="an-edit-info">
                                        <a href="#"><i class="fa fa-pencil"></i></a><a href="#"><i class="fa fa-times"></i></a><p>2 years, 4 months ago</p>
                                    </div>
                                </div>
                                <div class="an-published-content">
                                  <div class="an-published-text">
                                      <p style="float: left;">Just received "Expert" Badge from "System Administrator"</p><img width="70px" src="https://cdn.webhr.co/images/badges/WebHRBadge_Expert.png" align="right">

                                  </div>
                                  
                                </div>
                                <div class="an-published-footer">
                                    <div class="an-like-comment">
                                        <a href="#"><i class="fa fa-thumbs-up"></i> Like</a>
                                        <a href="#"><i class="fa fa-comments"></i> Comments</a>
                                    </div>
                                </div>
                            </div>
                        </div>
    								</div>	
    						</div>
    						<div class="col-md-4">	
                    <div class="sidebar-dashboard">
                      <div class="an-alert-box">
                          <div class="an-alert-header">
                            <h3>My Alerts</h3>
                            <div class="an-all-alert">
                              <a href="#" class="an-aproved" alt=""><i class="fa fa-check"></i>All Approvals</a>
                            </div>
                          </div>
                          <div class="an-alert-content">
                            <div class="an-single-list">
                              <a class="an-link-list" href="#"><i class="fa fa-envelope"></i>1 unread Inbox Message</a>
                            </div>
                            <div class="an-single-list">
                              <a class="an-link-list" href="#"><i class="fa fa-briefcase"></i>"WebHR Updates" assigned to "John Smith" is due on September 25, 2010</a>
                            </div>
                            <div class="an-single-list">
                              <a class="an-link-list" href="#"><i class="fa fa-birthday-cake"></i>No Birthdays Today</a>
                            </div>
                            <div class="an-single-list">
                              <a class="an-link-list" href="#">Waiting for your Approval</a>
                            </div>
                            <div class="an-single-list">
                              <a class="an-link-list" href="#"><i class="fa fa-bell"></i>Leaves <span class="an-badges-pull">1</span></a>
                            </div>
                          </div>
                      </div>
                       <div class="an-alert-box">
                        <div class="an-alert-header">
                          <h3>My Tasks</h3>
                          <div class="an-all-alert">
                            <a href="#" class="an-aproved" alt=""><i class="fa fa-plus-circle"></i>New Task</a>
                          </div>
                        </div>
                        <div class="an-alert-content">
                          <div class="an-single-list">
                            <img src="https://cdn.webhr.co/images/Animations/WebHRAnimation3.gif">
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
    <div role="tabpanel" class="tab-pane" id="hrdashboard">
        <div class="inner-home-db">
    		<div class="upper-profile-an">
    			<div class="col-md-12">
                    <div class="upper-header-theme">
                        <h3>Dashboard Filters</h3>
                    </div>
                    <div class="search-filter">
                        <div class="single-search-an">
                            
                        <select id="st" class="WebHRForm1" style="width:180px;" name="companies[]">
                            <option value="ALL"> All Companies</option>
                            @foreach($master['Companies'] as $val)
                            <option  value="{{$val['id']}}">{{$val['company_name']}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="single-search-an">
                           
                                 
                        <select id="st" class="WebHRForm1" style="width:180px;" name="stations[]">
                            <option value="ALL"> All Stations</option>
                            @foreach($master['Stations'] as $val)
                            <option  value="{{$val['id']}}">{{$val['station_name']}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="single-search-an">
                        <select id="st" class="WebHRForm1" style="width:180px;" name="departments[]">
                        <option value="ALL"> All Departments</option>
                            @foreach($master['Departments'] as $val)
                            <option  value="{{$val['id']}}">{{$val['department_name']}}</option>
                            @endforeach
                         </select>

                        </div>
                        <div class="single-search-an">
                            
                        <select id="st" class="WebHRForm1" style="width:180px;" name="departments[]">
                        <option value="ALL"> All Employees</option>
                        <option value="1">   Active Employees</option>
                        <option value="2">   Inactive Employees</option>
                         </select>

                        </div>
                        <div class="single-search-button-an">
                            <input type="submit" value="Apply Filters" class="submit-buttton-an">
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-profile-area">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="single-pai-db">
                                <h3>Male to Female Employees</h3>
                                <div class="pai-cart-an">
                                    
                                <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                                </div>
                                <div class="pai-table-data">
                                    <table border="0" width="100%">
		                                <tbody>
                                            <tr>    
                                                 <td  align="right" colspan="3">Employees</td>   
                                                 </tr>
                                                 <tr>
                                                 <td style="width:63%;">Male Employees </td>
                                                 <td>{{$result['EmployeeGender']['total_male']}} </td>
                                                 <td align="center"><a href="#"><i style="color:#b9b9b9;" class="fa fa-external-link"></i></a></td>

                                                 </tr>

                                                 <tr>
                                                 <td style="width:63%;">Female Employees </td>
                                                 <td>{{$result['EmployeeGender']['total_female']}} </td>
                                                 <td align="center"><a href="#"><i style="color:#b9b9b9;" class="fa fa-external-link"></i></a></td>

                                                 </tr>
                                                 
                                               
                                               
                                             </tr>
                                         </tbody>
                                     </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="single-pai-db">
                                <h3>Employees by Age Group</h3>
                                <div class="pai-cart-an">
                                    <img src="{{ url('admin/images/pai.png') }}">
                                </div>
                                <div class="pai-table-data">
                                    <table border="0" width="100%">
		                                <tbody>
                                            <tr>
                                                 <td>Age Group</td>
                                                 <td style="width:30%;" align="center">Employees</td>
                                                 <td style="width:16px;"></td>
                                                 </tr><tr>
                                                 <td class="WebHRTable_Body">31-40</td>
                                                 <td align="center">14</td>
                                                 <td align="center"><a href="#"><i style="color:#b9b9b9;" class="fa fa-external-link"></i></a></td>
                                                 </tr><tr><td>41-50</td>
                                                 <td align="center">3</td>
                                                 <td align="center"><a href="#"><i style="color:#b9b9b9;" class="fa fa-external-link"></i></a></td>
                                                 </tr><tr><td>51-60</td>
                                                 <td align="center">1</td>
                                                 <td align="center"><a href="#"><i style="color:#b9b9b9;" class="fa fa-external-link"></i></a></td>
                                             </tr>
                                         </tbody>
                                     </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="single-pai-db">
                                <h3>Employees By Types</h3>
                                <div class="pai-cart-an">
                                    <img src="{{ url('admin/images/pai.png') }}">
                                </div>
                                <div class="pai-table-data">
                                    <table border="0" width="100%">
		                                <tbody>
                                            <tr>
                                                 <td>Employee Type</td>
                                                 <td style="width:30%;" align="center">Employees</td>
                                                 <td style="width:16px;"></td>
                                                 </tr>
                                                @foreach($result['EmployeeType'] as $val) 
                                                 <tr>
                                                 <td>{{$val['employee_type']}}</td>
                                                 <td align="center">{{$val['total']}}</td>
                                                 <td align="center"><a href="#"><i style="color:#b9b9b9;" class="fa fa-external-link"></i></a></td>
                                                 </tr>
                                                @endforeach
                                         </tbody>
                                     </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="single-pai-db">
                                <h3>Employees by Categories</h3>
                                <div class="pai-cart-an">
                                    <img src="{{ url('admin/images/pai.png') }}">
                                </div>
                                <div class="pai-table-data">
                                    <table border="0" width="100%">
		                                
                                    <tbody>
                                            <tr>
                                                 <td>Category</td>
                                                 <td style="width:30%;" align="center">Employees</td>
                                                 <td style="width:16px;"></td>
                                                 </tr>
                                                @foreach($result['EmployessByCategory'] as $val) 
                                                 <tr>
                                                 <td>{{$val['employee_type']}}</td>
                                                 <td align="center">{{$val['total']}}</td>
                                                 <td align="center"><a href="#"><i style="color:#b9b9b9;" class="fa fa-external-link"></i></a></td>
                                                 </tr>
                                                @endforeach
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
    <div role="tabpanel" class="tab-pane" id="hrdata">
        <div class="inner-home-db">
    		<div class="upper-profile-an">
    			<div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="hr-data-an">
                                <div class="upper-header-theme">
                                    <h3>Dashboard Filters</h3>
                                </div>
                                <div class="search-filter">
                                    <div class="single-search-an">
                                        <input type="text" placeholder="search">
                                    </div>
                                    <div class="single-search-an">
                                        <input type="text" placeholder="search">
                                    </div>
                                    <div class="single-search-an">
                                        <input type="text" placeholder="search">
                                    </div>
                                    <div class="single-search-an">
                                        <input type="text" placeholder="search">
                                    </div>
                                    <div class="single-search-button-an">
                                        <input type="submit" value="Apply Filters" class="submit-buttton-an">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                 <div class="col-md-4">
                                    <div class="single-pai-db">
                                        <div class="pai-cart-an">
                                            <img src="{{ url('admin/images/pai.png') }}">
                                        </div>
                                        <h3>Employees by Designation</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="single-pai-db">
                                        <div class="pai-cart-an">
                                            <img src="{{ url('admin/images/pai.png') }}">
                                        </div>
                                        <h3>Employees by Designation</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="single-pai-db">
                                        <div class="pai-cart-an">
                                            <img src="{{ url('admin/images/pai.png') }}">
                                        </div>
                                        <h3>Employees by Designation</h3>
                                    </div>
                                </div>
                                <div class="table-data-hr">
                                     <div class="pai-table-data">
                                    <table border="0" width="100%">
                                        <thead>
		                                 <tr>
		                                  <td style="width:1%;" align="center">S#</td>
		                                  <td>Employee</td>
		                                  <td>User Name</td>
		                                  <td>Access Code</td>
		                                  <td>Designation</td>
		                                  <td>Department</td>
		                                  <td>Station</td>
		                                  <td>Company</td>
		                                  <td style="width:1%;"></td>
		                                 </tr>
		                                 </thead>
		                                <tbody>
                                            <tr>
                                                 <td>1</td>
                                                 <td>Allen Parker</td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                            </tr>
                                            <tr>
                                                 <td>2</td>
                                                 <td>Allen Parker</td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                            </tr>
                                            <tr>
                                                 <td>3</td>
                                                 <td>Allen Parker</td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                            </tr>
                                            <tr>
                                                 <td>4</td>
                                                 <td>Allen Parker</td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                            </tr>
                                            <tr>
                                                 <td>5</td>
                                                 <td>Allen Parker</td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                            </tr>
                                            <tr>
                                                 <td>6</td>
                                                 <td>Allen Parker</td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                            </tr>
                                            <tr>
                                                 <td>7</td>
                                                 <td>Allen Parker</td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                            </tr>
                                            <tr>
                                                 <td>8</td>
                                                 <td>Allen Parker</td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
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
    <div role="tabpanel" class="tab-pane" id="organogram">Coming Soon</div>
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



 

