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

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
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
                    <label for="exampleInputEmail1">الاقسام</label> <span style="font-size: initial;color: red;"></span>
                    <select class="form-control" name="section_id[]"  multiple required oninvalid="this.setCustomValidity('اختر القسم')"  oninput="this.setCustomValidity('')">
                        @foreach ($sections as $section)
                        <?php
                            $margin="0";
                            $color="#c20620";
                            
                            $new=[
                                'margin' =>0,
                                'childs' => $section->childs,
                                'color'=>'#209c41',
                                'number'=>2,
                                'type'=>"supplier_section",
                                'main_id'=>$section->id,//pramiry key of supplier we edit on it
                                'parent_id'=>'0',
                            ];
                        ?>
                            <option style="margin-right:{{$margin}}px;color: {{$color}};" value="{{ $section->id }}" <?php if (collect(old('section_id'))->contains($section->id)) {echo 'selected';}?> > - {{ $section->site_name_ar }}</option>
                            @if(count($section->childs))
                                @include('pages.products.manageChild',$new)
                            @endif
                        @endforeach
                    </select>
                </div>

                
                <hr>
                
               <!--------0--supplier , another--sub_supplier------------------>
               <div class="form-group">
                   <label for="supplier_or_sub">نوع المـــــــورد</label>
                   
                   <select class="form-control" name="supplier_or_sub" style="height: 50px;" required oninvalid="this.setCustomValidity('اختر نوع المورد')"  oninput="this.setCustomValidity('')">
                   <option value="0" selected > مورد رئيسى</option>

                   @foreach($suppliers as $supplier)
                        
                          <?php
                          
                            $color="#c20620";
                            $new=[
                                'childs' => $supplier->childs,
                                'color'=>'#209c41',
                                'number'=>2,
                                'type'=>"supplier",
                                'main_id'=>'',//pramiry key of supplier we edit on it
                               // 'main_id'=>$supplier->id,//pramiry key of supplier we edit on it
                                'parent_id'=>'',
                            ];
                        ?>
                            <option style="color:<?php echo $color;?>"  value="{{$supplier->id}}"  >- {{$supplier->name_ar}}</option>
                            @if(count($supplier->childs))
                                @include('pages.products.manageChild',$new)
                            @endif
                        @endforeach
                    </select>
                </div>
                <!----------------------------------------------------->
               <div class="form-group">
                    <label for="name_ar"> اسم المورد* </label>
                    <input type="text" class="form-control"  aria-describedby="name_ar" placeholder="ادخل اسم المورد" name="name_ar"  value="{{ old('name_ar') }}" required  id="regax_name_ar" onkeyup="check_regax_name_ar();" onkeypress="return CheckArabicCharactersOnly(event);"   required oninvalid="this.setCustomValidity('يجب ان يكون اسم المورد باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name"> يجب ان يكون اسم المورد باللغة العربية وايضا لا يكون ارقام فقط</span>

                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="name_en">اسم المورد بالانجليزية*</label>
                    <input type="text" class="form-control" id="name_en" aria-describedby="name_en" placeholder="ادخل اسم المورد بالانجليزية"  value="{{ old('name_en') }}" name="name_en" required onkeypress="return CheckEnglishCharactersOnly(event);"  oninvalid="this.setCustomValidity('يجب ان يكون اسم المورد باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون اسم المورد باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                 <!----------------------------------------------------->
                <div class="form-group">
                    <label for="logo">اللوجــو*</label>
                    <input type="file" class="form-control" name="logo" accept="image/*" required  oninvalid="this.setCustomValidity('قم بادخال الصورة')"  oninput="this.setCustomValidity('')">
                    <span style="color:red"> يجب اختيار صوره اقصى احداثياتها [300*300]</span>

                    @error('logo')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
             <!----------------------------------------------------->
                <div class="form-group">
                    <label for="exampleInputEmail1">الصور الفرعيه</label>

                    <input type="file" class="form-control" name="photos[]" accept="image/*" multiple>

                    @error('image')
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