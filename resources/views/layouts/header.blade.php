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
                <!-- <img src="{{ auth()->user()->photo }}" class="img-circle elevation-2" alt="User Image"> -->
                <img src="{{ asset('/images/logo.jpg') }}" alt="The Logo" class="img-circle elevation-2" >
              </div>

              <div class="info">

                  <!-- {{ Auth::user()->name }} -->
                  <span class="brand-text font-weight-light" style="color: #009879;font-size: 21px;font-weight: bold;">EradUnited</span>
                  <span class="d-block text-muted">
                    {{ Ucfirst(Auth::user()->type) }}
                  </span>
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
<!-- <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropdown
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
    <button class="dropdown-item" type="button">Action</button>
    <button class="dropdown-item" type="button">Another action</button>
    <button class="dropdown-item" type="button">Something else here</button>
  </div>
</div> -->
<!----------------------------------------->
</div>
        </router-link>

      <!-- Sidebar Menu -->
      @include('layouts.sidebar-menu')
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
