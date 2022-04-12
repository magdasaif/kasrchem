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
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
 
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
                <table id="datatable" class="table table-hover styled-table">
              
            <!--#############################################################-->
                    <thead>
                        <tr  style="color: #17899b;" >
                        <th>#</th>
                        <th>صورة النشرة </th>
                        <th>عنوان النشرة</th>
                        <th>الحالة</th>
                        <th>الاجراءات</th>
                        <th><input type="checkbox" name="select_all" onclick="checkAll('box1',this)"></th>

                        </tr>
                    </thead>
                   
                      <!--#############################################################-->
                      <tbody>
                         <?php $i = 0; $status=1?>
                        @foreach($releases as $release)
                            <tr>
                            <?php $i++; ?>
                            <td> {{$i}}</td>
                            @if(sizeof($release->mainImage())>0)
                            @foreach($release->mainImage() as $xx)
                            <td><img  style="width: 90px; height: 90px;" src=<?php echo asset("storage/releases/release_no_$release->id/{$xx->filename}")?> alt="" ></td>
                            
                            @endforeach
                            @else
                            <td></td>
                            @endif
                             <td>{{$release->name_ar}}</td>
                             <td><?php if($release->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                        
                            <td>
                                <a href="{{route('release.edit',encrypt($release->id))}}" style="font-weight: bold;font-size: 17px;" title="تعديل"><i class="fa fa-edit blue"></i></a>
                                /
                                <a href="#" style="font-weight: bold;font-size: 17px;" title="حذف" data-catid="{{$release->id}}" data-toggle="modal" data-target="#delete{{$release->id}}"> <i class="fa fa-trash red"></i></a>
						  <!--############################ model for delete #################################-->
          
                          <div class="modal modal-danger fade" id="delete{{$release->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="card-header" >
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form action="{{route('release.destroy',encrypt($release->id))}}"  method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>
                                             <div   style="text-align: center;font-size: 22px;color: red; text-decoration: underline;" > {{$release->name_ar}}</div>
                                            <input type="hidden" name="release_id" id="$release->id" value="$release->id">

                                    </div>
                                    <input type="hidden" name="deleted_image" value="{{$release->image}}">
                                    <input type="hidden" name="deleted_file" value="{{$release->file}}">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                        <button type="submit" class="btn btn-success">حذف</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
            <!--#############################################################-->
                            </td>
                            <td><input type="checkbox" name="row_checkbox" value="{{$release->id}}" class="box1" onclick="javascript:check();"></td>

                            </tr>
                      

                        @endforeach

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