<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">الرئيسيه</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                   
				   
				    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                            <div class="pull-left"><i class="fa fa-sitemap"></i><span
                                    class="right-nav-text">اقســـام الموقع</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('site_section.create')}}">اضافه قسم موقع</a></li>
                            <li><a href="{{route('site_section.index')}}">اقسام الموقع</a></li>
                            
                        </ul>
                    </li>
					
					
                    <!-- menu item Elements-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#sub1">
                            <div class="pull-left"><i class="fa fa-cubes"></i><span
                                    class="right-nav-text">التصنيفات الرئيسيه</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="sub1" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('categories.create')}}">اضافه تصنيف</a></li>
                            <li><a href="{{route('categories.index')}}">قائمه التصنيفات</a></li>
                            
                        </ul>
                    </li>
                   

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#slider">
                            <div class="pull-left"><i class="fa fa-image"></i><span
                                    class="right-nav-text">الصور المتحركة</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="slider" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('slider.create')}}">اضافة صورة</a></li>
                            <li><a href="{{route('slider.index')}}">قائمة الصور</a></li>
                            
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#article">
                            <div class="pull-left"><i class="fa fa-newspaper-o"></i><span
                                    class="right-nav-text">المقالات</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="article" class="collapse" data-parent="#sidebarnav">
                        <li><a href="{{route('article.create')}}"> اضافة مقال </a></li>
                            <li><a href="{{route('article.index')}}">قائمة المقالات</a></li>
                        </ul>
                    </li>


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#product">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">المنتجات</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="product" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('products.create')}}">اضافه منتج</a></li>
                            <li><a href="{{route('products.index')}}">قائمه المنتجات</a></li>

                            <li><a href="{{url('add_product')}}">اضافه منتج-livewire</a></li>

                            
                        </ul>
                    </li>


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#video">
                            <div class="pull-left"><i class="fa fa-video-camera"></i><span
                                    class="right-nav-text">الفيديو</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="video" class="collapse" data-parent="#sidebarnav">
                        <li><a href="{{route('video.create')}}"> اضافة فيديو </a></li>
                            <li><a href="{{route('video.index')}}">قائمة الفيديو</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#partners">
                            <div class="pull-left"><i class="fas fa-handshake"></i><span
                                    class="right-nav-text">الشركاء</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="partners" class="collapse" data-parent="#sidebarnav">
                        <li><a href="{{route('partner.create')}}"> اضافة شريك </a></li>
                            <li><a href="{{route('partner.index')}}">قائمة الشركاء</a></li>
                            </ul>
</li>
                         <li>

                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#release">
                            <div class="pull-left"><i class="fa fa-file-pdf-o"></i><span
                                    class="right-nav-text">النشرات</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="release" class="collapse" data-parent="#sidebarnav">
                        <li><a href="{{route('release.create')}}"> اضافة نشرة </a></li>
                            <li><a href="{{route('release.index')}}">قائمة النشرة</a></li>
                        </ul>
                    </li>
                    
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
