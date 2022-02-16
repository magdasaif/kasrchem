@extends('layouts.master')
@section('title')
<title> لوحة التحكم :تعديل المعرض</title>
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
                <h3 class="card-title">تعديل المعرض</h3>
              </div>
 <!--#############################################################-->
 <div class="modal-body"  >
   <form method="POST"  action="{{route('photo_gallery.update',$photo_gallery->id)}}" enctype="multipart/form-data">
                {{method_field('PATCH ')}}

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}

                 <!----------------------------------------------------->
                 <div class="form-group">
                        <label>  اقسام الموقع </label>

                        <select  class="form-control sub2"  id="section_sel" name="section_id" >
                            <option value="{{$s->id}}" selected>{{$s->site_name_ar}}</option>
                            <option value="0">جميع الاقسام</option>
                                @foreach ($sections as $sec)
                                <option value="{{ $sec->id }}" <?php if($sec->id == Session::get('section_id')){echo 'selected';}?>>{{ $sec->site_name_ar }}</option>
                                @endforeach
                        </select>

                    </div>
                   <!----------------------------------------------------->
              
                   <div class="form-group">
                 <label>التصنيف الرئيسى</label>
                <select   class="form-control main_category" id="main_category_id" name="main_cate_id" required  oninvalid="this.setCustomValidity('قم بادخال التصنيف الرئيسي')"  oninput="this.setCustomValidity('')">
                    @if(!Session::has('cate_id'))
                    
                        <option value="{{$photo_gallery->relation_with_main_category->id}}" selected="true">{{$photo_gallery->relation_with_main_category->subname_ar}}</option>
                    
                    @else
                        @foreach ($Main_Cat as $category)
                            @if(($category->id!=$photo_gallery->relation_with_main_category->id)   ) 
                                <option value="{{ $category->id }}" <?php if($category->id == Session::get('cate_id')){echo 'selected';}?>>{{ $category->subname_ar }}</option>
                            @endif
                        @endforeach
                    @endif
                 </select>
                 <!-----------------add new cate if no category found for this section------------------------------------>
                 <div class="form-control" id="sub1_requi" style="display:none;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد تصنيف رئيسى للقسم المختار من فضلك قم باضافته اولا</span>
                        <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal0" style="margin-right: 23px;font-weight: bold;"></i>
                    </div>
                    <!----------------------------------------------------->
                 <div  id="main_error" style="color: red;display: none;">قم بادخال التصنيف الرئيسي</div>
            </div>

            

            <!----------------------------------------------------->


            <div class="form-group"  id="sub2_div" name="sub2_div">
                    <label>   التصنيف الفرعي </label>
                    @if(Session::get('cate_id') && !Session::get('sub2_id'))
                        <!-----------------add new cate if no category found for this section------------------------------------>
                    <div class="form-control" id="sub2_requi" style="display:block;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد تصنيف فرعى للتصنيف الرئيسي المختار من فضلك قم باضافته اولا</span>
                        <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal" style="margin-right: 23px;font-weight: bold;"></i>
                    </div>
                    <!----------------------------------------------------->
                    @else
                    <select  class="form-control sub2"  id="sub2_sel" name="sub2" required  oninvalid="this.setCustomValidity('قم بادخال التصنيف الفرعى')"  oninput="this.setCustomValidity('')">
                        @if(!Session::has('sub2_id'))
                        <!-- <option value="ffffffffff">hereeeeeeeeeeeeeeeee</option> -->
                        <option value="{{ $photo_gallery->relation_with_sub2_category->id }}" selected >{{ $photo_gallery->relation_with_sub2_category->subname2_ar }}</option>
                        @else
                            @foreach ($Sub_Category2 as $sub2)
                                <option value="{{ $sub2->id }}" <?php if($sub2->id == Session::get('sub2_id')){echo 'selected';}?>>{{ $sub2->subname2_ar }}</option>
                            @endforeach
                        @endif
                    </select>
                    <div class="form-control" id="sub2_requi" style="display:none;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد تصنيف فرعى للتصنيف الرئيسي المختار من فضلك قم باضافته اولا</span>
                        <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal" style="margin-right: 23px;font-weight: bold;"></i>
                      </div>
                    <!----------------------------------------------------->
                    @endif
              </div>

             <!----------------------------------------------------- -->

             <div class="form-group"  id="sub3_div">
                <label>النوع الرئيسي</label>
                @if(Session::get('cate_id') && Session::get('sub2_id') && !Session::get('sub3_id'))
                    <!-----------------add new cate if no category found for this section------------------------------------>
                <div class="form-control" id="sub3_requi" style="display:block;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد نوع رئيسي للتصنيف الفرعي المختار من فضلك قم باضافته اولا</span>
                    <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal3" style="margin-right: 23px;font-weight: bold;"></i>
                </div>
                <!----------------------------------------------------->
                @else
                 <select  class="form-control sub3"  id="sub3_sel" name="sub3" required  oninvalid="this.setCustomValidity('قم بادخال النوع الرئيسي')"  oninput="this.setCustomValidity('')">
                    @if(Session::has('sub3_id'))
                    @else
                   <option value="{{$photo_gallery->relation_with_sub3_category->id}}" selected>{{$photo_gallery->relation_with_sub3_category->subname_ar}}</option>
                    @endif
                   @foreach ($Sub_Category3 as $sub3)
                            <option value="{{ $sub3->id }}" <?php if($sub3->id == Session::get('sub3_id')){echo 'selected';}?>>{{ $sub3->subname_ar }}</option>
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
                <div class="form-group"  id="sub4_div">
                <label>النوع الفرعى</label>
                    @if(Session::get('cate_id') && Session::get('sub2_id') && Session::get('sub3_id') && !Session::get('sub4_id'))
                        <!-----------------add new cate if no category found for this section------------------------------------>
                    <div class="form-control" id="sub4_requi" style="display:block;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد نوع فرعي للنوع الرئيسي المختار من فضلك قم باضافته اولا</span>
                        <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal4" style="margin-right: 23px;font-weight: bold;"></i>
                    </div>
                    <!----------------------------------------------------->
                    @else
                    <select  class="form-control sub4"   id="sub4_sel" name="sub4" required  oninvalid="this.setCustomValidity('قم بادخال النوع الفرعى')"  oninput="this.setCustomValidity('')">
                    @if(Session::has('sub4_id'))
                    @else
                        <option value="{{$photo_gallery->relation_with_sub4_category->id}}" selected>{{$photo_gallery->relation_with_sub4_category->subname_ar}}</option>
                    @endif
                     @foreach ($Sub_Category4 as $sub4)
                            <option value="{{ $sub4->id }}" <?php if($sub4->id == Session::get('sub4_id')){echo 'selected';}?>>{{ $sub4->subname_ar }}</option>
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
                    <label for="title_ar">اسم المعرض  بالعربية </label>
                    <input type="text" class="form-control" id="title_ar" aria-describedby="title_ar" placeholder="ادخل اسم المعرض بالعربية" name="title_ar" value="{{$photo_gallery->title_ar}}" required   oninvalid="this.setCustomValidity('قم بادخال اسم المعرض بالعربية')"  oninput="this.setCustomValidity('')">
                    @error('title_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="title_en">اسم المعرض بالانجليزية</label>
                    <input type="text" class="form-control" id="title_en" aria-describedby="title_en" placeholder="ادخل اسم المعرض بالانجليزية" name="title_en"  value="{{$photo_gallery->title_en}}" required oninvalid="this.setCustomValidity('قم بادخال اسم المعرض بالانجليزية')"  oninput="this.setCustomValidity('')">
                    @error('title_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
               
              
              <!----------------------------------------------------->
            <div class="form-group">
                    <label for="image">الصورة</label>
                   <center> <img data-v-20a423fa="" style="width:30%;" src="<?php echo asset("storage/photo_gallery/{$photo_gallery->image}")?>" class="uploaded-img"></center>
                    <input type="file" class="form-control" name="image" >
                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">الحالة</label>
                    <select class="form-control" name="status">
                            <option value="1" <?php if($photo_gallery->status==1){echo'selected';}?> >مُفعل</option>
                            <option value="0" <?php if($photo_gallery->status==0){echo'selected';}?> >غير مُفعل</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$photo_gallery->id}}">
               
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

@endsection
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>

<!-- add script for categories and changes on it -->
<script src="{{ URL::asset('/js/product/edit_script.js') }}"></script>