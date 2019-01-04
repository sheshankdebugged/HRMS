@include('template.admin_header')


<div class="main-section">
	<div class="container">
        <div class="row">
			<div class="inner-main-section">
				<div class="col-md-12 col-sm-12">
					<div class="left-bar-request nopadding">
						<div class="sidebar-menu">
							<ul>
								<li>
									<a href="#" alt="Dashboard"><i class="fa fa-angle-right"></i></a>
								</li>
								<li>
									<a href="#" alt="Dashboard"><i class="fa fa-tachometer"></i></a>
								</li>
								<li>
									<a href="#" alt="Dashboard"><i class="fa fa-envelope-open"></i></a>
								</li>
								<li>
									<a href="#" alt="Dashboard"><i class="fa fa-envelope-o"></i></a>
								</li>
								<li>
									<a href="#" alt="Dashboard"><i class="fa fa-user"></i></a>
								</li>
								<li>
									<a href="#" alt="Dashboard"><i class="fa fa-clipboard"></i></a>
								</li>
								<li>
									<a href="#" alt="Dashboard"><i class="fa fa-comments"></i></a>
								</li>
							</ul>
						</div>
					</div>
					<div class="right-bar-request">
						<div class="request-section">
							<div class="main-heading">
								<div class="inner-heading-request">
									<h2>Job Requests</h2>
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
							<div class="request-inner-table">
								<div class="upper-header-request">
									<div class="col-md-12 nopadding">
										<div class="col-md-4 nopadding">
											<h3>Job Requests</h3>
										</div>
										<div class="col-md-8 nopadding">
											<div class="search-area-request">
												<input type="text" placeholder="Quick Search...">
												<button><i class="fa fa-search"></i></button>
											</div>
											<div class="filter-btn-request">
												<a href="#" alt="Dashboard"><i class="fa fa-filter"></i></a>
												<a href="#" alt="Dashboard"><i class="fa fa-refresh"></i></a>
											</div>
											<div class="add-record-btn">
												<a href="#"><i class="fa fa-plus"></i>Add Record</a>
											</div>
											
										</div>
										
									</div>
								</div>
								<div class="inner-table-main" style="min-height:590px;">
									<table id="requesttab" border="0" cellspacing="0" cellpadding="3" width="100%" align="center">
									 <thead>
									  <tr>
										  <td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">Job Title</a></td>
										  <td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">Job Type</a></td>
										  <td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">No. of Positions</a></td>
										  <td style="background-color:#0c64ae; " class="hidden-xs datainner"><a style="color:#fff;" href="#">Reference Number</a></td>
										  <td style="background-color:#0c64ae; " class="hidden-xs datainner"><a style="color:#fff;" href="#" >Approval Status</a></td>
									  <td style="background-color:#0c64ae; width:1%;"></td>
									  </tr>
									</thead>
										<tbody>
											<tr id="second" class="context-requst-one selected">
											<td class="datainner" style="">Software Engineer</td>
											<td class="datainner" style="">Contract</td>
											<td class="datainner" style="">1</td>
											<td class="datainner" style=""></td>
											<td class="datainner" style="">Requested</td>
											<td align="right"><a href="#"><i style="font-size:16px;" class="fa fa-bars"></i></a></td>
										</tr>
										<tr id="1" class="context-requst-one">
											<td class="datainner" style="">HR Manager</td>
											<td class="datainner" style="">Contract</td>
											<td class="datainner" style="">1</td><td class="rtla1" style=""></td>
											<td class="datainner" style="">Requested</td>
											<td align="right"><a href="#" id="bars-new"><i style="font-size:16px;" class="fa fa-bars"></i></a></td>
										</tr>
										<tr id="1" class="context-requst-one">
											<td class="datainner" style="">HR Manager</td>
											<td class="datainner" style="">Contract</td>
											<td class="datainner" style="">1</td><td class="rtla1" style=""></td>
											<td class="datainner" style="">Requested</td>
											<td align="right"><a href="#" id="bars-new"><i style="font-size:16px;" class="fa fa-bars"></i></a></td>
										</tr>
										<tr id="1" class="context-requst-one">
											<td class="datainner" style="">HR Manager</td>
											<td class="datainner" style="">Contract</td>
											<td class="datainner" style="">1</td><td class="rtla1" style=""></td>
											<td class="datainner" style="">Requested</td>
											<td align="right"><a href="#" id="bars-new"><i style="font-size:16px;" class="fa fa-bars"></i></a></td>
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


@include('template.admin_footer')
