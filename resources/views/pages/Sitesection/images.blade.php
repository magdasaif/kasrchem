@extends('layouts.master')
@section('title')
<title>لوحة التحكم : {{$title}}</title>
 @endsection
@section('content')
<template>
<section class="content">
    <div class="container-fluid">
        <div class="">
           =
          <div class="col-12">
          @include('layouts.messages')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('site_section.index')}}" class="aa"> <li class="fas fab fa-product-hunt" ><span> قائمه اﻻقسام </span></li></a>
                    </button>
                </div>
              </div>
 <!--#############################################################-->
 <div class="modal-body">
            
            <form method="POST" action="{{url('add_section_images',encrypt($section_id))}}" enctype="multipart/form-data">

                {{method_field('POST')}}
                @csrf
                
                <div class="form-group">
                    <label for="exampleInputEmail1">صور القسم </label>

                    <input type="file" class="form-control" name="photos[]" accept="image/*" multiple required>

                    @error('photos')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror

                    <input type="hidden" value="{{$section_id}}" name="section_id">
                </div>
                <center> <button type="submit" class="btn btn-primary">حفظ الصور</button></center>
                <br>
                
            </form>

            <div class="row">
            @foreach($section_images as $image)
                 <div class="col">
                    <img  style="width: 150px; height: 150px;" src="{{$image->getUrl('edit')}}">
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
                                <form action="{{url('delete_section_images/'.$image->id)}}"  method="POST">
                                @method('GET')
                                {{csrf_field()}}
                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>

                                    </div>
                                    <div class="modal-footer">

                                        <input type="hidden" name="section_id" value="{{$section_id}}">
                                        <input type="hidden" name="media_id" value="{{$image->id}}">

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

            </div>
 <!--#############################################################-->

 		</div>
            </div>
        </div>
    </div>
</section>
</template>
@endsection