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
                            <option value="{{$s->id}}" selected>{{$s->site_name_ar}}</option>
                            <option value="0">جميع الاقسام</option>
                                @foreach ($sections as $sec)
                                <option value="{{ $sec->id }}" <?php if($sec->id == Session::get('section_id')){echo 'selected';}else{ if(old('section_id') == $sec->id){echo "selected";}}?>>{{ $sec->site_name_ar }}</option>
                                @endforeach
                        </select>
                        
                    </div>
                   <!----------------------------------------------------->
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم التصنيف الرئيسي</label>
                    <select class="form-control" id="main_category_id" name="main_cate_id"  required  oninvalid="this.setCustomValidity('قم بادخال التصنيف الرئيسي')"  oninput="this.setCustomValidity('')">
                        <option value="{{$product->relation_with_main_category->id}}" selected>{{$product->relation_with_main_category->subname_ar}}</option>
                        @foreach ($categories as $category)
                            @if($product->relation_with_main_category->id != $category->id)
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
                        <option value="{{ $product->relation_with_sub2_category->id }}" selected >{{ $product->relation_with_sub2_category->subname2_ar }}</option>
                        @foreach ($Sub_Category2 as $sub2)
                            <option value="{{ $sub2->id }}" <?php if($sub2->id == Session::get('sub2_id')){echo 'selected';}else{ if(old('sub2') == $sub2->id){echo "selected";}}?>>{{ $sub2->subname2_ar }}</option>
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
                 <select  class="form-control sub3"  id="sub3_sel" name="sub3" required  oninvalid="this.setCustomValidity('قم بادخال النوع الرئيسي')"  oninput="this.setCustomValidity('')">
                     <option value="{{$product->relation_with_sub3_category->id}}" selected>{{$product->relation_with_sub3_category->subname_ar}}</option>
                     @foreach ($sub_Category3 as $sub3)
                            <option value="{{ $sub3->id }}" <?php if($sub3->id == Session::get('sub3_id')){echo 'selected';}else{ if(old('sub3') == $sub3->id){echo "selected";}}?>>{{ $sub3->subname_ar }}</option>
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
                         <option value="{{$product->relation_with_sub4_category->id}}" selected>{{$product->relation_with_sub4_category->subname_ar}}</option>
                         @foreach ($sub_Category4 as $sub4)
                            <option value="{{ $sub4->id }}" <?php if($sub4->id == Session::get('sub4_id')){echo 'selected';}else{ if(old('sub4') == $sub4->id){echo "selected";}}?>>{{ $sub4->subname_ar }}</option>
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
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="name_ar" value="{{ $product->name_ar }}" required>
                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم المنتج بالانجليزيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="name_en" value="{{ $product->name_en }}" required>
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
                    <center> <img data-v-20a423fa="" style="width: 30%;" src="<?php echo asset("storage/products/product_no_$product->id/$product->image")?>" class="uploaded-img"> </center>

                    <input type="file" class="form-control" name="image" accept="image/*">

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
@endsection
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('assets/tinymce/tinymce.min.js') }}"></script>

<script>
    tinymce.init({
        selector: 'textarea.tinymce-editor',
        
        height: 300,
        theme: 'modern',
        plugins: [
        "advlist autolink autosave link image code lists charmap print preview hr anchor pagebreak spellchecker",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "table contextmenu directionality emoticons template textcolor paste fullpage textcolor"
    ],
//---------------------------دى الحااجات اللى بتظهر---------------------------- //
    toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
    toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | inserttime preview | forecolor backcolor",
    toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
    toolbar4: 'undo redo ',
    menubar: true,
    toolbar_items_size: 'small',
//---------------------------------------------------------------------------------------
    style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'},
        
    ],

//---------------------------------------------------------------------------------------
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ],
    
  //------------------to add class to image-------------------------
image_class_list: [
    {title: 'None', value: ''},
    {title: 'image_class', value: 'photo'},
    {title: 'Lightbox', value: 'lightbox'}
  ],
