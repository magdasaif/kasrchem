<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <router-link to="/dashboard" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt green"></i>
          <p>
            الرئيسيه
          </p>
        </router-link>
      </li>

      @can('isAdmin')
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa fa-sitemap green"></i>
          <p>اقسام الموقع<i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
          <li>
              <a href="{{route('site_section.create')}}" class="nav-link">
                  <i class="nav-icon fas fa-sitemap orange"></i>
                  <p> اضافه قسم </p>
              </a>
          </li>
          <li>
              <a href="{{route('site_section.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-sitemap orange"></i>
                  <p>قائمه الاقسام </p>
              </a>
          </li>
         </ul>
      </li>


      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa fa-cubes green"></i>
          <p>
             التصنيفات الرئيسيه
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li>
              <a href="{{route('categories.create')}}" class="nav-link">
                  <i class="nav-icon fas fa-cubes orange"></i>
                  <p> اضافه تصنيف</p>
              </a>
          </li>
          <li>
              <a href="{{route('categories.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-cubes orange"></i>
                  <p> قائمه التصنيفات</p>
              </a>
          </li>
        </ul>
      </li>

      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fab fa-product-hunt green"></i>
          <p> المنتجات<i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
          <li>
              <a href="{{route('products.create')}}" class="nav-link">
                  <i class="nav-icon fas fab fa-product-hunt orange"></i>
                  <p> اضافه منتج </p>
              </a>
          </li>
          <li>
              <a href="{{route('products.index')}}" class="nav-link">
                  <i class="nav-icon fas fab fa-product-hunt orange"></i>
                  <p>قائمه المنتجات </p>
              </a>
          </li>
          <!-- <li>
              <a href="{{url('add_product')}}">
                <i class="nav-icon fas fab fa-product-hunt orange"></i>
                <p>اضافه منتج-livewire</p>
              </a>
          </li> -->

         </ul>
      </li>

      @endcan
      
      

      <li class="nav-item">
        <a href="#" class="nav-link" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <i class="nav-icon fas fa-power-off red"></i>
          <p>تسجيل خروج</p>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>

    </ul>
  </nav>