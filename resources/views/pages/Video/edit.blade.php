@extends('layouts.master')
@section('title')
<title>لوحة التحكم :{{$title}}</title>
 @endsection
@section('content')
<div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
          
          <div class="col-12">
          @include('layouts.messages')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('video.index')}}" class="aa"> <li class="fas fa-video" ><span>  قائمة الفيديوهات </span></li></a>
                    </button>
                </div>
              </div>
        <!----------------start model-body----------------->
       <div class="modal-body">
            <form method="POST"  action="{{route('video.update',encrypt($video->id))}}" enctype="multipart/form-data">
                {{method_field('PATCH ')}}
                 @csrf
               <div class="form-group">
                <label for="exampleInputEmail1">الأقسام</label> 
                         <?php
                
                         $selected_sections=array(); // ارى هتحتوى على كل  الاقسام المختارة للفيديوعلشان واعملها سيلكتت
                        //push all selected sections_id for  vedio in $selected_sections
                        foreach ($video->rel_section as $section_select)
                        {
                          array_push($selected_sections,$section_select->id);
                        }
                         ?>
                    <!----------------------------------------------------->
                    @include('pages.Sitesection.sections_edit')
                    <!----------------------------------------------------->
            </div>
              <!--------------------------name_ar------------------------------>
                <div class="form-group">
                    <label for="name_ar">عنوان الفيديو *</label>
                    <input type="text" class="form-control" aria-describedby="name_ar" placeholder="ادخل عنوان الفيديو" name="name_ar" value="{{$video->name_ar}}"id="regax_name_ar" onkeyup="check_regax_name_ar();"    required oninvalid="this.setCustomValidity('يجب ان يكون عنوان الفيديو باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name"> يجب ان يكون عنوان الفيديو باللغة العربية وايضا لا يكون ارقام فقط</span>
                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

               <!-------------------------name_en---------------------------->
               <div class="form-group">
                    <label for="name_en">عنوان الفيديو بالانجليزية*</label>
                    <input type="text" class="form-control" id="name_en" aria-describedby="name_en" placeholder="ادخل عنوان الفيديو بالانجليزية" name="name_en"  value="{{$video->name_en}}" required onkeypress="return CheckEnglishCharactersOnly(event);" oninvalid="this.setCustomValidity('يجب ان يكون عنوان الفيديو باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون عنوان الفيديو باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

                    @error('title_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
               <!--------------------------link--------------------------->
               <div class="form-group">
                <label for="link">رابط الفيديو* </label>
                    <input type="text" class="form-control" name="link" value="{{$video->link}}" required>
                    @error('link')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <!---------------------------status-------------------------->
                <div class="form-group">
                    <label for="status">الحالة*</label>
                    <select class="form-control" name="status">
                            <option value="1" <?php if($video->status==1){echo'selected';}?> >مُفعل</option>
                            <option value="0" <?php if($video->status==0){echo'selected';}?> >غير مُفعل</option>
                    </select>
                </div>
                <!------------------------------------------------------------>
                <input type="hidden" name="id" value="{{encrypt($video->id)}}">
               <!-------------------------modal-footer----------------------------------->
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تعديل</button>
                </div>
                </form>

 		</div>
            </div>
        </div>
    </div>
</section>
            </div>
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('/js/regax_name/regax_name.js') }}"></script>

@endsection
