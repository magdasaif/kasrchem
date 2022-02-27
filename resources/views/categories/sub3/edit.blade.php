@extends('layouts.master')
@section('title')
<title>لوحة التحكم : تعديل نوع</title>
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
                <h3 class="card-title">تعديل نوع</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('categories3_new.index')}}" class="aa"> <li class="fas fa-cubes" ><span>  قائمة الانواع الرئيسيه </span></li></a>
                    </button>
                </div>
              </div>
 <!--#############################################################-->
 <div class="modal-body">
            
            <form method="POST" action="{{route('categories3.update',$sub3_categories->id)}}" enctype="multipart/form-data">
                {{method_field('PATCH')}}

                @csrf

               


<!----------------------------------------------------->
                <div class="form-group">
                        <label>  اقسام الموقع </label>
                        <select  class="form-control sub2"  id="section_sel" name="section_id" >
                            <option value="{{ $selected_section->id }}" selected>{{ $selected_section->site_name_ar }}</option>
                            <option value="0">جميع الاقسام</option>
                               @foreach ($sections as $sec)
                                    @if(($sec->id!=$selected_section->id)) 
                                        <option value="{{ $sec->id }}" <?php if($sec->id == Session::get('section_id')){echo 'selected';}else{ if(old('section_id') == $sec->id){echo "selected";}}?>>{{ $sec->site_name_ar }}</option>
                                    @endif
                                @endforeach
                        </select>

                    </div>
                   <!----------------------------------------------------->
                <div class="form-group">
                    <label for="exampleInputEmail1"> التصنيف الرئيسي</label>
                    <select class="form-control" id="main_category_id" name="main_cate_id"  required  oninvalid="this.setCustomValidity('قم بادخال التصنيف الرئيسي')"  oninput="this.setCustomValidity('')">

                        <option value="{{$main_categories->id}}" selected>{{$main_categories->subname_ar}}</option>
                        
                        @foreach ($all_main_categories as $category)
                            @if($main_categories->id != $category->id)
                                <option value="{{ $category->id }}" <?php if($category->id == Session::get('cate_id')){echo 'selected';}else{ if(old('main_category_id') == $category->id){echo "selected";}else{echo 'hidden';}}?>>{{ $category->subname_ar }}</option>
                            @endif
                        @endforeach
                    </select>
                     <!-----------------add new cate if no category found for this section------------------------------------>
                    <div class="form-control" id="sub1_requi" style="display:none;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد تصنيف رئيسى للقسم المختار من فضلك قم باضافته اولا</span>
                        <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal0" style="margin-right: 23px;font-weight: bold;"></i>
                    </div>
                    <!----------------------------------------------------->
                    <div  id="main_error" style="color: red;display: none;">قم بادخال التصنيف الرئيسي</div>
                </div>

            <!----------------------------------------------------->
            <div class="form-group"  id="sub2_div" name="sub2_div">
                    <label>   التصنيف الفرعي </label>
                    @if(Session::get('cate_id') && !Session::get('sub2_id'))
                        <!-----------------add new cate if no category found for this section------------------------------------>
                    <div class="form-control" id="sub2_requi" style="display:block;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد تصنيف فرعى للتصنيف الرئيسي المختار من فضلك قم باضافته اولا</span>
                        <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal" style="margin-right: 23px;font-weight: bold;"></i>
                    </div>
                    <!----------------------------------------------------->
                    @else
                    <select  class="form-control sub2"  id="sub2_sel" name="sub2" required  oninvalid="this.setCustomValidity('قم بادخال التصنيف الفرعى')"  oninput="this.setCustomValidity('')">
                        <option value="{{ $sub_categories->id }}" selected >{{ $sub_categories->subname2_ar }}</option>
                        @foreach ($all_sub_categories as $sub2)
                            @if($sub_categories->id != $sub2->id)
                                <option value="{{ $sub2->id }}" <?php if($sub2->id == Session::get('sub2_id')){echo 'selected';}else{ if(old('sub2') == $sub2->id){echo "selected";}else{echo 'hidden';}}?>>{{ $sub2->subname2_ar }}</option>
                            @endif
                        @endforeach
                    </select>
                    <div class="form-control" id="sub2_requi" style="display:none;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد تصنيف فرعى للتصنيف الرئيسي المختار من فضلك قم باضافته اولا</span>
                        <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal" style="margin-right: 23px;font-weight: bold;"></i>
                      </div>
                    <!----------------------------------------------------->
                    @endif
              </div>
   <!----------------------------------------------------- -->


                <!----------------------------------------------------->
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم النوع بالعربيه*</label>
                    <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter name" name="subname_ar" value="{{$sub3_categories->subname_ar}}" id="regax_name_ar" onkeyup="check_regax_name_ar();" onkeypress="return CheckArabicCharactersOnly(event);"   required oninvalid="this.setCustomValidity('يجب ان يكون اسم النوع باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name"> يجب ان يكون اسم النوع باللغة العربية وايضا لا يكون ارقام فقط</span>
                    @error('subname_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم النوع بالانجليزيه*</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname_en" value="{{$sub3_categories->subname_en}}" required onkeypress="return CheckEnglishCharactersOnly(event);" pattern="^(?=.*[a-zA-Z])[a-zA-Z0-9]+$" oninvalid="this.setCustomValidity('يجب ان يكون اسم النوع باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون اسم النوع باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

                    @error('subname_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">صوره*</label><br>
                    
                   <center> <img  id="previewImg" style="width: 30%;" src="<?php echo asset("storage/categories/third/".$sub3_categories->image)?>" class="uploaded-img"></center>
                   <br>
                    <center><button type="button" id="btn_image" class="btn btn-primary" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                    <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                        <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"></path>
                    </svg>
                    تعديل الصورة
                    </button></center>
                    <input type="file" class="form-control" name="image" id="my_file" accept="image/*" style="display: none;" >

                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                   <label for="exampleInputEmail1">الحالة</label>
                    <select class="form-control" name="status">
                            <option value="1" <?php if($sub3_categories->status==1){echo'selected';}?> >مُفعل</option>
                            <option value="0" <?php if($sub3_categories->status==0){echo'selected';}?> >غير مُفعل</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$sub3_categories->id}}">
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تعديل</button>
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

<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>

<script src="{{ URL::asset('/js/regax_name/regax_name.js') }}"></script>
<!-- <script src="{{ URL::asset('/js/regax_name/regax_name _model.js') }}"></script> -->

<!-- add script for categories and changes on it -->
<script src="{{ URL::asset('/js/product/edit_script.js') }}"></script>



<!-- edit script for edit_upload_image-->
<script src="{{ URL::asset('/js/edit_upload_image/edit_upload_image_script.js') }}"></script>
@endsection
