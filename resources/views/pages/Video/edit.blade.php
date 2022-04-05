@extends('layouts.master')
@section('title')
<title>لوحة التحكم : تعديل فيديو</title>
 @endsection
@section('content')
<div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
          
          <div class="col-12">
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> تعديل فيديو</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('video.index')}}" class="aa"> <li class="fas fa-video" ><span>  قائمة الفيديوهات </span></li></a>
                    </button>
                </div>
              </div>
 <!--#############################################################-->
 <div class="modal-body">
 <!-- <div style="text-align: center;color: red;font-size: x-large;">تاكد من ادخال (تصنيف فرعى ونوع رئيسى ونوع فرعى ) للتصنيف الرئيسى المراد اختياره </div> -->
             <!-- <hr> -->
            
            <form method="POST"  action="{{route('video.update',$video->id)}}" enctype="multipart/form-data">
                {{method_field('PATCH ')}}

                @csrf
                 <!--'video','Main_Cat','Sub_Category2','Sub_Category3','Sub_Category4'------------------------------------->
               <!----------------------------------------------------->
               <div class="form-group">
                <label for="exampleInputEmail1">الأقسام</label> 
                         <?php
                        $selected_supplier=array();

                        foreach ($video->rel_section as $supplier_select){
                          array_push($selected_supplier,$supplier_select->id);
                         }
                         ?>
                        
                <select class="form-control" name="site_id[]"  multiple required oninvalid="this.setCustomValidity('اختر القسم')"  oninput="this.setCustomValidity('')" >
                        
                 @foreach ($sections as $sec)
                 <?php
                     $margin="0";
                     $color="#c20620";
                     $size="15";
                     $type='supplier_section';
                     $number=2;
                     if(in_array($sec->id,$selected_supplier)){
                         $select_or_no='selected';
                     }else{
                         $select_or_no='';
                     }


                    $new= [
                         'childs' => $sec->childs,
                         'margin'=>$margin+30,
                         'color'=>'#209c41',
                         'size'=>$size-1,
                         'selected_supplier'=>$selected_supplier,
                         'type'=>$type,
                         'number'=>$number
                     ];
                 ?>
                     <option style="margin-right:{{$margin}}px;color: {{$color}};font-size: {{$size}}px;" value="{{ $sec->id }}" <?php if (collect(old('site_id'))->contains($sec->id)) {echo 'selected';}else{echo $select_or_no;}?>> - {{ $sec->site_name_ar }}</option>
                     @if(count($sec->childs))
                         @include('pages.products.manageChild',$new)
                     @endif
                 @endforeach
                 
             </select>
       
            </div>
            

   
 
              <!--========================================================-->
              
               <div class="form-group">
                    <label for="title_ar">عنوان الفيديو </label>
                    <input type="text" class="form-control" aria-describedby="title_ar" placeholder="ادخل عنوان الفيديو" name="title_ar" value="{{$video->title_ar}}"id="regax_name_ar" onkeyup="check_regax_name_ar();" onkeypress="return CheckArabicCharactersOnly(event);"   required oninvalid="this.setCustomValidity('يجب ان يكون عنوان الفيديو باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name"> يجب ان يكون عنوان الفيديو باللغة العربية وايضا لا يكون ارقام فقط</span>

                    @error('title_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="title_en">عنوان الفيديو بالانجليزية</label>
                    <input type="text" class="form-control" id="title_en" aria-describedby="title_en" placeholder="ادخل عنوان الفيديو بالانجليزية" name="title_en"  value="{{$video->title_en}}" required onkeypress="return CheckEnglishCharactersOnly(event);" oninvalid="this.setCustomValidity('يجب ان يكون عنوان الفيديو باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون عنوان الفيديو باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

                    @error('title_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
               <!----------------------------------------------------->
               <div class="form-group">
                <label for="content_ar">رابط الفيديو </label>
                    <input type="text" class="form-control" name="link" value="{{$video->link}}" required>
                    @error('link')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
              <!----------------------------------------------------->
                <div class="form-group">
                    <label for="image">الحالة</label>
                    <select class="form-control" name="status">
                            <option value="1" <?php if($video->status==1){echo'selected';}?> >مُفعل</option>
                            <option value="0" <?php if($video->status==0){echo'selected';}?> >غير مُفعل</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$video->id}}">
               
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تعديل</button>
                </div>
                </form>
                <!-- </div> -->
 <!--#############################################################--> 

 		</div>
            </div>
        </div>
    </div>
</section>
            </div>
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('/js/regax_name/regax_name.js') }}"></script>

@endsection
