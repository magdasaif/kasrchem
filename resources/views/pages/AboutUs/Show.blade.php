@extends('layouts.master')
@section('css')

@section('title')
تعديل  عن الموقع
@stop
@endsection
@section('page-header')


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

<div>
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" style="color: #2569b1;">تعديل عن الموقع</h5>
           
        </div>
        <div class="modal-body">
            
            <form method="POST"  action="{{url('About_us_update')}}" enctype="multipart/form-data">
                {{method_field('POST')}}

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}
              <!----------------------------------------------------->
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
                    <input type="file" class="form-control" name="image" accept="image/*" required>
                   <br> <center><img  style="width: 270px;height: 200px;"  src=<?php echo asset("storage/about_us/{$AboutUs->image}")?> alt="" ></center>
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
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ URL::asset('assets/tinymce/tinymce.min.js') }}"></script>
<script>
    tinymce.init({
        selector: 'textarea.tinymce-editor',
        height: 100,
        theme: 'modern',
        plugins: [
        "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "table contextmenu directionality emoticons template textcolor paste fullpage textcolor"
    ],

    toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
    toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | inserttime preview | forecolor backcolor",
    toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",

    menubar: false,
    toolbar_items_size: 'small',

    style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ],

    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ],
    
   
  
    });
    
  
    </script>
@endsection
