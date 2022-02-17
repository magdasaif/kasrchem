@extends('layouts.master')
@section('title')
<title>لوحة التحكم : اضافة النشرة</title>
 @endsection
@section('content')
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
                <h3 class="card-title"> اضافه نشره</h3>
              </div>
 <!--#############################################################-->
 <div class="modal-body">

            <form method="POST" action="{{route('release.store')}}" enctype="multipart/form-data">

                @csrf
                  <!----------------------------------------------------->
                   <!--========================================================-->
                   @include('categories.Category_models.select_category_adding')
              <!--========================================================-->
               <!----------------------------------------------------->
              
               <div class="form-group">
                    <label for="title_ar">اسم النشرة</label>
                    <input type="text" class="form-control" id="title_ar" aria-describedby="title_ar" placeholder="ادخل اسم النشرة" name="title_ar"  value="{{ old('title_ar') }}"required   oninvalid="this.setCustomValidity('قم بادخال اسم النشرة بالعربية')"  oninput="this.setCustomValidity('')">
                    @error('title_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="title_en">اسم النشرة بالانجليزية</label>
                    <input type="text" class="form-control" id="title_en" aria-describedby="title_en" placeholder="ادخل اسم النشرة بالانجليزية" name="title_en" value="{{ old('title_en') }}" required   oninvalid="this.setCustomValidity('قم بادخال اسم النشرة بالانجليزية')"  oninput="this.setCustomValidity('')">
                    @error('title_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                 <!----------------------------------------------------->
                 <div class="form-group">
                    <label for="image">صورة النشرة *</label>
                    <input type="file" class="form-control" name="image" accept="image/*"   value="{{ old('image') }}" required   oninvalid="this.setCustomValidity('قم بادخال الصورة')"  oninput="this.setCustomValidity('')"> 
                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
             <!----------------------------------------------------->
             <div class="form-group">
                    <label for="image">ملف النشرة *</label>
                    <input type="file" class="form-control" name="file"  accept="application/pdf,application/vnd.ms-excel"  value="{{ old('file') }}" required   oninvalid="this.setCustomValidity('قم بادخال ملف النشرة')"  oninput="this.setCustomValidity('')">
                    @error('file')
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
 <!--========================================================-->
 @include('categories.Category_models.categories_model_adding')
    <!--========================================================--> 
 		</div>
            </div>
        </div>
    </div>
</section>

<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>

<!-- add script for categories and changes on it -->
<script src="{{ URL::asset('/js/product/add_script.js') }}"></script>
@endsection