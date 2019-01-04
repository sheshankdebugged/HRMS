@include('template.admin_header')
<div class="main-section">
<div class="container">
   <div class="row">
      <div class="inner-main-section">
         <div class="col-md-12 col-sm-12">
            <div class="left-bar-request nopadding">
               <div class="sidebar-menu">
                  @include('template.employees_nav_icon')
               </div>
            </div>
            <div class="right-bar-request">
               <div class="request-section">
                  <div class="main-heading">
                     <div class="inner-heading-request">
                        <h2>{{ $pageTitle }}</h2>
                     </div>
                     <div class="settings-buttons">
                        <ul>
                           <li>
                              <a href="{{ url('onboardingsettings') }}" alt="Dashboard"><i class="fa fa-cog"></i></a>
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
                        <div class="text-center">
                           <h3>{{ $title }}</h3>
                        </div>
                     </div>
                     <div class="inner-table-main" style="min-height:590px;">
                        <div class="inner-table-main" style="min-height:590px;">
                           <table id="requesttab" border="0" cellspacing="0" cellpadding="3" width="100%" align="center">
                              <thead>
                              </thead>
                              <tbody>
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