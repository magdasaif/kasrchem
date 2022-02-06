@extends('layouts.master')
@section('content')
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

            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
            @endif
          
        
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">أقسام الموقع</h3>

                <div class="card-tools">

                   <button type="button" class="btn btn-sm btn-success">
                        <a href="{{URL('site_section/create')}}" style="color: #fff; !important"> <li class="fa fa-plus-square" ><span>اضافة قسم جديد</span></li></a>
                        </button>
                        

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
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

                           

                            <td><?php if($section->statues==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>


                            <td> 
                                <a href="{{route('site_section.edit',$section->id)}}"  title="تعديل"><i class="fa fa-edit blue"></i></a>
                             </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="products" @pagination-change-page="getResults"></pagination>
              </div>
            <!-- /.card -->
          </div>
        </div>
        </div>
  </section>
</template>
@endsection

