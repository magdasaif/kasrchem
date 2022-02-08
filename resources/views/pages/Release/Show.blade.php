@extends('layouts.master')
@section('title')
<title>لوحة التحكم : النشرات</title>
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
              <div class="card-header">
                <h3 class="card-title"> النشرات</h3>

                <div class="card-tools">

                   <button type="button" class="btn btn-sm bbtn">
                        <a href="{{route('release.create')}}" class="aa"> <li class="fa fa-plus-square" ><span> اضافة  </span></li></a>
                        </button>
                        

                </div>
              </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover styled-table">
            <!--#############################################################-->
                    <thead>
                        <tr  style="color: #17899b;" >
                        <th>#</th>
                        <th>صورة النشرة </th>
                        <th>عنوان النشرة</th>
                        <th>الحالة</th>
                        <th>الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php $i = 0; $status=1?>
                        @foreach($Rel as $release)
                            <tr>
                            <?php $i++; ?>
                            <td>{{ $i }}</td>
                            <td><img  style="width: 90px; height: 90px;" src=<?php echo asset("storage/release/release_$release->id/{$release->image}")?> alt="" ></td>
                             <td>{{$release->title_ar}}</td>
                             <td><?php if($release->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                        
                            <td>
                                <a href="{{route('release.edit',$release->id)}}" style="font-weight: bold;font-size: 17px;" title="تعديل"><i class="fa fa-edit blue"></i></a>
                                <!-- /
                                <a href="#" style="font-weight: bold;font-size: 17px;" title="حذف" data-catid="{{$release->id}}" data-toggle="modal" data-target="#delete{{$release->id}}"> <i class="fa fa-trash red"></i></a> -->
							</td>
                            </tr>
                        <!--############################ model for delete #################################-->
          
                            <div class="modal modal-danger fade" id="delete{{$release->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header" style="direction: ltr;">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form action="{{route('release.destroy',$release->id)}}"  method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>
                                            <input type="hidden" name="release_id" id="$release->id" value="$release->id">

                                    </div>
                                    <input type="hidden" name="deleted_image" value="{{$release->image}}">
                                    <input type="hidden" name="deleted_file" value="{{$release->file}}">
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
           
          </div>
        </div>
        </div>
  </section>
</template>
@endsection