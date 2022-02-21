@extends('layouts.master')
@section('title')
<title>لوحة التحكم :الصور المتحركة</title>
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
                <h3 class="card-title" > الصور المتحركة</h3>
                <div class="card-tools">
                 <!-- livewire add form-->
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('slider.create')}}"  class="aa"> <li class="fa fa-plus-square" ><span> اضافه </span></li></a>
                    </button>
                </div>
              </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover styled-table ">
            <!--#############################################################-->
                  <thead>
                        <tr >
                         <th>#</th>
                         <th>الصورة</th>
                        <th>الأولوية</th>
                        <th>الحالة</th>
                        <th>الاجراءات</th>
                        </tr>
                    </thead>
                      <tbody>
                         <?php $i = 0; $status=1?>

                        @foreach($Slider as $slider)
                            <tr>
                            <?php $i++; ?>
                            <td>{{ $i }}</td>
                            <td><img  style="width: 90px; height: 90px;" src=<?php echo asset("storage/slider/{$slider->image}")?> alt="" ></td>
                            <td>{{$slider->priority}}</td>
							<td style="font-weight: bold;font-size: 17px;"><?php if($slider->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                             
							<td style="font-weight: bold;font-size: 17px;">
							<a href="{{route('slider.edit',$slider->id)}}"  title="تعديل"><i class="fa fa-edit blue"></i></a>
                           
                             / &nbsp;
                                <a  title="حذف" data-catid="{{$slider->id}}" data-toggle="modal" data-target="#delete{{$slider->id}}"> <i class="fa fa-trash red del"></i></a> 

 <!--############################ model for delete #################################-->
          
                         <div class="modal modal-danger fade" id="delete{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content" style="direction: ltr;">
                                <div class="card-header" >
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form class="delete" action="{{route('slider.destroy',$slider->id)}}" method="POST">
                                   
                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>
                                             <img  style="width: 90px;" src=<?php echo asset("storage/slider/{$slider->image}")?> alt="" >
                                    </div>
                                    <input type="hidden" name="deleted_image" value="{{$slider->image}}">
                                    <div class="modal-footer">
                                   
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                        <input type="submit" value="حذف"  class="btn btn-primary">
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