@extends('layouts.master')
@section('title')
<title>لوحة التحكم : {{$title}}</title>
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
                <h3 class="card-title">تعديل النشرات</h3>
              </div>
 <!--#############################################################-->
 <div class="modal-body">
            
            <form method="POST"  action="{{route('release.update',$release->id)}}" enctype="multipart/form-data">
                {{method_field('PATCH ')}}

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}

                 <!--'release','Main_Cat','Sub_Category2','Sub_Category3','Sub_Category4'------------------------------------->
              <input type="hidden" name="release_id"  value="{{$release->id}}">
                 <div class="form-group">
                 <label>التصنيف الرئيسى</label>
                <select   class="form-control main_category" id="main_category_id" name="main_category" required>
                 <option value="0" disabled="true" >اختر التصنيف الرئيسى</option> 
                    <option value="{{$release->relation_with_main_category->id}}" selected="true">{{$release->relation_with_main_category->subname_ar}}</option>
                   <?php 
                    foreach($Main_Cat as $Main_Category)
                        { if (($Main_Category->id!=$release->relation_with_main_category->id) && ($Main_Category->sub_cate2_count>0)  ) 
                            {  
                    ?>
                              <option value="{{$Main_Category->id}}">{{$Main_Category->subname_ar}}</option>
                   <?php 
                            }
                        }
                    ?>
                 </select> </div>

            
             <!----------------------------------------------------->
        <div id="all" style="background-color: #e8f2f9;border-radius: 23px;width: 95%; margin: auto;padding: 20px;">    
            <div class="form-group"  id="sub2_div" style="display:block" >    
                    <label>   التصنيف الفرعي </label>

                    <select  class="form-control sub2"  id="sub2_id" name="sub2" required>
                    <option value="0" disabled="true" >اختر التصنيف الفرعي</option>
                    <option value="{{$release->relation_with_sub2_category->id}}" selected="true">{{$release->relation_with_sub2_category->subname2_ar}}</option>
                    <?php 
                    foreach($Sub_Category2 as $Sub_cat2)
                        { if ($Sub_cat2->id!=$release->relation_with_sub2_category->id ) 
                            {  
                    ?>
                              <option value="{{$Sub_cat2->id}}">{{$Sub_cat2->subname2_ar}}</option>
                   <?php 
                            }
                            else
                            {

                            }
                        }
                    ?>
                </select> 
              </div>

             <!----------------------------------------------------- -->
             
             <div class="form-group"  id="sub3_div" style="display:block" >
                <label>النوع</label>
                 <select  class="form-control sub3"  id="sub3_id" name="sub3" required>

                 <option value="0" disabled="true" >اختر النوع </option>
                    <option value="{{$release->relation_with_sub3_category->id}}" selected="true">{{$release->relation_with_sub3_category->subname_ar}}</option>
                    <?php 
                    foreach($Sub_Category3 as $Sub_cat3)
                        { if ($Sub_cat3->id!=$release->relation_with_sub3_category->id ) 
                            {  
                    ?>
                              <option value="{{$Sub_cat3->id}}">{{$Sub_cat3->subname_ar}}</option>
                   <?php 
                            }
                            else
                            {

                            }
                        }
                    ?>  
                 </select> 
                </div>

                <!----------------------------------------------------- -->
                <div class="form-group"  id="sub4_div" style="display:block" > 
                <label>النوع الفرعى</label>
                    <select  class="form-control sub4"  id="sub4_id" name="sub4" required>

                    <option value="0" disabled="true" >اختر النوع الفرعى</option>
                    <option value="{{$release->relation_with_sub4_category->id}}" selected="true">{{$release->relation_with_sub4_category->subname_ar}}</option>
                    <?php 
                    foreach($Sub_Category4 as $Sub_cat4)
                        { if ($Sub_cat4->id!=$release->relation_with_sub4_category->id ) 
                            {  
                    ?>
                              <option value="{{$Sub_cat4->id}}">{{$Sub_cat4->subname_ar}}</option>
                   <?php 
                            }
                            else
                            {

                            }
                        }
                    ?>  
                    </select>
                    </div>
            </div>
               <!----------------------------------------------------->
              
               <div class="form-group">
                    <label for="title_ar">اسم النشرة </label>
                    <input type="text" class="form-control" id="title_ar" aria-describedby="title_ar" placeholder="ادخل عنوان الفيديو" name="title_ar" value="{{$release->title_ar}}" required>
                    @error('title_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="title_en">اسم النشرة بالانجليزية</label>
                    <input type="text" class="form-control" id="title_en" aria-describedby="title_en" placeholder="ادخل اسم النشرة بالانجليزية" name="title_en"  value="{{$release->title_en}}" required>
                    @error('title_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
               <!----------------------------------------------------->
               
               <div class="form-group">
                    <label for="image">صورة النشرة</label>
                    <center><img  style="width: 30%;"src=<?php echo asset("storage/release/release_$release->id/{$release->image}")?> alt="" ></center>

                    <input type="file" class="form-control" name="image" accept="image/*">
                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
              <!----------------------------------------------------->
              <div class="form-group">
                    <label for="image">ملف النشرة</label>
                   <center> <embed src="<?php echo asset("storage/release/release_$release->id/{$release->file}")?>" width="30%"  accept="application/pdf,application/vnd.ms-excel"/></center>

                    <input type="file" class="form-control" name="filee"  >
                    @error('file')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
              <!----------------------------------------------------->
                <div class="form-group">
                    <label for="image">الحالة</label>
                    <select class="form-control" name="status">
                            <option value="1" <?php if($release->status==1){echo'selected';}?> >مُفعل</option>
                            <option value="0" <?php if($release->status==0){echo'selected';}?> >غير مُفعل</option>
                    </select>
                </div>
               
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تعديل</button>
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
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>

<script>
   
    //---------------for show seelct option of sub2------------------------//
     $(document).ready(function () {
    $('select[name="main_category"]').on('change', function () {
                var main_category_id = $(this).val();
               if (main_category_id) {
             //  alert("{{ URL::to('fetch_sub2')}}/" + main_category_id);
                   
                    $.ajax({
                        type: "GET",
                        url: "{{ URL::to('fetch_sub2')}}/" + main_category_id,
                        dataType: "json",
                      
                        success: function (data) 
                        {
                           //  alert("true");
                             
                           //  $("#all").show();
                           // $("#sub2_div").show();
                             $("#sub3_div").hide();
                             $("#sub4_div").hide();
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
