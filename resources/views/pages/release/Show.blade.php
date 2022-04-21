@extends('layouts.master')

 @section('title')
<title>لوحة التحكم : {{$title}}</title>
 @endsection

@section('content')

<!-- <meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->

<template>
  <section class="content">
    <div class="container-fluid">
        <div class="row">

        <div class="col-12">
        @include('layouts.messages')
 
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> {{$title}}</h3>

                <div class="card-tools">

                   <button type="button" class="btn btn-sm bbtn">
                        <a href="{{route('release.create')}}" class="aa"> <li class="fa fa-plus-square" ><span> اضافة  </span></li></a>
                        </button>
                        
                        <button type="button" id="btn_delete_all" disabled class="btn  btn-danger btn-sm  aa delelte_all " style=" font-weight: 900;font-size: 13px;">حذف المُحدد</button>

                </div>
              </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                        <!--=======================searchand form ============================-->
                        <input type="hidden" name="hidden_blade" id="hidden_blade" value="Show" />
                        <input type="hidden" name="hidden_blade" id="hidden_model" value="release" />
                                @include('pages.search_form')
                       <!--===========================================================================-->
                <table id="datatable" class="table table-hover styled-table">
              
            <!--#############################################################-->
                    <thead>
                        <tr  style="color: #17899b;" >
                        <th>#</th>
                        <th>صورة النشرة </th>
                        <th>عنوان النشرة</th>
                        <th>الحالة</th>
                        <th>الترتيب</th>
                        <th>الاجراءات</th>
                        <th><input type="checkbox" name="select_all" onclick="checkAll('box1',this)"></th>

                        </tr>
                    </thead>
                   
                      <!--#############################################################-->
                      <tbody>
                         
                         <!--=======================body  ============================-->
                            @include('pages.Release.paginate_release')
                        <!--========================================================-->

                    </tbody>
		</table>
            </div>
           
          </div>
           <!--========================================================-->
 <?php $type="release";?>
  @include('delete_all_model')
    <!--========================================================--> 
        </div>
        </div>
  </section>
</template>
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('/js/delete_all.js') }}"></script>
<script src="{{ URL::asset('/js/search_paginate.js') }}"></script>
<!--==========================datatable==============================-->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
$.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('release_datatable') }}",
        columns: [
            {data: 'name_ar', name: 'name_ar'},
            {data: 'status', name: 'status'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false},
        ]
    });
</script> -->
@endsection