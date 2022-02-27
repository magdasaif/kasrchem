@extends('layouts.master')
@section('title')
<title> لوحة التحكم :اضافة مورد</title>
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
                <h3 class="card-title"  > اضافة مورد</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('supplier.index')}}" class="aa"> <li class="fas fa-users" ><span>  قائمة الموردين </span></li></a>
                    </button>
                </div>
              </div>
 <!--#############################################################-->
      <div class="modal-body" >
            <form method="POST" action="{{route('supplier.store')}}" enctype="multipart/form-data">

                @csrf
               <!----------------------------------------------------->
              
               <div class="form-group">
                    <label for="name_ar"> اسم المورد </label>
                    <input type="text" class="form-control"  aria-describedby="name_ar" placeholder="ادخل اسم المورد" name="name_ar"  value="{{ old('name_ar') }}" required  id="regax_name_ar" onkeyup="check_regax_name_ar();" onkeypress="return CheckArabicCharactersOnly(event);"   required oninvalid="this.setCustomValidity('يجب ان يكون اسم المورد باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name"> يجب ان يكون اسم المورد باللغة العربية وايضا لا يكون ارقام فقط</span>

                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="name_en">اسم المورد بالانجليزية</label>
                    <input type="text" class="form-control" id="name_en" aria-describedby="name_en" placeholder="ادخل اسم المورد بالانجليزية"  value="{{ old('name_en') }}" name="name_en" required onkeypress="return CheckEnglishCharactersOnly(event);" pattern="^(?=.*[a-zA-Z])[a-zA-Z0-9]+$" oninvalid="this.setCustomValidity('يجب ان يكون اسم المورد باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون اسم المورد باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                 <!----------------------------------------------------->
                <div class="form-group">
                    <label for="logo">اللوجــو</label>
                    <input type="file" class="form-control" name="logo" accept="image/*" required  oninvalid="this.setCustomValidity('قم بادخال الصورة')"  oninput="this.setCustomValidity('')">
                    @error('logo')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
             <!----------------------------------------------------->

             <div class="form-group">
                    <label for="description_ar">وصف المورد بالعربية  </label>
                    <textarea  class="form-control tinymce-editor" name="description_ar" id="description_ar" placeholder="ادخل  وصف المورد بالعربية "  >{!! old('description_ar')!!}</textarea>
                    @error('description_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
          <!----------------------------------------------------->
              <div class="form-group">
                    <label for="description_en">وصف المورد بالانجليزية  </label>
                    <textarea  class="form-control tinymce-editor" name="description_en" id="description_en" placeholder="ادخل  وصف المورد بالانجليزية "  >{!! old('description_en')!!}</textarea>
                    @error('description_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
          <!----------------------------------------------------->
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
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('/js/regax_name/regax_name.js') }}"></script>
<!-- tinymce -->
<script src="{{ URL::asset('assets/tinymce/tinymce.min.js') }}"></script>

<script src="{{ URL::asset('/js/tiny.js') }}"></script>

@endsection