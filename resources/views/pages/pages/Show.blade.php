<<<<<<< HEAD
                       <?php $i = 0; $status=1?>
                       @if(count($Page)!=0 && $Page )
                       @foreach($Page as $Pagee)
                            <tr>
                            <?php $i++; ?>
                            <td>{{ $i }}</td>
                            <td>{{$Pagee->name_ar}}</td>
							<td style="font-weight: bold;font-size: 17px;"><?php if($Pagee->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                            <td>{{$Pagee->sort}}</td>
							<td style="font-weight: bold;font-size: 17px;">
							<a href="{{route('page.edit',encrypt($Pagee->id))}}"  title="تعديل"><i class="fa fa-edit blue"></i></a>
							/
                            <a href="{{ url('page_img/'.encrypt($Pagee->id)) }}"><i class="fa fa-camera yellow"></i></a>
                            /
					        <a  title="حذف" data-catid="{{$Pagee->id}}" data-toggle="modal" data-target="#delete{{$Pagee->id}}"> <i class="fa fa-trash red"></i></a>
                            <!--############################ model for delete #################################-->
                                
                            <div class="modal modal-danger fade" id="delete{{$Pagee->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="card-header" >
                                        <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                    </div>
                                    <form action="{{route('page.destroy',encrypt($Pagee->id))}}"  method="post">
                                            {{method_field('delete')}}
                                            {{csrf_field()}}
                                        <div class="modal-body">
                                                <h3 class="text-center">
                                                    هل تريد الحذف بالفعل؟
                                                </h3>
                                                <input type="hidden" name="Page_id" id="$Pagee->id" value="{{$Pagee->id}}">
                                                <div  name="Page_title_ar" style="text-align: center;font-size: 22px;color: red; text-decoration: underline;" > {{$Pagee->name_ar}}</div>
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
                            <td><input type="checkbox" name="row_checkbox" value="{{$Pagee->id}}" class="box1" onclick="javascript:check();"></td>

                            </tr>
                     

                        @endforeach

                        <tr>
                          <td colspan="8" align="center">
                          
                  
                          @if(isset($searching))
                            {{  $Page->appends(request()->input())->links('layouts.paginationlinks') }}
                            @else
                            {{ $Page->links('layouts.paginationlinks')}}
                            @endif
                
                          </td>
                          </tr>
                          @else
                            <tr><td colspan="8" style="text-align: center;font-size: 18px;color: red;">لا يوجد بيانات !</td></tr>
                          @endif
=======
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
        @include('layouts.messages')
          
            <div class="card">
              <div class="card-header" >
              <h3 class="card-title"> الصفحات</h3>

                <div class="card-tools">

                 <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('page.create')}}" class="aa"> <li class="fa fa-plus-square" ><span> اضافه </span></li></a>
                    </button>
                    <button type="button" id="btn_delete_all" disabled class="btn  btn-danger btn-sm  aa delelte_all " style=" font-weight: 900;font-size: 13px;">حذف المُحدد</button>
  

                </div>
              </div> 
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                 <!--=======================searchand form ============================-->
                 <input type="hidden" name="hidden_blade" id="hidden_blade" value="Show" />
                <input type="hidden" name="hidden_blade" id="hidden_model" value="page" />
                                        @include('pages.search_form')
                <!--===========================================================================-->
                <table id="datatable" class="table table-hover  styled-table" >
            <!--#############################################################-->
                  <thead>
                        <tr >

                        <th>#</th>
                        <th>اسم الصفحة</th>
                        <th>الحالة</th>
                        <th>الترتيب</th>
                        <th>الاجراءات</th>
                        <th><input type="checkbox" name="select_all" onclick="checkAll('box1',this)"></th>

                        </tr>
                    </thead>
                    <tbody>
                       <!--=======================body  ============================-->
                       @include('pages.pages.paginate_page')
                        <!--========================================================-->
                        
                    </tbody>
							
			 <!--#############################################################-->

		</table>
            </div>
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
<script src="{{ URL::asset('/js/search_paginate.js') }}"></script>
@endsection
>>>>>>> search_all
