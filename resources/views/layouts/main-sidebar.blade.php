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
                   
                    <!-- menu item Elements-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#sub1">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">التصنيفات الرئيسيه</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="sub1" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('categories.create')}}">اضافه تصنيف</a></li>
                            <li><a href="{{route('categories.index')}}">قائمه التصنيفات</a></li>
                            
                        </ul>
                    </li>
                   
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
