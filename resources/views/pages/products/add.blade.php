@extends('layouts.master')
@toastr_css

@section('title')
<title>لوحة التحكم : {{$title}}</title>
 @endsection
@section('content')
<div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          @include('layouts.messages')

         
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('products.index')}}" class="aa"> <li class="fas fab fa-product-hunt" ><span> قائمه المنتجات </span></li></a>
                    </button>
                </div>
              </div>
 <!--#############################################################-->
        <div class="modal-body">

            <form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
             @csrf
            <!----------------------------------------------------->
            @include('pages.Sitesection.tree_view_section_adding')
            <!----------------------------------------------------->
                <div class="form-group" style="display:none">
                    <label for="exampleInputEmail1">الموردين</label> <span style="font-size: initial;color: red;"> [ قم بتحديد الموردين ] </span>
                    <br>
                    <center>
                            <span style="color:#d54646;font-weight: bold;"> لاضافه مورد</span>
                            <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#SupplierModel" style="margin-right: 23px;font-weight: bold;"></i>
                    </center>
                    <select class="form-control" name="supplier_id[]"  multiple >
                        @foreach ($suppliers as $supplier)
                        <?php
                            $margin="0";
                            $color="#c20620";
                            
                            $new=[
                                'margin' =>0,
                                'childs' => $supplier->childs,
                                'color'=>'#209c41',
                                'number'=>2,
                                'type'=>"product",
                                'main_id'=>$supplier->id,//pramiry key of supplier we edit on it
                                'parent_id'=>'0',
                            ];
                        ?>
                            <option style="margin-right:{{$margin}}px;color: {{$color}};" value="{{ $supplier->id }}" <?php if (collect(old('supplier_id'))->contains($supplier->id)) {echo 'selected';}  if($supplier->id == Session::get('supplier_id')){echo 'selected';}?>> - {{ $supplier->name_ar }}</option>
                            @if(count($supplier->childs))
                                @include('pages.manageChild',$new)
                            @endif
                        @endforeach
                    </select>

                    <hr>
                </div>

                
                

                <div class="form-group">
                    <label for="exampleInputEmail1">اسم المنتج بالعربيه</label>
                    <textarea class="form-control" rows="5" aria-describedby="emailHelp" placeholder="Enter name" name="name_ar" id="regax_name_ar" onkeyup="check_regax_name_ar();" onkeypress="return CheckArabicCharactersOnly(event);"   required oninvalid="this.setCustomValidity('يجب ان يكون اسم المنتج باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">{!! old('name_ar')!!}</textarea>
                    <span style="color:red;display:none;font-weight: bold;" id="error_name"> يجب ان يكون اسم المنتج باللغة العربية وايضا لا يكون ارقام فقط</span>

                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">اسم المنتج بالانجليزيه</label>
                    <textarea class="form-control" rows="5" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="name_en" required onkeypress="return CheckEnglishCharactersOnly(event);"  oninvalid="this.setCustomValidity('يجب ان يكون اسم المنتج باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">{!! old('name_en')!!}</textarea>
                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون اسم المنتج باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">وصف المنتج بالعربيه</label>
                    <textarea class="form-control tinymce-editor" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter descrption" name="description_ar" >{!! old('description_ar')!!}</textarea>
                    @error('description_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">وصف المنتج بالانجليزيه</label>
                    <textarea class="form-control tinymce-editor" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter descrption" name="description_en" >{!! old('description_en')!!}</textarea>
                    @error('description_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror



                </div>

                <hr>
                <div class="row">

                    <div class="col-lg-12">
                       <center> <img src="{{ asset('images/logo2.jpg') }}" class="img-thumbnail img-preview" style="width:30%;" alt="" id="previewImg"></center>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>صورة المنتج الاساسية:  <span style="color:rgb(199, 8, 8)">*</span></label>
                            <input class="form-control" name="image" onchange="readURL(this);" type="file" accept="image/*" required >                            
                        </div>
                        @error('image')
                             <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                   
                </div>

                                            


                
                <div class="form-group">
                    <label for="exampleInputEmail1">صور المنتج الفرعيه</label>

                    <input type="file" class="form-control" name="photos[]" accept="image/*" multiple>

                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">ملفات المنتج</label>

                    <input type="file" class="form-control" name="product_files[]" accept=".pdf" multiple >

                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">رابط فيديو للمنتج</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="video_link" value="{{old('video_link')}}">
                    @error('video_link')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="exampleInputEmail1">الرابط</label>
                    <input type="text" class="form-control" id="link" aria-describedby="emailHelp" placeholder="Enter link" name="link" value="{{old('link')}}">
                    @error('link')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <hr>

                <div class="form-group">
                    <label for="exampleInputEmail1">ترتيب المنتج</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="sort" value="<?php if(old('sort')){echo old('sort');}else{echo'0';}?>">
                    @error('sort')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <hr>

                <div class="form-group">
                    <label for="exampleInputEmail1">الحالة</label>
                    <select class="form-control" name="status" style="height: 50px;">
                            <option value="1" {{ old('status') == '1' ? "selected" : "" }}>مُفعل</option>
                            <option value="0" {{ old('status') == '0' ? "selected" : "" }}>غير مُفعل</option>
                    </select>
                </div>

                <!-------------------------------------------------------------------------->
                <!--------------------------------------------------------------------------->

                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">اضافه</button>
                        <a href="{{route('products.index')}}"><button type="button" class="btn btn-danger"  > الغاء</button></a>

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
</div>


<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
@toastr_js
@toastr_render
<script src="{{ URL::asset('/js/regax_name/regax_name.js') }}"></script>

<!-- tinymce -->
<script src="{{ URL::asset('assets/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::asset('/js/tiny.js') }}"></script>
<script src="{{ URL::asset('/js/imagePreview.js') }}"></script>

@endsection