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
          <!----------------start success ___ error----------------->
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
        <!------------------end success ___ error----------------->
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
                <select class="form-control" name="site_id[]"  multiple required oninvalid="this.setCustomValidity('اختر القسم')"  oninput="this.setCustomValidity('')" >
                    @foreach ($sections as $sec)
                    <?php
                        $margin="0";
                        $color="#c20620";
                        $size="15";
                        //  $type='supplier_section';
                        $number=2;
                        if(in_array($sec->id,$selected_sections)){$select_or_no='selected';}
                        else{ $select_or_no='';}
                        $new= 
                        [
                            //$sec->childs   ---->بتجيب كل الاقسام الفرعية للاقسام الرئيسية
                            'childs' => $sec->childs,
                            'margin'=>$margin+30,
                            'color'=>'#209c41',
                            'size'=>$size-1,
                            'multi_selected'=>$selected_sections,
                            //  'type'=>$type,  //if found more one select --ex:supplier  section single ,multi
                            'number'=>$number
                        ];
                    ?>
                     <option style="margin-right:{{$margin}}px;color: {{$color}};font-size: {{$size}}px;" value="{{ $sec->id }}" <?php if (collect(old('site_id'))->contains($sec->id)) {echo 'selected';}else{echo $select_or_no;}?>> - {{ $sec->name_ar }}</option>
                    <!----manageChild هشوف لو فى اقسام فرعية للاقسام المختارة هيروح لصفحة الcount($sec->childs) --->
                     @if(count($sec->childs))
                         @include('pages.manageChild',$new)
                     @endif
                 @endforeach
               </select>
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
