@extends('layouts.master')
@section('title')
<title>لوحة التحكم : اضافه قسم</title>
 @endsection
@section('content')
<template>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            @endif

            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
            @endif
          <div class="col-12">
        
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">اضافه قسم</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('site_section.index')}}" class="aa"> <li class="fas fa-sitemap" ><span>  اقسام الموقع </span></li></a>
                    </button>
                </div>
              </div>
    
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
                                        $type="site_section",
                                        'site_id'=>$site->id,
                                    ];
                                     ?>
                                    <option style="color:<?php echo $color;?>"  value="{{$site->id}}">-{{$site->site_name_ar}}</option>
                                        @if(count($site->childs))
                                           @include('pages.products.manageChild',$new)
                                        @endif
                                         @endforeach
                                     </select>
                                 </div>
                                  <!--------------------------------------------------->

                                <div class="form-group">
                                    <label for="site_name_ar">اسم القسـم بالعربيه</label>
                                    <textarea class="form-control" rows="4" aria-describedby="emailHelp" placeholder="ادخل اسم القسـم بالعربيه"  name="site_name_ar"  required >{!! old('site_name_ar')!!}</textarea>

                                    <!-- <input type="text" class="form-control" id="site_name_ar" aria-describedby="site_name_ar" placeholder="ادخل اسم القسـم بالعربيه" name="site_name_ar" required> -->
                                    @error('site_name_ar')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="site_name_en">اسم القسم بالانجليزيه</label>
                                    <textarea class="form-control" rows="4" aria-describedby="emailHelp" placeholder="ادخل اسم القسـم بالانجليزية"  name="site_name_en"  required >{!! old('site_name_en')!!}</textarea>

                                    <!-- <input type="text" class="form-control" id="site_name_en" aria-describedby="site_name_en" placeholder="ادخل اسم القسـم بالانجليزية" name="site_name_en" required> -->
                                    @error('site_name_en')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="priority">الأولوية</label>
                                    <input type="number" class="form-control" id="priority" aria-describedby="priority" placeholder="ادخل الأولوية" name="priority" required>
                                    @error('priority')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image">صوره*</label>
                                    <input type="file" class="form-control" name="image" accept="image/*" required>
                                    @error('image')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="image">الحالـة</label>
                                    <select class="form-control" name="statues">
                                            <option value="1">مُفعل</option>
                                            <option value="0">غير مُفعل</option>
                                    </select>
                                </div>

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
@endsection
