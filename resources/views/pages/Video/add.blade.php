@extends('layouts.master')
@section('title')
<title>لوحة التحكم : اضافه فيديو</title>
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

            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
            @endif
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> اضافه فيديو</h3>
              </div>
 <!-------------------------------------اضافة الفيديو----------------------------------------------->
 <div class="modal-body">
 <!-- <div style="    text-align: center;color: red;font-size: x-large;">تاكد من ادخال (تصنيف فرعى ونوع رئيسى ونوع فرعى ) للتصنيف الرئيسى المراد اختياره </div>
             <hr> -->
            <form method="POST" action="{{route('video.store')}}" enctype="multipart/form-data">

                @csrf
                <div class="form-group">
                 <label>التصنيف الرئيسى</label>
                 <select class="form-control " name="main_category" id="main_category_id" required  oninvalid="this.setCustomValidity('قم بادخال التصنيف الرئيسي')"  oninput="this.setCustomValidity('')">
                    
                <option value="" disabled="true" selected="true">اختر التصنيف الرئيسي</option>
                   <?php 
                        foreach($Main_Cat as $Main_Category)
                        {
                            // if ($Main_Category->sub_cate2_count>0) 
                            // { 
                    ?>
                              <option  value="{{$Main_Category->id}}">{{$Main_Category->subname_ar}}</option>
                   <?php   
                            // }
                       }
                    ?>
                 </select> 
                 <div  id="main_error" style="color: red;display: none;">قم بادخال التصنيف الرئيسي</div>
                 @error('main_category')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

            <!----------------------------------------------------->
            <input type="hidden" value="" id="selected_main">
        <div  style="display: block">    
                <div class="form-group"  id="sub2_div"   >    
                    <label>   التصنيف الفرعي </label>
                    <select  class="form-control sub2"  id="sub2_sel" name="sub2" required >
                     </select>
                     <div class="form-control" id="sub2_requi" style="display:none;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد تصنيف فرعى للتصنيف الرئيسي المختار من فضلك قم باضافته اولا</span>
                    
                     <i  class="nav-icon fas fa-plus green" type="button"  id="btn_sub2_requi" data-toggle="modal" data-target="#exampleModal" style="margin-right: 23px;font-weight: bold;"></i>
                      </div>
                 </div>
             <!----------------------------------------------------- -->
             
             <div class="form-group"  id="sub3_div" >
                <label>النوع</label>
                 <select  class="form-control sub3"  id="sub3_sel" name="sub3" required  >
                 </select> 
                 <div class="form-control" id="sub3_requi" style="display:none;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد نوع رئيسي للتصنيف الفرعى المختار من فضلك قم باضافته اولا</span>
                    
                    <i  class="nav-icon fas fa-plus green" type="button"  id="btn_sub3_requi" data-toggle="modal" data-target="#exampleModal3" style="margin-right: 23px;font-weight: bold;"></i>
                </div>

                <!----------------------------------------------------- -->
                <div class="form-group"  id="sub4_div" > 
                <label>النوع الفرعى</label>
                    <select  class="form-control sub4"  id="sub4_sel" name="sub4" required  >
     
                    </select>
                    <div class="form-control" id="sub4_requi" style="display:none;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد نوع فرعى للنوع الرئيسي المختار من فضلك قم باضافته اولا</span>
                    
                    <i  class="nav-icon fas fa-plus green" type="button"  id="btn_sub4_requi" data-toggle="modal" data-target="#exampleModal4" style="margin-right: 23px;font-weight: bold;"></i>
                    </div>
            </div>
               <!----------------------------------------------------->
              
               <div class="form-group">
                    <label for="title_ar">عنوان الفيديو </label>
                    <input type="text" class="form-control" id="title_ar" aria-describedby="title_ar" placeholder="ادخل عنوان الفيديو" name="title_ar"     
                value="{{old('title_ar')}}"   required>
                    @error('title_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="title_en">عنوان الفيديو بالانجليزية</label>
                    <input type="text" class="form-control" id="title_en" aria-describedby="title_en" placeholder="ادخل عنوان الفيديو بالانجليزية" name="title_en"  value="{{old('title_en')}}" required>
                    @error('title_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                 <!----------------------------------------------------->
                <div class="form-group">
                <label for="content_ar">رابط الفيديو </label>
                    <input type="text" class="form-control" name="link" value="{{old('link')}}"  required>
                    @error('link')
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
 
            <!-------------MAIN_CATEGORY_MODEL -------------->
             <!-- @include('categories.Category_models.sub2_model') -->

            <!------------------------------------------------>
                @include('categories.Category_models.sub3_model')
            <!------------------------------------------------>
             @include('categories.Category_models.sub4_model')
             <!------------------------------------------------>

 		</div>
            </div>
        </div>
    </div>
</section>
            </div>
@endsection

<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>

<script>
 
    //---------------for show seelct option of sub2------------------------//
     $(document).ready(function () {
            $('select[name="main_category"]').on('change', function () {
                var main_category_id = $(this).val();
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
            
        });
         //---------------for show seelct option of sub3------------------------//
         $(document).ready(function () {
            $('select[name="sub2"]').on('change', function () {
                var sub2_id = $(this).val();
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
        });
        //---------------for show seelct option of sub4------------------------//
        $(document).ready(function () {
            $('select[name="sub3"]').on('change', function () {
                var sub3_id = $(this).val();
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
