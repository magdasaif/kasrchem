@extends('layouts.master')
@section('title')
<title> لوحة التحكم : الصفحات</title>
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
          
            <center><button type="button" disabled class="btn btn-danger"  id="btn_delete_all">حذف المُحدد</button></center>
            <div class="card">
              <div class="card-header" >
              <h3 class="card-title"> الصفحات</h3>

                <div class="card-tools">

                 <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('page.create')}}" class="aa"> <li class="fa fa-plus-square" ><span> اضافه </span></li></a>
                    </button>
                        

                </div>
              </div> 
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table id="datatable" class="table table-hover  styled-table" >
            <!--#############################################################-->
                  <thead>
                        <tr >

                        <th><input type="checkbox" name="select_all" onclick="checkAll('box1',this)"></th>
                        <th>#</th>
                        <th>اسم الصفحة</th>
                        <th>الحالة</th>
                        <th>الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php $i = 0; $status=1?>
                        @foreach($Page as $Pagee)
                            <tr>
                            <td><input type="checkbox" value="{{$Pagee->id}}" class="box1" onclick="javascript:check();"></td>
                            <?php $i++; ?>
                            <td>{{ $i }}</td>
                            <td>{{$Pagee->title_ar}}</td>
							<td style="font-weight: bold;font-size: 17px;"><?php if($Pagee->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
 
							<td style="font-weight: bold;font-size: 17px;">
							<a href="{{route('page.edit',$Pagee->id)}}"  title="تعديل"><i class="fa fa-edit blue"></i></a>
							/
					        <a  title="حذف" data-catid="{{$Pagee->id}}" data-toggle="modal" data-target="#delete{{$Pagee->id}}"> <i class="fa fa-trash red"></i></a>
                            <!--############################ model for delete #################################-->
                                
                            <div class="modal modal-danger fade" id="delete{{$Pagee->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                        <div class="card-header" >
                                                            <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                                        </div>
                                                        <form action="{{route('page.destroy',$Pagee->id)}}"  method="post">
                                                                {{method_field('delete')}}
                                                                {{csrf_field()}}
                                                            <div class="modal-body">
                                                                    <h3 class="text-center">
                                                                        هل تريد الحذف بالفعل؟
                                                                    </h3>
                                                                    <input type="hidden" name="Page_id" id="$Pagee->id" value="{{$Pagee->id}}">
                                                                    <div  name="Page_title_ar" style="text-align: center;font-size: 22px;color: red; text-decoration: underline;" > {{$Pagee->title_ar}}</div>
                                                        </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                                                <button type="submit" class="btn btn-success">حذف</button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                    </div>
                                    <!--#############################################################-->
                             <!-- <button class="btn btn-danger" data-catid={{$Pagee->id}} data-toggle="modal" data-target="#delete{{$Pagee->id}}">حذف</button> -->
							 
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
           <!--========================================================-->
 <?php $type="page";?>
  @include('delete_all_model')
    <!--========================================================-->  
        </div>
        </div>
  </section>
</template>

<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('/js/delete_all.js') }}"></script>

@endsection