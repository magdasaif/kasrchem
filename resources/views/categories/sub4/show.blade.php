@extends('layouts.master')
@section('css')

@section('title')
انواع الانواع الفرعية
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
            <h4 class="mb-0">انواع الانواع الفرعية</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">الرئيسيه</a></li>
                <li class="breadcrumb-item active"> انواع الانواع الفرعية</li>
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
                        <button type="button"   class="btn btn-success"><a href="{{URL('categories4_add/'.$sub3_id)}}" target="_blank"> اضافة نوع فرعي</a>
                        </button>
                     <br><br>
                    <table id="datatable" class="table table-striped table-bordered p-0">
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
                           
                            <td><?php if($sub_4->status==1){echo'<label class="btn btn-success">مُفعل</label>';}else{echo'<label class="btn btn-danger">غير مُفعل</label>';}?></td>
                            
                            <td>{{$sub_4->Sub_Category4->subname_ar}}</td>  
                           
                             <td> <button type="button" class="btn btn-info" ><a href="{{route('categories4.edit',$sub_4->id)}}" target="_blank"> تعديل</a></button></td>
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
