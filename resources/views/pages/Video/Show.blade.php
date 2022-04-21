@extends('layouts.master')
@section('title')
<title>لوحة التحكم : {{$title}}</title>
 @endsection
@section('content')
  <section class="content">
    <div class="container-fluid">
        <div class="row">

        <div class="col-12">
        @include('layouts.messages')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">  {{$title}}</h3>

                <div class="card-tools">

                   <button type="button" class="btn btn-sm bbtn">
                        <a href="{{route('video.create')}}" class="aa"> <li class="fa fa-plus-square" ><span> اضافة  </span></li></a>
                        </button>
                        <button type="button" id="btn_delete_all" disabled class="btn  btn-danger btn-sm  aa delelte_all " style=" font-weight: 900;font-size: 13px;">حذف المُحدد</button>


                </div>
              </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">   
               <!--=======================searchand form ============================-->
                    <input type="hidden" name="hidden_blade" id="hidden_blade" value="Show" />
                    <input type="hidden" name="hidden_model" id="hidden_model" value="video" />
                        @include('pages.search_form')
                   <!--===========================================================================-->
                <table id="datatable" class="table table-hover styled-table">
            
                    <thead>
                        <tr  style="color: #17899b;" >
                        <th>#</th>
                        <th>عنوان الفيديو</th>
                        <th>الحالة</th>
                        <th>الترتيب</th>
                        <th>الاجراءات</th>
                        <th ><input type="checkbox" name="select_all" onclick="checkAll('box1',this)"></th>
                        </tr>
                    </thead>
                    <tbody>        
                <!--=======================body  ============================-->
                @include('pages.Video.paginate_video')
                <!--========================================================-->
                    </tbody>


		</table>
            </div>
          
          </div>
           <!--========================================================-->
  <?php $type="video";?>
  @include('delete_all_model')
  <!--========================================================-->
        </div>
        </div>
  </section>

<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('/js/delete_all.js') }}"></script>
<script src="{{ URL::asset('/js/search_paginate.js') }}"></script>

@endsection