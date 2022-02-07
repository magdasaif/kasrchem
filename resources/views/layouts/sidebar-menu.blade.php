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

      <li class="nav-item">
        <a href="{{route('about_us.edit',1)}}" class="nav-link">
          <i class="nav-icon fas fa-info green"></i>
          <p>من نحن</p>
        </a>
      </li>
      
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa fa-sitemap green"></i>
          <p>اقسام الموقع<i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
          <li>
              <a href="{{route('site_section.create')}}" class="nav-link">
                  <i class="nav-icon fas fa-plus orange"></i>
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
                  <i class="nav-icon fas fa-plus orange"></i>
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
                  <i class="nav-icon fas fa-plus orange"></i>
                  <p> اضافه منتج </p>
              </a>
          </li>
          <li>
              <a href="{{route('products.index')}}" class="nav-link">
                  <i class="nav-icon fas fab fa-product-hunt orange"></i>
                  <p>قائمه المنتجات </p>
              </a>
          </li>
         </ul>
      </li>




      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa-video green"></i>
          <p> الفيديوهات<i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
          <li>
              <a href="{{route('video.create')}}" class="nav-link">
                  <i class="nav-icon fas fa-plus orange"></i>
                  <p> اضافه فيديو </p>
              </a>
          </li>
          <li>
              <a href="{{route('video.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-video orange"></i>
                  <p>قائمه الفيديوهات </p>
              </a>
          </li>

         </ul>
      </li>


      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa-handshake green"></i>
          <p> الشركاء<i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
          <li>
              <a href="{{route('partner.create')}}" class="nav-link">
                  <i class="nav-icon fas fa-plus orange"></i>
                  <p> اضافه شريك </p>
              </a>
          </li>
          <li>
              <a href="{{route('partner.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-handshake orange"></i>
                  <p>قائمه الشركاء </p>
              </a>
          </li>

         </ul>
      </li>



      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa-file-pdf green"></i>
          <p> النشرات<i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
          <li>
              <a href="{{route('release.create')}}" class="nav-link">
                  <i class="nav-icon fas fa-plus orange"></i>
                  <p> اضافه نشره </p>
              </a>
          </li>
          <li>
              <a href="{{route('release.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-file-pdf orange"></i>
                  <p>قائمه النشرات </p>
              </a>
          </li>

         </ul>
      </li>


      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa-building green"></i>
          <p> عناوين الفروع<i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
          <li>
              <a href="{{route('branches.create')}}" class="nav-link">
                  <i class="nav-icon fas fa-plus orange"></i>
                  <p> اضافه فرع </p>
              </a>
          </li>
          <li>
              <a href="{{route('branches.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-building orange"></i>
                  <p>قائمه الفروع </p>
              </a>
          </li>

         </ul>
      </li>

      
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa-link green"></i>
          <p> وسائل التواصل<i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
          <li>
              <a href="{{route('social.create')}}" class="nav-link">
                  <i class="nav-icon fas fa-plus orange"></i>
                  <p> اضافه رابط </p>
              </a>
          </li>
          <li>
              <a href="{{route('social.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-link orange"></i>
                  <p>قائمه الروابط </p>
              </a>
          </li>

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