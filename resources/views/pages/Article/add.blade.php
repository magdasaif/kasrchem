@extends('layouts.master')
@section('title')
<title>لوحة التحكم :ااضافةمقال</title>
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
                <h3 class="card-title"  >اضافة مقال </h3>

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
               <!--========================================================-->
               @include('categories.Category_models.select_category_adding')
              <!--========================================================-->
               <!----------------------------------------------------->

               <div class="form-group">
                    <label for="title_ar">عنوان المقال </label>
                    <input type="text" class="form-control" id="title_ar" aria-describedby="title_ar" placeholder="ادخل عنوان المقال" name="title_ar"  value="{{ old('title_ar') }}" required oninvalid="this.setCustomValidity('قم بادخال عنوان المقال بالعربية')"  oninput="this.setCustomValidity('')">
                    @error('title_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="title_en">عنوان المقال بالانجليزية</label>
                    <input type="text" class="form-control" id="title_en" aria-describedby="title_en" placeholder="ادخل عنوان المقال بالانجليزية" name="title_en"  value="{{ old('title_en') }}"required oninvalid="this.setCustomValidity('قم بادخال عنوان المقال بالانجليزية')"  oninput="this.setCustomValidity('')">
                    @error('title_en')
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
                <div class="form-group">
                    <label for="image">صوره</label>
                    <input type="file" class="form-control" name="image" accept="image/*" required oninvalid="this.setCustomValidity('قم بادخال الصورة')"  oninput="this.setCustomValidity('')">
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

<!-- tinymce -->
<script src="{{ URL::asset('assets/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::asset('/js/tiny.js') }}"></script>

@endsection