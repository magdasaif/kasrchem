@extends('layouts.master')
@section('title')
<title>لوحة التحكم : اضافه نوع</title>
 @endsection
@section('content')
<template>
<section class="content">
    <div class="container-fluid">
        <div class="row">
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
          <div class="col-12">
        
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">اضافه نوع</h3>
              </div>
 <!--#############################################################-->
            <div class="modal-body">
            <form method="POST" action="{{route('categories3.store')}}" enctype="multipart/form-data">
            
                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}
               
                <div class="form-group">
                    <!-- <select class="form-control" name="sub2_id" selected readonly>
                        @foreach ($Sub_Category2 as $Sub_Category2)
                            <option value="{{ $Sub_Category2->id }}" >{{ $Sub_Category2->subname2_ar }}</option>
                        @endforeach
                    </select> -->
                    <label for="exampleInputEmail1">اسم التصنيف الفرعي</label>
                    <input type="text" class="form-control" name="sub2_id" id="sub2_id" value="{{ $Sub_Category2->id}}" hidden>
                   <input type="text" class="form-control" name="sub2_name" id="sub2_name" value="{{ $Sub_Category2->subname2_ar }}" disabled="disabled" >
                </div>
               
                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم النوع بالعربيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ادخل اسم الفرع بالعربية" name="subname_ar" required>
                    @error('subname_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم النوع بالانجليزيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ادخل اسم الفرع بالانجليزية" name="subname_en" required>
                    @error('subname_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                
                <div class="form-group">
                    <label for="exampleInputEmail1">صوره</label>

                    <input type="file" class="form-control" name="image" accept="image/*">

                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                <label for="exampleInputEmail1">الحالة</label>
                    <select class="form-control" name="status">
                            <option value="1">مُفعل</option>
                            <option value="0">غير مُفعل</option>
                    </select>
                </div>
                
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">اضافه</button>
                </div>
                </form>
             </div>
 <!--#############################################################-->

 		</div>
            </div>
        </div>
    </div>
</section>
</template>
@endsection

