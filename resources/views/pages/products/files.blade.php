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
            <form method="POST" action="{{url('add_products_files',$product_id)}}" enctype="multipart/form-data">

                {{method_field('POST')}}
                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}

                <div class="form-group">
                    <label for="exampleInputEmail1">ملفات المنتج </label>

                    <input type="file" class="form-control" name="ffff[]" accept=".pdf" multiple required>

                    @error('ffff')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror

                    <input type="hidden" value="{{$product_id}}" name="product_id">
                </div>

                       <center> <button type="submit" class="btn btn-primary">حفظ الملفات</button></center>
                
                <br>
            </form>

            <div class="row">
            @foreach($Product_files as $file)            
                 <div class="col">
                   <embed src="<?php echo asset("storage/products/product_no_$product_id/$file->path")?>"  accept="application/pdf,application/vnd.ms-excel"/>
                    <!-- <br><center><button type="button" class="btn btn-danger" ><a href="{{url('delete_products_files/'.$file->id)}}"> حذف</a></button></center> -->
                    <br><button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#delete{{$file->id}}" style="margin-right: 55px;" > حذف</button>
                </div>
                 <!--############################ model for delete #################################-->
          
                 <div class="modal modal-danger fade" id="delete{{$file->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header" style="direction: ltr;">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form action="{{url('delete_products_files/'.$file->id)}}"  method="POST">
                                @method('GET')
                                {{csrf_field()}}
                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>

                                    </div>
                                    <div class="modal-footer">

                                        <input type="hidden" name="product_id" value="{{$product_id}}">
                                        <input type="hidden" name="file_name" value="{{$file->path}}">
                                        <input type="hidden" name="file_id" value="{{$file->id}}">

                                        
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