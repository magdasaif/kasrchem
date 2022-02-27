@extends('layouts.master')
@section('title')
<title>لوحة التحكم : اضافه تصنيف </title>
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
                <h3 class="card-title">اضافه تصنيف</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('categories.index')}}" class="aa"> <li class="fas fa-cubes" ><span>  قائمة التصنيفات الرئيسيه</span></li></a>
                    </button>
                </div>
              </div>
        <div class="modal-body">
            
            <form method="POST" action="{{route('categories.store')}}" enctype="multipart/form-data">
            
                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}

                <div class="form-group">
                    <label >الاقسام</label>
                    <select class="form-control" name="section_id">
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->site_name_ar }}</option>
                        @endforeach
                    </select>
                </div>

                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم التصنيف بالعربيه</label>
                    <input type="text" class="form-control"     aria-describedby="emailHelp" placeholder="Enter name"  name="subname_ar"  id="regax_name_ar" onkeyup="check_regax_name_ar();" onkeypress="return CheckArabicCharactersOnly(event);"   required >
                     <span style="color:red;display:none;" id="error_name">  اسم التصنيف باللغة العربية لا يجب ان يكون ارقام فقط</span>
                    @error('subname_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم التصنيف بالانجليزيه</label>
                    <input type="text" class="form-control" id="subname_en" onkeypress="return CheckArabicCharactersOnly2(event);" aria-describedby="emailHelp" placeholder="Enter name" name="subname_en"  pattern="^(?=.*[a-zA-Z])[a-zA-Z0-9]+$" required  oninvalid="this.setCustomValidity('قم بادخال التصنيف بالانجليزية بالشكل المطلوب')"  oninput="this.setCustomValidity('')">
                    @error('subname_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                
                <div class="form-group">
                    <label for="exampleInputEmail1">صوره</label>

                    <input type="file" class="form-control" name="image" accept="image/*" required>

                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <select class="form-control" name="status">
                            <option value="1">مُفعل</option>
                            <option value="0">غير مُفعل</option>
                    </select>
                </div>
                
                <div class="modal-footer">
                        <button  type="submit" class="btn btn-primary"  >اضافه</button>
                </div>
                </form>
        </div>
        </div>
            </div>
        </div>
    </div>
</section>
</template>

<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>

<script src="{{ URL::asset('/js/regax_name/regax_name.js') }}"></script>
    
@endsection
