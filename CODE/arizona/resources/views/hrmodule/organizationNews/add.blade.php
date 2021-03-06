@include('template.admin_header')

<div class="main-section">
	<div class="container">
		<div class="row">
			<div class="inner-main-section">
				<div class="col-md-12 col-sm-12">
					<div class="left-bar-request nopadding">
						<div class="sidebar-menu">@include('template.organisation_nav_icon')</div>
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
							<div class="request-inner-table">
								<div class="upper-header-request">
									<div class="col-md-12 nopadding">
										<div class="back-button">
											<div class="add-record-btn">
												<a href="{{ url('organizationnews') }}">
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
										<h4>News Title</h4>
									</div>
									<div class="form-subsets">@if ($errors->any())

										<div class="alert alert-danger">
											<ul>@foreach ($errors->all() as $error)

												<li>{{ $error }}</li>@endforeach
											</ul>
										</div>@endif

										<form method="post" action="{{ url('organizationnews/save') }}">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">
													<div class="form-field-inner">
														<div class="form-group">
															<input type="text" class="form-control-spacial" id="news_title" name="news_title" value="{{isset($result->news_title)?$result->news_title:''}}">
																<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" ></i>
															</div>
															<div class="form-group">
																<h4>News Details</h4>
															</div>
															<div class="form-group">
																<textarea class="notes" name="news_details" id="news_details" id="notes">{{isset($result->news_details)?$result->news_details:''}}</textarea>
															</div>
															<div class="form-group">
																<h4>News Image</h4>
																<input class="submit-office" type="file" name="news_images">
																</div>
																<div class="form-group">
																	<input class="submit-office" type="submit" value="{{$Addform}}">
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
					</div>@include('template.admin_footer')
