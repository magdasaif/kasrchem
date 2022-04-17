@extends('layouts.master')
@section('title')
<title>لوحة التحكم :{{$title}}</title>
 @endsection
@section('content')
<div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
          
          <div class="col-12">
          @include('layouts.messages')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> {{$title}}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('video.index')}}" class="aa"> <li class="fas fa-video" ><span>  قائمة الفيديوهات </span></li></a>
                    </button>
                </div>
              </div>
 <!-------------------------------------اضافة الفيديو----------------------------------------------->
 <div class="modal-body">
            <form method="POST" action="{{route('video.store')}}" enctype="multipart/form-data">

                @csrf
                <!--==========tree-site model==========-->
              @include('pages.Sitesection.tree_view_section_adding')
               <!-------------------------name_ar---------------------------->
               <div class="form-group">
                    <label for="name_ar">عنوان الفيديوبالعربية* </label>
                    <input type="text" class="form-control" aria-describedby="name_ar" placeholder="ادخل عنوان الفيديو" name="name_ar"  value="{{old('name_ar')}}"  id="regax_name_ar" onkeyup="check_regax_name_ar();"  required oninvalid="this.setCustomValidity('يجب ان يكون عنوان الفيديو باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name"> يجب ان يكون عنوان الفيديو باللغة العربية وايضا لا يكون ارقام فقط</span>
                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

               <!-------------------------name_en---------------------------->
               <div class="form-group">
                    <label for="name_en">عنوان الفيديو بالانجليزية*</label>
                    <input type="text" class="form-control"  aria-describedby="name_en" placeholder="ادخل عنوان الفيديو بالانجليزية" name="name_en"  value="{{old('name_en')}}"  required onkeypress="return CheckEnglishCharactersOnly(event);"  oninvalid="this.setCustomValidity('يجب ان يكون عنوان الفيديو باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون عنوان الفيديو باللغة الانجليزية وايضا لا يكون ارقام فقط</span>
                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                 <!-----------------------link------------------------------>
                <div class="form-group">
                <label for="link">رابط الفيديو </label>
                    <input type="text" class="form-control" name="link" value="{{old('link')}}"  required  oninvalid="this.setCustomValidity('قم بادخال رابط الفيديو')"  oninput="this.setCustomValidity('')">
                    @error('link')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                 <!---------------------------sort-------------------------->
                 <div class="form-group">
                    <label for="sort">الترتيب*</label>
                    <input type="number" class="form-control" id="sort" aria-describedby="sort" placeholder="ادخل الترنيب" name="sort"  value="{{ old('sort') }}"  required oninvalid="this.setCustomValidity('قم بادحال الترتيب')"  oninput="this.setCustomValidity('')">
                    @error('sort')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
             <!-------------------------status---------------------------->

                <div class="form-group">
                    <label for="status">الحالـة</label>
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
 		</div>
            </div>
        </div>
    </div>
</section>
   </div>


<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('/js/regax_name/regax_name.js') }}"></script>

@endsection