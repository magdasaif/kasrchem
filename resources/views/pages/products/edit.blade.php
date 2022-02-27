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
            @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                @endif

         

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
              </div>
 <!--#############################################################-->
        <div class="modal-body">

            <form method="POST" action="{{route('products.update',$product->id)}}" enctype="multipart/form-data">
            {{method_field('PATCH ')}}
                @csrf
                <!-- <div style="    text-align: center;color: red;font-size: x-large;">تاكد من ادخال (تصنيف فرعى ونوع رئيسى ونوع فرعى ) للتصنيف الرئيسى المراد اختياره </div>
                <hr> -->
                   <!----------------------------------------------------->
                   <div class="form-group">
                        <label>  اقسام الموقع </label>

                        <select  class="form-control sub2"  id="section_sel" name="section_id" >
                        <option value="{{$product->relation_with_site->id}}" selected>{{$product->relation_with_site->site_name_ar}}</option>
   
                            <option value="1" <?php if($product->relation_with_site->id=='1'){echo'hidden';}?>>اختر القسم</option>
                                @foreach ($sections as $sec)
                                    @if(($sec->id!=$product->relation_with_site->id)) 
                                        <option value="{{ $sec->id }}" <?php if($sec->id == Session::get('section_id')){echo 'selected';}else{ if(old('section_id') == $sec->id){echo "selected";}}?>>{{ $sec->site_name_ar }}</option>
                                    @endif
                                @endforeach
                        </select>

                    </div>
                   <!----------------------------------------------------->
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم التصنيف الرئيسي</label>
                    <select class="form-control" id="main_category_id" name="main_cate_id" >

                        @if(Session::get('cate_id'))
                        @else
                        <option value="{{$product->relation_with_main_category->id}}" selected>{{$product->relation_with_main_category->subname_ar}}</option>
                        @endif
                        
                        @foreach ($categories as $category)
                            @if($product->relation_with_main_category->id != $category->id)
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


            <div class="form-group"  id="sub2_div" name="sub2_div">
                    <label>   التصنيف الفرعي </label>
                    @if(Session::get('cate_id') && !Session::get('sub2_id'))
                        <!-----------------add new cate if no category found for this section------------------------------------>
                    <div class="form-control" id="sub2_requi" style="display:block;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد تصنيف فرعى للتصنيف الرئيسي المختار من فضلك قم باضافته اولا</span>
                        <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal" style="margin-right: 23px;font-weight: bold;"></i>
                    </div>
                    <!----------------------------------------------------->
                    @else
                    <select  class="form-control sub2"  id="sub2_sel" name="sub2" >
                        <option value="{{ $product->relation_with_sub2_category->id }}" selected >{{ $product->relation_with_sub2_category->subname2_ar }}</option>
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

             <div class="form-group"  id="sub3_div">
                <label>النوع الرئيسي</label>
                @if(Session::get('cate_id') && Session::get('sub2_id') && !Session::get('sub3_id'))
                    <!-----------------add new cate if no category found for this section------------------------------------>
                <div class="form-control" id="sub3_requi" style="display:block;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد نوع رئيسي للتصنيف الفرعي المختار من فضلك قم باضافته اولا</span>
                    <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal3" style="margin-right: 23px;font-weight: bold;"></i>
                </div>
                <!----------------------------------------------------->
                @else
                 <select  class="form-control sub3"  id="sub3_sel" name="sub3">
                     <option value="{{$product->relation_with_sub3_category->id}}" selected>{{$product->relation_with_sub3_category->subname_ar}}</option>
                     @foreach ($sub_Category3 as $sub3)
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
                <div class="form-group"  id="sub4_div">
                <label>النوع الفرعى</label>
                    @if(Session::get('cate_id') && Session::get('sub2_id') && Session::get('sub3_id') && !Session::get('sub4_id'))
                        <!-----------------add new cate if no category found for this section------------------------------------>
                    <div class="form-control" id="sub4_requi" style="display:block;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد نوع فرعي للنوع الرئيسي المختار من فضلك قم باضافته اولا</span>
                        <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal4" style="margin-right: 23px;font-weight: bold;"></i>
                    </div>
                    <!----------------------------------------------------->
                    @else
                    <select  class="form-control sub4"   id="sub4_sel" name="sub4" >
                         <option value="{{$product->relation_with_sub4_category->id}}" selected>{{$product->relation_with_sub4_category->subname_ar}}</option>
                         @foreach ($sub_Category4 as $sub4)
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
                <hr>
                <div class="form-group">
                    <label for="exampleInputEmail1">الموردين</label> <span style="font-size: initial;color: red;"> [ قم بتحديد الموردين ] </span>
                    <select class="form-control" name="supplier_id[]"  multiple required>

                        @foreach ($product->suppliers as $supplier_select)
                             <option selected value="{{ $supplier_select->id }}">{{ $supplier_select->name_ar }}</option>
                        @endforeach

                        @foreach ($suppliers as $supplier)
                             <option value="{{ $supplier->id }}">{{ $supplier->name_ar }}</option>
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
                    <textarea  class="form-control" rows="5" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="name_en" required onkeypress="return CheckEnglishCharactersOnly(event);" pattern="^(?=.*[a-zA-Z\s])[a-zA-Z0-9\s]+$" oninvalid="this.setCustomValidity('يجب ان يكون اسم المنتج باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">{!! $product->name_en !!}</textarea>
                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون اسم المنتج باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">وصف المنتج بالعربيه</label>
                    <textarea class="form-control tinymce-editor" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter descrption" name="desc_ar" >{!! $product->desc_ar !!}</textarea>
                    @error('desc_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">وصف المنتج بالانجليزيه</label>
                    <textarea class="form-control tinymce-editor" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter descrption" name="desc_en" >{!! $product->desc_en !!}</textarea>
                    @error('desc_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <hr>

                <div class="form-group">
                    <label for="exampleInputEmail1">صورة المنتج الاساسية</label>
                   
                    <center> <img  id="previewImg" style="width: 30%;" src="<?php echo asset("storage/products/product_no_$product->id/$product->image")?>" class="uploaded-img" title="للتعديل  اضغط على الصورة"> </center>
                   <br>
                    <center><button type="button" id="btn_image" class="btn btn-primary" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                                <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                                <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"></path>
                            </svg>
                             تعديل الصورة
                     </button></center>
                  
                     <input type="file" class="form-control" name="image"  id="my_file" accept="image/*" style="display: none;" >

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
<div style="display:none">

                <div class="form-group">
                    <label for="exampleInputEmail1">كود المنتج</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter code" name="code" value="{{ $product->code }}" required>
                    @error('code')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">سعر المنتج</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="price" value="{{ $product->price }}" required>
                    @error('price')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">الضريبه %</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="tax" value="{{ $product->tax }}">
                    @error('tax')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">سعر العرض ان وُجد</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="offer_price" value="{{$product->offer_price}}">
                    @error('offer_price')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">الكمية المتاحة</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="amount" value="{{$product->amount}}" required>
                    @error('amount')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">الحد الادني</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="min_amount" value="{{$product->min_amount}}" required>
                    @error('min_amount')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">الحد الاقصي</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="max_amount" value="{{$product->max_amount}}" required>
                    @error('max_amount')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">البيع من خلال</label>
                    <select class="form-control" name="sell_through" style="height: 50px;">
                            <option value="1" <?php if($product->sell_through==1){echo'selected';}?>>الموقع والفروع</option>
                            <option value="2" <?php if($product->sell_through==2){echo'selected';}?>>الموقع فقط</option>
                            <option value="3" <?php if($product->sell_through==3){echo'selected';}?>>الفروع فقط</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">الوزن القائم عند الشحن بالكيلو جرام</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="shipped_weight" value="{{$product->shipped_weight}}" required>
                    @error('shipped_weight')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                <label for="exampleInputEmail1">الاتاحة</label>
                    <select class="form-control" name="availabe_or_no" style="height: 50px;">
                            <option value="1" <?php if($product->availabe_or_no==1){echo'selected';}?>>متاح</option>
                            <option value="0" <?php if($product->availabe_or_no==0){echo'selected';}?>>غير متاح</option>
                    </select>
                </div>

                <div class="form-group">
                <label for="exampleInputEmail1"> يتطلب تصريح امنى</label>
                      <input type="checkbox" class="form-control" id="exampleInputEmail1" <?php if($product->security_permit==1){echo'checked';}?> name="security_permit" style="width: 100px;height: 20px;margin-right: 100px;">
                </div>

                 <!-------------------------------------------------------------------------->
                 <!-------------------------------------------------------------------------->
                 <div class="form repeater-default">
                    <label for="exampleInputEmail1">اضافه خصائص المنتج</label>

                        <div data-repeater-list="List_Classes">
                            @if($feature_count>0)
                                @foreach($features as $key=>$list)
                                <div data-repeater-item>
                                   <div class="row justify-content-between">

                                        <div class="col-md-2 col-sm-12 form-group">
                                            <input class="form-control" type="text" name="weight_ar"  placeholder="الخاصيه مثال : الوزن" value="{{ $list['weight_ar']}}"/>
                                            @error('weight_ar') <span class="text-danger error">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="col-md-2 col-sm-12 form-group">
                                            <input class="form-control" type="text" name="value_ar" placeholder="القيمة (مثال : 10كجم)" value="{{ $list['value_ar']}}"/>
                                            @error('value_ar') <span class="text-danger error">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="col-md-2 col-sm-12 form-group">
                                            <input class="form-control" type="text" name="weight_en" placeholder="الخاصية بالانجليزية (مثال : weight)" value="{{ $list['weight_en']}}"/>
                                            @error('weight_en') <span class="text-danger error">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="col-md-2 col-sm-12 form-group">
                                            <input class="form-control" type="text" name="value_en" placeholder="القيمة بالانجليزيه (مثال : 10كجم)" value="{{ $list['value_en']}}"/>
                                            @error('value_en') <span class="text-danger error">{{ $message }}</span>@enderror
                                        </div>


                                        <div class="col-md-2 col-sm-12 form-group d-flex align-items-center pt-2">
                                            <button class="btn btn-danger" data-repeater-delete type="button"> <i class="bx bx-x"></i>
                                                حذف
                                            </button>
                                        </div>

                                    </div>
                                </div>
                                <br>
                                @endforeach
                            @else
                            <div data-repeater-item>
                                <div class="row justify-content-between">

                                    <div class="col-md-2 col-sm-12 form-group">
                                        <input class="form-control" type="text" name="weight_ar"  placeholder="الخاصيه مثال : الوزن" value="{{old('weight_ar')}}"/>
                                        @error('weight_ar') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="col-md-2 col-sm-12 form-group">
                                        <input class="form-control" type="text" name="value_ar" placeholder="القيمة (مثال : 10كجم)" value="{{old('value_ar')}}"/>
                                        @error('value_ar') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="col-md-2 col-sm-12 form-group">
                                        <input class="form-control" type="text" name="weight_en" placeholder="الخاصية بالانجليزية (مثال : weight)" value="{{old('weight_en')}}"/>
                                        @error('weight_en') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="col-md-2 col-sm-12 form-group">
                                        <input class="form-control" type="text" name="value_en" placeholder="القيمة بالانجليزيه (مثال : 10كجم)" value="{{old('value_en')}}"/>
                                        @error('value_en') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="col-md-2 col-sm-12 form-group d-flex align-items-center pt-2">
                                        <button class="btn btn-danger" data-repeater-delete type="button">
                                            <i class="bx bx-x"></i>
                                            حذف
                                        </button>
                                    </div>
                            </div>
                            <hr>
                            </div>
                            @endif

                            </div>
                            <div class="form-group">
                                <div class="col p-0">
                                <center><button class="btn btn-success" data-repeater-create type="button"><i class="bx bx-plus"></i>
                                    اضافه خاصيه
                                </button></center>
                                </div>
                            </div>

                    </div>
                <!-------------------------------------------------------------------------->
                 <!-------------------------------------------------------------------------->
</div>

            <input type="hidden" value="{{$product->id}}" name="id">

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

<!-- add script for categories and changes on it -->
<script src="{{ URL::asset('/js/product/edit_script.js') }}"></script>

<!-- tinymce -->
<script src="{{ URL::asset('assets/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::asset('/js/tiny.js') }}"></script>

@endsection
