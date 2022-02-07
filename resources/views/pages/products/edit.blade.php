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
                   <!----------------------------------------------------->
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم التصنيف الرئيسي</label>
                    <select class="form-control" name="main_cate_id" style="height: 50px;">
                        <option value="{{$product->relation_with_main_category->id}}" selected>{{$product->relation_with_main_category->subname_ar}}</option>
                        @foreach ($categories as $category)
                            @if($category->sub_cate2_count>0 && $product->relation_with_main_category->id != $category->id)
                                <option value="{{ $category->id }}">{{ $category->subname_ar }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                 
            <!----------------------------------------------------->
            
              
            <div id="all" >    

            <div class="form-group"  id="sub2_div" name="sub2_div">    
                    <label>   التصنيف الفرعي </label>
                    <select  class="form-control sub2"  id="sub2_id" name="sub2" style="height: 50px;" required>
                        <option value="{{ $product->relation_with_sub2_category->id }}" selected >{{ $product->relation_with_sub2_category->subname2_ar }}</option>
                    </select> 
              </div>

             <!----------------------------------------------------- -->
             
             <div class="form-group"  id="sub3_div">
                <label>النوع</label>
                 <select  class="form-control sub3"  id="sub3_id" name="sub3" style="height: 50px;" required>
                     <option value="{{$product->relation_with_sub3_category->id}}" selected>{{$product->relation_with_sub3_category->subname_ar}}</option>
                 </select> 
                </div>

                <!----------------------------------------------------- -->
                <div class="form-group"  id="sub4_div"> 
                <label>النوع الفرعى</label>
                    <select  class="form-control sub4"  id="sub4_id" name="sub4" style="height: 50px;" required>
                         <option value="{{$product->relation_with_sub4_category->id}}" selected>{{$product->relation_with_sub4_category->subname_ar}}</option>

                        
                    </select>
                    </div>
            </div>
               <!----------------------------------------------------->
               
                <div class="form-group">
                    <label for="exampleInputEmail1">كود المنتج</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter code" name="code" value="{{ $product->code }}" required>
                    @error('code')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
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
                    <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter descrption" name="desc_ar" required>{{ $product->desc_ar }}</textarea>
                    @error('desc_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">وصف المنتج بالانجليزيه</label>
                    <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter descrption" name="desc_en" required>{{ $product->desc_en }}</textarea>
                    @error('desc_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror

                   

                </div>

                <hr>
                <div class="form-group">
                    <label for="exampleInputEmail1">الموردين</label> <small> [ قم بتحديد الموردين ] </small>
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
                <label for="exampleInputEmail1">الاتاحة</label>
                    <select class="form-control" name="availabe_or_no" style="height: 50px;">
                            <option value="1" <?php if($product->availabe_or_no==1){echo'selected';}?>>متاح</option>
                            <option value="0" <?php if($product->availabe_or_no==0){echo'selected';}?>>غير متاح</option>
                    </select>
                </div>

                <div class="form-group">
                <label for="exampleInputEmail1">اضافه كمنتج جديد</label>
                      <input type="checkbox" class="form-control" id="exampleInputEmail1"  name="add_as_new" style="width: 100px;height: 20px;margin-right: 100px;">
                </div>

                <div class="form-group">
                <label for="exampleInputEmail1"> يتطلب تصريح امنى</label>
                      <input type="checkbox" class="form-control" id="exampleInputEmail1" <?php if($product->security_permit==1){echo'checked';}?> name="security_permit" style="width: 100px;height: 20px;margin-right: 100px;">
                </div>

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
                
            <input type="hidden" value="{{$product->id}}" name="id">
                
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تعديل</button>
                        <a href="{{route('products.index')}}"><button type="button" class="btn btn-danger"  > الغاء</button></a>
                 </div>

                </form>
                </div>
 <!--#############################################################-->

 		</div>
            </div>
        </div>
    </div>
</section>
</div>
@endsection
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script>
        //---------------for show seelct option of sub2------------------------//
        $(document).ready(function () {
            $('select[name="main_cate_id"]').on('change', function () {
               // alert('ssss');
                var main_cate_id = $(this).val();
               if (main_cate_id) {
                  // alert(main_cate_id);
                  //alert("{{ URL::to('fetch_sub2')}}/" + main_cate_id);
                   
                    $.ajax({
                        type: "GET",
                        url: "{{ URL::to('fetch_sub2')}}/" + main_cate_id,
                        dataType: "json",
                        success: function (data) 
                        {
                           //  alert(data);

                            //  $("#all").show();
                             $("#sub3_div").css('display', 'none');
                             $("#sub4_div").css('display', 'none');
                          //  $("#sub2_div").show();
                             $('#sub2_id').empty();
                             $('#sub2_id').append('<option value="0" disabled="true" selected="true">اختر التصنيف الفرعي</option>');
                             $.each(data, function (key, value) {
                                 //alert('<option value="' + key + '">' + value + '</option>');
                              $('#sub2_id').append('<option value="' + key + '">' + value + '</option>');
                             });
                         
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
         //---------------for show seelct option of sub3------------------------//
         $(document).ready(function () {
            $('select[name="sub2"]').on('change', function () {
                var sub2_id = $(this).val();
               // alert (sub2_id);
               if (sub2_id) {
                //   alert("{{ URL::to('fetch_sub3')}}/" + sub2_id);
                   
                    $.ajax({
                        type: "GET",
                        url: "{{ URL::to('fetch_sub3')}}/" + sub2_id,
                        dataType: "json",
                      
                        success: function (data) 
                        {
                             //alert("true");
                            $("#sub3_div").show();
                            $("#sub4_div").css('display', 'none');
                             $('select[name="sub3"]').empty();
                             $('select[name="sub3"]').append('<option value="0" disabled="true" selected="true">اختر النوع</option>');
                               $.each(data, function (key, value) {
                              $('select[name="sub3"]').append('<option value="' + key + '">' + value + '</option>');
                             });
                         
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
        //---------------for show seelct option of sub4------------------------//
        $(document).ready(function () {
            $('select[name="sub3"]').on('change', function () {
                var sub3_id = $(this).val();
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
                            $("#sub4_div").show();
                             $('select[name="sub4"]').empty();
                             $('select[name="sub4"]').append('<option value="0" disabled="true" selected="true">اختر النوع الفرعى</option>');
                               $.each(data, function (key, value) {
                              $('select[name="sub4"]').append('<option value="' + key + '">' + value + '</option>');
                             });
                         
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
</script>