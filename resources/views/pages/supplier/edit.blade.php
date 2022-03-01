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
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('supplier.index')}}" class="aa"> <li class="fas fa-users" ><span>  قائمة الموردين </span></li></a>
                    </button>
                </div>
              </div>
 <!--#############################################################-->
 <div class="modal-body"  >
   <form method="POST"  action="{{route('supplier.update',$Supplier->id)}}" enctype="multipart/form-data">
                {{method_field('PATCH ')}}

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}

              
                  <!----------------------------------------------------->
                  <div  class="form-group">
                  <label for="supplier_or_sub">نوع المـــــــورد</label>
                  <select class="form-control" name="supplier_or_sub" style="height: 50px;" required oninvalid="this.setCustomValidity('اختر نوع المورد')"  oninput="this.setCustomValidity('')">
                    <?php
                        if($first_select=='0')
                        {
                            echo'<option value="0" selected > مورد رئيسى</option>';
                        }
                        else
                        {
                   ?>
                         <option value="{{ $parent_of_supplier->id}}" selected> {{ $parent_of_supplier->name_ar}}</option>
                   <?php
                        }    
                        foreach ($all_suppliers as $xx)
                        {
                           //   if($first_select!='0'){
                         //  if($xx->id == $parent_of_supplier->id)
                         //    {}else{
                          
                        $margin="0";
                        $color="#c20620";
                        $size="15";
                        $type="supplier";
                            ?>
                                <option  value="{{$xx->id}}"> {{$xx->name_ar}}</option>
                                @if(count($xx->childs))
                                    @include('pages.products.manageChild',['childs' => $xx->childs,'margin'=>$margin+30,'color'=>'#209c41','size'=>$size-1,'type'=>$type])
                                @endif
                            <?php
                            //     }
                            // } 
                         }?>
                        
                        </select>

                    </div>
                   <!----------------------------------------------------->
              
               <div class="form-group">
                    <label for="name_ar">اسم المورد  بالعربية *</label>
                    <input type="text" class="form-control"  aria-describedby="name_ar" placeholder="ادخل اسم المورد بالعربية" name="name_ar" value="{{$Supplier->name_ar}}" id="regax_name_ar" onkeyup="check_regax_name_ar();" onkeypress="return CheckArabicCharactersOnly(event);"   required oninvalid="this.setCustomValidity('يجب ان يكون اسم المورد باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">

                    <span style="color:red;display:none;font-weight: bold;" id="error_name"> يجب ان يكون اسم المورد باللغة العربية وايضا لا يكون ارقام فقط</span>
 
                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="name_en">اسم المورد بالانجليزية*</label>
                    <input type="text" class="form-control" id="name_en" aria-describedby="name_en" placeholder="ادخل اسم المورد بالانجليزية" name="name_en"  value="{{$Supplier->name_en}}" required onkeypress="return CheckEnglishCharactersOnly(event);" pattern="^(?=.*[a-zA-Z\s])[a-zA-Z0-9\s]+$" oninvalid="this.setCustomValidity('يجب ان يكون اسم المورد باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون اسم المورد باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

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
                   <center> <img id="previewImg"  style="width:30%;" src="<?php echo asset("storage/supplier/{$Supplier->logo}")?>" class="uploaded-img"></center>
                   <br>
                    <center><button type="button" id="btn_image" class="btn btn-primary" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                    <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                        <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"></path>
                    </svg>
                    تعديل الصورة
                    </button></center>
                   <input type="file" class="form-control" name="logo" id="my_file" accept="image/*" style="display: none;" >
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

<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('/js/regax_name/regax_name.js') }}"></script>

<!-- edit script for edit_upload_image-->
<script src="{{ URL::asset('/js/edit_upload_image/edit_upload_image_script.js') }}"></script>

<!-- tinymce -->
<script src="{{ URL::asset('assets/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::asset('/js/tiny.js') }}"></script>

@endsection