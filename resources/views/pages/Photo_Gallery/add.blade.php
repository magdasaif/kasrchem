@extends('layouts.master')
@section('title')
<title> لوحة التحكم :{{$title}}</title>
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
          
          <div class="col-12">
          @include('layouts.messages')
            <div class="card">
              <div class="card-header" >
                <h3 class="card-title"  > {{$title}} </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('photo_gallery.index')}}" class="aa"> <li class="fa fa-camera" ><span> قائمه المعارض </span></li></a>
                    </button>
                </div>
              </div>
 <!--#############################################################-->
 <div class="modal-body" >
  <form method="POST" action="{{route('photo_gallery.store')}}" enctype="multipart/form-data">

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}
                  <!----------------------------------------------------->
               <!--========================================================-->
               @include('pages.Sitesection.tree_view_section_adding')
              <!--========================================================-->
               <!----------------------------------------------------->
              
               <div class="form-group">
                    <label for="name_ar"> اسم المعرض  </label>
                    <input type="text" class="form-control"  aria-describedby="name_ar" placeholder="ادخل اسم المعرض" name="name_ar" value="{{ old('name_ar') }}" id="regax_name_ar" onkeyup="check_regax_name_ar();" onkeypress="return CheckArabicCharactersOnly(event);"   required oninvalid="this.setCustomValidity('يجب ان يكون اسم المعرض باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name"> يجب ان يكون اسم المعرض باللغة العربية وايضا لا يكون ارقام فقط</span>

                   
                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="name_en">اسم المعرض بالانجليزية</label>
                    <input type="text" class="form-control" id="name_en" aria-describedby="name_en" placeholder="ادخل اسم المعرض بالانجليزية" name="name_en" value="{{ old('name_en') }}" required onkeypress="return CheckEnglishCharactersOnly(event);"  oninvalid="this.setCustomValidity('يجب ان يكون اسم المعرض باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">

                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون اسم المعرض باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

                    @error('name_en')
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
                    <label for="exampleInputEmail1">صور المعرض الفرعيه</label>
                    <input type="file" class="form-control" name="photos[]" accept="image/*" multiple>

                    @error('photos')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
             <!----------------------------------------------------->
             
             <div class="form-group">
                    <label for="exampleInputEmail1">ترتيب المنتج</label>
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
<script src="{{ URL::asset('/js/regax_name/regax_name.js') }}"></script>
<script src="{{ URL::asset('/js/imagePreview.js') }}"></script>

@endsection