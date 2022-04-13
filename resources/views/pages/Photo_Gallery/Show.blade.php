@extends('layouts.master')
@section('title')
<title>لوحة التحكم :{{$title}}</title>
 @endsection
@section('content')
<template>
  <section class="content">
    <div class="container-fluid">
        <div class="row">

        <div class="col-12">
        @include('layouts.messages')
            

        
            <div class="card">
              <div class="card-header" >
              <h3 class="card-title"> {{$title}}</h3>

                <div class="card-tools">

                 <button type="button" class="btn btn-sm bbtn" >
                        <a  class="aa"  href="{{route('photo_gallery.create')}}" > <li class="fa fa-plus-square" ><span> اضافه </span></li></a>
                    </button>
                        
                    <button type="button" id="btn_delete_all" disabled class="btn  btn-danger btn-sm  aa delelte_all " style=" font-weight: 900;font-size: 13px;">حذف المُحدد</button>

                </div>
              </div> 
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table id="datatable" class="table table-hover  styled-table" >
            <!--#############################################################-->
                  <thead>
                        <tr >
                        <th>#</th>
                        <th>الصورة</th>
                        <th>الاسم</th>
                        <th>الترتيب</th>
                        <th>الحالة</th>
                        <th>الاجراءات</th>
                        <th><input type="checkbox" name="select_all" onclick="checkAll('box1',this)"></th>

                        </tr>
                    </thead>
                    <tbody>
                         <?php $i = 0; $status=1?>
                        @foreach($Photo_Gal as $Photo_Gallery)
                            <tr>
                            <?php $i++; ?>
                            <td>{{ $i }}</td>
                            @if(sizeof($Photo_Gallery->mainImages())>0)
                              @foreach($Photo_Gallery->mainImages() as $main) 
                                  <td><img  style="width: 90px; height: 90px;" src="<?php echo asset("storage/photo_gallery/gallery_photo_images_no_".$Photo_Gallery->id."/".$main->filename)?>"></td>
                              @endforeach
                            @else
                            <td></td>
                            @endif
                            <td>{{$Photo_Gallery->name_ar}}</td>
                            <td>{{$Photo_Gallery->sort}}</td>
                            <td><?php if($Photo_Gallery->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                            <td style="font-weight: bold;font-size: 17px;"> 
                             <a href="{{route('photo_gallery.edit',encrypt($Photo_Gallery->id))}}"  title="تعديل"><i class="fa fa-edit blue"></i></a>
                             /
                             <a href="{{ url('show_gallery_images/'.encrypt($Photo_Gallery->id)) }}"  title="الصور"><i class="fa fa-camera yellow"></i></a>

                              /
                              <a  title="حذف" data-catid="{{$Photo_Gallery->id}}" data-toggle="modal" data-target="#delete{{$Photo_Gallery->id}}"> <i class="fa fa-trash red"></i></a>
                             
                         <!--############################ model for delete #################################-->
          
                         <div class="modal modal-danger fade" id="delete{{$Photo_Gallery->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="card-header" >
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form action="{{route('photo_gallery.destroy',encrypt($Photo_Gallery->id))}}"  method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>
                                            <input type="hidden" name="galary_id" id="$Photo_Gallery->id" value="{{$Photo_Gallery->id}}">
                                            <img  style="width: 90px; height: 90px;" src=<?php echo asset("storage/photo_gallery/{$main->filename}")?> alt="" >
                                    </div>
                                    <input type="hidden" name="deleted_image" value="{{$main->filename}}">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                        <input type="submit" value="حذف"  class="btn btn-primary">
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
            <!--#############################################################-->
                        </td>
                        <td><input type="checkbox" name="row_checkbox"  value="{{$Photo_Gallery->id}}" class="box1" onclick="javascript:check();"></td>

                            </tr>
                        

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
             <!--========================================================-->
 <?php $type="gallery";?>
  @include('delete_all_model')
    <!--========================================================--> 
        </div>
        </div>
  </section>
</template>

<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('/js/delete_all.js') }}"></script>
@endsection