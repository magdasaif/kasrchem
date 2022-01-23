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
                            <li><a href="<?php echo e(route('site_section.create')); ?>">اضافه قسم موقع</a></li>
                            <li><a href="<?php echo e(route('site_section.index')); ?>">اقسام الموقع</a></li>
                            
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
                            <li><a href="<?php echo e(route('categories.create')); ?>">اضافه تصنيف</a></li>
                            <li><a href="<?php echo e(route('categories.index')); ?>">قائمه التصنيفات</a></li>
                            
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
                            <li><a href="<?php echo e(route('products.create')); ?>">اضافه منتج</a></li>
                            <li><a href="<?php echo e(route('products.index')); ?>">قائمه المنتجات</a></li>

                            <li><a href="<?php echo e(url('add_product')); ?>">اضافه منتج-livewire</a></li>

                            
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
                            <li><a href="<?php echo e(route('slider.create')); ?>">اضافة صورة</a></li>
                            <li><a href="<?php echo e(route('slider.index')); ?>">قائمة الصور</a></li>
                            
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
                        <li><a href="<?php echo e(route('article.create')); ?>"> اضافة مقال </a></li>
                            <li><a href="<?php echo e(route('article.index')); ?>">قائمة المقالات</a></li>
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
                        <li><a href="<?php echo e(route('video.create')); ?>"> اضافة فيديو </a></li>
                            <li><a href="<?php echo e(route('video.index')); ?>">قائمة الفيديو</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#partners">
                            <div class="pull-left"><i class="fa fa-handshake-o"></i><span
                                    class="right-nav-text">الشركاء</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="partners" class="collapse" data-parent="#sidebarnav">
                             <li><a href="<?php echo e(route('partner.create')); ?>"> اضافة شريك </a></li>
                            <li><a href="<?php echo e(route('partner.index')); ?>">قائمة الشركاء</a></li>
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
                        <li><a href="<?php echo e(route('release.create')); ?>"> اضافة نشرة </a></li>
                            <li><a href="<?php echo e(route('release.index')); ?>">قائمة النشرة</a></li>
                        </ul>
                    </li>



                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#branches">
                            <div class="pull-left"><i class="fa fa-building-o"></i><span
                                    class="right-nav-text">عناوين الفروع</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="branches" class="collapse" data-parent="#sidebarnav">
                        <li><a href="<?php echo e(route('branches.create')); ?>"> اضافة فرع </a></li>
                            <li><a href="<?php echo e(route('branches.index')); ?>">قائمة الفروع</a></li>
                        </ul>
                    </li>



                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#links">
                            <div class="pull-left"><i class="fas fa-link"></i><span
                                    class="right-nav-text">وسائل التواصل</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="links" class="collapse" data-parent="#sidebarnav">
                        <li><a href="<?php echo e(route('social.create')); ?>"> اضافة رابط </a></li>
                            <li><a href="<?php echo e(route('social.index')); ?>">قائمة الروابط</a></li>
                        </ul>
                    </li>



                    
                    

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#photo_gallery">
                            <div class="pull-left"><i class="fa fa-camera"></i><span
                                    class="right-nav-text">المعارض</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="photo_gallery" class="collapse" data-parent="#sidebarnav">
                        <li><a href="<?php echo e(route('photo_gallery.create')); ?>"> اضافة معرض</a></li>
                            <li><a href="<?php echo e(route('photo_gallery.index')); ?>">قائمة المعارض</a></li>
                        </ul>
                    </li>

                          <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#page">
                            <div class="pull-left"><i class="fa fa-code"></i><span
                                    class="right-nav-text">الصفحات</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="page" class="collapse" data-parent="#sidebarnav">
                        <li><a href="<?php echo e(route('page.create')); ?>"> اضافة صفحة</a></li>
                            <li><a href="<?php echo e(route('page.index')); ?>">قائمة الصفحات</a></li>
                        </ul>
                    </li>
                   
                   
                    <li>
                    <a href="<?php echo e(route('city.index')); ?>">المـدن
                            <div class="pull-left"><i class="fa fa-sitemap"></i></div>
                           
                        </a>
                       
                    </li>

                  
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
<?php /**PATH C:\wamp64\www\final\backend\resources\views\layouts\main-sidebar.blade.php ENDPATH**/ ?>