@extends('layouts.master')
@section('title')
<title>لوحة التحكم : اضافه نوع فرعى</title>
 @endsection
@section('content')
<template>
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
              <div class="card-header">
                <h3 class="card-title"> اضافه نوع فرعي</h3>
              </div>
 <!--#############################################################-->
 <div class="modal-body">
       
            <form method="POST" action="{{route('categories4.store')}}" enctype="multipart/form-data">
             @csrf
                
                <div class="form-group">    
                    <label>  اقسام الموقع </label>
                    @if($from_side_or_no=='yes')
                    <select  class="form-control sub2"  id="section_id2" name="section_id" >
                        <option value="0">جميع الاقسام</option>
                         @foreach ($sections as $sec)
                            <option value="{{ $sec->id }}" <?php if($sec->id == Session::get('section_id')){echo 'selected';}?>>{{ $sec->site_name_ar }}</option>
                         @endforeach
                    </select>
                    @else
                    <input type="text" class="form-control"  value="{{ $sections->site_name_ar }}" disabled>
                    @endif 
                </div>
                
                <div class="form-group">
                     <label for="exampleInputEmail1"> التصنيف الرئيسى</label>
                     
                        @if($from_side_or_no=='yes')
                        <select class="form-control" id="cate_id2" name="cate_id" required >
                            <option value="" selected disable>كل التصنيفات</option>
                            @foreach ($sub1_categories as $category)
                                <option value="{{ $category->id }}" <?php if($category->id == Session::get('cate_id')){echo 'selected';}else{echo 'hidden';}?>>{{ $category->subname_ar }}</option>
                            @endforeach
                        </select>
                         <!-----------------add new cate if no category found for this section------------------------------------>
                         <div class="form-control" id="sub1_requi" style="display:none;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد تصنيف رئيسى للقسم المختار من فضلك قم باضافته اولا</span>
                             <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal0" style="margin-right: 23px;font-weight: bold;"></i>
                        </div>
                         <!----------------------------------------------------->
                         @else
                            <input type="text" class="form-control"  value="{{ $sub1_categories->subname_ar }}" disabled>
                        @endif
                </div>
                
                <div class="form-group">
                   
                    <label for="exampleInputEmail1">اسم التصنيف الفرعي</label>
                    @if($from_side_or_no=='yes')
                            @if(Session::get('cate_id') && !Session::get('sub2_id'))
                             <!-----------------add new cate if no category found for this section------------------------------------>
                            <div class="form-control" id="sub2_requi"><span style="color:#d54646;font-weight: bold;"> لا يوجـد تصنيف فرعى للتصنيف الرئيسي المختار من فضلك قم باضافته اولا</span>
                                <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal" style="margin-right: 23px;font-weight: bold;"></i>
                            </div>
                            <!----------------------------------------------------->
                            @else
                            <select class="form-control" id="sub2_id2" name="sub2_id" required >
                                <option value="" selected disable>اختر التصنيف الفرعى</option>
                                @foreach ($Sub_Category2 as $sub2)
                                    <option value="{{ $sub2->id }}" <?php if($sub2->id == Session::get('sub2_id')){echo 'selected';}else{echo 'hidden';}?>>{{ $sub2->subname2_ar }}</option>
                                @endforeach
                            </select>
                           
                              <!-----------------add new cate if no category found for this section------------------------------------>
                              <div class="form-control" id="sub2_requi" style="display:none;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد تصنيف فرعى للتصنيف الرئيسي المختار من فضلك قم باضافته اولا</span>
                                <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal" style="margin-right: 23px;font-weight: bold;"></i>
                            </div>
                            <!----------------------------------------------------->
                            @endif
                        <!----------------------------------------------------->
                        @else
                        <input type="text" class="form-control" name="sub2_id"  value="{{ $Sub_Category2->id}}" hidden>
                        <input type="text" class="form-control" name="sub2_name"  value="{{ $Sub_Category2->subname2_ar }}" disabled="disabled" >
                       @endif
                </div>

                
                <div class="form-group">
                <label for="exampleInputEmail1">اسم النوع الرئيسى</label>
                      @if($from_side_or_no=='yes')
                        @if(Session::get('cate_id') && Session::get('sub2_id') && !Session::get('sub3_id'))
                             <!-----------------add new cate if no category found for this section------------------------------------>
                            <div class="form-control" id="sub3_requi"><span style="color:#d54646;font-weight: bold;"> لا يوجـد نوع رئيسي للتصنيف الفرعي المختار من فضلك قم باضافته اولا</span>
                                <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal3" style="margin-right: 23px;font-weight: bold;"></i>
                            </div>
                            <!----------------------------------------------------->
                            @else
                            <select class="form-control" id="sub3_id2" name="sub3_id" required >
                                <option value="" selected disable>كل الانواع الرئيسيه</option>
                                @foreach ($sub_Category3 as $sub3)
                                    <option value="{{ $sub3->id }}" <?php if($sub3->id == Session::get('sub3_id')){echo 'selected';}else{echo 'hidden';}?>>{{ $sub3->subname_ar }}</option>
                                @endforeach
                            </select>
                        
                            <!----------------------------------------------------->
                            <div class="form-control" id="sub3_requi" style="display:none;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد نوع رئيسي للتصنيف الفرعي المختار من فضلك قم باضافته اولا</span>
                                <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal3" style="margin-right: 23px;font-weight: bold;"></i>
                            </div>
                         <!----------------------------------------------------->
                        @endif
                        <!----------------------------------------------------->
                        @else
                        <input type="text" class="form-control" name="sub3_name" id="sub3_name" value="{{ $sub_Category3->subname_ar }}" disabled="disabled" >
                        <input type="text" class="form-control" name="sub3_id" id="sub3_id2" value="{{ $sub_Category3->id}}" hidden>
                        @endif
                </div>
               
                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم النوع الفرعى  بالعربيه</label>
                    <input type="text" class="form-control"  aria-describedby="emailHelp"  name="subname_ar"  value="{{ old('subname_ar') }}" id="regax_name_ar" onkeyup="check_regax_name_ar();" onkeypress="return CheckArabicCharactersOnly(event);"   required oninvalid="this.setCustomValidity('يجب ان يكون اسم النوع الفرعى باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name"> يجب ان يكون اسم النوع الفرعى باللغة العربية وايضا لا يكون ارقام فقط</span>

                    @error('subname_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم النوع الفرعى بالانجليزيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="subname_en"  value="{{ old('subname_en') }}" required onkeypress="return CheckEnglishCharactersOnly(event);" pattern="^(?=.*[a-zA-Z])[a-zA-Z0-9]+$" oninvalid="this.setCustomValidity('يجب ان يكون اسم النوع الفرعى باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">

                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون اسم النوع الفرعى باللغة الانجليزية وايضا لا يكون ارقام فقط</span>
                    @error('subname_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>



                <div class="form-group">
                <label for="exampleInputEmail1">الحالة</label>
                    <select class="form-control" name="status">
                    <option value="1" {{ old('status') == '1' ? "selected" : "" }}>مُفعل</option>
                     <option value="0" {{ old('status') == '0' ? "selected" : "" }}>غير مُفعل</option>
                    </select>
                </div>
                
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
</template>
@endsection
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('/js/regax_name/regax_name.js') }}"></script>
<!-- <script src="{{ URL::asset('/js/regax_name/regax_name _model.js') }}"></script> -->
<script>
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
                        $('select[name="cate_id"]').show();
                        $('#cate_id2').empty();
                              //لو فى تصنيف رئيسى للقسم هيعرضه  
                        $('#cate_id2').append('<option value="" disabled="true" selected="true">اختر التصنيف الرئيسى</option>');
                        $.each(data, function (key, value) {
                            //alert('<option value="' + key + '">' + value + '</option>');
                        $('#cate_id2').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                    else
                    {
                        // alert("لا يوجـد تصنيف رئيسى للقسم المختار من فضلك قم باضافته اولا");
                        $('select[name="cate_id"]').hide();//hide select 
                            $("#sub1_requi").show();//show div if sub1not founded
                            //-------------get name of section--------------//
                             //  document.getElementById("section_id2").value=section_id; 
                                document.getElementById("section_id1").value=section_id; 
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
    document.getElementById("section_id1").value=section_id;
    //alert(section_id);

    //save main category id value to return back with it
    var cate_id = $('select[name="cate_id"]').val();
    document.getElementById("cate_id").value=cate_id;
   // alert(cate_id);
    
    //read value of selected sub category
    document.getElementById("test").value=$("#cate_id2 option:selected" ).text();
    //-----------------------------------------------------------------
    //-----------------------------------------------------------------

    $('select[name="cate_id"]').on('change', function () {
        // alert('ssss');
        var cate_id = $(this).val();
        var section_id = $('select[name="section_id"]').val();
            // alert(section_id);
            // alert("{{ URL::to('fetch_sub1')}}/" + section_id);
            
            $.ajax({
                type: "GET",
                url: "{{ URL::to('fetch_sub2')}}/" + cate_id,
                dataType: "json",
                success: function (data) 
                {
                    //  alert(data);
                    if(data!='')
                    {
                        $("#sub2_requi").hide();
                        $('select[name="sub2_id"]').show();
                        $('#sub2_id2').empty();
                        $('#sub2_id2').append('<option value="" disabled="true" selected="true">اختر التصنيف الفرعى</option>');
                        $.each(data, function (key, value) {
                            //alert('<option value="' + key + '">' + value + '</option>');
                        $('#sub2_id2').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }else{
                         // alert("لا يوجـد تصنيف فرعى للتصنيف الرئيسى المختار من فضلك قم باضافته اولا");
                         $('select[name="sub2_id"]').hide();//hide select 
                            $("#sub2_requi").show();//show div if sub1not founded
                            //-------------get name of section--------------//
                                document.getElementById("section_id1").value=section_id;
                                document.getElementById("cate_id").value=cate_id;
                                
                               //  alert($( "#main_category_id option:selected" ).text()); //بيجيب قيمة الاوبشن المختارة

                               document.getElementById("test").value=$("#cate_id2 option:selected" ).text(); 
                                
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
    document.getElementById("section_id2").value=section_id;
   // alert(section_id);

    //save main category id value to return back with it
    var cate_id = $('select[name="cate_id"]').val();
    document.getElementById("cate_id2").value=cate_id;
   // alert(cate_id);

   var sub2_id = $('select[name="sub2_id"]').val();
   document.getElementById("sub2_id").value=sub2_id;
   
    //read value of selected sub category
    document.getElementById("sub2_name").value=$("#sub2_id2 option:selected" ).text();
    //-----------------------------------------------------------------
 //---------------for show seelct option of sub3------------------------//
$('select[name="sub2_id"]').on('change', function () {
    var sub2_id = $(this).val();
    var section_id = $('select[name="section_id"]').val();
    var cate_id = $('select[name="cate_id"]').val();
    // alert (sub2_id);
    if (sub2_id) {
        //alert("{{ URL::to('fetch_sub3')}}/" + sub2_id);
        
        $.ajax({
            type: "GET",
            url: "{{ URL::to('fetch_sub3')}}/" + sub2_id,
            dataType: "json",
            
            success: function (data) 
            {
                    //alert("true");
                if(data!='')
                {
                    $("#sub3_requi").hide();
                    $('select[name="sub3_id"]').show();
                    $('select[name="sub3_id"]').empty();
                    $('select[name="sub3_id"]').append('<option value="" disabled="true" selected="true">اختر النوع الرئيسى</option>');
                    $.each(data, function (key, value) {
                    $('select[name="sub3_id"]').append('<option value="' + key + '">' + value + '</option>');
                    });
                }else{
                         // alert("لا يوجـد توع رئيسى للتصنيف الفرعى المختار من فضلك قم باضافته اولا");
                         $('select[name="sub3_id"]').hide();//hide select 
                            $("#sub3_requi").show();//show div if sub1not founded
                            //-------------get name of section--------------//
                                document.getElementById("section_id2").value=section_id;
                                document.getElementById("cate_id2").value=cate_id;
                                document.getElementById("sub2_id").value=sub2_id;
                                
                               //  alert($( "#main_category_id option:selected" ).text()); //بيجيب قيمة الاوبشن المختارة

                               document.getElementById("sub2_name").value=$("#sub2_id2 option:selected" ).text(); 
                                
                           //----------------------------//
                    }
            },
            error:function()
            { alert("false"); }
        });
    }
    });
    
});
</script>
