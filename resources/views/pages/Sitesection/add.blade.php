@extends('layouts.master')
@section('title')
<title>لوحة التحكم :{{$title}}</title>
 @endsection
@section('content')
<template>
<section class="content">
    <div class="container-fluid">
        <div class="row">
  
          <div class="col-12">
          @include('layouts.messages')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('site_section.index')}}" class="aa"> <li class="fas fa-sitemap" ><span>  اقسام الموقع </span></li></a>
                    </button>
                </div>
              </div>
          <!------------------modal-body----------------->
            <div class="modal-body">
                <form method="POST" action="{{route('site_section.store')}}" enctype="multipart/form-data">
                @csrf
                    {{-- <input name="_token" value="{{csrf_token()}}"> --}}
                    <!--------------------------------------------------->
                        <div class="form-group">
                        <label for="site_or_sub">نوع القســم</label>
                        
                        <select class="form-control" name="site_or_sub" style="height: 50px;" required oninvalid="this.setCustomValidity('اختر نوع القسم')"  oninput="this.setCustomValidity('')">
                        <option value="0" selected > قسم رئيسى</option>
        
                        @foreach($parent_sites as $site)
                        <?php
                        $color="#c20620";
                        $new=[
                            'childs' => $site->childs,
                            'color'=>'#209c41',
                            'number'=>2,
                            // $type="site_section",
                            'site_id'=>$site->id,
                        ];
                            ?>
                        <option style="color:<?php echo $color;?>"  value="{{$site->id}}">-{{$site->name_ar}}</option>
                            @if(count($site->childs))
                                @include('pages.manageChild',$new)
                            @endif
                                @endforeach
                            </select>
                        </div>
                    <!----------------------name_ar----------------------------->
                    <div class="form-group">
                        <label for="name_ar">اسم القسـم بالعربيه</label>
                        <textarea class="form-control" rows="4" aria-describedby="name_ar" placeholder="ادخل اسم القسـم بالعربيه"  name="name_ar"  required >{!! old('name_ar')!!}</textarea>
                        @error('name_ar')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <!----------------------name_en----------------------------->
                    <div class="form-group">
                        <label for="name_en">اسم القسم بالانجليزيه</label>
                        <textarea class="form-control" rows="4" aria-describedby="name_en" placeholder="ادخل اسم القسـم بالانجليزية"  name="name_en"  required >{!! old('name_en')!!}</textarea>
                        @error('name_en')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <!----------------------sort----------------------------->

                    <div class="form-group">
                        <label for="sort">الترتيب</label>
                        <input type="number" class="form-control" id="sort" aria-describedby="sort" placeholder="ادخل الترتيب" name="sort" required>
                        @error('sort')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <!----------------------image----------------------------->
                    <div class="row">

                        <div class="col-lg-12">
                        <center> <img src="{{ asset('images/logo2.jpg') }}" class="img-thumbnail img-preview" style="width:30%;" alt="" id="previewImg"></center>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>صورة المنتج الاساسية:  <span style="color:rgb(199, 8, 8)">*</span></label>
                                <input class="form-control" name="image" onchange="readURL(this);" type="file" accept="image/*" required >                            
                            </div>
                            @error('image')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>

                    </div>
                    <!----------------------status----------------------------->
                     <div class="form-group">
                        <label for="status">الحالـة</label>
                        <select class="form-control" name="status">
                                <option value="1">مُفعل</option>
                                <option value="0">غير مُفعل</option>
                        </select>
                    </div>
                    <!-------------------------------------------------------------------->

                    <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">اضافه</button>
                    </div>
                </form>
                        </div>
                       


             </div>
            </div>
        </div>
    </div>
</section>
</template>
<script src="{{ URL::asset('/js/imagePreview.js') }}"></script>
@endsection
