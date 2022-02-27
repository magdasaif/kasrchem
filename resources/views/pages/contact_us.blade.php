@extends('layouts.master')
@section('title')
<title>لوحة التحكم :تواصل معنا</title>
 @endsection
@section('content')
<template>
  <section class="content">
    <div class="container-fluid">
        <div class="">

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
                <h3 class="card-title" > تواصل معنا</h3>
                <div class="card-tools">
                
                </div>
              </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table id="datatable"  class="table table-hover styled-table ">
            <!--#############################################################-->
                  <thead>
                        <tr>
                         <th><input type="checkbox" name="select_all" onclick="checkAll('box1',this)"></th>
                         <th>#</th>
                         <th>الاسم</th>
                        <th>البريد الالكترونى</th>
                        <th>الهاتف</th>
                        <th>التاريخ</th>
                        <th>حذف</th>
                        </tr>
                    </thead>
                      <tbody>
                         <?php $i = 0;?>

                        @foreach($contact as $cont)
                        <tr>
                        <td><input type="checkbox" value="{{$cont->id}}" class="box1" onclick="javascript:check();"></td>
                            <?php $i++; ?>
                            <td>{{ $i }}</td>
                            <td>{{$cont->name}}</td>
                            <td>{{$cont->email}}</td>
                            <td>{{$cont->phone}}</td>
                            <td>{{$cont->created_at}}</td>
                            <td style="font-weight: bold;font-size: 17px;">
							
                                <a  title="حذف" data-catid="{{$cont->id}}" data-toggle="modal" data-target="#delete{{$cont->id}}"> <i class="fa fa-trash red del"></i></a> 

 <!--############################ model for delete #################################-->
          
                         <div class="modal modal-danger fade" id="delete{{$cont->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content" style="direction: ltr;">
                                <div class="card-header" >
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form class="delete" action="{{route('contact.destroy',$cont->id)}}" method="POST">
                                @method('GET')
                                {{csrf_field()}}
                                    <div class="modal-body">
                                            <center><h3 class="text-center" style="margin-right: -127px;">
                                                هل تريد الحذف بالفعل؟
                                             </h3><center>
                                    </div>
                                    <div class="modal-footer">
                                   
                                    <center>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                        <input type="submit" value="حذف"  class="btn btn-primary">
                                    </center>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
            <!--#############################################################-->
                        </td>
                            
						</tr>
                       @endforeach
                    </tbody> 
                </table>
                </div></div>
           <!--#############################################################-->
  <!--========================================================-->
  <?php $type="contact";?>
  @include('delete_all_model')
    <!--========================================================-->    

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
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('/js/delete_all.js') }}"></script>
@endsection