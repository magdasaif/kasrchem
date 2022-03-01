@extends('layouts.master')
@section('title')
<title> لوحة التحكم :اضافةصور لمورد</title>
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
                <h3 class="card-title">  اضافه صور لمورد</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('supplier.index')}}" class="aa"> <li class="fas fa-users" ><span>  قائمة الموردين </span></li></a>
                    </button>
                </div>
            </div>
 <!--#############################################################-->
          <div class="modal-body">
            
                 <!--------------------form_add_gallery----------------------------------->
            <form method="POST" action="{{url('add_supplier_images',$id)}}" enctype="multipart/form-data">

                {{method_field('POST')}}
                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}

                <div class="form-group">
                    <label for="exampleInputEmail1">صور المورد</label>

                    <input type="file" class="form-control" name="image[]" accept="image/*" multiple required>

                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror

                    <input type="hidden" value="{{$id}}" name="supplier_id">
                </div>
                <center> <button type="submit" class="btn btn-primary">حفظ الصور</button></center><br><br>
               
                
            </form>

            <div class="row">
            @foreach($Supplier_image as $xx)
            <div class="col">
                  <img  style="width: 150px; height: 150px;" src="<?php echo asset("storage/supplier/supplier_no_$id/{$xx->image}")?>">
                  <br><button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#delete{{$xx->id}}" style="margin-right: 55px;" > حذف</button> 
                </div>
                
                 <!--############################ model for delete #################################-->
          
                  <div class="modal modal-danger fade" id="delete{{$xx->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header" style="direction: ltr;">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form action="{{url('delete_supplier_images/'.$xx->id)}}"  method="POST">
                                @method('GET')
                                {{csrf_field()}}
                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>

                                    </div>
                                    <input type="hidden" name="deleted_image" value="{{$xx->image}}">
                                    <input type="hidden" value="{{$id}}" name="supplier_id">
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
 <!--#############################################################-->

 		</div>
            </div>
        </div>
    </div>
</section>
</template>
@endsection