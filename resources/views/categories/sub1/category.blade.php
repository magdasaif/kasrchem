@extends('layouts.master')
@section('title')
<title>لوحة التحكم : التصنيفات الرئيسيه</title>
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
                <h3 class="card-title"> التصنيفات الرئيسيه</h3>

                <div class="card-tools">

                   <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{URL('categories/create')}}" class="aa"> <li class="fa fa-plus-square" ><span> اضافة تصنيف </span></li></a>
                        </button>
                        

                </div>
              </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover styled-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الصوره</th>
                            <th>اسم التصنيف</th>
                            <th>الحاله</th>
                            <th>عدد التصنيفات</th>
                            <th>الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;?>
                        @foreach($categories as $category)
                        <?php $i++;?>
                        <tr>
                            <td>{{$i}}</td>

                            <td><img  style="width: 90px; height: 90px;" src="<?php echo asset("storage/categories/first/$category->image")?>"></td>

                            <td>{{$category->subname_ar}}</td>
                            <td><?php if($category->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                            <td><a href="{{url('categories2/'.$category ->id)}}"><label class="btn btn-success">{{$category->sub_cate2_count}}</label></a></td> 
                            <td>
                                <a href="{{url('categories/'.$category ->id.'/edit/')}}" style="font-weight: bold;font-size: 17px;" title="تعديل"><i class="fa fa-edit blue"></i></a>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
          
          </div>
        </div>
        </div>
  </section>
</template>
@endsection
