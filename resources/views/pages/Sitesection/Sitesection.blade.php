@extends('layouts.master')
@section('css')

@section('title')
أقسام الموقع
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
            <h4 class="mb-0"> أقسام الموقع</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">الرئيسية</a></li>
                <li class="breadcrumb-item active">اقسام الموقع</li>
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
                    <button type="button"   class="btn btn-success"><a href="{{URL('site_section/create')}}" target="_blank"> اضافة قسم جديد</a>
                        </button>
                     <br><br>
                    <table id="datatable" class="table table-striped table-bordered p-0">
                    <thead>
                        <tr  style="color: #17899b;" >
                        <th>#</th>
                        <th>اسم القسم</th>
                        <th>الصورة</th>
                        <th>الأولوية</th>
                        <th>الحالة</th>
                        <th>الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php $i = 0; $statues=1?>

                        @foreach($site_section as $section)
                            <tr>
                            <?php $i++; ?>
                            <td>{{ $i }}</td>
                            <td>{{$section->site_name_ar}}</td>


                            <td><img  style="width: 90px; height: 90px;" src=<?php echo asset("storage/site_sections/site_section_image/{$section->image}")?> alt="" ></td>
                            <td>{{$section->priority}}</td>

                           

                            <td><?php if($section->statues==1){echo'<label class="btn btn-success">مُفعل</label>';}else{echo'<label class="btn btn-danger">غير مُفعل</label>';}?></td>


                            <td> <button type="button" class="btn btn-info" ><a href="{{route('site_section.edit',$section->id)}}"  target="_blank"> تعديل</a></button>
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
