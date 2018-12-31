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
												<a href="{{ url('polls') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Poll Information</h4>
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
                                        
                                        <form method="post" action="{{ url('polls/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">
												
												 <div class="form-group">
													<label>Poll Start Date:</label>
													<input type="text" placeholder="" class="form-control-spacial date" id="poll_start_date" name="poll_start_date" value="{{isset($result->poll_start_date)?$result->poll_start_date:''}}">

												 </div>

												 <div class="form-group">
													<label>Poll End Date:</label>
													<input type="text" placeholder="" class="form-control-spacial date" id="poll_end_date" name="poll_end_date" value="{{isset($result->poll_end_date)?$result->poll_end_date:''}}">

												 </div>

												 <div class="form-group">
													<h4>Question</h4>
												 </div>


												  <div class="form-group">
												   <label>Poll Question:</label>
													
													<input type="text" placeholder="Question" class="form-control-spacial" id="poll_question" name="poll_question" value="{{isset($result->poll_question)?$result->poll_question:''}}">
                                                    <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
												 </div>

												 

												 <div class="form-group">
													<h4>Answers</h4>
												 </div>


												 <div class="form-group">
												   <label>Poll Answer #1:</label>
													<input type="text" placeholder="Poll Answer #1" class="form-control-spacial" id="poll_answer_1" name="poll_answer_1" value="{{isset($result->poll_answer_1)?$result->poll_answer_1:''}}">
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
												 </div>

												 
												 <div class="form-group">
												   <label>Poll Answer #2:</label>
												   <input type="text" placeholder="Poll Answer #2" class="form-control-spacial" id="poll_answer_2" name="poll_answer_2" value="{{isset($result->poll_answer_2)?$result->poll_answer_2:''}}">
												   <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
                
												 </div>
												 <div class="form-group">
												   <label>Poll Answer #3:</label>
												   <input type="text" placeholder="Poll Answer #3" class="form-control-spacial" id="poll_answer_3" name="poll_answer_3" value="{{isset($result->poll_answer_3)?$result->poll_answer_3:''}}">
												   
                
												 </div>
												 <div class="form-group">
												   <label>Poll Answer #4:</label>
												   <input type="text" placeholder="Poll Answer #4" class="form-control-spacial" id="poll_answer_4" name="poll_answer_4" value="{{isset($result->poll_answer_4)?$result->poll_answer_4:''}}">
												   
                
												 </div>
												 <div class="form-group">
												   <label>Poll Answer #5:</label>
												   <input type="text" placeholder="Poll Answer #5" class="form-control-spacial" id="poll_answer_5" name="poll_answer_5" value="{{isset($result->poll_answer_5)?$result->poll_answer_5:''}}">
												   
                
												 </div>
												 </div>
												 <div class="form-group">
												   <label>Poll Answer #6:</label>
												   <input type="text" placeholder="Poll Answer #6" class="form-control-spacial" id="poll_answer_6" name="poll_answer_6" value="{{isset($result->poll_answer_6)?$result->poll_answer_6:''}}">
												 </div>


												
												<div class="form-group">
													<h4>Additional Information</h4>
												 </div>
												 <div class="form-group">
												 <label>Notes:</label>
													<textarea  name="additonal_information" id="additonal_information">{{isset($result->additonal_information)?$result->additonal_information:''}}</textarea>
												</div> 


												<div class="form-group">
												 <label>Record Added By:</label>
												 System Administrator
												</div> 

												
												<div class="form-group">
												 <label>Record Added On:</label>

												 @php 
												 $date  = date("F j, Y, g:i a"); 

												 @endphp
												 {{$date}}
												</div> 

												


												 
											
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
