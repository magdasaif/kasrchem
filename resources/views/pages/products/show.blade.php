@extends('layouts.master')
@section('content')
<template>
  <section class="content">
    <div class="container-fluid">
        <div class="">

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
                <h3 class="card-title"> {{$title}}</h3>

                <div class="card-tools">

                <!-- livewire add form
                <button type="button" class="btn btn-info" ><a href="{{url('add_product')}}"> اضافه</a></button> -->

                   <button type="button" class="btn btn-sm btn-success">
                        <a href="{{route('products.create')}}" style="color: #fff; !important"> <li class="fa fa-plus-square" ><span> اضافه </span></li></a>
                        </button>
                        

                </div>
              </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
            <!--#############################################################-->
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>كود المنتج</th>
                            <th>اسم المنتج</th>
                            <th>سعر المنتج</th>
                            <th>الصوره الاساسيه</th>
                            <th>الحاله</th>
                            <th>التوافر</th>
                            <th>الميديا</th>
                            <th>الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;?>
                        @foreach($products as $product)
                        <?php $i++;?>
                        <tr>
                            <td>{{$i}}</td>

                            <td>{{$product->code}}</td>
                            <td>{{$product->name_ar}}</td>
                            <td>{{$product->price}}</td>
                            <td><img  style="width: 90px; height: 90px;" src="<?php echo asset("storage/products/product_no_$product->id/$product->image")?>"></td>
                            <td><?php if($product->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>

                            <td><?php if($product->availabe_or_no==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>

                            <td>
                                <a href="{{ url('img/'.$product->id) }}"><button type="button" class="btn btn-sm btn-warning" > الصور</button></a>
                            
                               <a href="{{url('products_files/'.$product->id)}}"> <button type="button" class="btn btn-sm btn-primary" > الملفات</button></a>
                            </td>


                            <td>
                                <a href="{{route('products.edit',$product->id)}}" title="تعديل"><i class="fa fa-edit blue"></i></a>
                            </td>
                        </tr>

                        @endforeach
                    
                    </tbody>              
                </table>
           <!--#############################################################-->

		</table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                  <pagination :data="products" @pagination-change-page="getResults"></pagination>
            </div>
            <!-- /.card -->
          </div>
        </div>
        </div>
  </section>
</template>
@endsection