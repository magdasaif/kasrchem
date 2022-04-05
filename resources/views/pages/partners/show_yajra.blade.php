@extends('layouts.master')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    
@section('title')
<title>لوحة التحكم : {{$title}}</title>
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
              <div class="card-header">
                <h3 class="card-title"> {{$title}}</h3>

                <div class="card-tools">

                <!-- livewire add form
                <button type="button" class="btn btn-info" ><a href="{{url('add_product')}}"> اضافه</a></button> -->

                   <button type="button" class="btn btn-sm bbtn">
                        <a href="{{route('partner.create')}}" class="aa"> <li class="fa fa-plus-square" ><span> اضافه </span></li></a>
                        </button>
                        <button type="button" id="btn_delete_all" disabled class="btn  btn-danger btn-sm  aa delelte_all " style=" font-weight: 900;font-size: 13px;">حذف المُحدد</button>


                </div>
              </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                 <table class="table table-striped table-bordered zero-configuration yajra-datatable" id="partner-table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" name="select_all" onclick="checkAll('box1',this)"></th>
                            <th>الاسم</th>
                            <th>الترتيب</th>
                            <th>الحاله</th>
                            <th>الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
          
          </div>

        </div>
        </div>
  </section>
</template>

<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('/js/delete_all.js') }}"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>   -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    let table  = $('.yajra-datatable').DataTable({
        serverSide: true,
        processing: true,
        // language: {
        //         "url": "{{ asset('assets/datatable-lang/ar.json') }}"
        //     },
        // paging: true, // Allow data to be paged
         searching: true, // Search box and search function will be actived
        // // ordering: true,

        // // lengthMenu: [[1, 10, 25, 50, -1], [1, 10, 25, 50, "All"]],
        // pageLength: 10,

        // // autoWidth: true,
        
        // buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ],
      
        ajax: "{{ route('partner_datatable') }}",
        columns: [
            {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
            {data: 'name_ar', name: 'name_ar'},
            {data: 'sort', name: 'sort'},
            {data: 'status', name: 'status',width: '10%'},
            {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
            
        ]       

    });

    // let adminsTable = $('#partner-table').DataTable({
    //     // dom: "tiplr",
    //     serverSide: true,
    //     processing: true,
    //     searchable: true,
    //     // language: {
    //     //     url: "{{ asset('assets/datatable-lang/ar.json') }}"
    //     // },
    //     ajax: {
    //         url: '{{ route("partner_datatable") }}',
    //     },
    //     columns: [
    //         {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
    //         {data: 'name_ar', name: 'name_ar'},
    //         {data: 'sort', name: 'sort'},
    //         {data: 'status', name: 'status',width: '10%'},
    //         {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
    //     ],
    //      order: [[1, 'desc']],
    // });
</script>
@endsection