@extends('layouts.master')
@section('title')
<title>لوحة التحكم :تعديل صورة</title>
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
                <h3 class="card-title">تعديل صفحة</h3>
              </div>
 <!--#############################################################-->
 <div class="modal-body" >
   <form method="POST"  action="{{route('page.update',$page->id)}}" >
                {{method_field('PATCH ')}}

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}

              
               <!----------------------------------------------------->
              
               <div class="form-group">
                    <label for="title_ar">اسم الصفحة </label>
                    <input type="text" class="form-control" id="title_ar" aria-describedby="title_ar" placeholder="ادخل اسم الصفحة" name="title_ar" value="{{$page->title_ar}}" required oninvalid="this.setCustomValidity('قم بادخال اسم الصفحة بالعربية')"  oninput="this.setCustomValidity('')">
                    @error('title_ar')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="title_en">اسم الصفحة بالانجليزية</label>
                    <input type="text" class="form-control" id="title_en" aria-describedby="title_en" placeholder="ادخل اسم الصفحة بالانجليزية" name="title_en"  value="{{$page->title_en}}" required oninvalid="this.setCustomValidity('قم بادخال اسم الصفحة بالانجليزية')"  oninput="this.setCustomValidity('')">
                    @error('title_en')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>
               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="content_ar">وصف الصفحة </label>
                    <textarea  class="form-control tinymce-editor" name="description_ar" id="description_ar" placeholder="ادخل وصف الصفحة "  style="border-radius: 6px;">{!!$page->description_ar!!}</textarea>
                    
                    @error('description_ars')
                    <small class="form-text text-danger" style="font-size: 15px;font-weight: bold;">{{$message}}</small>
                    @enderror
                </div>
              <!----------------------------------------------------->
               
               <div class="form-group">
                    <label for="content_en">وصف الصفحة  بالانجليزية</label>
                    
                    <textarea  class="form-control tinymce-editor " name="description_en" id="description_en" placeholder="ادخل وصف الصفحة بالانجليزية "  style="border-radius: 6px;"> {!!$page->description_en!!}</textarea>

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
                    <label for="image">الحالة</label>
                    <select class="form-control" name="status">
                            <option value="1" <?php if($page->status==1){echo'selected';}?> >مُفعلة</option>
                            <option value="0" <?php if($page->status==0){echo'selected';}?> >غير مُفعلة</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$page->id}}">
               
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



<script src="{{ URL::asset('assets/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::asset('/js/tiny.js') }}"></script>

@endsection