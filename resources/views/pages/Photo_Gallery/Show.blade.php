@extends('layouts.master')
@section('title')
<title>لوحة التحكم :المعارض</title>
 @endsection
@section('content')
<template>
  <section class="content">
    <div class="container-fluid">
        <div class="row">

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
              <div class="card-header" >
              <h3 class="card-title"> المعارض</h3>

                <div class="card-tools">

                 <button type="button" class="btn btn-sm bbtn" >
                        <a  class="aa"  href="{{route('photo_gallery.create')}}" > <li class="fa fa-plus-square" ><span> اضافه </span></li></a>
                    </button>
                        

                </div>
              </div> 
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover  styled-table" >
            <!--#############################################################-->
                  <thead>
                        <tr >
                        <th>#</th>
                        <th>الصورة</th>
                        <th>الاسم</th>
                        <th>الحالة</th>
                        <th>الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php $i = 0; $status=1?>
                        @foreach($Photo_Gal as $Photo_Gallery)
                            <tr>
                            <?php $i++; ?>
                            <td>{{ $i }}</td>
                            <td><img  style="width: 90px; height: 90px;" src=<?php echo asset("storage/photo_gallery/{$Photo_Gallery->image}")?> alt="" ></td>
                            <td>{{$Photo_Gallery->title_ar}}</td>
                            <td><?php if($Photo_Gallery->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                            <td style="font-weight: bold;font-size: 17px;"> 
                             <a href="{{route('photo_gallery.edit',$Photo_Gallery->id)}}"  title="تعديل"><i class="fa fa-edit blue"></i></a>
                             /
                             <a href="{{ url('show_gallery_images/'.$Photo_Gallery->id) }}"  title="الصور"><i class="fa fa-camera yellow"></i></a>

                              /
                              <a  title="حذف" data-catid="{{$Photo_Gallery->id}}" data-toggle="modal" data-target="#delete{{$Photo_Gallery->id}}"> <i class="fa fa-trash red"></i></a>
                            <!-- <button type="button" class="btn btn-info" ><a href="{{route('photo_gallery.edit',$Photo_Gallery->id)}}"  target="_blank"> تعديل</a></button> -->
                           <!-- <a href="{{ url('show_gallery_images/'.$Photo_Gallery->id) }}"><button type="button" class="btn btn-warning" > الصور</button></a>
                           <button class="btn btn-danger" data-catid={{$Photo_Gallery->id}} data-toggle="modal" data-target="#delete{{$Photo_Gallery->id}}">حذف</button>  -->
                        
                             
                         
                        </td>
                            </tr>
                        <!--############################ model for delete #################################-->
          
                            <div class="modal modal-danger fade" id="delete{{$Photo_Gallery->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header" style="direction: ltr;">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form action="{{route('photo_gallery.destroy',$Photo_Gallery->id)}}"  method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>
                                            <input type="hidden" name="galary_id" id="$Photo_Gallery->id" value="{{$Photo_Gallery->id}}">

                                    </div>
                                    <input type="hidden" name="deleted_image" value="{{$Photo_Gallery->image}}">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                        <button type="submit" class="btn btn-success">حذف</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
            <!--#############################################################-->

                        @endforeach

                    </tbody>
							
			 <!--#############################################################-->

		</table>
            </div>
            <!-- /.card-body -->
            <!-- <div class="card-footer">
                  <pagination :data="products" @pagination-change-page="getResults"></pagination>
            </div> -->
            <!-- /.card -->
          </div>
        </div>
        </div>
  </section>
</template>
@endsection