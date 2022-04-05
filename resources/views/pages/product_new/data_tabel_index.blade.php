@extends('layouts.master')


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

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

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">لمنتجات</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">الرئيسيه</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">المنتجات</a>
                            </li>

                        </ol>
                    </div>
                </div>
            </div>
        </div>
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
                                        <table class="table table-striped table-bordered zero-configuration" id="product-table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <input type="checkbox" name="select_all" id="select-all">
                                                    </th>
                                                    <th>المنتج</th>
                                                    <th>الصوره</th>
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
@endsection

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js" integrity="sha512-uE2UhqPZkcKyOjeXjPCmYsW9Sudy5Vbv0XwAVnKBamQeasAVAmH6HR9j5Qpy6Itk1cxk+ypFRPeAZwNnEwNuzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.js" integrity="sha512-cG69LpvCJkui4+Uuj8gn/zRki74/E7FicYEXBnplyb/f+bbZCNZRHxHa5qwci1dhAFdK2r5T4dUynsztHnOS5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>

    let adminsTable = $('#product-table').DataTable({
        // dom: "tiplr",
        serverSide: true,
        processing: true,
        "language": {
                "url": "{{ asset('assets/datatable-lang/ar.json') }}"
            },
        ajax: {
            url: '{{ route("Product2.data") }}',
        },
        columns: [
            {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
            {data: 'name_ar', name: 'name_ar'},
            {data: 'name_en', name: 'name_en'},
            {data: 'sort', name: 'sort'},
            {data: 'status', name: 'status',width: '10%'},
            {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
        ],
         order: [[4, 'desc']],
       

    });
</script>
@endsection