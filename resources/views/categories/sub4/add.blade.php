@extends('layouts.master')

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
                <h3 class="card-title"> اضافه نوع فرعي</h3>
              </div>
 <!--#############################################################-->
 <div class="modal-body">
       
            <form method="POST" action="{{route('categories4.store')}}" enctype="multipart/form-data">
            
                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}
               
                <div class="form-group">
                <label for="exampleInputEmail1">اسم النوع الرئيسى</label>
                <input type="text" class="form-control" name="sub3_name" id="sub3_name" value="{{ $sub_Category3->subname_ar }}" disabled="disabled" >

                    <input type="text" class="form-control" name="sub3_id" id="sub3_id" value="{{ $sub_Category3->id}}" hidden>
                </div>
               
                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم النوع الفرعى  بالعربيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="subname_ar" required>
                    @error('subname_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم النوع الفرعى بالانجليزيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="subname_en" required>
                    @error('subname_en')
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
