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
                  <h2></h2>
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
                      <h3></h3>
                    </div>
                              <div class="col-md-8 nopadding">
                      <div class="search-area-request">
                        <input type="text" placeholder="Search...">
                        <button><i class="fa fa-search"></i></button>
                      </div>
                      <div class="filter-btn-request">
                        <a href="#" alt="Dashboard"><i class="fa fa-filter"></i></a>
                        <a href="#" alt="Dashboard"><i class="fa fa-refresh"></i></a>
                      </div>
                      <div class="add-record-btn">
                        <a href="{{ url('jobposts/add') }}"><i class="fa fa-plus"></i>Add Record</a>
                      </div>

                    </div>

                  </div>
                </div>
                <div class="inner-table-main" style="min-height:590px;">
                <div class="inner-table-main" style="min-height:590px;">
                
                   
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
