@extends('layouts.master')
@section('title')
<title>لوحة التحكم : {{$title}}</title>
 @endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
          
          <div class="col-12">
         <!--=================start success msg ===========================-->
         @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            @endif
           <!--=================start error msg ===========================-->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
           <!--=================start card-header===========================-->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">تعديل النشرات</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('release.index')}}" class="aa"> <li class="fas fa-file-pdf" ><span> قائمه النشرات </span></li></a>
                    </button>
                </div>
               </div>
           <!--=================end card-header===========================-->
           <!--=================start modal-body===========================-->
            <div class="modal-body">
            
            <form method="POST"  action="{{route('release.update',encrypt($releases->id))}}" enctype="multipart/form-data">
                {{method_field('PATCH')}}
                @csrf
             <!--========================tree_view_section_adding================================-->
               
               <div class="form-group">
                   <label for="exampleInputEmail1">الأقسام*</label> 
                    <?php
                        $selected_sections=array();
                        foreach ($releases->rel_section as $section_select)
                        {
                            array_push($selected_sections,$section_select->id);
                        }
                     ?>
                    <select class="form-control" name="site_id[]"  multiple required oninvalid="this.setCustomValidity('اختر القسم')"  oninput="this.setCustomValidity('')" >
                   @foreach ($sections as $sec)
                        <?php
                            $margin="0";
                            $color="#c20620";
                            $size="15";
                            // $type='supplier_section';
                            $number=2;
                            if(in_array($sec->id,$selected_sections))
                            {
                                $select_or_no='selected';
                            }
                            else
                            {
                                $select_or_no='';
                            }
                           $new=[
                                    'childs'             =>  $sec->childs,
                                    'margin'             =>  $margin+30,
                                    'color'              =>  '#209c41',
                                    'size'               =>   $size-1,
                                    'multi_selected'=>$selected_sections,
                                    // 'type'=>$type,
                                    'number'=>$number
                                ];
                        ?>
                            <option style="margin-right:{{$margin}}px;color: {{$color}};font-size: {{$size}}px;" value="{{ $sec->id }}" <?php if (collect(old('site_id'))->contains($sec->id)) {echo 'selected';}else{echo $select_or_no;}?>> - {{ $sec->name_ar }}</option>
                                @if(count($sec->childs))
                                    @include('pages.manageChild',$new)
                                @endif
                    @endforeach
                    
                </select>
                </div>
                <!--------------------------name_ar--------------------------->
                <div class="form-group">
                    <label for="title_ar">اسم النشرة *</label>
                    <input type="text" class="form-control" aria-describedby="name_ar" placeholder=" ادخل اسم النشرة بالعربية" name="name_ar" value="{{$releases->name_ar}}" id="regax_name_ar" onkeyup="check_regax_name_ar();"   required oninvalid="this.setCustomValidity('يجب ان يكون اسم التصنيف باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name"> يجب ان يكون اسم النشرة باللغة العربية وايضا لا يكون ارقام فقط</span>
                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <!----------------------------name_en------------------------->
               <div class="form-group">
                    <label for="name_en">اسم النشرة بالانجليزية*</label>
                    <input type="text" class="form-control" id="name_en" aria-describedby="name_en" placeholder="ادخل اسم النشرة بالانجليزية" name="name_en"  value="{{$releases->name_en}}" required onkeypress="return CheckEnglishCharactersOnly(event);"  oninvalid="this.setCustomValidity('يجب ان يكون اسم النشرة باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون اسم النشرة باللغة الانجليزية وايضا لا يكون ارقام فقط</span>
                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
               <!----------------------------image------------------------->
                <div class="form-group">
                    <label for="image">صورة النشرة*</label>


                    @if(sizeof($releases->mainImage())>0)
                    @foreach($releases->mainImage() as $xx)
                        <center><img id="previewImg" style="width: 30%;"src=<?php echo asset("storage/releases/release_no_$releases->id/{$xx->filename}")?> alt="" ></center>
                        <input type="hidden" name="morph_image_id" value="{{$xx->id}}">
                        <input type="hidden" name="old_image" value="{{$xx->filename}}">
                        @endforeach
                     @else
                     <center><img id="previewImg" style="width: 30%;" src="" alt="" ></center>

                     @endif
                    <br>
                    <center><button type="button" id="btn_image" class="btn btn-primary" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                    <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                        <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"></path>
                    </svg>
                    تعديل الصورة
                    </button></center>
                    <input type="file" class="form-control" name="image" id="my_file" accept="image/*" style="display: none;" onchange="readURL(this);" >
                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
              <!----------------------------file------------------------->
              <div class="form-group">
                    <label for="image">ملف النشرة*</label>

                    @if(sizeof($releases->mainFile())>0)
                      @foreach($releases->mainFile() as $xx)
                        <center> <embed  id="previewfile" src="<?php echo asset("storage/releases/release_no_$releases->id/{$xx->filename}")?>" width="30%"  accept="application/pdf,application/vnd.ms-excel"/></center>
                        <input type="hidden" name="morph_file_id" value="{{$xx->id}}">
                        <input type="hidden" name="old_file" value="{{$xx->filename}}">
                        @endforeach
                       @else
                       <center> <embed  id="previewfile" src="" alt="لا يوجد فايل" width="30%"  accept="application/pdf,application/vnd.ms-excel"/></center>
                     @endif

                   <br>
                    <center><button type="button" id="btn_file" class="btn btn-primary" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                    <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                        <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"></path>
                    </svg>
                    تعديل ملف النشرة
                    </button></center>
                    
                    <input type="file" class="form-control" name="filee"  id="my_filee"  style="display: none;"  accept="application/pdf,application/vnd.ms-excel">
                    @error('file')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <!---------------------------sort-------------------------->
                <div class="form-group">
                    <label for="sort">الترتيب*</label>
                    <input type="number" class="form-control" id="sort" aria-describedby="sort" placeholder="ادخل الترنيب" name="sort"  value="{{$releases->sort}}"  required oninvalid="this.setCustomValidity('قم بادحال الترتيب')"  oninput="this.setCustomValidity('')">
                    @error('sort')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
              <!--------------------------status--------------------------->
                <div class="form-group">
                    <label for="image">الحالة*</label>
                    <select class="form-control" name="status">
                            <option value="1" <?php if($releases->status==1){echo'selected';}?> >مُفعل</option>
                            <option value="0" <?php if($releases->status==0){echo'selected';}?> >غير مُفعل</option>
                    </select>
                </div>
             <!--------------------------------------------------------->
           
          <input type="hidden" name="release_id" value="{{encrypt($releases->id)}}">

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


<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>

<!-- add script for categories and changes on it -->
<script src="{{ URL::asset('/js/product/edit_script.js') }}"></script>

<!-- edit script for edit_upload_image-->
<script src="{{ URL::asset('/js/edit_upload_image/edit_upload_image_script.js') }}"></script>
<script src="{{ URL::asset('/js/regax_name/regax_name.js') }}"></script>
<script src="{{ URL::asset('/js/imagePreview.js') }}"></script>
@endsection