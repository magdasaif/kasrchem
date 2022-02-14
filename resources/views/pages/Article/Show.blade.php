@extends('layouts.master')
@section('title')
<title>لوحة التحكم :المقالات</title>
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
              <h3 class="card-title"> المقالات</h3>

                <div class="card-tools">

                 <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('article.create')}}" class="aa"> <li class="fa fa-plus-square" ><span> اضافه </span></li></a>
                    </button>
                        

                </div>
              </div> 
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover styled-table" >
            <!--#############################################################-->
                  <thead>
                        <tr>
                        <th>#</th>
                        <th>صورة المقال</th>
                        <th>عنوان المقال</th>
                        <th>الحالة</th>
                        <th>الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php $i = 0; $status=1?>
                        @foreach($Art as $article)
                            <tr>
                            <?php $i++; ?>
                            <td>{{ $i }}</td>
                            <td><img  style="width: 90px; height: 90px;" src=<?php echo asset("storage/article/{$article->image}")?> alt="" ></td>
                            <td >{{$article->title_ar}}</td>
                            <td style="font-weight: bold;font-size: 17px;" ><?php if($article->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                           
                            <td style="font-weight: bold;font-size: 17px;">
							<a href="{{route('article.edit',$article->id)}}"  title="تعديل"><i class="fa fa-edit blue"></i></a>
                            

                            / <a  title="حذف" data-catid="{{$article->id}}" data-toggle="modal" data-target="#delete{{$article->id}}"> <i class="fa fa-trash red"></i></a>

                     <!--############################ model for delete #################################-->
          
                    <div class="modal modal-danger fade" id="delete{{$article->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="card-header" >
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form action="{{route('article.destroy',$article->id)}}"  method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>
                                            <input type="hidden" name="Article_id" id="$article->id" value="{{$article->id}}">

                                    </div>
                                    <input type="hidden" name="deleted_image" value="{{$article->image}}">

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                        <input type="submit" value="حذف"  class="btn btn-primary">
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
                              <!--#######################################################################################-->
                        </td>
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
        </div>
        </div>
  </section>
</template>
@endsection