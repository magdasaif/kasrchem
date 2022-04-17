@extends('layouts.master')
@section('title')
<title>لوحة التحكم :{{$title}}</title>
 @endsection
@section('content')
<template>
  <section class="content">
    <div class="container-fluid">
        <div class="">

        <div class="col-12">
        @include('layouts.messages')

        
            <div class="card">
              <div class="card-header" >
                <h3 class="card-title" > {{$title}}</h3>
                <div class="card-tools">
                 <!-- livewire add form-->
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('slider.create')}}"  class="aa"> <li class="fa fa-plus-square" ><span> اضافه </span></li></a>
                    </button>
                    <button type="button" id="btn_delete_all" disabled class="btn  btn-danger btn-sm  aa delelte_all " style=" font-weight: 900;font-size: 13px;">حذف المُحدد</button>

                </div>
              </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table id="datatable" class="table table-hover styled-table ">
            <!--#############################################################-->
                  <thead>
                        <tr >
                         <th>#</th>
                         <th>الصورة</th>
                        <th>الترتيب</th>
                        <th>الحالة</th>
                        <th>الاجراءات</th>
                        <th ><input type="checkbox" name="select_all" onclick="checkAll('box1',this)"></th>

                        </tr>
                    </thead>
                      <tbody>
                         <?php $i = 0; $status=1?>

                        @foreach($Slider as $slider)
                            <tr>
                                
                            <?php $i++;
                            if(isset($slider->image->filename)){$img=$slider->image->filename;}else{$img='';}
                            ?>
                            <td>{{ $i }}</td>
                            <td><img  style="width: 90px; height: 90px;" src=<?php echo asset("storage/slider/{$img}")?> alt="" ></td>
                            <td>{{$slider->sort}}</td>
							<td style="font-weight: bold;font-size: 17px;"><?php if($slider->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                             
							<td style="font-weight: bold;font-size: 17px;">
							<a href="{{route('slider.edit',encrypt($slider->id))}}"  title="تعديل"><i class="fa fa-edit blue"></i></a>
                           
                             / &nbsp;
                                <a  title="حذف" data-catid="{{$slider->id}}" data-toggle="modal" data-target="#delete{{$slider->id}}"> <i class="fa fa-trash red del"></i></a> 

 <!--############################ model for delete #################################-->
          
                         <div class="modal modal-danger fade" id="delete{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content" style="direction: ltr;">
                                <div class="card-header" >
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form class="delete" action="{{route('slider.destroy',encrypt($slider->id))}}" method="POST">
                                   
                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>
                                             <img  style="width: 90px;" src=<?php echo asset("storage/slider/{$slider->filename}")?> alt="" >
                                    </div>
                                    <input type="hidden" name="deleted_image" value="{{$slider->filename}}">
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
                        <td ><input type="checkbox" name="row_checkbox" value="{{$slider->id}}" class="box1" onclick="javascript:check();"></td>

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
            <!--========================================================-->
 <?php $type="slider";?>
  @include('delete_all_model')
    <!--========================================================--> 
          </div>
        </div>
        </div>
  </section>
</template>
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('/js/delete_all.js') }}"></script>
@endsection