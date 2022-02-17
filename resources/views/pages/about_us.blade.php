@extends('layouts.master')
@section('title')
<title>لوحة التحكم : {{$title}}</title>
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

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> {{$title}}</h3>
              </div>
 <!--#############################################################-->
 <div class="modal-body">

        <form method="POST"  action="{{route('about/update')}}" enctype="multipart/form-data">
                {{method_field('POST')}}

                @csrf
              <!-------------------------------------tinymce-editor---------------->
              <div class="form-group">
                    <label for="title_ar" style="font-weight: bold;color: black"> من نحن</label>
                    <textarea  rows="3" cols="22" class="form-control tinymce-editor" name="title_ar" id="title_ar"  >{!!$AboutUs->title_ar!!}</textarea>

                    @error('title_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div><hr>
               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="title_en" style="font-weight: bold;color: black"> من نحن بالانجليزية</label>
                    <textarea  class="form-control tinymce-editor" name="title_en" id="title_en"  >{!!$AboutUs->title_en!!}</textarea>

                    @error('title_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div><hr>
                <!----------------------------------------------------->
                <div class="form-group">
                    <label for="mission_ar" style="font-weight: bold;color: black"> الرسالة</label>
                    <textarea  class="form-control tinymce-editor" name="mission_ar" id="mission_ar"  >{!!$AboutUs->mission_ar!!}</textarea>

                    @error('mission_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div><hr>
                <!----------------------------------------------------->
                <div class="form-group">
                    <label for="mission_en" style="font-weight: bold;color: black">  الرسالة بالانجليزية</label>
                    <textarea  class="form-control tinymce-editor" name="mission_en" id="mission_en"  >{!!$AboutUs->mission_en!!}</textarea>

                    @error('mission_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div><hr>
               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="vision_ar" style="font-weight: bold;color: black"> الرؤية</label>
                    <textarea  class="form-control tinymce-editor" name="vision_ar" id="vision_ar"  >{!!$AboutUs->vision_ar!!}</textarea>

                    @error('vision_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div><hr>
               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="vision_en" style="font-weight: bold;color: black"> الرؤية بالانجليزية</label>
                    <textarea  class="form-control tinymce-editor" name="vision_en" id="vision_en"  >{!!$AboutUs->vision_en!!}</textarea>

                    @error('vision_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div><hr>
               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="goal_ar" style="font-weight: bold;color: black">الهدف</label>
                    <textarea  class="form-control tinymce-editor" name="goal_ar" id="goal_ar"  >{!!$AboutUs->goal_ar!!}</textarea>

                    @error('goal_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div><hr>
               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="goal_en" style="font-weight: bold;color: black"> الهدف بالانجليزية</label>
                    <textarea  class="form-control tinymce-editor" name="goal_en" id="goal_en"  >{!!$AboutUs->goal_en!!}</textarea>

                    @error('goal_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div><hr>
               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="image">الصورة</label>
                   <center><img  style="width: 30%;"  src=<?php echo asset("storage/about_us/$AboutUs->image")?> alt="" ></center>
                      <br>
                    <input type="file" class="form-control" name="image" accept="image/*" >
                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
               <!----------------------------------------------------->
               <input type="hidden" name="deleted_image" value="{{$AboutUs->image}}">

                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تعديل</button>
                </div>
                </form>
                </div>
 <!--#############################################################-->

 		</div>
            </div>
        </div>
    </div>
</section>

<script src="{{ URL::asset('assets/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::asset('/js/tiny.js') }}"></script>
@endsection