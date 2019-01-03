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
                        <h2>{{ $pageTitle }}</h2>
                     </div>
                     @if ($errors->any())
                     <div class="alert alert-danger">
                        <ul>
                           @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                           @endforeach
                        </ul>
                     </div>
                     @endif
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
                        <div class="col-md-4 nopadding">
                           <h3>{{ $pageTitle }}</h3>
                        </div>
                        <div class="col-md-8 nopadding">
                           <div class="filter-btn-request">
                              <a href="managecontracttypes" alt="Dashboard"><i class="fa fa-refresh"></i></a>
                           </div>
                           <div class="add-record-btn">
                                    <a href="{{ url('setting') }}"><i class="fa fa-angle-left"></i>Back</a>
                           </div>
                           <div class="add-record-btn" >
                              <a href="#" id="addrecord" > <i class="fa fa-plus"></i>Add Record </a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-subsets">
                     <div id="addskills" class="text-center" style="display:none;">
                        <form method="post" action="{{ url('managecontracttypes/save') }}">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">
                           <div class="form-field-inner">
                              <div class="form-group">
                                 <input type="text" class="form-control-spacial" placeholder="New Record Value" id="contract_type" name="contract_type" value="{{isset($result->contract_type)?$result->contract_type:''}}">
                              </div>
                              <div class="form-group">
                                 <input class="submit-office" type="submit" value="Add Record">
                              </div>
                           </div>
                        </form>
                     </div>
                     <div class="inner-table-main" style="min-height:590px;">
                        <div class="inner-table-main" style="min-height:590px;">
                           <table id="requesttab" border="0" cellspacing="0" cellpadding="3" width="100%" align="center">
                              <thead>
                                 <tr>
                                    <td style="background-color:#0c64ae; " class="thbackgroud"><a style="color:#fff; " href="#">S#</a></td>
                                    <td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#">Value</a></td>
                                    <td style="background-color:#0c64ae; " class=""><a style="color:#fff; " href="#"></a></td>
                                    <td style="background-color:#0c64ae; width:1%;"></td>
                                 </tr>
                              </thead>
                              <tbody>
                                 @php $i=1; @endphp
                                 @foreach($listData as $list)
                                 <tr id="second" class="context-requst-one selected">
                                    <td class="datainner" style="">{{$i}} </td>
                                    <td class="datainner" style="">{{$list->contract_type}}</td>
                                    <td class="datainner" style=""> </td>
                                    <td align="right">
                                       <a href="{{url('/managecontracttypes/delete/')}}/{{$list->id}}" onclick="return confirm('Are you sure to want delete this?')"><i class="fa fa-times"></i></a>
                                    </td>
                                 </tr>
                                 @php $i++; @endphp
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
</div>
@include('template.admin_footer')
<script>
   $(document).ready(function(){
    
    var id =0;
     $("#addrecord").click(function(){
   	if(id == 0){
   		id++;
   		$("#addskills").show();
   	}else{
   		id=0;
   		$("#addskills").hide();
   	}  
     });

   });

</script>