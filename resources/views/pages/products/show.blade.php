@extends('layouts.master')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@section('title')
<title>لوحة التحكم : {{$title}}</title>
 @endsection

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

                   <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('products.create')}}" class="aa"> <li class="fa fa-plus-square" ><span> اضافه </span></li></a>
                    </button>
                    <button type="button" id="btn_delete_all" disabled class="btn  btn-danger btn-sm  aa delelte_all " style=" font-weight: 900;font-size: 13px;">حذف المُحدد</button>


                </div>
              </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table id="datatable" class="table table-hover styled-table">
            <!--#############################################################-->
                    <thead>
                        <tr>
                            <th>#</th>
                            <!-- <th>كود المنتج</th> -->
                            <th>اسم المنتج</th>
                            <!-- <th>سعر المنتج</th> -->
                            <th>الصوره الاساسيه</th>
                            <th>الترتيب</th>
                            <th>الحاله</th>
                            <!-- <th>التوافر</th> -->
                            <th>الميديا</th>
                            <th>الاجراءات</th>
                            <th><input type="checkbox" name="select_all" onclick="checkAll('box1',this)"></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;?>
                        @foreach($products as $product)
                        <?php $i++;?>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$product->name_ar}}</td>

                            @if(sizeof($product->mainImages())>0)
                              @foreach($product->mainImages() as $main) 
                                  <td><img  style="width: 90px; height: 90px;" src="<?php echo asset("storage/products/product_no_".$product->id."/".$main->filename)?>"></td>
                              @endforeach
                            @else
                            <td></td>
                            @endif
                              
                            <td>{{$product->sort}}</td>
                            <td><?php if($product->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>

                            <!-- <td><?php if($product->availabe_or_no==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td> -->

                            <td>
                                <a href="{{ url('img/'.encrypt($product->id)) }}"><button type="button" class="btn btn-sm btn-warning" > الصور</button></a>

                               <a href="{{url('products_files/'.encrypt($product->id))}}"> <button type="button" class="btn btn-sm btn-primary" > الملفات</button></a>
                            </td>


                            <td>
                                <a href="{{route('products.edit',$product->id)}}" title="تعديل" style="font-weight: bold;font-size: 17px;"><i class="fa fa-edit blue"></i></a>
                                /
                                <a  title="حذف" data-catid="{$product->id}}" data-toggle="modal" data-target="#delete{{$product->id}}"> <i class="fa fa-trash red del"></i></a> 

                              <!--############################ model for delete #################################-->

                              <div class="modal modal-danger fade" id="delete{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                              <div class="modal-content">
                              <div class="card-header" >
                                <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                              </div>
                              <form class="delete" action="{{route('product_delete',encrypt($product->id))}}" method="GET">
                              @method('POST')
                             {{csrf_field()}}
                              <div class="modal-body">
                                        <h3 class="text-center">
                                            هل تريد الحذف بالفعل؟
                                          </h3>
                                          <div   style="text-align: center;font-size: 22px;color: red; text-decoration: underline;" > {{$product->name_ar}}</div>
                                    </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                  <input type="submit" value="حذف"  class="btn btn-primary">
                                </div>
                                

                              </form>
                              </div>
                              </div>
                              </div>
                              <!--#############################################################-->
                              </td>
                              <td><input type="checkbox" value="{{$product->id}}" class="box1" onclick="javascript:check();"></td>

                        </tr>

                        @endforeach

                    </tbody>
           <!--#############################################################-->

		</table>
            </div>

          </div>

  <!--========================================================-->
  <?php $type="product";?>
  @include('delete_all_model')
  <!--========================================================-->
        </div>
        </div>
  </section>
</template>
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('/js/delete_all.js') }}"></script>
@endsection
