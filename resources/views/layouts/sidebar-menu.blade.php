<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <a href="{{route('dashboard')}}" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt green"></i>
          <p class="ttitle">
            الرئيسيه
          </p>
        </a>
      </li>

      @can('isAdmin')

       <li class="nav-item">
        <a href="{{route('about/edit',1)}}" class="nav-link">
          <i class="nav-icon fas fa-info green"></i>
          <p  class="ttitle">من نحن</p>
        </a>
      </li> 
      
      <!------------------------------اقسام الموقع-------------------------------------------->
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
<!---------------------------تصنيفات----------------------------------------------->

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
   <!-------------------------------supplier------------------------------------------->
        <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users  green"></i>
          <p  class="ttitle"> الموردين</p> 
          <i class="left fas fa-angle-right" style="margin-right: 37%;"></i>
        </a>
        <ul class="nav nav-treeview">
          <li>
              <a href="{{route('supplier.create')}}" class="nav-link">
                  <i class="nav-icon fas fa-plus orange"></i>
                  <p> اضافة مورد </p>
              </a>
          </li>
         
          <li>
              <a href="{{route('supplier.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-users orange"></i>
                  <p>  قائمةالموردين</p>
              </a>
          </li>
         </ul>
      </li>
<!----------------------------products---------------------------------------------->
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
         </ul>
      </li>


<!-------------------------------------video----------------------->
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa-video green"></i>
          <p  class="ttitle"> الفيديوهات</p><i class="left fas fa-angle-right" style="margin-right: 37%;"></i>
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

<!-------------------------------------شركاء----------------------->

      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa-handshake green"></i>
          <p  class="ttitle"> الشركاء</p><i class="left fas fa-angle-right" style="margin-right: 43%;"></i>
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


<!-------------------------------------نشرات----------------------->

      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa-file-pdf green"></i>
          <p  class="ttitle"> النشرات</p><i class="left fas fa-angle-right" style="margin-right: 43%;"></i>
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

<!-------------------------------------فروع----------------------->

      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa-building green"></i>
          <p  class="ttitle"> عناوين الفروع</p><i class="left fas fa-angle-right" style="margin-right: 25%;"></i>
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

      <!-------------------------------------وسائل التواصل----------------------->

      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa-link green"></i>
          <p  class="ttitle"> وسائل التواصل</p><i class="left fas fa-angle-right" style="margin-right: 25%;"></i>
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
      <li class="nav-item">
        <a href="{{route('settings/edit',1)}}" class="nav-link">
          <i class="nav-icon fas fa-cogs green"></i>
          <p  class="ttitle">اعدادات الموقع</p>
        </a>
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