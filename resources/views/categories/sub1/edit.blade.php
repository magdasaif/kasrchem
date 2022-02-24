@extends('layouts.master')
@section('title')
<title>لوحة التحكم : تعديل التصنيف</title>
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
              </div>
                <div class="modal-body">
                    
                    <form method="POST" action="{{route('categories.update',$categories->id)}}" enctype="multipart/form-data">
                        {{method_field('PATCH')}}

                        @csrf
                        <div class="form-group">
                        <label for="exampleInputEmail1">اقسام الموقع</label>
                            <select class="form-control" name="section_id">
                                <option value="{{ $categories->relation_with_section->id }}">{{ $categories->relation_with_section->site_name_ar }}</option>

                                @foreach ($sectionss as $section)
                                    <option value="{{ $section->id }}">{{ $section->site_name_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم التصنيف بالعربيه</label>
                            <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter name" name="subname_ar"   id="regax_name_ar" onkeyup="check_regax_name_ar();" onkeypress="return CheckArabicCharactersOnly(event);"   required oninvalid="this.setCustomValidity('يجب ان يكون اسم التصنيف باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">

                            <span style="color:red;display:none;font-weight: bold;" id="error_name"> يجب ان يكون اسم التصنيف باللغة العربية وايضا لا يكون ارقام فقط</span>

                            @error('subname_ar')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم التصنيف بالانجليزيه</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname_en" value="{{$categories->subname_en}}" required onkeypress="return CheckEnglishCharactersOnly(event);" pattern="^(?=.*[a-zA-Z])[a-zA-Z0-9]+$" oninvalid="this.setCustomValidity('يجب ان يكون اسم التصنيف باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">

                            <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون اسم التصنيف باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

                            @error('subname_en')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>



                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">صوره*</label><br>
                            <center><img  id="previewImg" style="width: 30%;" src="<?php echo asset("storage/categories/first/$categories->image")?>" class="uploaded-img"> </center>
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
                                    <option value="1" <?php if($categories->status==1){echo'selected';}?> >مُفعل</option>
                                    <option value="0" <?php if($categories->status==0){echo'selected';}?> >غير مُفعل</option>
                            </select>
                        </div>
                        <input type="hidden" name="id" value="{{$categories->id}}">
                        <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">تعديل</button>
                        </div>
                    </form>
                </div>
                
                </div>
            </div>
        </div>
    </div>
</section>
</template>

<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('/js/regax_name/regax_name.js') }}"></script>
<!-- edit script for edit_upload_image-->
<script src="{{ URL::asset('/js/edit_upload_image/edit_upload_image_script.js') }}"></script>
@endsection
