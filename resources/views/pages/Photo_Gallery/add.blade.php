@extends('layouts.master')
@section('title')
<title> لوحة التحكم :اضافةمعرض</title>
@endsection
@section('content')
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
              <div class="card-header" >
                <h3 class="card-title"  > اضافة معرض </h3>
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
                    <label for="title_ar"> اسم المعرض  </label>
                    <input type="text" class="form-control"  aria-describedby="title_ar" placeholder="ادخل اسم المعرض" name="title_ar" value="{{ old('title_ar') }}" id="regax_name_ar" onkeyup="check_regax_name_ar();" onkeypress="return CheckArabicCharactersOnly(event);"   required oninvalid="this.setCustomValidity('يجب ان يكون اسم المعرض باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name"> يجب ان يكون اسم المعرض باللغة العربية وايضا لا يكون ارقام فقط</span>

                   
                    @error('title_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="title_en">اسم المعرض بالانجليزية</label>
                    <input type="text" class="form-control" id="title_en" aria-describedby="title_en" placeholder="ادخل اسم المعرض بالانجليزية" name="title_en" value="{{ old('title_en') }}" required onkeypress="return CheckEnglishCharactersOnly(event);"  oninvalid="this.setCustomValidity('يجب ان يكون اسم المعرض باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">

                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون اسم المعرض باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

                    @error('title_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                 <!----------------------------------------------------->
                <div class="form-group">
                    <label for="image">صوره</label>
                    <input type="file" class="form-control" name="image" accept="image/*" required   oninvalid="this.setCustomValidity('قم بادخال الصورة')"  oninput="this.setCustomValidity('')">
                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
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

<!-- add script for categories and changes on it -->
<script src="{{ URL::asset('/js/product/add_script.js') }}"></script>

@endsection