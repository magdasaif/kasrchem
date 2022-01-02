@extends('layouts.master')
@section('css')

@section('title')
التصنيفات الرئيسيه
@stop
@endsection
@section('page-header')


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

<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> التصنيفات الرئيسيه</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">الرئيسيه</a></li>
                <li class="breadcrumb-item active">التصنيفات الرئيسيه</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

            <!--#############################################################-->
                    <div class="table-responsive">

                    <table id="datatable" class="table table-striped table-bordered p-0">
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
                            <td><?php if($category->status==1){echo'<label class="badge badge-success">مُفعل</label>';}else{echo'<label class="badge badge-danger">غير مُفعل</label>';}?></td>
                            <td><a href="{{url('categories2/'.$category ->id)}}"><label class="badge badge-success">{{$count}}</label></a></td> 
                            <td>
                                <button type="button" class="btn btn-info" ><a href="{{url('categories/'.$category ->id.'/edit/')}}"> تعديل</a></button>
                            </td>
                        </tr>

                        @endforeach
                    
                    </tbody>              
                </table>
            </div>
            <!--#############################################################-->

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
