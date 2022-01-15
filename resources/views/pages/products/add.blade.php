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


@if(Session::has('error'))
     <div class="alert alert-danger">
         {{Session::get('error')}}
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

                <div class="form-group">
                    <label for="exampleInputEmail1">اسم التصنيف الرئيسي</label>
                    <select class="form-control" name="main_cate_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->subname_ar }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">كود المنتج</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter code" name="code" required>
                    @error('code')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم المنتج بالعربيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="name_ar" required>
                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم المنتج بالانجليزيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="name_en" required>
                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">وصف المنتج بالعربيه</label>
                    <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter descrption" name="desc_ar" required></textarea>
                    @error('desc_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">وصف المنتج بالانجليزيه</label>
                    <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter descrption" name="desc_en" required></textarea>
                    @error('desc_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror

                   

                </div>

                <hr>

                <div class="form-group">
                    <label for="exampleInputEmail1">سعر المنتج</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="price" required>
                    @error('price')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">الضريبه %</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="tax" value="0">
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
                    <label for="exampleInputEmail1">رابط فيديو للمنتج</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="video_link">
                    @error('video_link')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <hr>
               
                <div class="form-group">
                    <label for="exampleInputEmail1">الوزن القائم عند الشحن بالكيلو جرام</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="shipped_weight" value="0" required>
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
                    <select class="form-control" name="status">
                            <option value="1">مُفعل</option>
                            <option value="0">غير مُفعل</option>
                    </select>
                </div>

                <div class="form-group">
                <label for="exampleInputEmail1">الاتاحة</label>
                    <select class="form-control" name="availabe_or_no">
                            <option value="1">متاح</option>
                            <option value="0">غير متاح</option>
                    </select>
                </div>
                
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">اضافه</button>
                </div>
                </form>
        </div>
      
        </div>
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection
