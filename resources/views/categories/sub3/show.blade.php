@extends('layouts.master')
@section('title')
<title>لوحة التحكم : الانواع الرئيسيه</title>
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
              <div class="card-header">
                <h3 class="card-title"> الانواع الرئيسيه</h3>

                <div class="card-tools">

                   <button type="button" class="btn btn-sm bbtn">
                        @if($from_side_or_no=='yes')
                             <a href="{{url('categories3_new/create')}}" class="aa"> <li class="fa fa-plus-square" ><span> اضافة نوع رئيسى </span></li></a>
                        @else
                            <a href="{{url('categories3_add/'.$sub2_id)}}" class="aa"> <li class="fa fa-plus-square" ><span> اضافة نوع رئيسى</span></li></a>
                        @endif
                    </button>
                        

                </div>
              </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover styled-table">
            <!--#############################################################-->
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الصوره</th>
                            <th>اسم النوع</th>
                            <th>الحاله</th>
                            <th>التصنيف الفرعى</th>
                            <th>الانواع الفرعية </th>
                            <th>الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
            
                        <?php $i=1;?>
                        @foreach($sub_Category3 as $sub_3)
                        <?php $i++;?>
                        <tr>
                            <td>{{$i}}</td>

                            <td><img  style="width: 90px; height: 90px;" src="<?php echo asset("storage/categories/third/$sub_3->image")?>"></td>

                            <td>{{$sub_3->subname_ar}}</td>
                           
                            <td><?php if($sub_3->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>                            
                             <td>{{$sub_3->Sub_Category3->subname2_ar}}</td>  

                             <td><a href="{{url('categories4/'.$sub_3->id)}}"><label class="btn btn-success">{{$sub_3->relation_sub3_with_sub4_count}}</label></a></td>
                             <td> <a href="{{route('categories3.edit',$sub_3->id)}}" style="font-weight: bold;font-size: 17px;"  title="تعديل"><i class="fa fa-edit blue"></i></a></td>
                        
                        </tr>

                        @endforeach
                    
                    </tbody>              
                <!--#############################################################-->

		        </table>
            </div>
           
          </div>
        </div>
        </div>
  </section>
</template>
@endsection