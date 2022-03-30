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

             <!-- <div style="    text-align: center;color: red;font-size: x-large;">تاكد من ادخال (تصنيف فرعى ونوع رئيسى ونوع فرعى ) للتصنيف الرئيسى المراد اختياره </div>
             <hr> -->
   <!----------------------------------------------------->
            <!--========================================================-->
            @include('categories.Category_models.select_category_adding')
              <!--========================================================-->
               <!----------------------------------------------------->
                <div class="form-group">
                    <label for="exampleInputEmail1">الموردين</label> <span style="font-size: initial;color: red;"> [ قم بتحديد الموردين ] </span>
                    <br>
                    <center>
                            <span style="color:#d54646;font-weight: bold;"> لاضافه مورد</span>
                            <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#SupplierModel" style="margin-right: 23px;font-weight: bold;"></i>
                    </center>
                    <select class="form-control" name="supplier_id[]"  multiple required>
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
                                @include('pages.products.manageChild',$new)
                            @endif
                        @endforeach
                    </select>
                </div>

                
                <hr>

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
                    <textarea class="form-control tinymce-editor" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter descrption" name="desc_ar" >{!! old('desc_ar')!!}</textarea>
                    @error('desc_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">وصف المنتج بالانجليزيه</label>
                    <textarea class="form-control tinymce-editor" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter descrption" name="desc_en" >{!! old('desc_en')!!}</textarea>
                    @error('desc_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror



                </div>

                <hr>

                <div class="form-group">
                    <label for="exampleInputEmail1">صورة المنتج الاساسية *</label>

                    <input type="file" class="form-control" name="image" accept="image/*" required>

                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
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
<!----------------------------------------------------------------------------->
<div style="display:none">

                <div class="form-group">
                    <label for="exampleInputEmail1">كود المنتج</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter code" name="code" value="<?php if(old('code')){echo old('code');}else{echo'0';}?>" >
                    @error('code')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">سعر المنتج</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="price" value="<?php if(old('price')){echo old('price');}else{echo'0';}?>">
                    @error('price')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">الضريبه %</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="tax" value="<?php if(old('tax')){echo old('tax');}else{echo'0';}?>">
                    @error('tax')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">سعر العرض ان وُجد</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="offer_price" value="<?php if(old('offer_price')){echo old('offer_price');}else{echo'0';}?>">
                    @error('offer_price')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">الكمية المتاحة</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="amount" value="1" >
                    @error('amount')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">الحد الادني</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="min_amount" value="1" >
                    @error('min_amount')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">الحد الاقصي</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="max_amount" value="1" >
                    @error('max_amount')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="exampleInputEmail1">البيع من خلال</label>
                    <select class="form-control" name="sell_through"  style="height: 50px;">
                            <option value="1" {{ old('sell_through') == '1' ? "selected" : "" }}>الموقع والفروع</option>
                            <option value="2" {{ old('sell_through') == '2' ? "selected" : "" }}>الموقع فقط</option>
                            <option value="3" {{ old('sell_through') == '3' ? "selected" : "" }}>الفروع فقط</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">الوزن القائم عند الشحن بالكيلو جرام</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="shipped_weight" value="0" >
                    @error('shipped_weight')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>




                <div class="form-group">
                <label for="exampleInputEmail1">الاتاحة</label>
                    <select class="form-control" name="availabe_or_no" style="height: 50px;">
                            <option value="1" {{ old('availabe_or_no') == '1' ? "selected" : "" }}>متاح</option>
                            <option value="0" {{ old('availabe_or_no') == '0' ? "selected" : "" }}>غير متاح</option>
                    </select>
                </div>

                <div class="form-group">
                <label for="exampleInputEmail1"> يتطلب تصريح امنى</label>
                      <input type="checkbox" class="form-control" id="exampleInputEmail1"  name="security_permit" style="width: 100px;height: 20px;margin-right: 100px;" {{ old('security_permit') == 'on' ? "checked" : "" }}>
                </div>

                <!--------------------------------------------------------------------------->
                 <!-------------------------------------------------------------------------->
        <div class="form repeater-default">
            <label for="exampleInputEmail1">اضافه خصائص المنتج</label>

                <div data-repeater-list="List_Classes">
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
                        <button class="btn btn-danger" data-repeater-delete type="button"> <i class="bx bx-x"></i>
                            حذف
                        </button>
                        </div>
                    </div>
                    <hr>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col p-0">
                    <center><button class="btn btn-success" data-repeater-create type="button"><i class="bx bx-plus"></i>
                        اضافه خاصيه
                    </button></center>
                    </div>
                </div>
        </div>

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

<!-- add script for categories and changes on it -->
<script src="{{ URL::asset('/js/product/add_script.js') }}"></script>
<script src="{{ URL::asset('/js/regax_name/regax_name.js') }}"></script>

<!-- tinymce -->
<script src="{{ URL::asset('assets/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::asset('/js/tiny.js') }}"></script>
@endsection