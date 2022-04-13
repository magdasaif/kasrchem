@extends('layouts.master')
@section('title')
<title>لوحة التحكم :{{$title}} </title>
 @endsection
@section('content')

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
              <div class="card-header" >
                <h3 class="card-title">{{$title}}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('page.index')}}" class="aa"> <li class="fa fa-code" ><span> قائمه الصفحات </span></li></a>
                    </button>
                </div>
              </div>
 <!--#############################################################-->
 <div class="modal-body" >


 <center><h3 style='color:#009879'>ـــــــــــــــــــــــــ الصور الفرعيه ـــــــــــــــــــــــــ</h3></center>
<br>
 <form method="POST" action="{{url('add_page_images',encrypt($page->id))}}" enctype="multipart/form-data">
        {{method_field('POST')}}
        @csrf
        
        <div class="form-group">
            <label for="exampleInputEmail1">الصور الفرعيه</label>

            <input type="file" class="form-control" name="photos[]" accept="image/*" multiple required>
            <span style="color:red">الأبعاد [يجب أن يكون العرض بين (850 و 1200) ، ويجب أن يكون الارتفاع بين (315 و 600)]</span>

            @error('photos')
            <small class="form-text text-danger">{{$message}}</small>
            @enderror

            <input type="hidden" value="{{encrypt($page->id)}}" name="page_id">
        </div>
        <center> <button type="submit" class="btn btn-primary">حفظ الصور</button></center>
        <br>
        
    </form>
<!-- ------------------------------------------------------------------------- -->
 <div class="row">
            @foreach($page->images as $image)
                 <div class="col">
                    <img  style="width: 150px; height: 150px;" src="<?php echo asset("storage/pages/page_no_$page->id/$image->filename")?>">
                    <br><button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#delete{{$image->id}}" style="margin-right: 55px;"> حذف</button>

                </div>
                
                 <!--############################ model for delete #################################-->
          
                 <div class="modal modal-danger fade" id="delete{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header" style="direction: ltr;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                        </div>
                        <form action="{{url('delete_page_images/'.encrypt($image->id))}}"  method="POST">
                        @method('GET')
                        {{csrf_field()}}
                            <div class="modal-body">
                                    <h3 class="text-center">
                                        هل تريد الحذف بالفعل؟
                                        </h3>

                            </div>
                            <div class="modal-footer">

                                <input type="hidden" name="page_id" value="{{encrypt($page->id)}}">
                                <input type="hidden" name="image_name" value="{{$image->filename}}">
                                <input type="hidden" name="image_id" value="{{$image->id}}">

                                <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                <button type="submit" class="btn btn-primary" >حذف</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>
            <!--#############################################################-->
            @endforeach
            </div>
<br><hr>
<center><h3 style='color:#009879'> ـــــــــــــــــــــــ البيانات الاساسيه ـــــــــــــــــــــــــ </h3></center>
<br><hr>
            <!-- ------------------------------------------------------------------------- -->
   <form method="POST"  action="{{route('page.update',encrypt($page->id))}}" enctype="multipart/form-data">
   <!-- <form method="POST"  action="{{url('page/'.$page->id.'/update')}}" enctype="multipart/form-data"> -->
                {{method_field('PATCH ')}}

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}

              
               <!----------------------------------------------------->
              
               <div class="form-group">
                    <label for="name_ar">اسم الصفحة </label>
                    <input type="text" class="form-control"  aria-describedby="name_ar" placeholder="ادخل اسم الصفحة" name="name_ar" value="{{$page->name_ar}}" id="regax_name_ar" onkeyup="check_regax_name_ar();" onkeypress="return CheckArabicCharactersOnly(event);"   required oninvalid="this.setCustomValidity('يجب ان يكون اسم الصفحة باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name"> يجب ان يكون اسم الصفحة باللغة العربية وايضا لا يكون ارقام فقط</span>

                    @error('name_ar')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="name_en">اسم الصفحة بالانجليزية</label>
                    <input type="text" class="form-control" id="name_en" aria-describedby="name_en" placeholder="ادخل اسم الصفحة بالانجليزية" name="name_en"  value="{{$page->name_en}}"required onkeypress="return CheckEnglishCharactersOnly(event);"  oninvalid="this.setCustomValidity('يجب ان يكون اسم الصفحة باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون اسم الصفحة باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

                    @error('name_en')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>
                 <!----------------------------------------------------->
                
               <!----------------------------------------------------->
              
               <!----------------------------------------------------->
               <div class="form-group">
                   <br>
                   <hr>
                    <label for="content_ar">وصف الصفحة </label>
                    <textarea  class="form-control" rows="4" name="description_ar" id="description_ar" placeholder="ادخل وصف الصفحة "  style="border-radius: 6px;">{!!$page->description_ar!!}</textarea>
                    
                    @error('description_ar')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>
              <!----------------------------------------------------->
               
               <div class="form-group">
                    <label for="content_en">وصف الصفحة  بالانجليزية</label>
                    
                    <textarea  class="form-control" rows="4" name="description_en" id="description_en" placeholder="ادخل وصف الصفحة بالانجليزية "  style="border-radius: 6px;"> {!!$page->description_en!!}</textarea>

                    @error('description_en')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>
              <!----------------------------------------------------->
               <div class="form-group">
                    <label for="content_ar">محتوى الصفحة </label>
                    <textarea  class="form-control tinymce-editor" name="content_ar" id="content_ar" placeholder="ادخل محتوى الصفحة " >{!!$page->content_ar!!}</textarea>
                    
                    @error('content_ar')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>
              <!----------------------------------------------------->
               
               <div class="form-group">
                    <label for="content_en">محتوى الصفحة  بالانجليزية</label>
                    
                    <textarea  class="form-control tinymce-editor" name="content_en" id="content_en" placeholder="ادخل محتوى الصفحة بالانجليزية " > {!!$page->content_en!!}</textarea>

                    @error('content_en')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>
                <!----------------------------------------------------->
                <div class="form-group">
                    <label for="exampleInputEmail1">الترتيب </label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="sort" value="{{$page->sort}}">
                    @error('sort')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <hr>
              <!----------------------------------------------------->
                 <div class="form-group">
                    <label for="image">الحالة</label>
                    <select class="form-control" name="status">
                            <option value="1" <?php if($page->status==1){echo'selected';}?> >مُفعلة</option>
                            <option value="0" <?php if($page->status==0){echo'selected';}?> >غير مُفعلة</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{encrypt($page->id)}}">
               
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >تعديل</button>
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

<script src="{{ URL::asset('assets/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::asset('/js/tiny.js') }}"></script>

@endsection