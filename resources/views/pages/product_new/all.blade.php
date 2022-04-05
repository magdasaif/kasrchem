@extends('layouts.master')

<head>
<meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
@section('title')
<title>
    لوحة التحكم :
    {{$title}}</title>
 @endsection

@section('content')

<!--start Content Body -->

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

    
        <div class="content-body">
            <!-- Zero configuration table -->
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">المنتجات</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <a href="{{ route('Product2.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> اضافه</a>

                                    <button type="button" class="btn btn-warning mb-3"
                                        id="btn_delete_all" data-toggle="modal"
                                        data-target="#bulkdelete" >
                                        <i class="fa fa-trash"></i>
                                        حذف الكل                                            
                                    </button>
                                    
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered zero-configuration yajra-datatable" id="product-table">
                                            <thead>
                                                <tr>
                                                <th><input type="checkbox" name="select_all" onclick="checkAll('box1',this)"></th>
<!-- 
                                                    <th>
                                                        <input type="checkbox" name="select_all" id="select-all">
                                                    </th> -->
                                                    <th>المنتج</th>
                                                    <th>الترتيب</th>
                                                    <th>الحاله</th>
                                                    <th>الميديا</th>
                                                    <th>الاجراءات</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Zero configuration table -->

        </div>
    </div>

<!--End Content Body -->

<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>   -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });
//     let table  = $('.yajra-datatable').DataTable({
//         serverSide: true,
//         processing: true,
//         // language: {
//         //         "url": "{{ asset('assets/datatable-lang/ar.json') }}"
//         //     },
//         // paging: true, // Allow data to be paged
//          searching: true, // Search box and search function will be actived
//         // // ordering: true,

//         // // lengthMenu: [[1, 10, 25, 50, -1], [1, 10, 25, 50, "All"]],
//         // pageLength: 10,

//         // // autoWidth: true,
        
//         // buttons: [
//         //     'copy', 'csv', 'excel', 'pdf', 'print'
//         // ],
      
//         ajax: "{{ route('product_datatable') }}",
//         columns: [
//             {data: 'record_select', name: 'record_select'},
//             {data: 'name_ar', name: 'name_ar' , searchable: true,sortable:true},
//             {data: 'name_ar', name: 'name_ar'},
//             {data: 'sort', name: 'sort'},
//             {data: 'status', name: 'status',width: '10%'},
//             { data: 'action', name: 'action',  orderable: true, searchable: false},
//             { data: 'action', name: 'action',  orderable: true, searchable: false},
            
//         ]       

//     });

    let adminsTable = $('#product-table').DataTable({
        // dom: "tiplr",
        serverSide: true,
        processing: true,
        searchable: true,
        // language: {
        //     url: "{{ asset('assets/datatable-lang/ar.json') }}"
        // },
        ajax: {
            url: '{{ route("product_datatable") }}',
        },
        columns: [
            {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
            {data: 'name_ar', name: 'products.name_ar'},
            {data: 'sort', name: 'products.sort'},
            {data: 'status', name: 'products.status',width: '10%'},
            {data: 'media', name: 'products.media', searchable: false, sortable: false, width: '20%'},
            {data: 'actions', name: 'products.actions', searchable: false, sortable: false, width: '20%'},
        ],
         order: [[1, 'desc']],
       

    });
</script>
<script src="{{ URL::asset('/js/delete_all.js') }}"></script>
@endsection


