@extends('layouts.master')
@section('css')

@section('title')
التصنيفات الفرعية
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
            <h4 class="mb-0"> انواع التصنيفات الفرعية</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">الرئيسيه</a></li>
                <li class="breadcrumb-item active"> انواع التصنيفات الفرعية</li>
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
            <!-- {{url('categories3_add/'.$sub2_id)}} -->
                    <div class="table-responsive">
                        <button type="button"   class="btn btn-success"><a href="{{URL('categories3_add/'.$sub2_id)}}" target="_blank"> اضافة نوع</a>
                        </button>
                     <br><br>
                    <table id="datatable" class="table table-striped table-bordered p-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الصوره</th>
                            <th>اسم النوع</th>
                            <th>الحاله</th>
                            <th>التصنيف الفرعى</th>
                            <th>الانواع الفرعية </th>
                            <th>الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
            
                        <?php $i=1;?>
                        @foreach($sub_Category3 as $sub_3)
                        <?php $i++;?>
                        <tr>
                            <td>{{$i}}</td>

                            <td><img  style="width: 90px; height: 90px;" src="<?php echo asset("storage/categories/third/$sub_3->image")?>"></td>

                            <td>{{$sub_3->subname_ar}}</td>
                           
                            <td><?php if($sub_3->status==1){echo'<label class="btn btn-success">مُفعل</label>';}else{echo'<label class="btn btn-danger">غير مُفعل</label>';}?></td>
                            
                             <td>{{$sub_3->Sub_Category3->subname2_ar}}</td>  

                             <td><a href="{{url('categories4/'.$sub_3->id)}}"><label class="btn btn-success">{{$sub_3->relation_sub3_with_sub4_count}}</label></a></td>
                         
                            <td>
                            
                                <button type="button" class="btn btn-info" ><a href="{{route('categories3.edit',$sub_3->id)}}" target="_blank"> تعديل</a></button>
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
