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
          
        
            <div class="card">
              <div class="card-header" >
                <h3 class="card-title" > تواصل معنا</h3>
                <div class="card-tools">
                
                </div>
              </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover styled-table ">
            <!--#############################################################-->
                  <thead>
                        <tr >
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
                                   
                                    <div class="modal-body">
                                            <center><h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3><center>
                                    </div>
                                    <div class="modal-footer">
                                   
                                    <input type="hidataen" name="_method" value="DELETE">
                                    <input type="hidataen" name="_token" value="{{ csrf_token() }}" />
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