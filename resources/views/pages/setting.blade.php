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
          @include('layouts.messages')
            
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
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="site_name_en" value="{{$info->site_name_en}}" required   oninvalid="this.setCustomValidity('يجب ان يكون اسم الموقع باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
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

                    @if(($info->getFirstMediaUrl('site_logo','logo')))
                        <center><img id="previewImg"src="{{$info->getFirstMediaUrl('site_logo','logo')}}" class="uploaded-img"> </center>
                        <input type="hidden" name="media_url" value="{{$info->getFirstMediaUrl('site_logo')}}">
                    @else
                        <center> <img src="{{ asset('images/logo2.jpg') }}" class="img-thumbnail img-preview" style="width:30%;" alt="" id="previewImg"></center>
                        <input type="hidden" name="deleted_image"/>
                    @endif
                    <br>
                    <center>
                        <button type="button" id="btn_image" class="btn btn-primary" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                                <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                                <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"></path>
                            </svg>
                            تعديل اللوجو                                      
                        </button>
                    </center>
                    <input type="file" class="form-control" name="site_logo"  id="my_file" accept="image/*" style="display: none;" onchange="readURL(this);">
                    <!-- <center><span style="color:red">يجب اختيار صوره من نوع png  او svg  واقصى احداثياتها [300*300]</span></center> -->
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
<!-- edit script for edit_upload_image-->
<script src="{{ URL::asset('/js/edit_upload_image/edit_upload_image_script.js') }}"></script>
<script src="{{ URL::asset('/js/imagePreview.js') }}"></script>

@endsection