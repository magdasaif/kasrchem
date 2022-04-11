@extends('layouts.master')

@section('title')
<title>لوحة التحكم : {{$title}}</title>
 @endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
          
          <div class="col-12">
           <!--=================start success msg ===========================-->
          @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            @endif
           <!--=================start error msg ===========================-->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
           <!--=================start card-header===========================-->
            <div class="card">
                <!--=================start card-header===========================-->
              <div class="card-header">
                <h3 class="card-title"> اضافه نشره</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('release.index')}}" class="aa"> <li class="fas fa-file-pdf" ><span> قائمه النشرات </span></li></a>
                    </button>
                </div>
              </div>
              <!--=================end card-header===========================-->
            <div class="card">
             <!--=================start modal-body===========================-->
            <div class="modal-body">
             <form method="POST" action="{{route('release.store')}}" enctype="multipart/form-data">

                @csrf
                <!--========================tree_view_section_adding================================-->
                @include('pages.Sitesection.tree_view_section_adding')
               
              <!--------------------------name_ar--------------------------->
               <div class="form-group">
                    <label for="title_ar">اسم النشرة*</label>
                    <input type="text" class="form-control"  aria-describedby="name_ar" placeholder="ادخل اسم النشرة" name="name_ar"  value="{{ old('name_ar') }}" id="regax_name_ar" onkeyup="check_regax_name_ar();"   required oninvalid="this.setCustomValidity('يجب ان يكون اسم النشرة باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name"> يجب ان يكون اسم النشرة باللغة العربية وايضا لا يكون ارقام فقط</span>

                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <!-------------------------name_en---------------------------->
               <div class="form-group">
                    <label for="title_en">اسم النشرة بالانجليزية *</label>
                    <input type="text" class="form-control" id="name_en" aria-describedby="name_en" placeholder="ادخل اسم النشرة بالانجليزية" name="name_en" value="{{ old('name_en') }}" required onkeypress="return CheckEnglishCharactersOnly(event);"  oninvalid="this.setCustomValidity('يجب ان يكون اسم النشرة باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">

                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون اسم النشرة باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                 <!----------------------------image------------------------->
                <div class="form-group">
                    <label for="image">صورة النشرة *</label>
                    <div class="col-lg-12">
                       <center> <img src="{{ asset('images/logo2.jpg') }}" class="img-thumbnail img-preview" style="width:30%;" alt="" id="previewImg"></center>
                    </div>
                    <input type="file" class="form-control" name="image" accept="image/*"   value="{{ old('image') }}"  onchange="readURL(this);" required   oninvalid="this.setCustomValidity('قم بادخال الصورة')"  oninput="this.setCustomValidity('')"> 
                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            <!-----------------------------file------------------------>
                <div class="form-group">
                    <label for="image">ملف النشرة *</label>
                    <input type="file" class="form-control" name="file"  accept="application/pdf,application/vnd.ms-excel"  value="{{ old('file') }}" required   oninvalid="this.setCustomValidity('قم بادخال ملف النشرة')"  oninput="this.setCustomValidity('')">
                    @error('file')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            <!---------------------------sort-------------------------->
                <div class="form-group">
                    <label for="sort">الترتيب*</label>
                    <input type="number" class="form-control" id="sort" aria-describedby="sort" placeholder="ادخل الترنيب" name="sort"  value="{{ old('sort') }}" required required oninvalid="this.setCustomValidity('قم بادحال الترتيب')"  oninput="this.setCustomValidity('')">
                    @error('sort')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
         <!------------------------------status----------------------->

                <div class="form-group">
                    <label for="status">الحالـة*</label>
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

<script src="{{ URL::asset('/js/regax_name/regax_name.js') }}"></script>
<script src="{{ URL::asset('/js/imagePreview.js') }}"></script>
@endsection