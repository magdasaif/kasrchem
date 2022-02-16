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
@endsection
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<!-- tinymce -->
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
  //---------------for show seelct option of sub2------------------------//
  $(document).ready(function () {
    $('select[name="section_id"]').on('change', function () {
        // alert('ssss');
        var section_id = $(this).val();
            // alert(section_id);
            // alert("{{ URL::to('fetch_sub1')}}/" + section_id);

            $.ajax({
                type: "GET",
                url: "{{ URL::to('fetch_sub1')}}/" + section_id,
                dataType: "json",
                success: function (data)
                {



                    if(data!='')
                    {
                        $("#sub1_requi").hide();
                        $('select[name="main_category"]').show();
                        $('#main_category_id').empty();

                        //هيخفى ويفضى اى حاجه تحته
                        $("#sub2_requi").hide();
                        $('#sub2_sel').empty();
                        $('#sub2_sel').show();

                        $("#sub3_requi").hide();
                        $('#sub3_sel').empty();
                        $('#sub3_sel').show();

                        $("#sub4_requi").hide();
                        $('#sub4_sel').empty();
                        $('#sub4_sel').show();

                              //لو فى تصنيف رئيسى للقسم هيعرضه
                        $('#main_category_id').append('<option value="" disabled="true" selected="true">اختر التصنيف الرئيسى</option>');
                        $.each(data, function (key, value) {
                            //alert('<option value="' + key + '">' + value + '</option>');
                        $('#main_category_id').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                    else
                    {
                        // alert("لا يوجـد تصنيف رئيسى للقسم المختار من فضلك قم باضافته اولا");
                        $('select[name="main_category"]').hide();//hide select
                            $("#sub1_requi").show();//show div if sub1not founded

                            $("#sub2_requi").hide();
                            $('#sub2_sel').empty();
                            $('#sub2_sel').show();

                            $("#sub3_requi").hide();
                            $('#sub3_sel').empty();
                            $('#sub3_sel').show();

                            $("#sub4_requi").hide();
                            $('#sub4_sel').empty();
                            $('#sub4_sel').show();
                            //-------------get name of section--------------//
                                document.getElementById("section_id").value=section_id;
                                //  alert($( "#main_category_id option:selected" ).text()); //بيجيب قيمة الاوبشن المختارة
                                 document.getElementById("new_main_name").value=$("#section_sel option:selected" ).text();
                            //----------------------------//
                    }

                },
                error:function()
                { alert("false"); }
            });
    });
    //---------------------to get value if not making change in select------------------------
    //save section id value to return back with it
    var section_id = $('select[name="section_id"]').val();
    document.getElementById("section_id").value=section_id;
    document.getElementById("section_id1").value=section_id;
    document.getElementById("section_id2").value=section_id;
    document.getElementById("section_id22").value=section_id;
    //alert(section_id);

    //save main category id value to return back with it
    var cate_id = $('select[name="main_category"]').val();
    document.getElementById("cate_id").value=cate_id;
    document.getElementById("cate_id2").value=cate_id;
    document.getElementById("cate_id22").value=cate_id;
   // alert(cate_id);


   var sub2_id = $('select[name="sub2"]').val();
   document.getElementById("sub2_id").value=sub2_id;
   document.getElementById("sub2_id2").value=sub2_id;



   var sub3_id = $('select[name="sub3"]').val();
   document.getElementById("sub3_id").value=sub3_id;

    //read value of selected sub category
    document.getElementById("new_main_name").value=$("#section_sel option:selected" ).text();
    document.getElementById("test").value=$("#main_category_id option:selected" ).text();
    document.getElementById("sub2_name").value=$("#sub2_sel option:selected" ).text();
    document.getElementById("sub3_name").value=$("#sub3_sel option:selected" ).text();

    if($("#sub1_requi").css('display')=='block'){

    $("#sub2_requi").hide();
    $('#sub2_sel').empty();
    $('#sub2_sel').show();

    $("#sub3_requi").hide();
    $('#sub3_sel').empty();
    $('#sub3_sel').show();

    $("#sub4_requi").hide();
    $('#sub4_sel').empty();
    $('#sub4_sel').show();
    }

    if($("#sub2_requi").css('display')=='block'){
    $("#sub3_requi").hide();
    $('#sub3_sel').empty();
    $('#sub3_sel').show();

    $("#sub4_requi").hide();
    $('#sub4_sel').empty();
    $('#sub4_sel').show();
    }

    if($("#sub3_requi").css('display')=='block'){
    $("#sub4_requi").hide();
    $('#sub4_sel').empty();
    $('#sub4_sel').show();
    }


//-----------------------------------------------------------------


    //-----------------------------------------------------------------

            $('select[name="main_category"]').on('change', function () {
                var main_category_id = $(this).val();
                var section_id = $('select[name="section_id"]').val();
            // alert(main_category_id);
             // alert($( "#main_category_id option:selected" ).text());
              if (main_category_id=='')
             {
                $("#main_error").show();

             }else
             {
               if (main_category_id ) {
                 // alert("{{ URL::to('fetch_sub2')}}/" + main_category_id);

                    $.ajax({
                        type: "GET",
                        url: "{{ URL::to('fetch_sub2')}}/" + main_category_id,
                        dataType: "json",

                        success: function (data)
                        {
                            //alert("true");
                            // $("#all").show();
                            // $("#sub2_div").show();

                           // alert("data="+data) ;
                           // alert(main_category_id);
                            $('select[name="sub2"]').empty();
                             //--------------------------------------------//

                             //هيخفى ويفضى اى حاجه تحته

                            $("#sub3_requi").hide();
                            $('#sub3_sel').empty();
                            $('#sub3_sel').show();

                            $("#sub4_requi").hide();
                            $('#sub4_sel').empty();
                            $('#sub4_sel').show();

                             if(data!='')
                            {
                                $('select[name="sub2"]').show();
                                $("#sub2_requi").hide();

                                $('select[name="sub2"]').append('<option value="" disabled="true" selected="true">اختر التصنيف الفرعي</option>');
                                $.each(data, function (key, value)
                                {
                                   $('select[name="sub2"]').append('<option value="' + key + '">' + value + '</option>');
                                });

                            }
                            else
                            {
                               // alert("لا يوجـد تصنيف فرعى للتصنيف الرئيسي المختار من فضلك قم باضافته اولا");
                                $('select[name="sub2"]').hide();//hide select
                                 $("#sub2_requi").show();//show div if sub2not founded
                                    //-------------get name of main_category--------------//

                                    document.getElementById("section_id1").value=section_id;
                                    document.getElementById("cate_id").value=main_category_id;
                                    //  alert($( "#main_category_id option:selected" ).text()); //بيجيب قيمة الاوبشن المختارة
                                    document.getElementById("test").value=$("#main_category_id option:selected" ).text();
                                //----------------------------//



                            }
                         //--------------------------------------------//
                        },
                        error:function()
                        { alert("false"); }
                    });

                }
                else {
                    alert('AJAX load did not work');
                }

            }
            });


         //---------------for show seelct option of sub3------------------------//

            $('select[name="sub2"]').on('change', function () {
                var sub2_id = $(this).val();
                var section_id = $('select[name="section_id"]').val();
                var cate_id = $('select[name="main_category"]').val();
               // alert(sub2_id);
               if (sub2_id) {

                    $.ajax({
                        type: "GET",
                        url: "{{ URL::to('fetch_sub3')}}/" + sub2_id,
                        dataType: "json",

                        success: function (data)
                        {
                             //alert("true");
                          // $("#sub3_div").show();
                             $('select[name="sub3"]').empty();

                             //هيخفى ويفضى اى حاجه تحته
                             $("#sub4_requi").hide();
                                $('#sub4_sel').empty();
                                $('#sub4_sel').show();

                             //--------------------------------------------//
                             if(data!='')
                            {
                                $('select[name="sub3"]').show();
                                $("#sub3_requi").hide();

                                $('select[name="sub3"]').append('<option value="" disabled="true" selected="true">اختر النوع</option>');
                               $.each(data, function (key, value) {
                              $('select[name="sub3"]').append('<option value="' + key + '">' + value + '</option>');
                             });

                            }
                            else
                            {
                                $('select[name="sub3"]').hide();//hide select
                                 $("#sub3_requi").show();//show div if sub2not founded
                                    //-------------get name of sub2--------------//
                                   // alert(sub2_id);
                                        document.getElementById("sub2_id").value=sub2_id;
                                        document.getElementById("section_id2").value=section_id;
                                        document.getElementById("cate_id2").value=cate_id;
                                        document.getElementById("sub2_name").value=$("#sub2_sel option:selected" ).text();
                                    //----------------------------------------------------//
                            }
                             //--------------------------------------------//


                        },
                        error:function()
                        { alert("false"); }
                    });

                }
                else {
                    alert('AJAX load did not work');
                }
            });

        //---------------for show seelct option of sub4------------------------//

            $('select[name="sub3"]').on('change', function () {
                var sub3_id = $(this).val();
                var section_id = $('select[name="section_id"]').val();
                var cate_id = $('select[name="main_category"]').val();
                var sub2_id = $('select[name="sub2"]').val();
                //alert (sub3_id);
               if (sub3_id) {
                  // alert("{{ URL::to('fetch_sub4')}}/" + sub3_id);

                    $.ajax({
                        type: "GET",
                        url: "{{ URL::to('fetch_sub4')}}/" + sub3_id,
                        dataType: "json",

                        success: function (data)
                        {
                             //alert("true");
                           // $("#sub4_div").show();
                             $('select[name="sub4"]').empty();
                              //--------------------------------------------//
                              if(data!='')
                            {
                                $('select[name="sub4"]').show();
                                $("#sub4_requi").hide();

                                $('select[name="sub4"]').append('<option value="" disabled="true" selected="true">اختر النوع الفرعى</option>');
                               $.each(data, function (key, value) {
                              $('select[name="sub4"]').append('<option value="' + key + '">' + value + '</option>');
                             });

                            }
                            else
                            {
                                $('select[name="sub4"]').hide();//hide select
                                 $("#sub4_requi").show();//show div if sub2not founded
                                    //-------------get name of sub2--------------//
                                       document.getElementById("sub3_id").value=sub3_id;

                                        document.getElementById("sub2_id2").value=sub2_id;
                                        document.getElementById("section_id22").value=section_id;
                                        document.getElementById("cate_id22").value=cate_id;
                                        document.getElementById("sub3_name").value=$("#sub3_sel option:selected" ).text();

                                   //----------------------------------------------------//
                            }
                             //--------------------------------------------//


                        },
                        error:function()
                        { alert("false"); }
                    });

                }
                else {
                    alert('AJAX load did not work');
                }
            });


        });

        //--------------------------------------------------------------------------//
    </script>


