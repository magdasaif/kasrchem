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
                    <select  class="form-control sub2"  id="section_id" name="section_id" >
                        <option value="0">جميع الاقسام</option>
                         @foreach ($sections as $sec)
                            <option value="{{ $sec->id }}">{{ $sec->site_name_ar }}</option>
                         @endforeach
                    </select>
                    @else
                    <input type="test" class="form-control"  value="{{ $sections->site_name_ar }}" disabled>
                    @endif 
                </div>
                
                <div class="form-group">
                     <label for="exampleInputEmail1"> التصنيف الرئيسى</label>
                     
                         @if($from_side_or_no=='yes')
                        <select class="form-control" id="cate_id" name="cate_id" required >
                            <option value="" selected disable>كل التصنيفات</option>
                            @foreach ($sub1_categories as $category)
                                <option value="{{ $category->id }}">{{ $category->subname_ar }}</option>
                            @endforeach
                        </select>
                         <!----------------------------------------------------->
                         @else
                            <input type="test" class="form-control"  value="{{ $sub1_categories->subname_ar }}" disabled>
                        @endif
                </div>
                
                <div class="form-group">
                   
                    <label for="exampleInputEmail1">اسم التصنيف الفرعي</label>
                        @if($from_side_or_no=='yes')
                        <select class="form-control" id="sub2_id" name="sub2_id" required >
                            <option value="" selected disable>كل الانواع الفرعيه</option>
                            @foreach ($Sub_Category2 as $sub2)
                                <option value="{{ $sub2->id }}">{{ $sub2->subname2_ar }}</option>
                            @endforeach
                        </select>
                        <!----------------------------------------------------->
                        @else
                        <input type="text" class="form-control" name="sub2_name" id="sub2_name" value="{{ $Sub_Category2->subname2_ar }}" disabled="disabled" >

                       @endif
                </div>

                
                <div class="form-group">
                <label for="exampleInputEmail1">اسم النوع الرئيسى</label>
                      @if($from_side_or_no=='yes')
                        <select class="form-control" id="sub3_id" name="sub3_id" required >
                            <option value="" selected disable>كل الانواع الرئيسيه</option>
                            @foreach ($sub_Category3 as $sub3)
                                <option value="{{ $sub3->id }}">{{ $sub3->subname_ar }}</option>
                            @endforeach
                        </select>
                        <!----------------------------------------------------->
                        @else
                        <input type="text" class="form-control" name="sub3_name" id="sub3_name" value="{{ $sub_Category3->subname_ar }}" disabled="disabled" >
                        <input type="text" class="form-control" name="sub3_id" id="sub3_id" value="{{ $sub_Category3->id}}" hidden>
                        @endif
                </div>
               
                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم النوع الفرعى  بالعربيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="subname_ar" required>
                    @error('subname_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم النوع الفرعى بالانجليزيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="subname_en" required>
                    @error('subname_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>



                <div class="form-group">
                <label for="exampleInputEmail1">الحالة</label>
                    <select class="form-control" name="status">
                            <option value="1">مُفعل</option>
                            <option value="0">غير مُفعل</option>
                    </select>
                </div>
                
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
                    //  alert(data);
                         $('#sub2_id').empty();
                        $('#cate_id').empty();
                        $('#cate_id').append('<option value="" disabled="true" selected="true">اختر التصنيف الرئيسى</option>');
                        $.each(data, function (key, value) {
                            //alert('<option value="' + key + '">' + value + '</option>');
                        $('#cate_id').append('<option value="' + key + '">' + value + '</option>');
                        });
                    
                },
                error:function()
                { alert("false"); }
            });
    });

    //-----------------------------------------------------------------
    
    $('select[name="cate_id"]').on('change', function () {
        // alert('ssss');
        var cate_id = $(this).val();
            // alert(section_id);
            // alert("{{ URL::to('fetch_sub1')}}/" + section_id);
            
            $.ajax({
                type: "GET",
                url: "{{ URL::to('fetch_sub2')}}/" + cate_id,
                dataType: "json",
                success: function (data) 
                {
                    //  alert(data);
                        $('#sub2_id').empty();
                        $('#sub2_id').append('<option value="" disabled="true" selected="true">اختر التصنيف الفرعى</option>');
                        $.each(data, function (key, value) {
                            //alert('<option value="' + key + '">' + value + '</option>');
                        $('#sub2_id').append('<option value="' + key + '">' + value + '</option>');
                        });
                    
                },
                error:function()
                { alert("false"); }
            });
    });
    
});
  //---------------for show seelct option of sub3------------------------//
  $(document).ready(function () {
            $('select[name="sub2_id"]').on('change', function () {
                var sub2_id = $(this).val();
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
                             $('select[name="sub3_id"]').empty();
                             $('select[name="sub3_id"]').append('<option value="" disabled="true" selected="true">اختر النوع الرئيسى</option>');
                               $.each(data, function (key, value) {
                              $('select[name="sub3_id"]').append('<option value="' + key + '">' + value + '</option>');
                             });
                         
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
        
        //-------------
</script>
