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
            <form method="POST" action="{{url('add_product_images',$product_id)}}" enctype="multipart/form-data">

                {{method_field('POST')}}
                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}

                <div class="form-group">
                    <label for="exampleInputEmail1">صور المنتج </label>

                    <input type="file" class="form-control" name="photos[]" accept="image/*" multiple required>

                    @error('photos')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror

                    <input type="hidden" value="{{$product_id}}" name="product_id">
                </div>

                <div class="modal-footer">
                       <center> <button type="submit" class="btn btn-success">حفظ الصور</button></center>
                </div>
                
            </form>

            <div class="row">
            @foreach($Product_images as $image)
                 <div class="col">
                    <img  style="width: 150px; height: 150px;" src="<?php echo asset("storage/products/product_no_$product_id/$image->path")?>">
                    <!-- <br><center><button type="button" class="btn btn-danger" data-catid={{$image->id}} data-toggle="modal" data-target="#delete" ><a href="{{url('delete_product_images/'.$image->id)}}"> حذف</a></button></center> -->
                    <br><center><button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#delete" > حذف</button></center>
                </div>
                
                 <!--############################ model for delete #################################-->
          
                 <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                        <button type="submit" class="btn btn-success" >حذف</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
            <!--#############################################################-->
            @endforeach
            </div>
            </div>

            <br><center><button type="button" class="btn btn-success" ><a href="{{route('products.index')}}"> قائمه المنتجات</a></button></center><br>

            
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
