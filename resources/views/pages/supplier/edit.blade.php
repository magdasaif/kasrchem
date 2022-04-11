@extends('layouts.master')
@section('title')
<title>لوحة التحكم : {{$title}}</title>
@endsection
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
                
          <div class="col-12">
                 @include('layouts.messages')
            <div class="card">
              <div class="card-header" >
                <h3 class="card-title">{{$title}}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('supplier.index')}}" class="aa"> <li class="fas fa-users" ><span>  قائمة الموردين </span></li></a>
                    </button>
                </div>
              </div>
 <!--#############################################################-->
 <div class="modal-body"  >
   <form method="POST"  action="{{route('supplier.update',encrypt($Supplier->id))}}" enctype="multipart/form-data">
                {{method_field('PATCH ')}}

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}

                    <!----------------------------------------------------->
                  
                <div class="form-group">
                    <label for="exampleInputEmail1">الاقسام</label>
                             <?php
                            $selected_sections=array();

                            foreach ($Supplier->sup_sections as $section_select){
                              array_push($selected_sections,$section_select->id);
                             }
                             ?>
                            
                    <select class="form-control" name="section_id[]"  multiple required oninvalid="this.setCustomValidity('اختر القسم')"  oninput="this.setCustomValidity('')">
                            
                        @foreach ($all_sections as $sec)
                        <?php
                            $margin="0";
                            $color="#c20620";
                            $size="15";
                            $type='supplier_section';
                            $number=2;
                            if(in_array($sec->id,$selected_sections)){
                                $select_or_no='selected';
                            }else{
                                $select_or_no='';
                            }


                           $new= [
                                'childs' => $sec->childs,
                                'margin'=>$margin+30,
                                'color'=>'#209c41',
                                'size'=>$size-1,
                                'multi_selected'=>$selected_sections,
                                'type'=>$type,
                                'number'=>$number
                            ];
                        ?>
                            <option style="margin-right:{{$margin}}px;color: {{$color}};font-size: {{$size}}px;" value="{{ $sec->id }}" <?php if (collect(old('section_id'))->contains($sec->id)) {echo 'selected';}else{echo $select_or_no;}?>> - {{ $sec->name_ar }}</option>
                            @if(count($sec->childs))
                                @include('pages.manageChild',$new)
                            @endif
                        @endforeach
                        
                    </select>
                </div>
                <hr>
                  <!----------------------------------------------------->
                  <div  class="form-group">
                  <label for="supplier_or_sub">نوع المـــــــورد</label>
                  <select class="form-control" name="supplier_or_sub" style="height: 50px;" required oninvalid="this.setCustomValidity('اختر نوع المورد')"  oninput="this.setCustomValidity('')">

                        <option value='0' <?php if($Supplier->parent_id == 0){echo'selected';}?>>مورد رئيسى</option>
                        <?php
                        foreach ($all_suppliers as $xx)
                        {
                            $color="#c20620";
                            $new=[
                                'childs' => $xx->childs,
                                'color'=>'#209c41',
                                'number'=>2,
                                'type'=>"supplier",
                                'main_id'=>$Supplier->id,//pramiry key of supplier we edit on it 
                                'parent_id'=>$Supplier->parent_id //parent_id of another supplier

                            ];

                            // echo 'parent_id'.$Supplier->parent_id;
                            // echo 'id'.$xx->id;
                            // echo'<br>----------------------<br>';
                            
                            ?>
                                <option  style="color: {{$color}};"  value="{{$xx->id}}" <?php if($Supplier->parent_id == $xx->id){echo'selected';}?>>- {{$xx->name_ar}}</option>
                                @if(count($xx->childs))
                                    @include('pages.manageChild',$new)
                                @endif
                            <?php
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
                    <input type="text" class="form-control" id="name_en" aria-describedby="name_en" placeholder="ادخل اسم المورد بالانجليزية" name="name_en"  value="{{$Supplier->name_en}}" required onkeypress="return CheckEnglishCharactersOnly(event);" oninvalid="this.setCustomValidity('يجب ان يكون اسم المورد باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون اسم المورد باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
               
              
              
               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="exampleInputEmail1">اللوجــو</label>

                    @if(sizeof($Supplier->mainImages())>0)
                        @foreach($Supplier->mainImages() as $main)
                            <center> <img  id="previewImg" style="width: 30%;" src="<?php echo asset("storage/supplier/supplier_no_$Supplier->id/$main->filename")?>" class="uploaded-img" title="للتعديل  اضغط على الصورة"> </center>
                            <input type="hidden" name="image_id" value="{{$main->id}}">

                            <br>
                            <center>
                                <button type="button" id="btn_image" class="btn btn-primary" >

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                                        <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                                        <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"></path>
                                    </svg>
        تعديل الصورة                                        
                                </button>
                                <br>
                                <span style="color:red"> يجب اختيار صوره اقصى احداثياتها [300*300]</span>
                            </center>
                            <input type="hidden" name="deleted_image" value="{{$main->filename}}">
                            <input type="file" class="form-control" name="image"  id="my_file" accept="image/*" style="display: none;" onchange="readURL(this);">

                     @endforeach
                    @else
                    <div class="row">
                        <div class="col-lg-12">
                        <center> <img src="{{ asset('images/logo2.jpg') }}" class="img-thumbnail img-preview" style="width:30%;" alt="" id="previewImg"></center>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>اللوجو<span style="color:rgb(199, 8, 8)">*</span></label>
                                <input class="form-control" name="image" onchange="readURL(this);" type="file" accept="image/*" required >                            
                                <input type="hidden" name="deleted_image"/>
                            </div>
                            @error('image')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    @endif
                    
                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @endif
               <!----------------------------------------------------->
              
               <!----------------------------------------------------->
               <hr>
                <div class="form-group">
                    <label for="exampleInputEmail1"> الترتيب</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="sort" value="{{$Supplier->sort}}">
                    @error('sort')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <hr>
               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="exampleInputEmail1">الحالة</label>
                    <select class="form-control" name="status" style="height: 50px;">
                            <option value="1" <?php if($Supplier->status==1){echo'selected';}?>>مُفعل</option>
                            <option value="0" <?php if($Supplier->status==0){echo'selected';}?>>غير مُفعل</option>
                    </select>
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
<script src="{{ URL::asset('/js/imagePreview.js') }}"></script>


@endsection