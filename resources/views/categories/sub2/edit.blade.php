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
                <div class="form-group">
                     <label for="exampleInputEmail1">  اقسام الموقع*</label>
                    <input type="test" class="form-control"  value="{{ $sections->site_name_ar }}" disabled>
                </div>
                
                <div class="form-group">
                     <label for="exampleInputEmail1"> التصنيف الرئيسى*</label>
                    <input type="test" class="form-control"  value="{{ $sub_categories->relation_sub2_with_main->subname_ar }}" disabled>
                    <input type="hidden" class="form-control" name="cate_id" value="{{ $sub_categories->relation_sub2_with_main->id }}">
                </div>
                
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

 		</div>
            </div>
        </div>
    </div>
</section>
</template>
@endsection
