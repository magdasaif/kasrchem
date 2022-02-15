@extends('layouts.master')
@section('title')
<title>لوحة التحكم :تعديل صورة</title>
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
                <h3 class="card-title">تعديل صفحة</h3>
              </div>
 <!--#############################################################-->
 <div class="modal-body" >
   <form method="POST"  action="{{route('page.update',$page->id)}}" >
                {{method_field('PATCH ')}}

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}

              
               <!----------------------------------------------------->
              
               <div class="form-group">
                    <label for="title_ar">اسم الصفحة </label>
                    <input type="text" class="form-control" id="title_ar" aria-describedby="title_ar" placeholder="ادخل اسم الصفحة" name="title_ar" value="{{$page->title_ar}}" required oninvalid="this.setCustomValidity('قم بادخال اسم الصفحة بالعربية')"  oninput="this.setCustomValidity('')">
                    @error('title_ar')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="title_en">اسم الصفحة بالانجليزية</label>
                    <input type="text" class="form-control" id="title_en" aria-describedby="title_en" placeholder="ادخل اسم الصفحة بالانجليزية" name="title_en"  value="{{$page->title_en}}" required oninvalid="this.setCustomValidity('قم بادخال اسم الصفحة بالانجليزية')"  oninput="this.setCustomValidity('')">
                    @error('title_en')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>
               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="content_ar">وصف الصفحة </label>
                    <textarea  class="form-control tinymce-editor" name="description_ar" id="description_ar" placeholder="ادخل وصف الصفحة "  style="border-radius: 6px;">{!!$page->description_ar!!}</textarea>
                    
                    @error('description_ars')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>
              <!----------------------------------------------------->
               
               <div class="form-group">
                    <label for="content_en">وصف الصفحة  بالانجليزية</label>
                    
                    <textarea  class="form-control tinymce-editor " name="description_en" id="description_en" placeholder="ادخل وصف الصفحة بالانجليزية "  style="border-radius: 6px;"> {!!$page->description_en!!}</textarea>

                    @error('description_en')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>
              <!----------------------------------------------------->
               <div class="form-group">
                    <label for="content_ar">محتوى الصفحة </label>
                    <textarea  class="form-control tinymce-editor" name="content_ar" id="content_ar" placeholder="ادخل محتوى الصفحة " >{!!$page->content_ar!!}</textarea>
                    
                    @error('content_ar')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>
              <!----------------------------------------------------->
               
               <div class="form-group">
                    <label for="content_en">محتوى الصفحة  بالانجليزية</label>
                    
                    <textarea  class="form-control tinymce-editor" name="content_en" id="content_en" placeholder="ادخل محتوى الصفحة بالانجليزية " > {!!$page->content_en!!}</textarea>

                    @error('content_en')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>
              <!----------------------------------------------------->
                 <div class="form-group">
                    <label for="image">الحالة</label>
                    <select class="form-control" name="status">
                            <option value="1" <?php if($page->status==1){echo'selected';}?> >مُفعلة</option>
                            <option value="0" <?php if($page->status==0){echo'selected';}?> >غير مُفعلة</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$page->id}}">
               
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

@endsection

<script src="{{ URL::asset('assets/tinymce/tinymce.min.js') }}"></script>
<script>
    tinymce.init({
        selector: 'textarea.tinymce-editor',
        
        height: 300,
        theme: 'modern',
        plugins: [
        "advlist autolink autosave link image code lists charmap print preview hr anchor pagebreak spellchecker",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "table contextmenu directionality emoticons template textcolor paste fullpage textcolor"
    ],
//---------------------------دى الحااجات اللى بتظهر---------------------------- //
    toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
    toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | inserttime preview | forecolor backcolor",
    toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
    toolbar4: 'undo redo ',
    menubar: true,
    toolbar_items_size: 'small',
//---------------------------------------------------------------------------------------
    style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'},
        
    ],

//---------------------------------------------------------------------------------------
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ],
    
  //------------------to add class to image-------------------------
image_class_list: [
    {title: 'None', value: ''},
    {title: 'image_class', value: 'photo'},
    {title: 'Lightbox', value: 'lightbox'}
  ],
//-------------------------------for upload image------------------
  
  /* enable title field in the Image dialog*/
  image_title: true,
  /* enable automatic uploads of images represented by blob or data URIs*/
  automatic_uploads: true,
 
   file_picker_types: 'file image media',
  /* and here's our custom image picker*/
  file_picker_callback: function (cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');

    
    input.onchange = function () {
      var file = this.files[0];

      var reader = new FileReader();
      reader.onload = function () {
        /*
          Note: Now we need to register the blob in TinyMCEs image blob
          registry. In the next release this part hopefully won't be
          necessary, as we are looking to handle it internally.
        */
        var id = 'blobid' + (new Date()).getTime();
        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(',')[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        /* call the callback and populate the Title field with the file name */
        cb(blobInfo.blobUri(), { title: file.name });
      };
      reader.readAsDataURL(file);
    };

    input.click();
  },
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'

    });
    </script>
