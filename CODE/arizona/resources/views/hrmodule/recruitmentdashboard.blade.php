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
									<h2>Recruitment Dashboard</h2>
								</div>
                         </div>
                            <div class="request-inner-table">
								<div class="upper-header-request">
									<div class="col-md-12 nopadding">
										<div class="search-field-outer">
                                            <input class="search-field" type="text" placeholder="Candidates Search...">
                                            <a href="#"><i class="fa fa-search"></i></a>
                                            <a href="#"><i class="fa fa-filter"></i></a>
                                        </div>
							        </div>
						</div>
                        <div class="bottom-search-request">
                               <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="search-left-area">
                                                <h2>Candidates Demographics</h2>
                                                <div class="persentage-inner">
                                                    <div class="persentage-left">
                                                        <span>86%</span>
                                                            <br><p>Male Candidates</p>
                                                        </div>
                                                        <div class="persentage-center">
                                                        <div class="pai-cart-an">
                                                            <img src="{{ url('admin/images/pai.png') }}">
                                                        </div>
                                                        </div>
                                                        <div class="persentage-right">
                                                        <span>14%</span>
                                                            <br><p>Female Candidates</p>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                             <div class="search-right-area">
                                                <h2>Recruitment Timeline</h2>
                                            </div>
                                            <div class="search-timeline-outline">
                                                <div class="search-timeline-single">
                                                    <div class="left-text-name">
                                                        <span>JS</span>
                                                    </div>
                                                    <div class="middle-name">
                                                        <h3>John Smith</h3>
                                                        <p>Applied for HR Manager Position</p>
                                                    </div>
                                                    <div class="timeline-date">
                                                        <span>December 31, 1969</span>
                                                    </div>
                                                </div>
                                                 <div class="search-timeline-single">
                                                    <div class="left-text-name">
                                                        <span>JS</span>
                                                    </div>
                                                    <div class="middle-name">
                                                        <h3>John Smith</h3>
                                                        <p>Applied for HR Manager Position</p>
                                                    </div>
                                                    <div class="timeline-date">
                                                        <span>December 31, 1969</span>
                                                    </div>
                                                </div>
                                                 <div class="search-timeline-single">
                                                    <div class="left-text-name">
                                                        <span>JS</span>
                                                    </div>
                                                    <div class="middle-name">
                                                        <h3>John Smith</h3>
                                                        <p>Applied for HR Manager Position</p>
                                                    </div>
                                                    <div class="timeline-date">
                                                        <span>December 31, 1969</span>
                                                    </div>
                                                </div>
                                                 <div class="search-timeline-single">
                                                    <div class="left-text-name">
                                                        <span>JS</span>
                                                    </div>
                                                    <div class="middle-name">
                                                        <h3>John Smith</h3>
                                                        <p>Applied for HR Manager Position</p>
                                                    </div>
                                                    <div class="timeline-date">
                                                        <span>December 31, 1969</span>
                                                    </div>
                                                </div>
                                                 <div class="search-timeline-single">
                                                    <div class="left-text-name">
                                                        <span>JS</span>
                                                    </div>
                                                    <div class="middle-name">
                                                        <h3>John Smith</h3>
                                                        <p>Applied for HR Manager Position</p>
                                                    </div>
                                                    <div class="timeline-date">
                                                        <span>December 31, 1969</span>
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
	</div>
</div>


@include('template.admin_footer')
