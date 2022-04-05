@extends('layouts.master')
@section('title')
<title>لوحة التحكم : {{$title}}</title>
 @endsection
@section('content')
<template>
<section class="content">
    <div class="container-fluid">
        <div class="">
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
            
            <form method="POST" action="{{url('add_product_images',encrypt($product_id))}}" enctype="multipart/form-data">

                {{method_field('POST')}}
                @csrf
                
                <div class="form-group">
                    <label for="exampleInputEmail1">صور المنتج </label>

                    <input type="file" class="form-control" name="photos[]" accept="image/*" multiple required>

                    @error('photos')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror

                    <input type="hidden" value="{{$product_id}}" name="product_id">
                </div>
                <center> <button type="submit" class="btn btn-primary">حفظ الصور</button></center>
                <br>
                
            </form>

            <div class="row">
            @foreach($Product_images as $image)
                 <div class="col">
                    <img  style="width: 150px; height: 150px;" src="<?php echo asset("storage/products/product_no_$product_id/$image->filename")?>">
                    <!-- <br><center><button type="button" class="btn btn-danger" data-catid={{$image->id}} data-toggle="modal" data-target="#delete" ><a href="{{url('delete_product_images/'.$image->id)}}"> حذف</a></button></center> -->
                    <br><button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#delete{{$image->id}}" style="margin-right: 55px;"> حذف</button>

                </div>
                
                 <!--############################ model for delete #################################-->
          
                 <div class="modal modal-danger fade" id="delete{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header" style="direction: ltr;">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form action="{{url('delete_product_images/'.$image->id)}}"  method="POST">
                                @method('GET')
                                {{csrf_field()}}
                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>

                                    </div>
                                    <div class="modal-footer">

                                        <input type="hidden" name="product_id" value="{{$product_id}}">
                                        <input type="hidden" name="image_name" value="{{$image->filename}}">
                                        <input type="hidden" name="image_id" value="{{$image->id}}">

                                        <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                        <button type="submit" class="btn btn-primary" >حذف</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
            <!--#############################################################-->
            @endforeach
            </div>
            <!-- <br><center><a href="{{route('products.index')}}"><button type="button" class="btn btn-success" > قائمه المنتجات</button></a></center><br> -->

            </div>
 <!--#############################################################-->

 		</div>
            </div>
        </div>
    </div>
</section>
</template>
@endsection