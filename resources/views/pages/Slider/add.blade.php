@extends('layouts.master')
@section('title')
<title>لوحة التحكم :اضافة صورة</title>
 @endsection
@section('content')
<template>
<section class="content">
    <div class="container-fluid">
        <div class="row">    
          <div class="col-12">
          @include('layouts.messages')
       
        
            <div class="card">
              <div class="card-header" >
                <h3 class="card-title">اضافة صورة</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('slider.index')}}" class="aa"> <li class="fas fa-image" ><span>   قائمة الصور </span></li></a>
                    </button>
                </div>
              </div>
 <!--#############################################################-->
 <div class="modal-body" >
   <form method="POST" action="{{route('slider.store')}}" enctype="multipart/form-data">

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}

                <div class="form-group">
                    <label for="sort">الترتيب</label>
                    <input type="number" class="form-control" id="sort" aria-describedby="sort" placeholder="ادخل الترتيب" name="sort"  value="{{ old('sort') }}" required  oninvalid="this.setCustomValidity('قم بادخال الترتيب')"  oninput="this.setCustomValidity('')">
                    @error('sort')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="row">

                    <div class="col-lg-12">
                    <center> <img src="{{ asset('images/logo2.jpg') }}" class="img-thumbnail img-preview" style="width:30%;" alt="" id="previewImg"></center>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label> صوره <span style="color:rgb(199, 8, 8)">*</span></label>
                            <input class="form-control" name="image" onchange="readURL(this);" type="file" accept="image/*" required >                            
                            <span style="color:red">الأبعاد [يجب أن يكون العرض بين (850 و 1200) ، ويجب أن يكون الارتفاع بين (315 و 600)]</span>
                        </div>
                        @error('image')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                </div>


                <div class="form-group">
                    <label for="image">الحالـة</label>
                    <select class="form-control" name="status" >
                       <option value="1" {{ old('status') == '1' ? "selected" : "" }}>مُفعل</option>
                       <option value="0" {{ old('status') == '0' ? "selected" : "" }}>غير مُفعل</option>
                    </select>
                </div>

                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">اضافة</button>
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
<script src="{{ URL::asset('/js/imagePreview.js') }}"></script>
@endsection

