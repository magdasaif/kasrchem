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
                <h3 class="card-title">تعديل تصنيف</h3>
              </div>
                <div class="modal-body">
                    
                    <form method="POST" action="{{route('categories.update',$categories->id)}}" enctype="multipart/form-data">
                        {{method_field('PATCH')}}

                        @csrf
                        <div class="form-group">
                            <select class="form-control" name="section_id">
                                <option value="{{ $categories->relation_with_section->id }}">{{ $categories->relation_with_section->site_name_ar }}</option>

                                @foreach ($sectionss as $section)
                                    <option value="{{ $section->id }}">{{ $section->site_name_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم التصنيف بالعربيه</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname_ar" value="{{$categories->subname_ar}}" required>
                            @error('subname_ar')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم التصنيف بالانجليزيه</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname_en" value="{{$categories->subname_en}}" required>
                            @error('subname_en')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>



                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">صوره</label><br>
                            <center><img data-v-20a423fa=""style="width: 30%;" src="<?php echo asset("storage/categories/first/$categories->image")?>" class="uploaded-img"> </center>

                            <input type="file" class="form-control" name="image" accept="image/*">

                            @error('image')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">الحالة</label>
                            <select class="form-control" name="status">
                                    <option value="1" <?php if($categories->status==1){echo'selected';}?> >مُفعل</option>
                                    <option value="0" <?php if($categories->status==0){echo'selected';}?> >غير مُفعل</option>
                            </select>
                        </div>
                        <input type="hidden" name="id" value="{{$categories->id}}">
                        <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">تعديل</button>
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
