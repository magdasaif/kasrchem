@extends('layouts.master')
@section('title')
<title> لوحة التحكم :{{$title}}</title>
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
                <h3 class="card-title">  {{$title}}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('photo_gallery.index')}}" class="aa"> <li class="fa fa-camera" ><span> قائمه المعارض </span></li></a>
                    </button>
                </div>
</div>
 <!--#############################################################-->
          <div class="modal-body">
            
                 <!--------------------form_add_gallery----------------------------------->
            <form method="POST" action="{{url('add_gallery_images',encrypt($id))}}" enctype="multipart/form-data">

                {{method_field('POST')}}
                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}

                <div class="form-group">
                    <label for="exampleInputEmail1">صور المعرض</label>
                    <input type="file" class="form-control" name="photos[]" accept="image/*" multiple required>

                    @error('photos')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror

                    <input type="hidden" value="{{$id}}" name="gallery_id">
                </div>
                <center> <button type="submit" class="btn btn-primary">حفظ الصور</button></center><br><br>
               
                
            </form>

            <div class="row">
            @foreach($Gallery_Photo as $xx)
            <div class="col">
                 <img  src="{{$xx->getUrl('edit')}}">
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
                                <form action="{{url('delete_gallery_images/'.encrypt($xx->id))}}"  method="POST">
                                @method('GET')
                                {{csrf_field()}}
                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>

                                    </div>
                                    <input type="hidden" name="gallery_id" value="{{$id}}">
                                    <input type="hidden" name="media_id" value="{{$xx->id}}">
                                    
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
            <br><br>
            </div>
 <!--#############################################################-->

 		</div>
            </div>
        </div>
    </div>
</section>
</template>
@endsection