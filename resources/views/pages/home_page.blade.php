@extends('layouts.master')
@section('title')
<title>لوحة التحكم : {{$title}}</title>
 @endsection
@section('content')
<template>
    <section class="content">
        <div class="container-fluid">
        <div class="row ">
            
                <!-- <div class="col-12 col-sm-6 col-md-4">
                   <a href="{{route('site_section.index')}}">
                       <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="nav-icon fas fa fa-sitemap"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text" style="color: #009879;font-size: 20px;font-weight: bold;">اقسام الموقع</span>
                                <span class="info-box-number" style="font-size:20px;">
                                {{$sections}}
                                </span>
                            </div>
                         
                        </div>
                    </a>
                  
                </div> -->

                <!-- fix for small devices only -->
                 <div class="clearfix hidden-md-up"></div>
                 
                <!-- <div class="col-12 col-sm-6 col-md-4">
                   <a href="{{route('categories.index')}}">
                       <div class="info-box">
                            <span class="info-box-icon bg-danger elevation-1"><i class="nav-icon fas fa fa-cubes"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text" style="color: #009879;font-size: 20px;font-weight: bold;"> التصنيفات الرئيسيه</span>
                                <span class="info-box-number" style="font-size:20px;">
                                {{$sub1}}
                                </span>
                            </div>
                           
                        </div>
                    </a>
                   
                </div> -->

                 <!-- fix for small devices only -->
                 <div class="clearfix hidden-md-up"></div>
                 
                <div class="col-12 col-sm-6 col-md-4">
                   <a href="{{route('slider.index')}}">
                       <div class="info-box">
                            <span class="info-box-icon bg-success elevation-1"><i class="nav-icon fas fa fa-image"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text" style="color: #009879;font-size: 20px;font-weight: bold;">  الصور المتحركة</span>
                                <span class="info-box-number" style="font-size:20px;">
                                {{$slider}}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>

                 <!-- fix for small devices only -->
                 <div class="clearfix hidden-md-up"></div>
                 
                <div class="col-12 col-sm-6 col-md-4">
                   <a href="{{route('article.index')}}">
                       <div class="info-box">
                            <span class="info-box-icon bg-warning elevation-1"><i class="nav-icon fas fa fa-newspaper"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text" style="color: #009879;font-size: 20px;font-weight: bold;"> المقالات</span>
                                <span class="info-box-number" style="font-size:20px;">
                                {{$article}}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

  
                <div class="col-12 col-sm-6 col-md-4">
                   <a href="{{route('video.index')}}">
                       <div class="info-box">
                            <span class="info-box-icon bg-success elevation-1"><i class="nav-icon fas fa fa-video"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text" style="color: #009879;font-size: 20px;font-weight: bold;"> الفيديوهات</span>
                                <span class="info-box-number" style="font-size:20px;">
                                {{$video}}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

  
                <div class="col-12 col-sm-6 col-md-4">
                   <a href="{{route('photo_gallery.index')}}">
                       <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="nav-icon fas fa fa-camera"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text" style="color: #009879;font-size: 20px;font-weight: bold;"> معارض الصور</span>
                                <span class="info-box-number" style="font-size:20px;">
                                {{$gallery}}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-4">
                   <a href="{{route('partner.index')}}">
                       <div class="info-box">
                            <span class="info-box-icon bg-danger elevation-1"><i class="nav-icon fas fa fa-handshake"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text" style="color: #009879;font-size: 20px;font-weight: bold;">  الشركاء</span>
                                <span class="info-box-number" style="font-size:20px;">
                                {{$partner}}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>

                  <!-- fix for small devices only -->
                  <div class="clearfix hidden-md-up"></div>
                 
                 <div class="col-12 col-sm-6 col-md-4">
                    <a href="{{route('social.index')}}">
                        <div class="info-box">
                             <span class="info-box-icon bg-info elevation-1"><i class="nav-icon fas fa fa-link"></i></span>
 
                             <div class="info-box-content">
                                 <span class="info-box-text" style="color: #009879;font-size: 20px;font-weight: bold;">  وسائل التواصل</span>
                                 <span class="info-box-number" style="font-size:20px;">
                                 {{$social}}
                                 </span>
                             </div>
                             <!-- /.info-box-content -->
                         </div>
                     </a>
                     <!-- /.info-box -->
                 </div>


                    <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-4">
                <a href="{{route('products.index')}}">
                    <div class="info-box">
                            <span class="info-box-icon bg-warning elevation-1"><i class="nav-icon fas fab fa-product-hunt"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text" style="color: #009879;font-size: 20px;font-weight: bold;">  المنتجات</span>
                                <span class="info-box-number" style="font-size:20px;">
                                {{$product}}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>

                 <!-- fix for small devices only -->
                 <div class="clearfix hidden-md-up"></div>
  
                <div class="col-12 col-sm-6 col-md-4">
                <a href="{{route('branches.index')}}">
                    <div class="info-box">
                            <span class="info-box-icon bg-success elevation-1"><i class="nav-icon fas fa fa-building"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text" style="color: #009879;font-size: 20px;font-weight: bold;"> الفروع</span>
                                <span class="info-box-number" style="font-size:20px;">
                                {{$branches}}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>


                  <!-- fix for small devices only -->
                  <div class="clearfix hidden-md-up"></div>
  
                    <div class="col-12 col-sm-6 col-md-4">
                    <a href="{{route('supplier.index')}}">
                        <div class="info-box">
                                <span class="info-box-icon bg-success elevation-1"><i class="nav-icon fas fa-users "></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text" style="color: #009879;font-size: 20px;font-weight: bold;"> الموردين</span>
                                    <span class="info-box-number" style="font-size:20px;">
                                    {{$supplier}}
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </a>
                        <!-- /.info-box -->
                    </div>
  
            </div>
           
        </div><!--/. container-fluid -->
    </section>
</template>
@endsection
