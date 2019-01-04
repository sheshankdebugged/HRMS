@include('template.admin_header')
<div class="main-section">
	<div class="container">
        <div class="row">
			<div class="inner-main-section">
				<div class="col-md-12 col-sm-12">
					<div class="left-bar-request nopadding">
						<div class="sidebar-menu">
                        @include('template.recruitment_nav_icon')
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
												<a href="{{ url('jobposts') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
                                    @if(Session::get('message'))
                            <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Success! {{Session::get('message')}}
                            </div>
                            @endif
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

                                        <form method="post" action="{{ url('jobpostsettings/save') }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

                                            <div class="form-field-inner">
                                                <div class="form-upper-main">
                                                    <h4>Reference Number</h4>
                                                </div>
                                                <div class="form-group">
                                                    <label>Reference Number:</label>
                                                    <select id="st" class="WebHRForm1 chosen-select" style="width:180px;" name="referance_no_id">
													@foreach($master['ReferanceNumber'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->referance_no_id) && $result->referance_no_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
													@endforeach
													</select>
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
                                                {{--Additional Information End--}}

                                                <div class="form-group">
                                                    <input class="submit-office" type="submit" value="Save Settings">
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
