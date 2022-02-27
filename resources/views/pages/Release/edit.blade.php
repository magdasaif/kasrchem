@extends('layouts.master')
@section('title')
<title>لوحة التحكم : تعديل النشرة</title>
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
                {{method_field('PATCH')}}
                @csrf
                 <!----------------------------------------------------->
                 <div class="form-group">    
                        <label>  اقسام الموقع </label>
                        <select  class="form-control sub2"  id="section_sel" name="section_id" >
                        <option value="{{$release->relation_with_site->id}}" selected>{{$release->relation_with_site->site_name_ar}}</option>
                            @foreach ($sections as $sec)
                                @if(($sec->id!=$release->relation_with_site->id)) 
                                    <option value="{{ $sec->id }}" <?php if($sec->id == Session::get('section_id')){echo 'selected';}else{ if(old('section_id') == $sec->id){echo "selected";}}?>>{{ $sec->site_name_ar }}</option>
                                @endif
                            @endforeach
                        </select>
                        
                    </div>
                 <!----------------------------------------------------->

                 <!--'release','Main_Cat','Sub_Category2','Sub_Category3','Sub_Category4'------------------------------------->
              <input type="hidden" name="release_id"  value="{{$release->id}}">
            <div class="form-group">
                 <label>التصنيف الرئيسى</label>
                <select   class="form-control main_category" id="main_category_id" name="main_cate_id" >
                        @if(!Session::get('cate_id'))
                            <option value="{{$release->relation_with_main_category->id}}" selected="true">{{$release->relation_with_main_category->subname_ar}}</option>
                        @endif
                        @foreach ($Main_Cat as $category)
                            @if(($category->id!=$release->relation_with_main_category->id)   ) 
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
        <!-- <div id="all" style="background-color:rgb(247 247 247);border-radius: 23px;width: 95%; margin: auto;padding: 20px;">     -->
            <div class="form-group"  id="sub2_div" >    
                    <label>   التصنيف الفرعي </label>
                    @if(Session::get('cate_id') && !Session::get('sub2_id'))
                        <!-----------------add new cate if no category found for this section------------------------------------>
                    <div class="form-control" id="sub2_requi" style="display:block;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد تصنيف فرعى للتصنيف الرئيسي المختار من فضلك قم باضافته اولا</span>
                        <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal" style="margin-right: 23px;font-weight: bold;"></i>
                    </div>
                    <!----------------------------------------------------->
                    @else
                    <select  class="form-control sub2"  id="sub2_sel" name="sub2" >
                        @if(!Session::get('sub2_id'))
                            <option value="{{ $release->relation_with_sub2_category->id }}" selected >{{ $release->relation_with_sub2_category->subname2_ar }}</option>
                        @endif
                            @foreach ($Sub_Category2 as $sub2)
                                @if($sub2->id!=$release->relation_with_sub2_category->id )
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
             
             <div class="form-group"  id="sub3_div" >
                <label>النوع الرئيسي</label>
                @if(Session::get('cate_id') && Session::get('sub2_id') && !Session::get('sub3_id'))
                    <!-----------------add new cate if no category found for this section------------------------------------>
                <div class="form-control" id="sub3_requi" style="display:block;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد نوع رئيسي للتصنيف الفرعي المختار من فضلك قم باضافته اولا</span>
                    <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal3" style="margin-right: 23px;font-weight: bold;"></i>
                </div>
                <!----------------------------------------------------->
                @else
                 <select  class="form-control sub3"  id="sub3_sel" name="sub3" >
                     @if(!Session::get('sub3_id'))
                     <option value="{{$release->relation_with_sub3_category->id}}" selected>{{$release->relation_with_sub3_category->subname_ar}}</option>
                     @endif
                      @foreach($Sub_Category3 as $sub3)
                        @if($sub3->id!=$release->relation_with_sub3_category->id ) 
                            <option value="{{ $sub3->id }}" <?php if($sub3->id == Session::get('sub3_id')){echo 'selected';}else{ if(old('sub3') == $sub3->id){echo "selected";}else{echo 'hidden';}}?>>{{ $sub3->subname_ar }}</option>
                        @endif
                    @endforeach
                 </select> 
                  <!----------------------------------------------------->
                  <div class="form-control" id="sub3_requi" style="display:none;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد نوع رئيسي للتصنيف الفرعي المختار من فضلك قم باضافته اولا</span>
                        <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal3" style="margin-right: 23px;font-weight: bold;"></i>
                    </div>
                    <!----------------------------------------------------->
                @endif
            </div>

                <!----------------------------------------------------- -->
                <div class="form-group"  id="sub4_div" > 
                    <label>النوع الفرعى</label>
                    @if(Session::get('cate_id') && Session::get('sub2_id') && Session::get('sub3_id') && !Session::get('sub4_id'))
                        <!-----------------add new cate if no category found for this section------------------------------------>
                    <div class="form-control" id="sub4_requi" style="display:block;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد نوع فرعي للنوع الرئيسي المختار من فضلك قم باضافته اولا</span>
                        <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal4" style="margin-right: 23px;font-weight: bold;"></i>
                    </div>
                    <!----------------------------------------------------->
                    @else
                    <select  class="form-control sub4"  id="sub4_sel" name="sub4" >
                        @if(!Session::get('sub4_id'))
                        <option value="{{$release->relation_with_sub4_category->id}}" selected>{{$release->relation_with_sub4_category->subname_ar}}</option>
                        @endif
                        @foreach ($Sub_Category4 as $sub4)
                            @if($sub4->id!=$release->relation_with_sub4_category->id )
                                 <option value="{{ $sub4->id }}" <?php if($sub4->id == Session::get('sub4_id')){echo 'selected';}else{ if(old('sub4') == $sub4->id){echo "selected";}else{echo 'hidden';}}?>>{{ $sub4->subname_ar }}</option>
                            @endif
                        @endforeach
                    </select>
                    <div class="form-control" id="sub4_requi" style="display:none;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد نوع فرعى للنوع الرئيسي المختار من فضلك قم باضافته اولا</span>
                        <i  class="nav-icon fas fa-plus green" type="button"  data-toggle="modal" data-target="#exampleModal4" style="margin-right: 23px;font-weight: bold;"></i>
                    </div>
                     <!----------------------------------------------------->
                     @endif
                </div>
      
               <!----------------------------------------------------->
              
               <div class="form-group">
                    <label for="title_ar">اسم النشرة </label>
                    <input type="text" class="form-control" aria-describedby="title_ar" placeholder=" ادخل اسم النشرة بالعربية" name="title_ar" value="{{$release->title_ar}}" id="regax_name_ar" onkeyup="check_regax_name_ar();" onkeypress="return CheckArabicCharactersOnly(event);"   required oninvalid="this.setCustomValidity('يجب ان يكون اسم التصنيف باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">

                    <span style="color:red;display:none;font-weight: bold;" id="error_name"> يجب ان يكون اسم النشرة باللغة العربية وايضا لا يكون ارقام فقط</span>

                    @error('title_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="title_en">اسم النشرة بالانجليزية</label>
                    <input type="text" class="form-control" id="title_en" aria-describedby="title_en" placeholder="ادخل اسم النشرة بالانجليزية" name="title_en"  value="{{$release->title_en}}" required onkeypress="return CheckEnglishCharactersOnly(event);" pattern="^(?=.*[a-zA-Z])[a-zA-Z0-9]+$" oninvalid="this.setCustomValidity('يجب ان يكون اسم النشرة باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">

                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون اسم النشرة باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

                    @error('title_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
               <!----------------------------------------------------->
               
               <div class="form-group">
                    <label for="image">صورة النشرة</label>
                    <center><img id="previewImg" style="width: 30%;"src=<?php echo asset("storage/release/release_$release->id/{$release->image}")?> alt="" ></center>
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
              <!----------------------------------------------------->
              <div class="form-group">
                    <label for="image">ملف النشرة</label>
                   <center> <embed  id="previewfile" src="<?php echo asset("storage/release/release_$release->id/{$release->file}")?>" width="30%"  accept="application/pdf,application/vnd.ms-excel"/></center>
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
 <!--========================================================-->
 @include('categories.Category_models.categories_model_adding')
    <!--========================================================--> 
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
@endsection