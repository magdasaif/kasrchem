@extends('layouts.master')
@section('css')

@section('title')
اضافه صور المعرض  


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
            <h4 class="mb-0">
</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">الرئيسيه</a></li>
                <li class="breadcrumb-item active">
                اضافه صور المعرض  

                </li>
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
            <a href="{{route('photo_gallery.index')}}"><button type="button" class="btn btn-success" > قائمة المعارض</button></a><br><br>
                 <!--------------------form_add_gallery----------------------------------->
            <form method="POST" action="{{url('add_gallery_images',$id)}}" enctype="multipart/form-data">

                {{method_field('POST')}}
                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}

                <div class="form-group">
                    <label for="exampleInputEmail1">صور المعرض</label>

                    <input type="file" class="form-control" name="image[]" accept="image/*" multiple required>

                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror

                    <input type="hidden" value="{{$id}}" name="gallery_id">
                </div>
                <center> <button type="submit" class="btn btn-success">حفظ الصور</button></center><br><br>
               
                
            </form>
              <!--------------------------show_images_of_gallary--------------------------------------------->
            <div class="row">
            @foreach($Gallery_Photo as $xx)
            <div class="col">
                  <img  style="width: 150px; height: 150px;" src="<?php echo asset("storage/photo_gallery/gallery_photo_images_no_$id/{$xx->image}")?>">
                  <br><button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#delete{{$xx->id}}" style="margin-right: 55px;" > حذف</button> 
                </div>
               
                 <!--############ model for delete ################-->
          
                 <div class="modal modal-danger fade" id="delete{{$xx->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header" style="direction: ltr;">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form action="{{url('delete_gallery_images/'.$xx->id)}}"  method="POST">
                                @method('GET')
                                {{csrf_field()}}
                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>

                                    </div>
                                    <input type="hidden" name="deleted_image" value="{{$xx->image}}">
                                    <input type="hidden" value="{{$id}}" name="gallery_id">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                        <button type="submit" class="btn btn-success" >حذف</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
                   <!--########################################-->
                 
            @endforeach
            </div>
            </div>

            
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
