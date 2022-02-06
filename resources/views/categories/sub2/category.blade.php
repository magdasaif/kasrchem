@extends('layouts.master')
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
                <h3 class="card-title"> التصنيفات الفرعيه</h3>

                <div class="card-tools">

                   <button type="button" class="btn btn-sm" style=" background-color: #343a40;">
                        <a href="{{url('categories2/add/'.$id)}}" style="color: #fff; !important"> <li class="fa fa-plus-square" ><span> اضافة تصنيف </span></li></a>
                        </button>
                        

                </div>
              </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">

            <!--#############################################################-->
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الصوره</th>
                            <th>اسم التصنيف</th>
                            <th>الحاله</th>
                            <th>التصنيف الرئيسى </th>
                            <th>الانواع</th>
                            <th>الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;?>
                        @foreach($categories as $category)
                        <?php $i++;?>
                        <tr>
                            <td>{{$i}}</td>

                            <td><img  style="width: 90px; height: 90px;" src="<?php echo asset("storage/categories/second/$category->image2")?>"></td>
                            <td>{{$category->subname2_ar}}</td>
                            <td><?php if($category->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>                            <td>{{$category->relation_sub2_with_main->subname_ar}}</td>
                            <td><a href="{{url('categories3/'.$category ->id)}}"><label class="btn btn-success">{{$category->sub_cate3_count}}</label></a></td> 
                           
                            <td> <a href="{{url('categories2/'.$category ->id.'/edit/')}}"  title="تعديل"><i class="fa fa-edit blue"></i></a></td>
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