//-------------------------------for upload image------------------
  
  /* enable title field in the Image dialog*/
  image_title: true,
  /* enable automatic uploads of images represented by blob or data URIs*/
  automatic_uploads: true,
 
   file_picker_types: 'file image media',
  /* and here's our custom image picker*/
  file_picker_callback: function (cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');

    
    input.onchange = function () {
      var file = this.files[0];

      var reader = new FileReader();
      reader.onload = function () {
        /*
          Note: Now we need to register the blob in TinyMCEs image blob
          registry. In the next release this part hopefully won't be
          necessary, as we are looking to handle it internally.
        */
        var id = 'blobid' + (new Date()).getTime();
        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(',')[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        /* call the callback and populate the Title field with the file name */
        cb(blobInfo.blobUri(), { title: file.name });
      };
      reader.readAsDataURL(file);
    };

    input.click();
  },
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'

    });
    
   
    //---------------for show selct option of when change on any one of them------------------------//
     $(document).ready(function () {

        $('select[name="section_id"]').on('change', function () {
        // alert('ssss');
        var section_id = $(this).val();
            // alert(section_id);
            // alert("{{ URL::to('fetch_sub1')}}/" + section_id);
            
            $.ajax({
                type: "GET",
                url: "{{ URL::to('fetch_sub1')}}/" + section_id,
                dataType: "json",
                success: function (data) 
                {
                    if(data!='')
                    { //لو فى تصنيف رئيسى للقسم هيعرضه 

                        //هيخفى ويفضى اى حاجه تحته
                        $("#sub1_requi").hide();
                        $('#main_category_id').empty();
                        
                        $('select[name="main_cate_id"]').show();
                        
                        $("#sub2_requi").hide();
                            $('#sub2_sel').empty();
                            $('#sub2_sel').show();
                            
                            $("#sub3_requi").hide();
                            $('#sub3_sel').empty();
                            $('#sub3_sel').show();
                            
                            $("#sub4_requi").hide();
                            $('#sub4_sel').empty();
                            $('#sub4_sel').show();
                        
                        $('#main_category_id').append('<option value="" disabled="true" selected="true">اختر التصنيف الرئيسى</option>');
                        $.each(data, function (key, value) {
                            //alert('<option value="' + key + '">' + value + '</option>');
                        $('#main_category_id').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                    else
                    {
                        // alert("لا يوجـد تصنيف رئيسى للقسم المختار من فضلك قم باضافته اولا");


                        $('select[name="main_cate_id"]').hide();//hide select 
                        $("#sub1_requi").show();//show div if sub1not founded
                        
                        $("#sub2_requi").hide();
                            $('#sub2_sel').empty();
                            $('#sub2_sel').show();
                            
                            $("#sub3_requi").hide();
                            $('#sub3_sel').empty();
                            $('#sub3_sel').show();
                            
                            $("#sub4_requi").hide();
                            $('#sub4_sel').empty();
                            $('#sub4_sel').show();

                        
                       
                            //-------------get name of section--------------//
                                document.getElementById("section_id").value=section_id; 
                                //  alert($( "#main_category_id option:selected" ).text()); //بيجيب قيمة الاوبشن المختارة
                                 document.getElementById("new_main_name").value=$("#section_sel option:selected" ).text(); 
                            //----------------------------//
                    }
                    
                },
                error:function()
                { alert("false"); }
            });
    });
    //---------------------to get value if not making change in select------------------------
    //save section id value to return back with it
    var section_id = $('select[name="section_id"]').val();
    document.getElementById("section_id").value=section_id;
    document.getElementById("section_id1").value=section_id;
    document.getElementById("section_id2").value=section_id;
    document.getElementById("section_id22").value=section_id;
    //alert(section_id);

    //save main category id value to return back with it
    var cate_id = $('select[name="main_cate_id"]').val();
    document.getElementById("cate_id").value=cate_id;
    document.getElementById("cate_id2").value=cate_id;
    document.getElementById("cate_id22").value=cate_id;
   // alert(cate_id);


   var sub2_id = $('select[name="sub2"]').val();
   document.getElementById("sub2_id").value=sub2_id;
   document.getElementById("sub2_id2").value=sub2_id;



   var sub3_id = $('select[name="sub3"]').val();
   document.getElementById("sub3_id").value=sub3_id;
   
    //read value of selected sub category
    document.getElementById("new_main_name").value=$("#section_sel option:selected" ).text(); 
    document.getElementById("test").value=$("#main_category_id option:selected" ).text();
    document.getElementById("sub2_name").value=$("#sub2_sel option:selected" ).text();
    document.getElementById("sub3_name").value=$("#sub3_sel option:selected" ).text(); 

    if($("#sub1_requi").css('display')=='block'){

$("#sub2_requi").hide();
$('#sub2_sel').empty();
$('#sub2_sel').show();

$("#sub3_requi").hide();
$('#sub3_sel').empty();
$('#sub3_sel').show();

$("#sub4_requi").hide();
$('#sub4_sel').empty();
$('#sub4_sel').show();
}

if($("#sub2_requi").css('display')=='block'){
$("#sub3_requi").hide();
$('#sub3_sel').empty();
$('#sub3_sel').show();

$("#sub4_requi").hide();
$('#sub4_sel').empty();
$('#sub4_sel').show();
}

if($("#sub3_requi").css('display')=='block'){
$("#sub4_requi").hide();
$('#sub4_sel').empty();
$('#sub4_sel').show();
}

//-----------------------------------------------------------------------------
    $('select[name="main_cate_id"]').on('change', function () {
                var main_category_id = $(this).val();
                var section_id = $('select[name="section_id"]').val();

              if (main_category_id) {
                 // alert("{{ URL::to('fetch_sub2')}}/" + main_category_id);
                   
                    $.ajax({
                        type: "GET",
                        url: "{{ URL::to('fetch_sub2')}}/" + main_category_id,
                        dataType: "json",
                      
                        success: function (data) 
                        {
                             //alert("true");
                             
                             $('select[name="sub2"]').empty();
                             $('select[name="sub3"]').empty();
                             $('select[name="sub4"]').empty();

                           
                               //--------------------------------------------//
                            if(data!='')
                            {
                                
                                $('select[name="sub2"]').show();
                                $("#sub2_requi").hide();
                            
                                $("#sub3_requi").hide();
                                $('#sub3_sel').empty();
                                $('#sub3_sel').show();
                                
                                $("#sub4_requi").hide();
                                $('#sub4_sel').empty();
                                $('#sub4_sel').show();
                            
                                $('select[name="sub2"]').append('<option value="" disabled="true" selected="true">اختر التصنيف الفرعي</option>');
                             $.each(data, function (key, value) {
                              $('select[name="sub2"]').append('<option value="' + key + '">' + value + '</option>');
                             });
                         
                            }
                            else
                            {
                               // alert("لا يوجـد تصنيف فرعى للتصنيف الرئيسي المختار من فضلك قم باضافته اولا");
                                $('select[name="sub2"]').hide();//hide select 
                                 $("#sub2_requi").show();//show div if sub2not founded

                                 $("#sub3_requi").hide();
                                $('#sub3_sel').empty();
                                $('#sub3_sel').show();
                                
                                $("#sub4_requi").hide();
                                $('#sub4_sel').empty();
                                $('#sub4_sel').show();
                                
                                    //-------------get name of main_category--------------//
                                    document.getElementById("section_id1").value=section_id;

                                       document.getElementById("cate_id").value=main_category_id; 
                                       //  alert($( "#main_category_id option:selected" ).text()); //بيجيب قيمة الاوبشن المختارة
                                        document.getElementById("test").value=$("#main_category_id option:selected" ).text(); 
                                    //----------------------------//
                            
                            
                           
                            }
                         //--------------------------------------------//
                          
                        },
                        error:function()
                        { alert("false"); }
                    });
                   
                }
                else {
                    alert('AJAX load did not work');
                }
            });
       
         //---------------for show seelct option of sub3------------------------//
        
            $('select[name="sub2"]').on('change', function () {
                var sub2_id = $(this).val();
                var section_id = $('select[name="section_id"]').val();
                var cate_id = $('select[name="main_category"]').val();
               // alert (sub2_id);
               if (sub2_id) {
                  // alert("{{ URL::to('fetch_sub3')}}/" + sub2_id);
                   
                    $.ajax({
                        type: "GET",
                        url: "{{ URL::to('fetch_sub3')}}/" + sub2_id,
                        dataType: "json",
                      
                        success: function (data) 
                        {
                             //alert("true");
                            /// $("#sub3_div").show();
                             $('select[name="sub3"]').empty();
                             $('select[name="sub4"]').empty();
                               //--------------------------------------------//
                               if(data!='')
                            {
                                $('select[name="sub3"]').show();
                                $("#sub3_requi").hide();
                                
                                $("#sub4_requi").hide();
                                $('#sub4_sel').empty();
                                $('#sub4_sel').show();
                                
                                $('select[name="sub3"]').append('<option value="" disabled="true" selected="true">اختر النوع</option>');
                               $.each(data, function (key, value) {
                              $('select[name="sub3"]').append('<option value="' + key + '">' + value + '</option>');
                             });
                            }
                            else
                            {
                                $('select[name="sub3"]').hide();//hide select 
                                $("#sub3_requi").show();//show div if sub2not founded
                                
                                $("#sub4_requi").hide();
                                $('#sub4_sel').empty();
                                $('#sub4_sel').show();
                                    //-------------get name of sub2--------------//
                                   // alert(sub2_id);
                                   document.getElementById("section_id2").value=section_id;
                                    document.getElementById("cate_id2").value=cate_id;
                                    
                                       document.getElementById("sub2_id").value=sub2_id; 
                                     //  alert($( "#sub2_sel option:selected" ).text());
                                        document.getElementById("sub2_name").value=$("#sub2_sel option:selected" ).text(); 
                                    //----------------------------------------------------//
                            }
                             //--------------------------------------------//
                            
                            
                         
                        },
                        error:function()
                        { alert("false"); }
                    });
                   
                }
                else {
                    alert('AJAX load did not work');
                }
            });
      
        //---------------for show seelct option of sub4------------------------//
       
            $('select[name="sub3"]').on('change', function () {
                var sub3_id = $(this).val();
                var section_id = $('select[name="section_id"]').val();
                var cate_id = $('select[name="main_category"]').val();
                var sub2_id = $('select[name="sub2"]').val();
                //alert (sub3_id);
               if (sub3_id) {
                  // alert("{{ URL::to('fetch_sub4')}}/" + sub3_id);
                   
                    $.ajax({
                        type: "GET",
                        url: "{{ URL::to('fetch_sub4')}}/" + sub3_id,
                        dataType: "json",
                      
                        success: function (data) 
                        {
                             //alert("true");
                          //  $("#sub4_div").show();
                             $('select[name="sub4"]').empty();
                                //--------------------------------------------//
                                if(data!='')
                            {
                                $('select[name="sub4"]').show();
                                $("#sub4_requi").hide();
                                
                                $('select[name="sub4"]').append('<option value="" disabled="true" selected="true">اختر النوع الفرعى</option>');
                               $.each(data, function (key, value) {
                              $('select[name="sub4"]').append('<option value="' + key + '">' + value + '</option>');
                             });
                         
                            }
                            else
                            {
                                $('select[name="sub4"]').hide();//hide select 
                                 $("#sub4_requi").show();//show div if sub2not founded
                                    //-------------get name of sub2--------------//
                                         document.getElementById("sub2_id2").value=sub2_id; 
                                        document.getElementById("section_id22").value=section_id;
                                        document.getElementById("cate_id22").value=cate_id;
                                       document.getElementById("sub3_id").value=sub3_id; 
                                        document.getElementById("sub3_name").value=$("#sub3_sel option:selected" ).text(); 
                                    //----------------------------------------------------//
                            }
                        },
                        error:function()
                        { alert("false"); }
                    });
                   
                }
                else {
                    alert('AJAX load did not work');
                }
            });
        });
        //--------------------------------------------------------------------------//
    </script>