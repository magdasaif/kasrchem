@extends('layouts.master')

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
              <div class="card-header" style="background-color: rgb(96 211 145);">
                <h3 class="card-title"  > اضافة صفحة </h3>
              </div>
 <!--#############################################################-->
 <div class="modal-body" style=" width: 68%; margin-right: 128px;">
   <form method="POST" action="{{route('page.store')}}" >

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}
            <!----------------------------------------------------->
                 <div class="form-group">
                    <label for="title_ar">اسم الصفحة  </label>
                    <input type="text" class="form-control" id="title_ar" aria-describedby="title_ar" placeholder="ادخل اسم الصفحة" name="title_ar" required>
                    @error('title_ar')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>
            <!----------------------------------------------------->
               <div class="form-group">
                    <label for="title_en">اسم الصفحة بالانجليزية</label>
                    <input type="text" class="form-control" id="title_en" aria-describedby="title_en" placeholder="ادخل اسم الصفحة بالانجليزية" name="title_en" required>
                    @error('title_en')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>
            <!----------------------------------------------------->
               <div class="form-group">
                    <label for="description_ar">وصف الصفحة </label>
                    <textarea  class="form-control " name="description_ar" id="description_ar" placeholder="ادخل وصف الصفحة " style="border-radius: 6px;" ></textarea>
                    @error('description_ar')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>
            <!----------------------------------------------------->
               <div class="form-group">
                    <label for="description_en"> وصف الصفحة بالانجليزية</label>
                    
                    <textarea  class="form-control " name="description_en" id="description_en" placeholder="ادخل وصف الصفحة بالانجليزية"  style="border-radius: 6px;"></textarea>

                    @error('description_en')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>
            <!----------------------------------------------------->
               <div class="form-group">
                    <label for="content_ar">المحتوى</label>
                    <textarea  class="form-control tinymce-editor" name="content_ar" id="content_ar" placeholder="ادخل محتوى الصفحة "  ></textarea>
                    @error('content_ar')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>
            <!----------------------------------------------------->
                <div class="form-group">
                    <label for="content_en"> المحتوى بالانجليزية </label>
                    <textarea  class="form-control tinymce-editor" name="content_en" id="content_en" placeholder="ادخل محتوى الصفحة بالانجليزية "  ></textarea>
                    @error('content_en')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>
             <!----------------------------------------------------->
               <div class="form-group">
                    <label for="image">الحالـة</label>
                    <select class="form-control" name="status"  required>
                            <option value="1">مُفعلة</option>
                            <option value="0">غير مُفعلة</option>
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
@endsection

<!-- tinymce -->
<script src="{{ URL::asset('assets/tinymce/tinymce.min.js') }}"></script>
<script>
    tinymce.init({
        selector: 'textarea.tinymce-editor',
        height: 300,
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


