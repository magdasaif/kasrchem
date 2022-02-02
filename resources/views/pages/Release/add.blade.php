@extends('layouts.master')

@section('css')

@section('title')

اضافة نشرة
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"  style="color: #2569b1;"> اضافة نشرة</h5>
            
        </div>
        <div class="modal-body">

            <form method="POST" action="{{route('release.store')}}" enctype="multipart/form-data">

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}
                  <!----------------------------------------------------->
                
                  <div class="form-group">
                 <label>التصنيف الرئيسى</label>
                <select   class="form-control main_category" id="main_category_id" name="main_category" required>
                    
                    <option value="0" disabled="true" selected="true">اختر التصنيف الرئيسى</option>
                   <?php 
                   foreach($Main_Cat as $Main_Category)
                    { if ($Main_Category->sub_cate2_count>0) 
                        {  ?>
                              <option value="{{$Main_Category->id}}">{{$Main_Category->subname_ar}}</option>
                   <?php }
                }
                      ?>
                 </select> 
                 @error('main_category')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

            <!----------------------------------------------------->
        <div id="all" style="background-color: #e8f2f9;border-radius: 23px;width: 95%; margin: auto;padding: 20px;display: none">    
            <div class="form-group"  id="sub2_div"  style="display: none";>    
                    <label>   التصنيف الفرعي </label>
                    <select  class="form-control sub2"  id="sub2_id" name="sub2" required>
                     </select> 
              </div>

             <!----------------------------------------------------- -->
             
             <div class="form-group"  id="sub3_div"  style="display: none";>
                <label>النوع</label>
                 <select  class="form-control sub3"  id="sub3_id" name="sub3" required>
                 </select> 
                </div>

                <!----------------------------------------------------- -->
                <div class="form-group"  id="sub4_div"  style="display: none";> 
                <label>النوع الفرعى</label>
                    <select  class="form-control sub4"  id="sub4_id" name="sub4" required>

                        
                    </select>
                    </div>
            </div>
               <!----------------------------------------------------->
              
               <div class="form-group">
                    <label for="title_ar">اسم النشرة</label>
                    <input type="text" class="form-control" id="title_ar" aria-describedby="title_ar" placeholder="ادخل اسم النشرة" name="title_ar" required>
                    @error('title_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="title_en">اسم النشرة بالانجليزية</label>
                    <input type="text" class="form-control" id="title_en" aria-describedby="title_en" placeholder="ادخل اسم النشرة بالانجليزية" name="title_en" required>
                    @error('title_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                 <!----------------------------------------------------->
                 <div class="form-group">
                    <label for="image">صورة النشرة</label>
                    <input type="file" class="form-control" name="image" accept="image/*" required>
                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
             <!----------------------------------------------------->
             <div class="form-group">
                    <label for="image">ملف النشرة</label>
                    <input type="file" class="form-control" name="file"  accept="application/pdf,application/vnd.ms-excel" required>
                    @error('file')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
              <!----------------------------------------------------->

                <div class="form-group">
                    <label for="image">الحالـة</label>
                    <select class="form-control" name="status"  required>
                            <option value="1">مُفعل</option>
                            <option value="0">غير مُفعل</option>
                    </select>
                </div>
     
          <!----------------------------------------------------->
         
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">اضافه</button>
                </div>
                </form>
        </div>
        </div>
    </div>
</div>
@endsection
@section('js')

<script>
    
    //---------------for show seelct option of sub2------------------------//
     $(document).ready(function () {
            $('select[name="main_category"]').on('change', function () {
                var main_category_id = $(this).val();
               // alert(main_category_id);
              
               if (main_category_id ) {
                 // alert("{{ URL::to('fetch_sub2')}}/" + main_category_id);
                   
                    $.ajax({
                        type: "GET",
                        url: "{{ URL::to('fetch_sub2')}}/" + main_category_id,
                        dataType: "json",
                      
                        success: function (data) 
                        {
                             //alert("true");
                             
                             $("#all").show();
                            $("#sub2_div").show();
                             $('select[name="sub2"]').empty();
                             $('select[name="sub2"]').append('<option value="0" disabled="true" selected="true">اختر التصنيف الفرعي</option>');
                             $.each(data, function (key, value) {
                              $('select[name="sub2"]').append('<option value="' + key + '">' + value + '</option>');
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
         //---------------for show seelct option of sub3------------------------//
         $(document).ready(function () {
            $('select[name="sub2"]').on('change', function () {
                var sub2_id = $(this).val();
                 // alert (sub2_id);
               if (sub2_id) {
                  // alert("{{ URL::to('fetch_sub3')}}/" + sub2_id);
                   
                    $.ajax({
                        type: "GET",
                        url: "{{ URL::to('fetch_sub3')}}/" + sub2_id,
                        dataType: "json",
                      
                        success: function (data) 
                        {
                             //alert("true");
                            $("#sub3_div").show();
                             $('select[name="sub3"]').empty();
                             $('select[name="sub3"]').append('<option value="0" disabled="true" selected="true">اختر النوع</option>');
                               $.each(data, function (key, value) {
                              $('select[name="sub3"]').append('<option value="' + key + '">' + value + '</option>');
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
                            $("#sub4_div").show();
                             $('select[name="sub4"]').empty();
                             $('select[name="sub4"]').append('<option value="0" disabled="true" selected="true">اختر النوع الفرعى</option>');
                               $.each(data, function (key, value) {
                              $('select[name="sub4"]').append('<option value="' + key + '">' + value + '</option>');
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
        //--------------------------------------------------------------------------//
    </script>

@endsection
