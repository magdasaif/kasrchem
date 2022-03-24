@extends('layouts.master')
@section('title')
<title>لوحة التحكم :تعديل المقالات</title>
 @endsection
@section('content')

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
              <div class="card-header" >
                <h3 class="card-title">تعديل مقال</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('article.index')}}" class="aa"> <li class="fa fa-newspaper" ><span> قائمه المقالات </span></li></a>
                    </button>
                </div>
              </div>
 <!--#############################################################-->
 <div class="modal-body" >
   <form method="POST"  action="{{route('article.update',$article->id)}}" enctype="multipart/form-data">
                {{method_field('PATCH ')}}

                @csrf
    <!----------------------------------------------------->
          <div class="form-group">
            <label for="exampleInputEmail1">الأقسام</label> 
                     <?php
                    $selected_supplier=array();

                    foreach ($article->rel_section as $supplier_select){
                      array_push($selected_supplier,$supplier_select->id);
                     }
                     ?>
                    
            <select class="form-control" name="site_id[]"  multiple required oninvalid="this.setCustomValidity('اختر القسم')"  oninput="this.setCustomValidity('')" >
                    
             @foreach ($sections as $sec)
             <?php
                 $margin="0";
                 $color="#c20620";
                 $size="15";
                 $type='supplier_section';
                 $number=2;
                 if(in_array($sec->id,$selected_supplier)){
                     $select_or_no='selected';
                 }else{
                     $select_or_no='';
                 }


                $new= [
                     'childs' => $sec->childs,
                     'margin'=>$margin+30,
                     'color'=>'#209c41',
                     'size'=>$size-1,
                     'selected_supplier'=>$selected_supplier,
                     'type'=>$type,
                     'number'=>$number
                 ];
             ?>
                 <option style="margin-right:{{$margin}}px;color: {{$color}};font-size: {{$size}}px;" value="{{ $sec->id }}" <?php if (collect(old('site_id'))->contains($sec->id)) {echo 'selected';}else{echo $select_or_no;}?>> - {{ $sec->site_name_ar }}</option>
                 @if(count($sec->childs))
                     @include('pages.products.manageChild',$new)
                 @endif
             @endforeach
             
         </select>
   
        </div>
         <!----------------------------------------------------->
               <div class="form-group">
                    <label for="title_ar">عنوان المقال </label>
                    <input type="text" class="form-control"  aria-describedby="title_ar" placeholder="ادخل عنوان المقال" name="title_ar" value="{{$article->title_ar}}"id="regax_name_ar" onkeyup="check_regax_name_ar();" onkeypress="return CheckArabicCharactersOnly(event);"   required oninvalid="this.setCustomValidity('يجب ان يكون عنوان المقال باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">

                    <span style="color:red;display:none;font-weight: bold;" id="error_name"> يجب ان يكون اسم التصنيف باللغة العربية وايضا لا يكون ارقام فقط</span>

                    @error('title_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="title_en">عنوان المقال بالانجليزية</label>
                    <input type="text" class="form-control" id="title_en" aria-describedby="title_en" placeholder="ادخل عنوان المقال بالانجليزية" name="title_en"  value="{{$article->title_en}}" required onkeypress="return CheckEnglishCharactersOnly(event);" pattern="^(?=.*[a-zA-Z\s])[a-zA-Z0-9\s]+$" oninvalid="this.setCustomValidity('يجب ان يكون عنوان المقال باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون عنوان المقال باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

                   
                    @error('title_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="content_ar">محتوى المقال </label>
                    <textarea  class="form-control tinymce-editor" name="content_ar" id="content_ar" placeholder="ادخل محتوى المقال " >{!!$article->content_ar!!}</textarea>
                    
                    @error('content_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
              <!----------------------------------------------------->
               
               <div class="form-group">
                    <label for="content_en">محتوى المقال  بالانجليزية</label>
                    
                    <textarea  class="form-control tinymce-editor" name="content_en" id="content_en" placeholder="ادخل محتوى المقال بالانجليزية " > {!!$article->content_en!!}</textarea>

                    @error('content_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
              <!----------------------------------------------------->
                <div class="form-group">
                    <label for="image">الصورة</label>
                   <center> <img  id="previewImg" style="width:30%;" src="<?php echo asset("storage/article/{$article->image}")?>" class="uploaded-img"></center>
                    
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
                    <label for="image">الحالة</label>
                    <select class="form-control" name="status">
                            <option value="1" <?php if($article->status==1){echo'selected';}?> >مُفعل</option>
                            <option value="0" <?php if($article->status==0){echo'selected';}?> >غير مُفعل</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$article->id}}">
               
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تعديل</button>
                </div>
                </form>

<!-- </div> -->
 <!--#############################################################-->
 		</div>
            </div>
        </div>
    </div>
</section>


<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>

<!-- edit script for edit_upload_image-->
<script src="{{ URL::asset('/js/edit_upload_image/edit_upload_image_script.js') }}"></script>

<script src="{{ URL::asset('assets/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::asset('/js/tiny.js') }}"></script>
<script src="{{ URL::asset('/js/regax_name/regax_name.js') }}"></script>
@endsection