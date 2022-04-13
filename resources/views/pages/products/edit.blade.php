@extends('layouts.master')
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

            <form method="POST" action="{{route('products.update',encrypt($product->id))}}" enctype="multipart/form-data">
            {{method_field('PATCH ')}}
                @csrf
               <!----------------------------------------------------->
                <hr>
                <div class="form-group">
                    <label for="exampleInputEmail1">الاقسام</label>
                             <?php
                            $selected_sections=array();

                            foreach ($product->rel_section as $section_select){
                              array_push($selected_sections,$section_select->id);
                             }
                             ?>
                            
                    <select class="form-control" name="site_id[]"  multiple required oninvalid="this.setCustomValidity('اختر القسم')"  oninput="this.setCustomValidity('')">
                            
                        @foreach ($sections as $sec)
                        <?php
                            $margin="0";
                            $color="#c20620";
                            $size="15";
                            $type='product';
                            $number=2;
                            if(in_array($sec->id,$selected_sections)){
                                $select_or_no='selected';
                            }else{
                                $select_or_no='';
                            }


                           $new= [
                                'childs' => $sec->childs,
                                'margin'=>$margin+30,
                                'color'=>'#209c41',
                                'size'=>$size-1,
                                'multi_selected'=>$selected_sections,
                                'number'=>$number
                            ];
                        ?>
                            <option style="margin-right:{{$margin}}px;color: {{$color}};font-size: {{$size}}px;" value="{{ $sec->id }}" <?php if (collect(old('section_id'))->contains($sec->id)) {echo 'selected';}else{echo $select_or_no;}?>> - {{ $sec->name_ar }}</option>
                            @if(count($sec->childs))
                                @include('pages.manageChild',$new)
                            @endif
                        @endforeach
                        
                    </select>
                </div>
                <!----------------------------------------------------->
         
                <div class="form-group" style="display:none">
                    <label for="exampleInputEmail1">الموردين</label> <span style="font-size: initial;color: red;"> [ قم بتحديد الموردين ] </span>
                             <?php
                            $selected_supplier=array();
                            if(count($product->suppliers)>0){
                                foreach ($product->suppliers as $supplier_select){
                                array_push($selected_supplier,$supplier_select->id);
                                }
                            }
                             ?>
                            
                    <select class="form-control" name="supplier_id[]"  multiple >
                            
                        @foreach ($suppliers as $supplier)
                        <?php
                            $margin="0";
                            $color="#c20620";
                            $size="15";
                            $type='product';
                            $number=2;
                            if(in_array($supplier->id,$selected_supplier)){
                                $select_or_no='selected';
                            }else{
                                $select_or_no='';
                            }


                           $new= [
                                'childs' => $supplier->childs,
                                'margin'=>$margin+30,
                                'color'=>'#209c41',
                                'size'=>$size-1,
                                'selected_supplier'=>$selected_supplier,
                                'type'=>$type,
                                'number'=>$number
                            ];
                        ?>
                            <option style="margin-right:{{$margin}}px;color: {{$color}};font-size: {{$size}}px;" value="{{ $supplier->id }}" <?php if (collect(old('supplier_id'))->contains($supplier->id)) {echo 'selected';}elseif($supplier->id == Session::get('supplier_id')){echo 'selected';}else{echo $select_or_no;}?>> - {{ $supplier->name_ar }}</option>
                            @if(count($supplier->childs))
                                @include('pages.manageChild',$new)
                            @endif
                        @endforeach
                        
                    </select>
                </div>
                <hr>

                <div class="form-group">
                    <label for="exampleInputEmail1">اسم المنتج بالعربيه</label>
                    <textarea class="form-control" rows="5"  aria-describedby="emailHelp" placeholder="Enter name" name="name_ar" id="regax_name_ar" onkeyup="check_regax_name_ar();" onkeypress="return CheckArabicCharactersOnly(event);"   required oninvalid="this.setCustomValidity('يجب ان يكون اسم المنتج باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">{!! $product->name_ar !!}</textarea>
                    <span style="color:red;display:none;font-weight: bold;" id="error_name"> يجب ان يكون اسم المنتج باللغة العربية وايضا لا يكون ارقام فقط</span>

                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">اسم المنتج بالانجليزيه</label>
                    <textarea  class="form-control" rows="5" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="name_en" required onkeypress="return CheckEnglishCharactersOnly(event);"  oninvalid="this.setCustomValidity('يجب ان يكون اسم المنتج باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">{!! $product->name_en !!}</textarea>
                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون اسم المنتج باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">وصف المنتج بالعربيه</label>
                    <textarea class="form-control tinymce-editor" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter descrption" name="description_ar" >{!! $product->description_ar !!}</textarea>
                    @error('description_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">وصف المنتج بالانجليزيه</label>
                    <textarea class="form-control tinymce-editor" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter descrption" name="description_en" >{!! $product->description_en !!}</textarea>
                    @error('description_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <hr>

                <div class="form-group">
                    <label for="exampleInputEmail1">صورة المنتج الاساسية</label>

                    @if(sizeof($product->mainImages())>0)
                        @foreach($product->mainImages() as $main)
                            <center> <img  id="previewImg" style="width: 30%;" src="<?php echo asset("storage/products/product_no_$product->id/$main->filename")?>" class="uploaded-img" title="للتعديل  اضغط على الصورة"> </center>
                            <input type="hidden" name="image_id" value="{{$main->id}}">

                            <br>
                            <center>
                                <button type="button" id="btn_image" class="btn btn-primary" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                                        <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                                        <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"></path>
                                    </svg>
                                    تعديل الصورة                                      
                                </button>
                            </center>
                            <input type="hidden" name="deleted_image" value="{{$main->filename}}">
                            <input type="file" class="form-control" name="image"  id="my_file" accept="image/*" style="display: none;" onchange="readURL(this);">

                     @endforeach
                    @else
                    <div class="row">
                        <div class="col-lg-12">
                        <center> <img src="{{ asset('images/logo2.jpg') }}" class="img-thumbnail img-preview" style="width:30%;" alt="" id="previewImg"></center>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>صورة المنتج الاساسية:  <span style="color:rgb(199, 8, 8)">*</span></label>
                                <input class="form-control" name="image" onchange="readURL(this);" type="file" accept="image/*" required >                            
                                <input type="hidden" name="deleted_image"/>
                            </div>
                            @error('image')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    @endif
                    
                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="exampleInputEmail1">رابط فيديو للمنتج</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="video_link" value="{{$product->video_link}}">
                    @error('video_link')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">الرابط</label>
                    <input type="text" class="form-control" id="link" aria-describedby="emailHelp" placeholder="Enter link" name="link" value="{{$product->link}}">
                    @error('link')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <hr>
                <div class="form-group">
                    <label for="exampleInputEmail1">ترتيب المنتج</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="sort" value="{{$product->sort}}">
                    @error('sort')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <hr>

                <div class="form-group">
                    <label for="exampleInputEmail1">الحالة</label>
                    <select class="form-control" name="status" style="height: 50px;">
                            <option value="1" <?php if($product->status==1){echo'selected';}?>>مُفعل</option>
                            <option value="0" <?php if($product->status==0){echo'selected';}?>>غير مُفعل</option>
                    </select>
                </div>

                <div class="form-group">
                <label for="exampleInputEmail1">اضافه كمنتج جديد</label>
                      <input type="checkbox" class="form-control" id="exampleInputEmail1"  name="add_as_new" style="width: 100px;height: 20px;margin-right: 100px;">
                </div>
                <!----------------------------------------------------------------------------->

                <input type="hidden" value="{{encrypt($product->id)}}" name="id">

                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تعديل</button>
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
<script src="{{ URL::asset('/js/regax_name/regax_name.js') }}"></script>
<!-- edit script for edit_upload_image-->
<script src="{{ URL::asset('/js/edit_upload_image/edit_upload_image_script.js') }}"></script>

<!-- tinymce -->
<script src="{{ URL::asset('assets/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::asset('/js/tiny.js') }}"></script>
<script src="{{ URL::asset('/js/imagePreview.js') }}"></script>

@endsection
