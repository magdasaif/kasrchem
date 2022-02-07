@extends('layouts.master')
@section('title')
<title>لوحة التحكم : الانواع الفرعية</title>
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
                <h3 class="card-title"> الانواع الفرعيه</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn">
                        <a href="{{URL('categories4_add/'.$sub3_id)}}" class="aa"> <li class="fa fa-plus-square" ><span> اضافة نوع فرعي </span></li></a>
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
                            <th>الاســــم</th>
                            <th>الحاله</th>
                            <th>اسم النوع</th>
                           <th>الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
            
                        <?php $i=1;?>
                        @foreach($sub_category4 as $sub_4)
                        <?php $i++;?>
                        <tr>
                            <td>{{$i}}</td>

                            <td>{{$sub_4->subname_ar}}</td>
                           
                            <td><?php if($sub_4->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>                            
                            <td>{{$sub_4->Sub_Category4->subname_ar}}</td>  
                            <td> <a href="{{route('categories4.edit',$sub_4->id)}}" style="font-weight: bold;font-size: 17px;" title="تعديل"><i class="fa fa-edit blue"></i></a></td>
                        </tr>

                        @endforeach
             <!--#############################################################-->

		</table>
            </div>
         
          </div>
        </div>
        </div>
  </section>
</template>
@endsection