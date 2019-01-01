@include('template.admin_header')
<div class="main-section">
	<div class="container">
        <div class="row">
			<div class="inner-main-section">
				<div class="col-md-12 col-sm-12">
					<div class="left-bar-request nopadding">
						<div class="sidebar-menu">
                        @include('template.payroll_nav_icon')
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
										<!-- <li>
											<a href="#" alt="Dashboard"><i class="fa fa-cog"></i></a>
										</li>
										<li>
											<a href="#" alt="Dashboard"><i class="fa fa-question-circle"></i></a>
										</li> -->
									</ul>
								</div>
							</div>
							<div class="request-inner-table">
								<div class="upper-header-request">
									<div class="col-md-12 nopadding">
										<div class="back-button">
											<div class="add-record-btn">
												<a href="{{ url('reimbursements') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Reimbursement Information</h4>
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
                                        
                                        <form method="post" action="{{ url('reimbursements/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">
												
												 <div class="form-group">
													<label>Employee Name:</label>
													<select  name ="employee_id" id="employee_id" class="form-control-select" >
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}">{{$val['employee_name']}}</option>
													@endforeach													
											        </select>
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>
												 <div class="form-group">
													<label>Forward Application To:</label>
													<select  name ="forward_employee_id" id="forward_employee_id" class="form-control-select" >
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}">{{$val['employee_name']}}</option>
													@endforeach													
											        </select>
													<!-- <i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i> -->

												 </div>
												 <div class="form-group">
													<label>Title:</label>
													<input type="text" placeholder="reimbursements title" class="form-control-spacial" id="reimbursements_title" name="reimbursements_title" value="{{isset($result->reimbursements_title)?$result->reimbursements_title:''}}">
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>
												 <!-- <div class="form-group">
													<label>Amount:</label>
													<input type="text" placeholder="Reimbursements Amount" class="form-control-spacial" id="reimbursements_amount" name="reimbursements_amount" value="{{isset($result->reimbursements_amount)?$result->reimbursements_amount:''}}">
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div> -->
												 <div class="form-group">
													<label>Date:</label>
													<input type="text" placeholder="" class="form-control-spacial date" id="reimbursements_date" name="reimbursements_date" value="{{isset($result->reimbursements_date)?$result->reimbursements_date:''}}">
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>
												</div>

												<div class="form-group">
													<label>Include in Payslip:</label>
													<input class="switch" id="iip" checked="true" type="checkbox">
												</div>
												<div class="form-group">
													<h4>Reimbursement Items</h4>
													<div class="inner-table-main" style="min-height:590px;">
								                   <div class="inner-table-main" style="min-height:590px;">
									              <table id="requesttab" border="0" cellspacing="0" cellpadding="3" width="100%" align="center">
									             		<thead>
									               			<tr>
										  						<td style="background-color:#0c64ae; " class="thbackgroud"><a style="color:#fff; " href="#">S#</a></td>
										  						<td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">Date</a></td>
										  						<td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">Category</a></td>
										  						<td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">Item</a></td>
										  						<td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">Receipt #</a></td>
										  						<td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">Country</a></td>
										  						<td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">Amount (Local Currency)</a></td>
										  						<td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">Tax</a></td>
										  						<td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">Amount</a></td>
														  		<td style="background-color:#0c64ae; width:1%;"></td>
									  						</tr>
														</thead>
													</table>
													</div>
												</div>
												 <div class="form-group">
													<h4>Reimbursement Description</h4>
												 </div>

                                                 <div class="form-group">
												 <label>Notes:</label>
													<textarea class="tinyeditorclass" name="reimbursement_description" id="reimbursement_description">{{isset($result->reimbursement_description)?$result->reimbursement_description:''}}</textarea>
												</div> 
												<div class="form-group">
													<h4>Reimbursement Document (Optional)</h4>
												 </div>
												 <div class="back-button">
													<div class="add-record-btn">
													<a href="#">Add Attachment</a>
													</div>
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
