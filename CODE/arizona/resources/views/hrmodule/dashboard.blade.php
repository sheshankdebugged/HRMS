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
							<div class="main-dashboard-out">
								<div class="dash-board-bd">

	  <!-- Nav tabs -->
	  <ul class="nav nav-tabs" role="tablist">
	    <li role="presentation"><a href="#home" class="active" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
	    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">HR Dashboard</a></li>
	    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">HR Data</a></li>
	    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Organogram</a></li>
	  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
    	<div class="inner-home-db">
    		<div class="upper-profile-db">
    			<div class="col-md-12">
            <div class="row">
        				<div class="col-md-2 nopadding">
        					<div class="user-profile-dp">
        						<img src="{{ url('admin/images/user.jpg') }}">
        					</div>
        				</div>
        				<div class="col-md-7 nopadding">
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
    <div role="tabpanel" class="tab-pane" id="profile">Coming Soon</div>
    <div role="tabpanel" class="tab-pane" id="messages">Coming Soon</div>
    <div role="tabpanel" class="tab-pane" id="settings">Coming Soon</div>
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
