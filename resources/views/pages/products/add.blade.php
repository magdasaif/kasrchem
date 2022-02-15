@extends('layouts.master')
@section('title')
<title>لوحة التحكم : {{$title}}</title>
 @endsection
@section('content')
<div>
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
                <h3 class="card-title">{{$title}}</h3>
              </div>
 <!--#############################################################-->
        <div class="modal-body">
            
            <form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
             @csrf

             <!-- <div style="    text-align: center;color: red;font-size: x-large;">تاكد من ادخال (تصنيف فرعى ونوع رئيسى ونوع فرعى ) للتصنيف الرئيسى المراد اختياره </div>
             <hr> -->
   <!----------------------------------------------------->
            <!--========================================================-->
            @include('categories.Category_models.select_category_adding')
              <!--========================================================-->
               <!----------------------------------------------------->
                <div class="form-group">
                    <label for="exampleInputEmail1">الموردين</label> <span style="font-size: initial;color: red;"> [ قم بتحديد الموردين ] </span>
                    <select class="form-control" name="supplier_id[]"  multiple required>
                        @foreach ($suppliers as $supplier)
                             <option value="{{ $supplier->id }}" {{ (collect(old('supplier_id'))->contains($supplier->id)) ? 'selected':'' }}>{{ $supplier->name_ar }}</option>
                        @endforeach
                    </select>
                </div>
                <hr>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم المنتج بالعربيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="name_ar" value="{{ old('name_ar') }}" required>
                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم المنتج بالانجليزيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="name_en" value="{{ old('name_en') }}" required>
                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">وصف المنتج بالعربيه</label>
                    <textarea class="form-control tinymce-editor" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter descrption" name="desc_ar" >{!! old('desc_ar')!!}</textarea>
                    @error('desc_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">وصف المنتج بالانجليزيه</label>
                    <textarea class="form-control tinymce-editor" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter descrption" name="desc_en" >{!! old('desc_en')!!}</textarea>
                    @error('desc_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror

                   

                </div>

                <hr>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">صورة المنتج الاساسية *</label>

                    <input type="file" class="form-control" name="image" accept="image/*" required>

                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">صور المنتج الفرعيه</label>

                    <input type="file" class="form-control" name="photos[]" accept="image/*" multiple>

                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">ملفات المنتج</label>

                    <input type="file" class="form-control" name="product_files[]" accept=".pdf" multiple >

                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">رابط فيديو للمنتج</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="video_link" value="{{old('video_link')}}">
                    @error('video_link')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <hr>

                <div class="form-group">
                    <label for="exampleInputEmail1">ترتيب المنتج</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="sort" value="<?php if(old('sort')){echo old('sort');}else{echo'0';}?>">
                    @error('sort')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <hr>

                <div class="form-group">
                    <label for="exampleInputEmail1">الحالة</label>
                    <select class="form-control" name="status" style="height: 50px;">
                            <option value="1" {{ old('status') == '1' ? "selected" : "" }}>مُفعل</option>
                            <option value="0" {{ old('status') == '0' ? "selected" : "" }}>غير مُفعل</option>
                    </select>
                </div>
<!----------------------------------------------------------------------------->
<div style="display:none">

                <div class="form-group">
                    <label for="exampleInputEmail1">كود المنتج</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter code" name="code" value="<?php if(old('code')){echo old('code');}else{echo'0';}?>" >
                    @error('code')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">سعر المنتج</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="price" value="<?php if(old('price')){echo old('price');}else{echo'0';}?>">
                    @error('price')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">الضريبه %</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="tax" value="<?php if(old('tax')){echo old('tax');}else{echo'0';}?>">
                    @error('tax')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">سعر العرض ان وُجد</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="offer_price" value="<?php if(old('offer_price')){echo old('offer_price');}else{echo'0';}?>">
                    @error('offer_price')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">الكمية المتاحة</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="amount" value="1" >
                    @error('amount')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">الحد الادني</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="min_amount" value="1" >
                    @error('min_amount')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">الحد الاقصي</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="max_amount" value="1" >
                    @error('max_amount')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
               
                
                <div class="form-group">
                    <label for="exampleInputEmail1">البيع من خلال</label>
                    <select class="form-control" name="sell_through"  style="height: 50px;">
                            <option value="1" {{ old('sell_through') == '1' ? "selected" : "" }}>الموقع والفروع</option>
                            <option value="2" {{ old('sell_through') == '2' ? "selected" : "" }}>الموقع فقط</option>
                            <option value="3" {{ old('sell_through') == '3' ? "selected" : "" }}>الفروع فقط</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">الوزن القائم عند الشحن بالكيلو جرام</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="shipped_weight" value="0" >
                    @error('shipped_weight')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                


                <div class="form-group">
                <label for="exampleInputEmail1">الاتاحة</label>
                    <select class="form-control" name="availabe_or_no" style="height: 50px;">
                            <option value="1" {{ old('availabe_or_no') == '1' ? "selected" : "" }}>متاح</option>
                            <option value="0" {{ old('availabe_or_no') == '0' ? "selected" : "" }}>غير متاح</option>
                    </select>
                </div>

                <div class="form-group">
                <label for="exampleInputEmail1"> يتطلب تصريح امنى</label>
                      <input type="checkbox" class="form-control" id="exampleInputEmail1"  name="security_permit" style="width: 100px;height: 20px;margin-right: 100px;" {{ old('security_permit') == 'on' ? "checked" : "" }}>
                </div>
                
                <!--------------------------------------------------------------------------->
                 <!-------------------------------------------------------------------------->
        <div class="form repeater-default">
            <label for="exampleInputEmail1">اضافه خصائص المنتج</label>
            
                <div data-repeater-list="List_Classes">
                    <div data-repeater-item>
                    <div class="row justify-content-between">
                            
                             <div class="col-md-2 col-sm-12 form-group">
                                <input class="form-control" type="text" name="weight_ar"  placeholder="الخاصيه مثال : الوزن" value="{{old('weight_ar')}}"/>
                                @error('weight_ar') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-2 col-sm-12 form-group">
                                <input class="form-control" type="text" name="value_ar" placeholder="القيمة (مثال : 10كجم)" value="{{old('value_ar')}}"/>
                                @error('value_ar') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-2 col-sm-12 form-group">
                                <input class="form-control" type="text" name="weight_en" placeholder="الخاصية بالانجليزية (مثال : weight)" value="{{old('weight_en')}}"/>
                                @error('weight_en') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-2 col-sm-12 form-group">
                                <input class="form-control" type="text" name="value_en" placeholder="القيمة بالانجليزيه (مثال : 10كجم)" value="{{old('value_en')}}"/>
                                @error('value_en') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                                        
                        
                        <div class="col-md-2 col-sm-12 form-group d-flex align-items-center pt-2">
                        <button class="btn btn-danger" data-repeater-delete type="button"> <i class="bx bx-x"></i>
                            حذف
                        </button>
                        </div>
                    </div>
                    <hr>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col p-0">
                    <center><button class="btn btn-success" data-repeater-create type="button"><i class="bx bx-plus"></i>
                        اضافه خاصيه
                    </button></center>
                    </div>
                </div>
        </div>
        
</div>
                <!-------------------------------------------------------------------------->
                <!--------------------------------------------------------------------------->

                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">اضافه</button>
                        <a href="{{route('products.index')}}"><button type="button" class="btn btn-danger"  > الغاء</button></a>

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
</div>
@endsection
<script src="{{ URL::asset('assets/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>

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
                    { //لو فى تصنيف رئيسى للقسم هيعرضه 

                        //هيخفى ويفضى اى حاجه تحته
                        $("#sub1_requi").hide();
                        $('#main_category_id').empty();
                        
                        $('select[name="main_category"]').show();
                        
                        $("#sub2_requi").hide();
                        $('#sub2_sel').empty();
                        
                        $("#sub3_requi").hide();
                        $('#sub3_sel').empty();
                        
                        $("#sub4_requi").hide();
                        $('#sub4_sel').empty();
                        
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
                        
                        $("#sub3_requi").hide();
                        $('#sub3_sel').empty();
                        
                        $("#sub4_requi").hide();
                        $('#sub4_sel').empty();

                        
                       
                            //-------------get name of section--------------//
                                document.getElementById("section_id").value=section_id; 
                                //  alert($( "#main_category_id option:selected" ).text()); //بيجيب قيمة الاوبشن المختارة
                                 document.getElementById("new_main_name").value=$("#section_id2 option:selected" ).text(); 
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
    document.getElementById("new_main_name").value=$("#section_id2 option:selected" ).text(); 
    document.getElementById("test").value=$("#main_category_id option:selected" ).text();
    document.getElementById("sub2_name").value=$("#sub2_sel option:selected" ).text();
    document.getElementById("sub3_name").value=$("#sub3_sel option:selected" ).text(); 

    if($("#sub1_requi").css('display')=='block'){

        $("#sub2_requi").hide();
        $('#sub2_sel').empty();
        
        $("#sub3_requi").hide();
        $('#sub3_sel').empty();
        
        $("#sub4_requi").hide();
        $('#sub4_sel').empty();
    }

    if($("#sub2_requi").css('display')=='block'){
        $("#sub3_requi").hide();
        $('#sub3_sel').empty();
        
        $("#sub4_requi").hide();
        $('#sub4_sel').empty();
    }

    if($("#sub3_requi").css('display')=='block'){
        $("#sub4_requi").hide();
        $('#sub4_sel').empty();
    }

    
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
                             if(data!='')
                            {
                                $('select[name="sub2"]').show();
                                $("#sub2_requi").hide();

                                //هيخفى ويفضى اى حاجه تحته
                                                                
                                $("#sub3_requi").hide();
                                $('#sub3_sel').empty();
                                
                                $("#sub4_requi").hide();
                                $('#sub4_sel').empty();
                        
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

                                //هيخفى ويفضى اى حاجه تحته
                                                                                                
                                $("#sub3_requi").hide();
                                $('#sub3_sel').empty();
                                
                                $("#sub4_requi").hide();
                                $('#sub4_sel').empty();
                                 
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
                             //--------------------------------------------//
                             if(data!='')
                            {
                                $('select[name="sub3"]').show();
                                $("#sub3_requi").hide();

                                //هيخفى ويفضى اى حاجه تحته
                                $("#sub4_requi").hide();
                                $('#sub4_sel').empty();
                                
                                $('select[name="sub3"]').append('<option value="" disabled="true" selected="true">اختر النوع</option>');
                               $.each(data, function (key, value) {
                              $('select[name="sub3"]').append('<option value="' + key + '">' + value + '</option>');
                             });

                            }
                            else
                            {
                                $('select[name="sub3"]').hide();//hide select 
                                 $("#sub3_requi").show();//show div if sub2not founded

                                  //هيخفى ويفضى اى حاجه تحته
                                $("#sub4_requi").hide();
                                $('#sub4_sel').empty();
                                
                                    //-------------get name of sub2--------------//
                                   // alert(sub2_id);
                                    document.getElementById("section_id2").value=section_id;
                                    document.getElementById("cate_id2").value=cate_id;
                                    document.getElementById("sub2_id").value=sub2_id; 
                                     //  alert($( "#sub2_sel option:selected" ).text());
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

                                        document.getElementById("sub2_id2").value=sub2_id; 
                                        document.getElementById("section_id22").value=section_id;
                                        document.getElementById("cate_id22").value=cate_id;
                                       document.getElementById("sub3_id").value=sub3_id; 
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

