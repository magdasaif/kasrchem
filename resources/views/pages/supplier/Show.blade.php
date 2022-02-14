@extends('layouts.master')
@section('title')
<title>لوحة التحكم :الموردين</title>
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
              <h3 class="card-title"> الموردين</h3>

                <div class="card-tools">

                 <button type="button" class="btn btn-sm bbtn" >
                        <a  class="aa"  href="{{route('supplier.create')}}" > <li class="fa fa-plus-square" ><span> اضافه </span></li></a>
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
                        <th>الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php $i = 0;?>
                        @foreach($Supplier as $Supp)
                            <tr>
                            <?php $i++; ?>
                            <td>{{ $i }}</td>
                            <td><img  style="width: 90px; height: 90px;" src=<?php echo asset("storage/supplier/{$Supp->logo}")?> alt="" ></td>
                            <td>{{$Supp->name_ar}}</td>
                            <td style="font-weight: bold;font-size: 17px;"> 
                             <a href="{{route('supplier.edit',$Supp->id)}}"  title="تعديل"><i class="fa fa-edit blue"></i></a>
                             /
                             <a href="{{ url('show_supplier_images/'.$Supp->id) }}"  title="صور المورد"><i class="fa fa-camera yellow"></i></a>

                             &nbsp; / &nbsp;
                                <a  title="حذف" data-catid="{{$Supp->id}}" data-toggle="modal" data-target="#delete{{$Supp->id}}"> <i class="fa fa-trash red del"></i></a> 

                                 <!--############################ model for delete #################################-->
          
                            <div class="modal modal-danger fade" id="delete{{$Supp->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="card-header" style="direction: ltr;">
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form class="delete" action="{{ route('supplier.destroy',$Supp->id) }}" method="POST">
                                <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>
                                       </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="_method" value="DELETE">
                                       <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                      
                                       <input type="hidden" name="deleted_image" value="{{ $Supp->logo}}" />
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                      <input type="submit" value="حذف"  class="btn btn-primary">
                                    </div>
                                   

                                </form>
                                </div>
                            </div>
                            </div>
            <!--#############################################################-->
                   </td>
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