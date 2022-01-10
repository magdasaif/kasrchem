@extends('layouts.master')
@section('css')

@section('title')
التصنيفات الفرعيه
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
            <h4 class="mb-0"> التصنيفات الفرعيه</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">الرئيسيه</a></li>
                <li class="breadcrumb-item active">التصنيفات الفرعيه</li>
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

    <button type="button" class="btn btn-info" ><a href="{{url('categories2/add/'.$id)}}" target="_blank"> اضافه</a></button>
    <br>
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
                            <td><?php if($category->status==1){echo'<label class="btn btn-success">مُفعل</label>';}else{echo'<label class="btn btn-danger">غير مُفعل</label>';}?></td>
                            <td>{{$category->relation_sub2_with_main->subname_ar}}</td>
                            <td><a href="{{url('categories3/'.$category ->id)}}"><label class="btn btn-success">{{$category->sub_cate3_count}}</label></a></td> 
                            <td>
                                <button type="button" class="btn btn-info" ><a href="{{url('categories2/'.$category ->id.'/edit/')}}" target="_blank"> تعديل</a></button>
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
