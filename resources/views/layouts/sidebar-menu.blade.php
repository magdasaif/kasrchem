<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <router-link to="/dashboard" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt green"></i>
          <p class="ttitle">
            الرئيسيه
          </p>
        </router-link>
      </li>

      @can('isAdmin')
      <!-------------------------------------------------------------------------->
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa fa-sitemap green"></i>
          <p  class="ttitle">اقسام الموقع</p> <i class="left fas fa-angle-right" style="margin-right: 33%;"></i>
        </a>
        <ul class="nav nav-treeview">
          <li>
              <a href="{{route('site_section.create')}}" class="nav-link">
                  <i class="nav-icon fas fa-plus orange"></i>
                  <p  class="ttitle"> اضافه قسم </p>
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
<!-------------------------------------------------------------------------->

      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa fa-cubes green"></i>
          <p  class="ttitle">
             التصنيفات الرئيسيه
          </p> <i class="left fas fa-angle-right" style="margin-right:18%;"></i>
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
<!-------------------------------------------------------------------------->
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fab fa-product-hunt green"></i>
          <p  class="ttitle"> المنتجات</p> <i class="left fas fa-angle-right" style="margin-right: 40%;"></i>
        </a>
        <ul class="nav nav-treeview">
          <li>
              <a href="{{route('products.create')}}" class="nav-link">
                  <i class="nav-icon fas  fa-plus orange"></i>
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
<!-------------------------------------slider----------------------->
<li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa fa-image green"></i>
          <p  class="ttitle">الصور المتحركة</p> <i class="left fas fa-angle-right" style="margin-right: 22%;"></i>
        </a>
        <ul class="nav nav-treeview">
          <li>
              <a href="{{route('slider.create')}}" class="nav-link">
                  <i class="nav-icon fas fa-plus orange"></i>
                  <p> اضافة صورة </p>
              </a>
          </li>
          <li>
              <a href="{{route('slider.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-image orange"></i>
                  <p> قائمة الصور </p>
              </a>
          </li>
         </ul>
      </li>
<!---------------------------------article----------------------------------------->
<li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa fa-newspaper green"></i>
          <p  class="ttitle"> المقالات</p> <i class="left fas fa-angle-right" style="margin-right: 40%;"></i>
        </a>
        <ul class="nav nav-treeview">
          <li>
              <a href="{{route('article.create')}}" class="nav-link">
                  <i class="nav-icon fas fa-plus orange"></i>
                  <p> اضافة مقال </p>
              </a>
          </li>
          <li>
              <a href="{{route('article.index')}}" class="nav-link">
                  <i class="nav-icon fas fa fa-newspaper orange"></i>
                  <p> قائمة المقالات </p>
              </a>
          </li>
         </ul>
      </li>

<!---------------------------------pages----------------------------------------->
<li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa fa-code green"></i>
          <p  class="ttitle"> الصفحات</p> <i class="left fas fa-angle-right" style="margin-right: 37%;"></i>
        </a>
        <ul class="nav nav-treeview">
          <li>
              <a href="{{route('page.create')}}" class="nav-link">
                  <i class="nav-icon fas fa-plus orange"></i>
                  <p> اضافة صفحة </p>
              </a>
          </li>
          <li>
              <a href="{{route('page.index')}}" class="nav-link">
                  <i class="nav-icon fas fa fa-code orange"></i>
                  <p>  قائمةالصفحات </p>
              </a>
          </li>
         </ul>
      </li>
<!-------------------------------gallary------------------------------------------->
<li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa fa-camera green"></i>
          <!-- <p> المعارض<i class="right fas fa-angle-left"></i></p> -->
          <p  class="ttitle"> المعارض</p> 
          <i class="left fas fa-angle-right" style="margin-right: 37%;"></i>
        </a>
        <ul class="nav nav-treeview">
          <li>
              <a href="{{route('photo_gallery.create')}}" class="nav-link">
                  <i class="nav-icon fas fa-plus orange"></i>
                  <p> اضافة معرض </p>
              </a>
          </li>
          <li>
              <a href="{{route('photo_gallery.index')}}" class="nav-link">
                  <i class="nav-icon fas fa fa-camera orange"></i>
                  <p>  قائمةالمعارض </p>
              </a>
          </li>
         </ul>
      </li>
<!-------------------------------------------------------------------------->
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