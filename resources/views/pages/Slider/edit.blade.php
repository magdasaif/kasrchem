@extends('layouts.master')
@section('title')
<title>لوحة التحكم :{{$title}}/title>
 @endsection
@section('content')
<template>
<section class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-12">
        @include('layouts.messages')
         
        
            <div class="card">
              <div class="card-header"  >
                <h3 class="card-title">{{$title}}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('slider.index')}}" class="aa"> <li class="fas fa-image" ><span>   قائمة الصور </span></li></a>
                    </button>
                </div>
              </div>
 <!--#############################################################-->
 <div class="modal-body" >
   <form method="POST"  action="{{route('slider.update',encrypt($Slider->id))}}" enctype="multipart/form-data">
                {{method_field('PATCH ')}}

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}

                <div class="form-group">
                    <label for="sort">الترتيب</label>
                    <input type="number" class="form-control" id="sort" aria-describedby="sort" placeholder="Enter sort" name="sort"  value="{{ $Slider->sort}}" required>
                    @error('sort')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">الصورة</label>

                    @if(isset($Slider->image->filename))
                        <center><img id="previewImg" width="30%" src="<?php echo asset("storage/slider/".$Slider->image->filename)?>" class="uploaded-img"> </center>
                        <input type="hidden" name="deleted_image" value="{{$Slider->image->filename}}">
                        <input type="hidden" name="image_id" value="{{$Slider->image->id}}">
                    @else
                        <center> <img src="{{ asset('images/logo2.jpg') }}" class="img-thumbnail img-preview" style="width:30%;" alt="" id="previewImg"></center>
                        <input type="hidden" name="deleted_image"/>
                    @endif
                    
                   <br>
                    <center><button type="button" id="btn_image" class="btn btn-primary" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                    <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                        <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"></path>
                    </svg>
                    تعديل الصورة
                    </button></center>
                   <input type="file" class="form-control" name="image" id="my_file" accept="image/*" style="display: none;"  onchange="readURL(this);">
                   <center><span style="color:red">الأبعاد [يجب أن يكون العرض بين (850 و 1200) ، ويجب أن يكون الارتفاع بين (315 و 600)]</span></center>
                   @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

               

                <div class="form-group">
                    <label for="image">الحالة</label>
                    <select class="form-control" name="status">
                            <option value="1" <?php if($Slider->status==1){echo'selected';}?> >مُفعل</option>
                            <option value="0" <?php if($Slider->status==0){echo'selected';}?> >غير مُفعل</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{encrypt($Slider->id)}}">
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >تعديل</button>
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

<!-- edit script for edit_upload_image-->
<script src="{{ URL::asset('/js/edit_upload_image/edit_upload_image_script.js') }}"></script>
<script src="{{ URL::asset('/js/imagePreview.js') }}"></script>

@endsection
