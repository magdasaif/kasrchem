@extends('layouts.master')
@section('title')
<title>لوحة التحكم :{{$title}}</title>
 @endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
           
          <div class="col-12">
          @include('layouts.messages')
            <div class="card">
              <div class="card-header" >
                <h3 class="card-title"  >{{$title}} </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('article.index')}}" class="aa"> <li class="fa fa-newspaper" ><span> قائمه المقالات </span></li></a>
                    </button>
                </div>
                
              </div>
 <!--#############################################################-->
 <div class="modal-body" >
   <form method="POST" action="{{route('article.store')}}" enctype="multipart/form-data">

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}
                  <!----------------------------------------------------->
               @include('pages.Sitesection.tree_view_section_adding')
               <!----------------------------------------------------->

               <div class="form-group">
                    <label for="name_ar">عنوان المقال </label>
                    <input type="text" class="form-control" aria-describedby="name_ar" placeholder="ادخل عنوان المقال" name="name_ar"  value="{{ old('name_ar') }}" id="regax_name_ar" onkeyup="check_regax_name_ar();" onkeypress="return CheckArabicCharactersOnly(event);"   required oninvalid="this.setCustomValidity('يجب ان يكون اسم المقال باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">

                    <span style="color:red;display:none;font-weight: bold;" id="error_name"> يجب ان يكون اسم المقال باللغة العربية وايضا لا يكون ارقام فقط</span>

                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="name_en">عنوان المقال بالانجليزية</label>
                    <input type="text" class="form-control" id="name_en" aria-describedby="name_en" placeholder="ادخل عنوان المقال بالانجليزية" name="name_en"  value="{{ old('name_en') }}" required onkeypress="return CheckEnglishCharactersOnly(event);"  oninvalid="this.setCustomValidity('يجب ان يكون اسم المقال باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">

                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون اسم المقال باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="content_ar">محتوى المقال </label>
                    <textarea  class="form-control tinymce-editor" name="content_ar" id="content_ar" placeholder="ادخل محتوى المقال "  >{!! old('content_ar')!!}</textarea>
                    @error('content_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
              <!----------------------------------------------------->

               <div class="form-group">
                    <label for="content_en"> محتوى المقال بالانجليزية </label>

                    <textarea  class="form-control tinymce-editor" name="content_en" id="content_en" placeholder="ادخل محتوى المقال بالانجليزية "  >{!! old('content_en')!!}</textarea>

                    @error('content_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
              <!----------------------------------------------------->
              <hr>
                <div class="row">

                    <div class="col-lg-12">
                       <center> <img src="{{ asset('images/logo2.jpg') }}" class="img-thumbnail img-preview" style="width:30%;" alt="" id="previewImg"></center>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>صورة <span style="color:rgb(199, 8, 8)">*</span></label>
                            <input class="form-control" name="image" onchange="readURL(this);" type="file" accept="image/*" required >                            
                        </div>
                        @error('image')
                             <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                   
                </div>
             <!----------------------------------------------------->
             <div class="form-group">
                    <label for="exampleInputEmail1">الترتيب</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="sort" value="<?php if(old('sort')){echo old('sort');}else{echo'0';}?>">
                    @error('sort')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <hr>
             <!----------------------------------------------------->

                <div class="form-group">
                    <label for="image">الحالـة</label>
                    <select class="form-control" name="status"  required>
                    <option value="1" {{ old('status') == '1' ? "selected" : "" }}>مُفعل</option>
                     <option value="0" {{ old('status') == '0' ? "selected" : "" }}>غير مُفعل</option>
                    </select>
                </div>
          <!----------------------------------------------------->
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">اضافه</button>
                </div>
                </form>

</div>
 <!--#############################################################-->

 		</div>
            </div>
        </div>
    </div>
</section>

<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<!-- tinymce -->
<script src="{{ URL::asset('assets/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::asset('/js/tiny.js') }}"></script>
<script src="{{ URL::asset('/js/regax_name/regax_name.js') }}"></script>
<script src="{{ URL::asset('/js/imagePreview.js') }}"></script>
@endsection