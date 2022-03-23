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

                    @if(Session::has('data'))
                        <ol> 
                            @foreach(session::get('data')  as $d)
                             <li style="color:green;font-size:15px">{{$d}}</li>
                            @endforeach
                         </ol>
                    @endif
            
                </div>
            @endif

         
            
            <div class="card">
              <div class="card-header" >
              <h3 class="card-title"> الموردين</h3>

                <div class="card-tools">

                 <button type="button" class="btn btn-sm bbtn" >
                        <a  class="aa"  href="{{route('supplier.create')}}" > <li class="fa fa-plus-square" ><span> اضافه </span></li></a>
                    </button>
                    <!-- <button type="button" disabled class="btn btn-danger"  id="btn_delete_all">حذف المُحدد</button> -->
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
                        <th>الاجراءات</th>
                        <th ><input type="checkbox" name="select_all" onclick="checkAll('box1',this)"></th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php $i = 0;?>
                        @foreach($Supplier as $Supp)
                            <tr>
                            <?php $i++; ?>
                            <td>{{ $i }}</td>
                            <td><img  style="width: 90px; height: 90px;" src=<?php echo asset("storage/supplier/supplier_no_$Supp->id/{$Supp->logo}")?> alt="" ></td>
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
                                <div class="card-header" >
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form class="delete" action="{{ route('supplier.destroy',$Supp->id) }}" method="POST">
                                <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>
                                             <div  style="text-align: center;font-size: 22px;color: red; text-decoration: underline;" > {{$Supp->name_ar}}</div>

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
                               <td  ><input type="checkbox" value="{{$Supp->id}}" class="box1" onclick="javascript:check();"></td>

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
  <?php $type="supplier";?>
  @include('delete_all_model')
  <!--========================================================-->
        </div>
        </div>
  </section>
</template>
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('/js/delete_all.js') }}"></script>

@endsection