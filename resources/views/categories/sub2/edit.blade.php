@extends('layouts.master')
@section('title')
<title>لوحة التحكم : تعديل تصنيف</title>
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
                <h3 class="card-title">تعديل تصنيف</h3>
                <div class="card-tools">
                      <button type="button" class="btn btn-sm bbtn">
                        <a href="{{route('categories2_new.index')}}" class="aa" > <li class="fa fa-plus-square" ><span>قائمه التصنيفات الفرعيه</span></li></a>
                        <!-- <a href="{{url('categories2/'.$sub_categories->relation_sub2_with_main->id)}}" class="aa" > <li class="fa fa-plus-square" ><span>قائمه التصنيفات الفرعيه</span></li></a> -->
                     </button>
                </div>
              </div>
 <!--#############################################################-->
        <div class="modal-body">
            
            <form method="POST" action="{{route('categories2.update',$sub_categories->id)}}" enctype="multipart/form-data">
                {{method_field('PATCH')}}

                @csrf
                
                <!-- <div class="form-group">
                     <label for="exampleInputEmail1">  اقسام الموقع*</label>
                    <input type="test" class="form-control"  value="{{ $selected_section->site_name_ar }}" disabled>
                </div>
                
                <div class="form-group">
                     <label for="exampleInputEmail1"> التصنيف الرئيسى*</label>
                    <input type="test" class="form-control"  value="{{ $sub_categories->relation_sub2_with_main->subname_ar }}" disabled>
                    <input type="hidden" class="form-control" name="cate_id" value="{{ $sub_categories->relation_sub2_with_main->id }}">
                </div> -->

 <!----------------------------------------------------->
                <div class="form-group">
                        <label>  اقسام الموقع </label>
                        <select  class="form-control sub2"  id="section_sel" name="section_id" >
                            <option value="{{ $selected_section->id }}" selected>{{ $selected_section->site_name_ar }}</option>
                            <option value="0">جميع الاقسام</option>
                                @foreach ($sections as $sec)
                                <option value="{{ $sec->id }}" <?php if($sec->id == Session::get('section_id')){echo 'selected';}else{ if(old('section_id') == $sec->id){echo "selected";}}?>>{{ $sec->site_name_ar }}</option>
                                @endforeach
                        </select>

                    </div>
                   <!----------------------------------------------------->
                <div class="form-group">
                    <label for="exampleInputEmail1"> التصنيف الرئيسي</label>
                    <select class="form-control" id="main_category_id" name="main_cate_id"  required  oninvalid="this.setCustomValidity('قم بادخال التصنيف الرئيسي')"  oninput="this.setCustomValidity('')">

                        <option value="{{$main_categories->id}}" selected>{{$main_categories->subname_ar}}</option>
                        
                        <!-- @foreach ($all_main_categories as $category)
                            @if($main_categories->id != $category->id)
                                <option value="{{ $category->id }}" <?php if($category->id == Session::get('cate_id')){echo 'selected';}else{ if(old('main_category_id') == $category->id){echo "selected";}}?>>{{ $category->subname_ar }}</option>
                            @endif
                        @endforeach -->
                    </select>
                     <!-----------------add new cate if no category found for this section------------------------------------>
                    <div class="form-control" id="sub1_requi" style="display:none;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد تصنيف رئيسى للقسم المختار من فضلك قم باضافته اولا</span>
                        <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal0" style="margin-right: 23px;font-weight: bold;"></i>
                    </div>
                    <!----------------------------------------------------->
                    <div  id="main_error" style="color: red;display: none;">قم بادخال التصنيف الرئيسي</div>
                </div>

            <!----------------------------------------------------->



                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم التصنيف بالعربيه*</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname2_ar" value="{{$sub_categories->subname2_ar}}" required>
                    @error('subname2_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم التصنيف بالانجليزيه*</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname2_en" value="{{$sub_categories->subname2_en}}" required>
                    @error('subname2_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>



                
                <div class="form-group">
                    <label for="exampleInputEmail1">صوره*</label><br>
                   <center> <img data-v-20a423fa="" style="width: 30%;" src="<?php echo asset("storage/categories/second/$sub_categories->image2")?>" class="uploaded-img"> 

                    <input type="file" class="form-control" name="image" accept="image/*">

                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                <label for="exampleInputEmail1">الحالة</label>
                    <select class="form-control" name="status">
                            <option value="1" <?php if($sub_categories->status==1){echo'selected';}?> >مُفعل</option>
                            <option value="0" <?php if($sub_categories->status==0){echo'selected';}?> >غير مُفعل</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$sub_categories->id}}">

                
                
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

<!-- add script for categories and changes on it -->
<script src="{{ URL::asset('/js/product/edit_script.js') }}"></script>

@endsection
