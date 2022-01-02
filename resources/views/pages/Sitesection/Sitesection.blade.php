@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
    اقسام الموقع
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
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
         <!---------------------------- error msg------------------------------->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
       <!-----------------------------العرض-------------------------------->
                <div class="container">



                    <div class="card-body" style="text-align: right;">
                        <button type="button" class="btn btn-info" ><a href="{{route('site_section.create')}}">  اضافة قسم جديد</a></button>

                        <br><br>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>اسم القسم</th>
                        <th>الصورة</th>
                        <th>الترتيب</th>
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
                            <td><img  style="width: 90px; height: 90px;" src="<?php echo asset("storage/site_sections/site_section_image/$section->image")?>"></td>
                           {{--  <td>{{$section->image}}</td>--}}
                            <td>{{$i}}</td>
                
                            @if($section->statues==1)
                            <td>مفعل</td>
                            @else
                            <td>غير مفعل</td>
                            @endif
                          
                          {{--  <td> 
                                 <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $section->id}}"
                                   title="تعديل">  تعديل </button>
                             </td>

                             --}}
                             
                            <td> <button type="button" class="btn btn-info" ><a href={{route('site_section.edit',$section->id)}}> تعديل</a></button>
                             </td>
                             
                            </tr>
                
 <!--------------------------------- edit_modal----------------------------------->


                          
                        @endforeach
                      
                    </tbody>
                  </table>
                </div>
                
                
                </div>
 

<!--------------------------------------------------------------------------------->




            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
