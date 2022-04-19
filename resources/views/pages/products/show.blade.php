@extends('layouts.master')

@section('title')
<title>لوحة التحكم : {{$title}}</title>
 @endsection

@section('content')
<template>
  <section class="content">
    <div class="container-fluid">
        <div class="">

        <div class="col-12">
        @include('layouts.messages')

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
              <!--=======================searchand form ============================-->
       
            <div class="col-md-6" style="margin-top:40px">
              <form action="{{ route('searching') }}" method="GET" style="display: flex;">
         
                 <div class="form-group">
                    <input type="text" class="form-control" name="query_text" placeholder=" بحث باسم المنتج ....."  value="{{ request()->input('query_text') }}">
                    <span class="text-danger">@error('query_text'){{ $message }} @enderror</span>
                 </div>
                 <div class="form-group">
                  <button type="submit" class="btn btn-primary">بحث</button>
                 </div>
              </form>
            </div>
              <br>
          <!--===========================================================================-->

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
                        <!--===========================================================-->
                        @if(isset($searching_result))
                        @if(count($searching_result) > 0)
                        @foreach($searching_result as $product)
                        <?php $i++;?>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$product->name_ar}}</td>
                            <!-- <td><img src="{{$product->getFirstMediaUrl('product')}}"></td> -->

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
                                <a href="{{route('products.edit',encrypt($product->id))}}" title="تعديل" style="font-weight: bold;font-size: 17px;"><i class="fa fa-edit blue"></i></a>
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
                              <td><input type="checkbox" name="row_checkbox" value="{{$product->id}}" class="box1" onclick="javascript:check();"></td>

                        </tr>
                              @endforeach
                           @else
                             <tr><td colspan="8" style="text-align: center;font-size: 18px;color: red;">لا يوجد بيانات !</td></tr>
                           @endif
                           @else
                        <!--===========================================================-->

                        @foreach($products as $product)
                        <?php $i++;?>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$product->name_ar}}</td>
                            <!-- <td><img src="{{$product->getFirstMediaUrl('product')}}"></td> -->

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
                                <a href="{{route('products.edit',encrypt($product->id))}}" title="تعديل" style="font-weight: bold;font-size: 17px;"><i class="fa fa-edit blue"></i></a>
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
                              <td><input type="checkbox" name="row_checkbox" value="{{$product->id}}" class="box1" onclick="javascript:check();"></td>

                        </tr>

                        @endforeach
                        @endif
                      <!--===========================================================-->
                    </tbody>
           <!--#############################################################-->

		</table>
            </div>
            

            <div class="pagination-block">
                @if(isset($searching_result))
            {{  $searching_result->appends(request()->input())->links('layouts.paginationlinks') }}
            @else
            {{ $products->links('layouts.paginationlinks')}}
            @endif
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
