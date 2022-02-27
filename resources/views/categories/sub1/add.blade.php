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
                    <label for="exampleInputEmail1">اسم التصنيف بالعربيه*</label>
                    <input type="text" class="form-control"     aria-describedby="emailHelp" placeholder="Enter name"  name="subname_ar"   value="{{ old('subname_ar') }}"  id="regax_name_ar" onkeyup="check_regax_name_ar();" onkeypress="return CheckArabicCharactersOnly(event);"   required oninvalid="this.setCustomValidity('يجب ان يكون اسم التصنيف باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name"> يجب ان يكون اسم التصنيف باللغة العربية وايضا لا يكون ارقام فقط</span>
                    @error('subname_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم التصنيف بالانجليزيه*</label>
                    <input type="text" class="form-control" id="subname_en"   name="subname_en"  value="{{ old('subname_en') }}"  required onkeypress="return CheckEnglishCharactersOnly(event);" pattern="^(?=.*[a-zA-Z\s])[a-zA-Z0-9\s]+$" oninvalid="this.setCustomValidity('يجب ان يكون اسم التصنيف باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون اسم التصنيف باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

                    @error('subname_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                
                <div class="form-group">
                    <label for="exampleInputEmail1">صوره*</label>

                    <input type="file" class="form-control" name="image" accept="image/*"   value="{{ old('image') }}" required   oninvalid="this.setCustomValidity('قم بادخال الصورة')"  oninput="this.setCustomValidity('')"> 

                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                <label for="status">الحالة*</label>

                    <select class="form-control" name="status">
                    <option value="1" {{ old('status') == '1' ? "selected" : "" }}>مُفعل</option>
                     <option value="0" {{ old('status') == '0' ? "selected" : "" }}>غير مُفعل</option>
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
   
    <!-- <script src="{{ URL::asset('/js/regax_name/regax_name _model.js') }}"></script> -->
@endsection
