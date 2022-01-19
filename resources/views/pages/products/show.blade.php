@extends('layouts.master')
@section('css')

@livewireStyles

@section('title')
    {{$title}}
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
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

            <a href="{{route('products.create')}}"><button type="button" class="btn btn-info" > اضافه</button></a>

            <!-- livewire add form
                <button type="button" class="btn btn-info" ><a href="{{url('add_product')}}"> اضافه</a></button> -->

            <!--#############################################################-->
                    <div class="table-responsive">
                    
                    <table id="datatable" class="table table-striped table-bordered p-0">
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

                            <td><?php if($product->status==1){echo'<label class="btn btn-success">مُفعل</label>';}else{echo'<label class="btn btn-danger">غير مُفعل</label>';}?></td>
                            <td><?php if($product->availabe_or_no==1){echo'<label class="btn btn-success">متاح</label>';}else{echo'<label class="btn btn-danger">غير متاح</label>';}?></td>

                            <td>
                                <a href="{{ url('img/'.$product->id) }}"><button type="button" class="btn btn-info" > الصور</button></a>
                            
                               <a href="{{url('products_files/'.$product->id)}}"> <button type="button" class="btn btn-info" > الملفات</button></a>
                            </td>


                            <td>
                                <a href="{{route('products.edit',$product->id)}}"><button type="button" class="btn btn-info" > تعديل</button></a>
                            </td>
                        </tr>

                        @endforeach
                    
                    </tbody>              
                </table>
            </div>
            <!--#############################################################-->

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@livewireScripts
@endsection
