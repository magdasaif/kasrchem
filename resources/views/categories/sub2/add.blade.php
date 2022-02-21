@extends('layouts.master')
@section('title')
<title>لوحة التحكم : اضافه تصنيف</title>
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
                <h3 class="card-title">اضافه تصنيف فرعى</h3>
              </div>
 <!--#############################################################-->
        <div class="modal-body">
            
            <form method="POST" action="{{route('categories2.store')}}" enctype="multipart/form-data">
            
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
                            <option value="" selected disable>اختر التصنيف الرئيسي</option>
                            @foreach ($sub1_categories as $category)
                                <option value="{{ $category->id }}" <?php if($category->id == Session::get('cate_id')){echo 'selected';}?>>{{ $category->subname_ar }}</option>
                            @endforeach
                        </select>
                        <!-----------------add new cate if no category found for this section------------------------------------>
                        <div class="form-control" id="sub1_requi" style="display:none;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد تصنيف رئيسى للقسم المختار من فضلك قم باضافته اولا</span>
                             <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal0" style="margin-right: 23px;font-weight: bold;"></i>
                        </div>
                         <!----------------------------------------------------->

                         @else
                            <input type="text" class="form-control"  value="{{ $sub1_categories->subname_ar }}" disabled>
                            <input type="hidden" class="form-control" name="cate_id" value="{{ $sub1_categories->id }}">
                        @endif
                </div>

                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم التصنيف بالعربيه</label>
                    <!-- pattern="^[a-zA-Z][a-zA-Z0-9-_]+$" -->
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname2_ar" required>
                    @error('subname2_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم التصنيف بالانجليزيه</label>
                    <!-- pattern="^[\u0621-\u064A\u0660-\u0669a-zA-Z][a-zA-Z0-9-_]+$" -->
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname2_en"   required>
                    @error('subname2_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                
                <div class="form-group">
                    <label for="exampleInputEmail1">صوره</label>

                    <input type="file" class="form-control" name="image" accept="image/*" required>

                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                   <label for="exampleInputEmail1">الحاله</label>
                    <select class="form-control" name="status">
                            <option value="1">مُفعل</option>
                            <option value="0">غير مُفعل</option>
                    </select>
                </div>
                @if($from_side_or_no=='yes')
                <input type="hidden" name="change_redirect" value="yes">
                @endif
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
                     // alert(data);
                    
                    if(data!='')
                    {
                        //لو فى تصنيف رئيسى للقسم هيعرضه  
                        $("#sub1_requi").hide();
                        $('select[name="cate_id"]').show();
                        $('#cate_id2').empty();
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
});
</script>