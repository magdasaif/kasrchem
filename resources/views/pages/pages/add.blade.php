@extends('layouts.master')
@section('title')
<title>لوحة التحكم :اضافة صفحة</title>
 @endsection
@section('content')
<section class="content">
    <div class="container-fluid">
 
        <div class="row">
            <div class="col-12">
            @include('layouts.messages')
         
        
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> اضافة صفحة </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('page.index')}}" class="aa"> <li class="fa fa-code" ><span> قائمه الصفحات </span></li></a>
                    </button>
                </div>
              </div>
 <!--#############################################################-->
 <div class="modal-body">
   <form method="POST" action="{{route('page.store')}}" enctype="multipart/form-data">

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}
            <!----------------------------------------------------->
                 <div class="form-group">
                    <label for="name_ar">اسم الصفحة  </label>
                    <input type="text" class="form-control"  aria-describedby="name_ar" placeholder="ادخل اسم الصفحة" name="name_ar"  value="{{ old('name_ar') }}" id="regax_name_ar" onkeyup="check_regax_name_ar();" onkeypress="return CheckArabicCharactersOnly(event);"   required oninvalid="this.setCustomValidity('يجب ان يكون اسم الصفحة باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">

                    <span style="color:red;display:none;font-weight: bold;" id="error_name"> يجب ان يكون اسم الصفحة باللغة العربية وايضا لا يكون ارقام فقط</span>

                    @error('name_ar')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>
            <!----------------------------------------------------->
               <div class="form-group">
                    <label for="name_en">اسم الصفحة بالانجليزية</label>
                    <input type="text" class="form-control" id="name_en" aria-describedby="name_en" placeholder="ادخل اسم الصفحة بالانجليزية" name="name_en" value="{{ old('name_en') }}" required onkeypress="return CheckEnglishCharactersOnly(event);"  oninvalid="this.setCustomValidity('يجب ان يكون اسم الصفحة باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون اسم الصفحة باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

                    @error('name_en')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>
            <!----------------------------------------------------->
                <div class="form-group">
                    <label for="exampleInputEmail1">الصور الفرعيه</label>

                    <input type="file" class="form-control" name="photos[]" accept="image/*" multiple>
                    <span style="color:red">الأبعاد [يجب أن يكون العرض بين (850 و 1200) ، ويجب أن يكون الارتفاع بين (315 و 600)]</span>

                    @error('photos')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            
            <!----------------------------------------------------->
               <div class="form-group">
                    <label for="description_ar">وصف الصفحة </label>
                    <textarea  class="form-control" rows="4" name="description_ar" id="description_ar" placeholder="ادخل وصف الصفحة " style="border-radius: 6px;" > {!! old('description_ar')!!}</textarea>
                    @error('description_ar')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>
            <!----------------------------------------------------->
               <div class="form-group">
                    <label for="description_en"> وصف الصفحة بالانجليزية</label>
                    
                    <textarea  class="form-control" rows="4" name="description_en" id="description_en" placeholder="ادخل وصف الصفحة بالانجليزية"  style="border-radius: 6px;">{!! old('description_en')!!}</textarea>

                    @error('description_en')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>
            <!----------------------------------------------------->
               <div class="form-group">
                    <label for="content_ar">المحتوى</label>
                    <textarea  class="form-control tinymce-editor" name="content_ar" id="content_ar" placeholder="ادخل محتوى الصفحة "  >{!! old('content_ar')!!}</textarea>
                    @error('content_ar')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>
            <!----------------------------------------------------->
                <div class="form-group">
                    <label for="content_en"> المحتوى بالانجليزية </label>
                    <textarea  class="form-control tinymce-editor" name="content_en" id="content_en" placeholder="ادخل محتوى الصفحة بالانجليزية "  >{!! old('content_en')!!}</textarea>
                    @error('content_en')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>
             <!----------------------------------------------------->
             <div class="form-group">
                    <label for="exampleInputEmail1">الترتيب </label>
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
                        <button type="submit" class="btn btn-primary" >اضافه</button>
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

<script src="{{ URL::asset('/js/regax_name/regax_name.js') }}"></script>
<!-- tinymce -->
<script src="{{ URL::asset('assets/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::asset('/js/tiny.js') }}"></script>
<script src="{{ URL::asset('/js/imagePreview.js') }}"></script>
@endsection