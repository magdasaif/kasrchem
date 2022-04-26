<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <router-link to="/dashboard" class="brand-link">
      <img src="{{ asset('/images/logo.jpg') }}" alt="The Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <center><span class="brand-text font-weight-light">Eradco</span> </center>
    </router-link> -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
               
              <img src="{{App\Models\SiteInfo::find('1')->getFirstMediaUrl('site_logo','nav')}}">
            
                <!-- <img src="{{ auth()->user()->photo }}" class="img-circle elevation-2" alt="User Image"> -->
              </div>

              <div class="info">

                  <!-- {{ Auth::user()->name }} -->
                  <span class="brand-text font-weight-light" style="color: #009879;font-size: 21px;font-weight: bold;">Kasrchem</span>
                  <center><span class="d-block " style="color:white;">
                    {{ Ucfirst(Auth::user()->type) }}
                  </span></center>
              </div>
             
             <!----------------------------------------->
           
                <!-- <a href="{{route('show_password')}}" title="تغيير كلمة السر"><i class="fa fa-key green" style="margin: 13px;"></i></a> -->
           
<!----------------------------------------->
<div class="dropdown">
<i class="arrow down" style="margin: 13px;" ></i>

  <div class="dropdown-content">
  <a href="{{route('show_password')}}" title="تغيير كلمة السر"><i class="fa fa-key green" style="margin: 13px;"></i>  </a>
  </div>
</div>
<!----------------------------------------->

<!----------------------------------------->
</div>
        </router-link>

      <!-- Sidebar Menu -->
      @include('layouts.sidebar-menu')
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
