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
                        <a href="{{route('article.create')}}" class="aa"> <li class="fa fa-plus-square" ><span> اضافه </span></li></a>
                    </button>
                        
                    <button type="button" id="btn_delete_all" disabled class="btn  btn-danger btn-sm  aa delelte_all " style=" font-weight: 900;font-size: 13px;">حذف المُحدد</button>

                </div>
              </div> 
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
<<<<<<< HEAD
=======
                 <!--=======================searchand form ============================-->
                 <input type="hidden" name="hidden_blade" id="hidden_blade" value="show" />
                <input type="hidden" name="hidden_blade" id="hidden_model" value="article" />
                                        @include('pages.search_form')
                <!--===========================================================================-->
>>>>>>> search_all
                <table id="datatable" class="table table-hover styled-table" >
            <!--#############################################################-->
                  <thead>
                        <tr>
                        <th>#</th>
                        <th>صورة المقال</th>
                        <th>عنوان المقال</th>
                        <th>الحالة</th>
                        <th>الترتيب</th>
                        <th>الاجراءات</th>
                        <th><input type="checkbox" name="select_all" onclick="checkAll('box1',this)"></th>

                        </tr>
                    </thead>
                    <tbody>
<<<<<<< HEAD
                         <?php $i = 0; $status=1?>
                        @foreach($articles as $article)
                            <tr>
                            <?php $i++;?>
                            <td>{{ $i }}</td>
                            <td><img src="{{$article->getFirstMediaUrl('article','index')}}"></td>
                            <td >{{$article->name_ar}}</td>
                            <td style="font-weight: bold;font-size: 17px;" ><?php if($article->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                            <td >{{$article->sort}}</td>
                            <td style="font-weight: bold;font-size: 17px;">
							<a href="{{route('article.edit',encrypt($article->id))}}"  title="تعديل"><i class="fa fa-edit blue"></i></a>
                            

                            / <a  title="حذف" data-catid="{{$article->id}}" data-toggle="modal" data-target="#delete{{$article->id}}"> <i class="fa fa-trash red"></i></a>

                     <!--############################ model for delete #################################-->
          
                    <div class="modal modal-danger fade" id="delete{{$article->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="card-header" >
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form action="{{route('article.destroy',encrypt($article->id))}}"  method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>
                                            <input type="hidden" name="Article_id" id="$article->id" value="{{$article->id}}">
                                            <div  style="text-align: center;font-size: 22px;color: red; text-decoration: underline;" > {{$article->title_ar}}</div>
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
                        <td><input type="checkbox" value="{{$article->id}}" class="box1" onclick="javascript:check();"></td>

                            </tr>
                        
            

                        @endforeach

=======
                         <!--=======================body  ============================-->
                              @include('pages.article.paginate_article')
                           <!--========================================================-->
>>>>>>> search_all
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
  <?php $type="article";?>
  @include('delete_all_model')
  <!--========================================================-->
        </div>
        </div>
  </section>
</template>
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('/js/delete_all.js') }}"></script>
<<<<<<< HEAD
=======
<script src="{{ URL::asset('/js/search_paginate.js') }}"></script>
>>>>>>> search_all
@endsection