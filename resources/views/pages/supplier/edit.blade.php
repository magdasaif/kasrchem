@extends('layouts.master')
@section('title')
<title> لوحة التحكم :تعديل الموردين</title>
@endsection
@section('content')

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
              <div class="card-header" >
                <h3 class="card-title">تعديل الموردين</h3>
              </div>
 <!--#############################################################-->
 <div class="modal-body"  >
   <form method="POST"  action="{{route('supplier.update',$Supplier->id)}}" enctype="multipart/form-data">
                {{method_field('PATCH ')}}

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}

              
                
        
               <!----------------------------------------------------->
              
               <div class="form-group">
                    <label for="name_ar">اسم المورد  بالعربية </label>
                    <input type="text" class="form-control" id="name_ar" aria-describedby="name_ar" placeholder="ادخل اسم المعرض بالعربية" name="name_ar" value="{{$Supplier->name_ar}}" required>
                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="name_en">اسم المورد بالانجليزية</label>
                    <input type="text" class="form-control" id="name_en" aria-describedby="name_en" placeholder="ادخل اسم المعرض بالانجليزية" name="name_en"  value="{{$Supplier->name_en}}" required>
                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
               
              
              
               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="description_ar"> وصف المورد بالعربية  </label>
                    <textarea  class="form-control tinymce-editor" name="description_ar" id="content_ar" placeholder="ادخل وصف المورد بالعربية " >{!!$Supplier->description_ar!!}</textarea>
                    
                    @error('description_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
              
               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="description_en">وصف المورد بالانجليزية</label>
                    <textarea  class="form-control tinymce-editor" name="description_en" id="description_en" placeholder="ادخل وصف المورد بالانجليزية" >{!!$Supplier->description_en!!}</textarea>
                    
                    @error('description_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
              <!----------------------------------------------------->
            <div class="form-group">
                    <label for="logo">الصورة</label>
                   <center> <img data-v-20a423fa="" style="width:30%;" src="<?php echo asset("storage/supplier/{$Supplier->logo}")?>" class="uploaded-img"></center>
                    <input type="file" class="form-control" name="logo" >
                    @error('logo')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
   <!----------------------------------------------------->
               
                <input type="hidden" name="id" value="{{$Supplier->id}}">
               
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تعديل</button>
                </div>
                </form>
</div>
 <!--#############################################################-->

 		</div>
            </div>
        </div>
    </div>
</section>

@endsection
<!-- tinymce -->
<script src="{{ URL::asset('assets/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::asset('/js/tiny.js') }}"></script>