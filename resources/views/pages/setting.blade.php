@extends('layouts.master')
@section('title')
<title>لوحة التحكم : {{$title}}</title>
 @endsection
@section('content')
<template>
<section class="content">
    <div class="container-fluid">
        <div class="row">
          
          <div class="col-12">
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> {{$title}}</h3>
              </div>
 <!--#############################################################-->
 <div class="modal-body">
            
            <form method="POST" action="{{route('settings/update')}}" enctype="multipart/form-data">
            {{method_field('POST')}}
                @csrf

                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم الموقع بالعربيه</label>
                    <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter name" name="site_name_ar" value="{{$info->site_name_ar}}" id="regax_name_ar" onkeyup="check_regax_name_ar();" onkeypress="return CheckArabicCharactersOnly(event);"   required oninvalid="this.setCustomValidity('يجب ان يكون اسم الموقع باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">

                    <span style="color:red;display:none;font-weight: bold;" id="error_name"> يجب ان يكون اسم الموقع باللغة العربية وايضا لا يكون ارقام فقط</span>

                    @error('site_name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم الموقع بالانجليزيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="site_name_en" value="{{$info->site_name_en}}" required onkeypress="return CheckEnglishCharactersOnly(event);" pattern="^(?=.*[a-zA-Z\s])[a-zA-Z0-9\s]+$" oninvalid="this.setCustomValidity('يجب ان يكون اسم الموقع باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون اسم الموقع باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

                    @error('site_name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <hr>
                <div class="form-group">
                    <label for="exampleInputEmail1">وصف الموقع بالعربيه</label>
                    <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter desc" name="site_desc_ar"required>{{$info->site_desc_ar}}</textarea>
                    @error('site_desc_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">وصف الموقع بالانجليزيه</label>
                    <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter desc" name="site_desc_en"required>{{$info->site_desc_en}}</textarea>
                    @error('site_desc_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <hr>
                <div class="form-group">
                    <label for="exampleInputEmail1">لوجو</label>
                    <center><img data-v-20a423fa="" width="30%" src="<?php echo asset("images/$info->site_logo")?>" class="uploaded-img"> </center>
                    <input type="file" class="form-control" name="site_logo" accept="image/*">
                    <input type="hidden" name="deleted_image" value="{{$info->site_logo}}">
                    @error('site_logo')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <hr>
                <div class="form-group">
                    <label for="exampleInputEmail1">ايميل الموقع</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter mail" value="{{$info->site_mail}}" name="site_mail">
                    @error('site_mail')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">الهاتف </label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter phone" value="{{$info->site_phone}}" name="site_phone">
                    @error('site_phone')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">الفاكس</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter fax" value="{{$info->site_fax}}" name="site_fax">
                    @error('site_fax')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">whatsapp</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter whatsapp" value="{{$info->site_whatsapp}}" name="site_whatsapp">
                    @error('site_whatsapp')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <hr>
                <div class="form-group">
                    <label for="exampleInputEmail1">لينك تطبيق الايفون </label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter link" value="{{$info->ios_link}}" name="ios_link">
                    @error('ios_link')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">لينك تطبيق الاندرويد </label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter link" value="{{$info->android_link}}" name="android_link">
                    @error('android_link')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                     <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تعديل</button>

                    </div>
                </form>
                </div>
 <!--#############################################################-->

 		</div>
            </div>
        </div>
    </div>
</section>
</template>
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>

<script src="{{ URL::asset('/js/regax_name/regax_name.js') }}"></script>
@endsection