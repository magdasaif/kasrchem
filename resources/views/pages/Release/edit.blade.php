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
                            <!-- <option value="0">جميع الاقسام</option> -->
                                @foreach ($sections as $sec)
                                <option value="{{ $sec->id }}" <?php if($sec->id == Session::get('section_id')){echo 'selected';}else{ if(old('section_id') == $sec->id){echo "selected";}}?>>{{ $sec->site_name_ar }}</option>
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
                                <option value="{{ $category->id }}" <?php if($category->id == Session::get('cate_id')){echo 'selected';}else{ if(old('main_category_id') == $category->id){echo "selected";}}?>>{{ $category->subname_ar }}</option>
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
                                    <option value="{{ $sub2->id }}" <?php if($sub2->id == Session::get('sub2_id')){echo 'selected';}else{ if(old('sub2') == $sub2->id){echo "selected";}}?>>{{ $sub2->subname2_ar }}</option>
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
                            <option value="{{ $sub3->id }}" <?php if($sub3->id == Session::get('sub3_id')){echo 'selected';}else{ if(old('sub3') == $sub3->id){echo "selected";}}?>>{{ $sub3->subname_ar }}</option>
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
                                 <option value="{{ $sub4->id }}" <?php if($sub4->id == Session::get('sub4_id')){echo 'selected';}else{ if(old('sub4') == $sub4->id){echo "selected";}}?>>{{ $sub4->subname_ar }}</option>
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
                    <input type="text" class="form-control" id="title_ar" aria-describedby="title_ar" placeholder="ادخل عنوان الفيديو" name="title_ar" value="{{$release->title_ar}}" required  oninvalid="this.setCustomValidity('قم بادخال اسم النشرة بالعربية')"  oninput="this.setCustomValidity('')">
                    @error('title_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="title_en">اسم النشرة بالانجليزية</label>
                    <input type="text" class="form-control" id="title_en" aria-describedby="title_en" placeholder="ادخل اسم النشرة بالانجليزية" name="title_en"  value="{{$release->title_en}}" required  oninvalid="this.setCustomValidity('قم بادخال اسم النشرة بالانجليزية')"  oninput="this.setCustomValidity('')">
                    @error('title_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
               <!----------------------------------------------------->
               
               <div class="form-group">
                    <label for="image">صورة النشرة</label>
                    <center><img  style="width: 30%;"src=<?php echo asset("storage/release/release_$release->id/{$release->image}")?> alt="" ></center>

                    <input type="file" class="form-control" name="image" accept="image/*"  oninvalid="this.setCustomValidity('قم بادخال الصورة')"  oninput="this.setCustomValidity('')">
                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
              <!----------------------------------------------------->
              <div class="form-group">
                    <label for="image">ملف النشرة</label>
                   <center> <embed src="<?php echo asset("storage/release/release_$release->id/{$release->file}")?>" width="30%"  accept="application/pdf,application/vnd.ms-excel"/></center>

                    <input type="file" class="form-control" name="filee"  oninvalid="this.setCustomValidity('قم بادخال ملف النشرة')"  oninput="this.setCustomValidity('')" >
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

@endsection