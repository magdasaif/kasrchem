@extends('layouts.master')
@section('css')

@section('title')
المنتجات
@stop
@endsection
@section('page-header')


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

<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{$title}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">الرئيسيه</a></li>
                <li class="breadcrumb-item active">{{$title}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">



        <div class="modal-header">
            <h5 class="modal-title">اضافه منتج</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            
            <form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
            
                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}

                   <!----------------------------------------------------->
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم التصنيف الرئيسي</label>
                    <select class="form-control" name="main_cate_id" style="height: 50px;">
                        <option value="0" selected disable>اختر التصنيف الرئيسي</option>
                        @foreach ($categories as $category)
                            @if($category->sub_cate2_count>0)
                                <option value="{{ $category->id }}">{{ $category->subname_ar }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                 
            <!----------------------------------------------------->
            
              
            <div id="all" style="background-color: #e8f2f9;border-radius: 23px;width: 95%; margin: auto;padding: 20px;display: none">    

            <div class="form-group"  id="sub2_div" name="sub2_div" style="display: none";>    
                    <label>   التصنيف الفرعي </label>
                    <select  class="form-control sub2"  id="sub2_id" name="sub2"  style="height: 50px;" required>
                    </select> 
              </div>

             <!----------------------------------------------------- -->
             
             <div class="form-group"  id="sub3_div" style="display: none";>
                <label>النوع</label>
                 <select  class="form-control sub3"  id="sub3_id" name="sub3"  style="height: 50px;" required>
                 </select> 
                </div>

                <!----------------------------------------------------- -->
                <div class="form-group"  id="sub4_div"  style="display: none";> 
                <label>النوع الفرعى</label>
                    <select  class="form-control sub4"  id="sub4_id" name="sub4"  style="height: 50px;" required>

                        
                    </select>
                    </div>
            </div>
               <!----------------------------------------------------->
               
                <div class="form-group">
                    <label for="exampleInputEmail1">كود المنتج</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter code" name="code" value="{{ old('code') }}" required>
                    @error('code')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم المنتج بالعربيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="name_ar" value="{{ old('name_ar') }}" required>
                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم المنتج بالانجليزيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="name_en" value="{{ old('name_en') }}" required>
                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">وصف المنتج بالعربيه</label>
                    <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter descrption" name="desc_ar" required>{{ old('desc_ar') }}</textarea>
                    @error('desc_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">وصف المنتج بالانجليزيه</label>
                    <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter descrption" name="desc_en" required>{{ old('desc_ar') }}</textarea>
                    @error('desc_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror

                   

                </div>

                <hr>

                <div class="form-group">
                    <label for="exampleInputEmail1">سعر المنتج</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="price" value="{{ old('price') }}" required>
                    @error('price')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">الضريبه %</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="tax" value="{{ old('tax') }}">
                    @error('tax')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">سعر العرض ان وُجد</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="offer_price" value="0">
                    @error('offer_price')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">الكمية المتاحة</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="amount" value="1" required>
                    @error('amount')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">الحد الادني</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="min_amount" value="1" required>
                    @error('min_amount')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">الحد الاقصي</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="max_amount" value="1" required>
                    @error('max_amount')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <hr>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">صورة المنتج الاساسية</label>

                    <input type="file" class="form-control" name="image" accept="image/*" required>

                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">صور المنتج الفرعيه</label>

                    <input type="file" class="form-control" name="photos[]" accept="image/*" multiple required>

                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">ملفات المنتج</label>

                    <input type="file" class="form-control" name="product_files[]" accept=".pdf" multiple required>

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
                
                <hr>
                
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
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="shipped_weight" value="{{old('shipped_weight')}}" required>
                    @error('shipped_weight')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
               
                <div class="form-group">
                    <label for="exampleInputEmail1">ترتيب المنتج</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="sort" value="0">
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
                
                 <!-------------------------------------------------------------------------->
                 <label for="exampleInputEmail1">اضافه خصائص المنتج</label>
                <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="List_Classes">
                                <div data-repeater-item>
                                    <div class="row">

                                        <div class="col">
                                            <input class="form-control" type="text" name="weight_ar"  placeholder="الخاصيه مثال : الوزن" value="{{old('weight_ar')}}"/>
                                            @error('weight_ar') <span class="text-danger error">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="col">
                                            <input class="form-control" type="text" name="value_ar" placeholder="القيمة (مثال : 10كجم)" value="{{old('value_ar')}}"/>
                                            @error('value_ar') <span class="text-danger error">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="col">
                                            <input class="form-control" type="text" name="weight_en" placeholder="الخاصية بالانجليزية (مثال : weight)" value="{{old('weight_en')}}"/>
                                            @error('weight_en') <span class="text-danger error">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="col">
                                            <input class="form-control" type="text" name="value_en" placeholder="القيمة بالانجليزيه (مثال : 10كجم)" value="{{old('value_en')}}"/>
                                            @error('value_en') <span class="text-danger error">{{ $message }}</span>@enderror
                                        </div>


                                        <div class="col">
                                           
                                            <input class="btn btn-danger btn-block" data-repeater-delete
                                                type="button" value="حذف" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col-12">
                                    <input class="button" data-repeater-create type="button" value="اضافه"/>
                                </div>

                            </div>

                        </div>
                    </div>
                <!-------------------------------------------------------------------------->
                
            
                
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">اضافه</button>
                        <a href="{{route('products.index')}}"><button type="button" class="btn btn-danger"  > الغاء</button></a>

                </div>
                </form>
        </div>
      
        </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>

//  $("#all").css('display', 'none'); 
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
                             $("#all").css('display', 'block');
                            $("#sub2_div").show();
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
@endsection
