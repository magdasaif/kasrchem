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
                    <input type="text" class="form-control" id="title_ar" aria-describedby="title_ar" placeholder="ادخل اسم النشرة" name="title_ar"  value="{{ old('title_ar') }}"required>
                    @error('title_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="title_en">اسم النشرة بالانجليزية</label>
                    <input type="text" class="form-control" id="title_en" aria-describedby="title_en" placeholder="ادخل اسم النشرة بالانجليزية" name="title_en" value="{{ old('title_en') }}" required>
                    @error('title_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                 <!----------------------------------------------------->
                 <div class="form-group">
                    <label for="image">صورة النشرة *</label>
                    <input type="file" class="form-control" name="image" accept="image/*"   value="{{ old('image') }}" required>
                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
             <!----------------------------------------------------->
             <div class="form-group">
                    <label for="image">ملف النشرة *</label>
                    <input type="file" class="form-control" name="file"  accept="application/pdf,application/vnd.ms-excel"  value="{{ old('file') }}" required>
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
@endsection
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script>
//---------------for show seelct option of sub2------------------------//
$(document).ready(function () {

        $('select[name="section_id"]').on('change', function () {
        // alert('ssss');
        var section_id = $(this).val();
          //  alert(section_id);
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

