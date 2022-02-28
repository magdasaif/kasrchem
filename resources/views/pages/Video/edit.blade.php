@extends('layouts.master')
@section('title')
<title>لوحة التحكم : تعديل فيديو</title>
 @endsection
@section('content')
<div>
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
                <h3 class="card-title"> تعديل فيديو</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('video.index')}}" class="aa"> <li class="fas fa-video" ><span>  قائمة الفيديوهات </span></li></a>
                    </button>
                </div>
              </div>
 <!--#############################################################-->
 <div class="modal-body">
 <!-- <div style="text-align: center;color: red;font-size: x-large;">تاكد من ادخال (تصنيف فرعى ونوع رئيسى ونوع فرعى ) للتصنيف الرئيسى المراد اختياره </div> -->
             <!-- <hr> -->
            
            <form method="POST"  action="{{route('video.update',$video->id)}}" enctype="multipart/form-data">
                {{method_field('PATCH ')}}

                @csrf
                 <!--'video','Main_Cat','Sub_Category2','Sub_Category3','Sub_Category4'------------------------------------->
               <!----------------------------------------------------->
               <div hidden class="form-group">
                        <label>  اقسام الموقع </label>

                        <select  class="form-control sub2"  id="section_sel" name="section_id" >
                            <option value="{{$video->relation_with_site->id}}" selected>{{$video->relation_with_site->site_name_ar}}</option>
                                 @foreach ($sections as $sec)
                                    @if(($sec->id!=$video->relation_with_site->id)) 
                                        <option value="{{ $sec->id }}" <?php if($sec->id == Session::get('section_id')){echo 'selected';}else{ if(old('section_id') == $sec->id){echo "selected";}}?>>{{ $sec->site_name_ar }}</option>
                                    @endif
                                @endforeach
                        </select>

                    </div>
                   <!----------------------------------------------------->
      
                <!--========================================================-->
                <div  hidden  class="form-group">
                 <label>التصنيف الرئيسى</label>
                <select   class="form-control main_category" id="main_category_id" name="main_cate_id">
                    @if(Session::get('cate_id'))
                    @else
                    <option value="{{$video->relation_with_main_category->id}}" selected="true">{{$video->relation_with_main_category->subname_ar}}</option>
                    @endif
                    @foreach ($Main_Cat as $category)
                            @if(($category->id!=$video->relation_with_main_category->id)   ) 
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


            <div hidden class="form-group"  id="sub2_div" name="sub2_div">
                    <label>   التصنيف الفرعي </label>
                    @if(Session::get('cate_id') && !Session::get('sub2_id'))
                        <!-----------------add new cate if no category found for this section------------------------------------>
                    <div class="form-control" id="sub2_requi" style="display:block;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد تصنيف فرعى للتصنيف الرئيسي المختار من فضلك قم باضافته اولا</span>
                        <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal" style="margin-right: 23px;font-weight: bold;"></i>
                    </div>
                    <!----------------------------------------------------->
                    @else
                    <select  class="form-control sub2"  id="sub2_sel" name="sub2" >
                        @if(Session::get('sub2_id'))
                        @else
                            <option value="{{ $video->relation_with_sub2_category->id }}" selected >{{ $video->relation_with_sub2_category->subname2_ar }}</option>
                        @endif
                        @foreach ($Sub_Category2 as $sub2)
                            <option value="{{ $sub2->id }}" <?php if($sub2->id == Session::get('sub2_id')){echo 'selected';}else{ if(old('sub2') == $sub2->id){echo "selected";}else{echo 'hidden';}}?>>{{ $sub2->subname2_ar }}</option>
                        @endforeach
                    </select>
                    <div class="form-control" id="sub2_requi" style="display:none;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد تصنيف فرعى للتصنيف الرئيسي المختار من فضلك قم باضافته اولا</span>
                        <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal" style="margin-right: 23px;font-weight: bold;"></i>
                      </div>
                    <!----------------------------------------------------->
                    @endif
              </div>

             <!----------------------------------------------------- -->

             <div hidden class="form-group"  id="sub3_div">
                <label>النوع الرئيسي</label>
                @if(Session::get('cate_id') && Session::get('sub2_id') && !Session::get('sub3_id'))
                    <!-----------------add new cate if no category found for this section------------------------------------>
                <div class="form-control" id="sub3_requi" style="display:block;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد نوع رئيسي للتصنيف الفرعي المختار من فضلك قم باضافته اولا</span>
                    <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal3" style="margin-right: 23px;font-weight: bold;"></i>
                </div>
                <!----------------------------------------------------->
                @else
                 <select  class="form-control sub3"  id="sub3_sel" name="sub3" >
                     @if(Session::get('sub3_id'))
                     @else
                        <option value="{{$video->relation_with_sub3_category->id}}" selected>{{$video->relation_with_sub3_category->subname_ar}}</option>
                    @endif
                    @foreach ($Sub_Category3 as $sub3)
                            <option value="{{ $sub3->id }}" <?php if($sub3->id == Session::get('sub3_id')){echo 'selected';}else{ if(old('sub3') == $sub3->id){echo "selected";}else{echo 'hidden';}}?>>{{ $sub3->subname_ar }}</option>
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
                <div  hidden class="form-group"  id="sub4_div">
                <label>النوع الفرعى</label>
                    @if(Session::get('cate_id') && Session::get('sub2_id') && Session::get('sub3_id') && !Session::get('sub4_id'))
                        <!-----------------add new cate if no category found for this section------------------------------------>
                    <div class="form-control" id="sub4_requi" style="display:block;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد نوع فرعي للنوع الرئيسي المختار من فضلك قم باضافته اولا</span>
                        <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal4" style="margin-right: 23px;font-weight: bold;"></i>
                    </div>
                    <!----------------------------------------------------->
                    @else
                    <select  class="form-control sub4" id="sub4_sel" name="sub4" >
                        @if(Session::get('sub4_id'))
                        @else
                            <option value="{{$video->relation_with_sub4_category->id}}" selected>{{$video->relation_with_sub4_category->subname_ar}}</option>
                        @endif
                        @foreach ($Sub_Category4 as $sub4)
                            <option value="{{ $sub4->id }}" <?php if($sub4->id == Session::get('sub4_id')){echo 'selected';}else{ if(old('sub4') == $sub4->id){echo "selected";}else{echo 'hidden';}}?>>{{ $sub4->subname_ar }}</option>
                        @endforeach
                    </select>
                    <div class="form-control" id="sub4_requi" style="display:none;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد نوع فرعى للنوع الرئيسي المختار من فضلك قم باضافته اولا</span>
                        <i  class="nav-icon fas fa-plus green" type="button"  data-toggle="modal" data-target="#exampleModal4" style="margin-right: 23px;font-weight: bold;"></i>
                    </div>
                     <!----------------------------------------------------->
                @endif
             </div>
               <!----------------------------------------------------->
              <!--========================================================-->
              
               <div class="form-group">
                    <label for="title_ar">عنوان الفيديو </label>
                    <input type="text" class="form-control" aria-describedby="title_ar" placeholder="ادخل عنوان الفيديو" name="title_ar" value="{{$video->title_ar}}"id="regax_name_ar" onkeyup="check_regax_name_ar();" onkeypress="return CheckArabicCharactersOnly(event);"   required oninvalid="this.setCustomValidity('يجب ان يكون عنوان الفيديو باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name"> يجب ان يكون عنوان الفيديو باللغة العربية وايضا لا يكون ارقام فقط</span>

                    @error('title_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="title_en">عنوان الفيديو بالانجليزية</label>
                    <input type="text" class="form-control" id="title_en" aria-describedby="title_en" placeholder="ادخل عنوان الفيديو بالانجليزية" name="title_en"  value="{{$video->title_en}}" required onkeypress="return CheckEnglishCharactersOnly(event);" pattern="^(?=.*[a-zA-Z\s])[a-zA-Z0-9\s]+$" oninvalid="this.setCustomValidity('يجب ان يكون عنوان الفيديو باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون عنوان الفيديو باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

                    @error('title_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
               <!----------------------------------------------------->
               <div class="form-group">
                <label for="content_ar">رابط الفيديو </label>
                    <input type="text" class="form-control" name="link" value="{{$video->link}}" required>
                    @error('link')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
              <!----------------------------------------------------->
                <div class="form-group">
                    <label for="image">الحالة</label>
                    <select class="form-control" name="status">
                            <option value="1" <?php if($video->status==1){echo'selected';}?> >مُفعل</option>
                            <option value="0" <?php if($video->status==0){echo'selected';}?> >غير مُفعل</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$video->id}}">
               
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تعديل</button>
                </div>
                </form>
                <!-- </div> -->
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

<!-- add script for categories and changes on it -->
<script src="{{ URL::asset('/js/product/edit_script.js') }}"></script>

@endsection
