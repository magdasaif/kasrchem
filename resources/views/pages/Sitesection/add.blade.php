@extends('layouts.master')
@section('title')
<title>لوحة التحكم : اضافه قسم</title>
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
                <h3 class="card-title">اضافه قسم</h3>
              </div>
    
                      <div class="modal-body">

                            <form method="POST" action="{{route('site_section.store')}}" enctype="multipart/form-data">

                                @csrf
                                {{-- <input name="_token" value="{{csrf_token()}}"> --}}



                                <div class="form-group">
                                    <label for="site_name_ar">اسم القسـم بالعربيه</label>
                                    <input type="text" class="form-control" id="site_name_ar" aria-describedby="site_name_ar" placeholder="ادخل اسم القسـم بالعربيه" name="site_name_ar" required>
                                    @error('site_name_ar')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="site_name_en">اسم القسم بالانجليزيه</label>
                                    <input type="text" class="form-control" id="site_name_en" aria-describedby="site_name_en" placeholder="ادخل اسم القسـم بالانجليزية" name="site_name_en" required>
                                    @error('site_name_en')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="priority">الأولوية</label>
                                    <input type="number" class="form-control" id="priority" aria-describedby="priority" placeholder="ادخل الأولوية" name="priority" required>
                                    @error('priority')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image">صوره</label>
                                    <input type="file" class="form-control" name="image">
                                    @error('image')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="image">الحالـة</label>
                                    <select class="form-control" name="statues">
                                            <option value="1">مُفعل</option>
                                            <option value="0">غير مُفعل</option>
                                    </select>
                                </div>

                                <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">اضافه</button>
                                </div>
                                </form>
                        </div>
                       


             </div>
            </div>
        </div>
    </div>
</section>
</template>
@endsection
