@extends('layouts.master')
@section('title')
<title>لوحة التحكم : تعديل قسم</title>
 @endsection
@section('content')
<template>
<section class="content">
    <div class="container-fluid">
        <div class="row">
          
          <div class="col-12">
          @include('layouts.messages')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">تعديل قسم</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('site_section.index')}}" class="aa"> <li class="fas fa-sitemap" ><span>  اقسام الموقع </span></li></a>
                    </button>
                </div>
              </div>
                <div class="modal-body">
                    <form method="POST"  action="{{route('site_section.update',encrypt($section->id))}}" enctype="multipart/form-data">
                        {{method_field('PATCH ')}}

                        @csrf
                        {{-- <input name="_token" value="{{csrf_token()}}"> --}}

                     <!----------------------------------------------------->
                 <div  class="form-group">
                    <label for="site_or_sub">نوع القسم</label>
                    <select class="form-control" name="site_or_sub" style="height: 50px;" required oninvalid="this.setCustomValidity('اختر نوع القسم')"  oninput="this.setCustomValidity('')">
                        <?php
                          if($first_select=='0')
                          {
                              echo'<option value="0" selected > قسـم رئيسى</option>';
                          }
                          else
                          {
                        ?>
                           <option value="{{ $parent_of_section->id}}" selected> {{ $parent_of_section->name_ar}}</option>
                           <option value="0"  > قسم رئيسى</option>
                       <?php
                          }    
                          foreach ($all_sections as $xx)
                          {
                            
                                 $color="#c20620";
                                    $new=[
                                        'childs' => $xx->childs,
                                        'color'=>'#209c41',
                                        'number'=>2,
                                        $type="site_section",
                                        'site_id'=>$xx->id,
                                    ];
                 
                              ?>
                                <option style="color:<?php echo $color;?>"  value="{{$xx->id}}">-{{$xx->name_ar}}</option>
                                @if(count($xx->childs))
                                   @include('pages.manageChild',$new)
                                @endif
                              <?php
                              //     }
                              // } 
                           }?>
                          
                          </select>
  
                      </div>
                     <!----------------------------------------------------->

                        <div class="form-group">
                            <label for="name_ar"  class="mr-sm-2">اسم القسم بالعربية:</label>
                            <!-- <input id="site_name_ar" type="text" name="site_name_ar"class="form-control" value="{{ $section->site_name_ar }}" required> -->
                            <textarea class="form-control" rows="4" aria-describedby="emailHelp" placeholder="ادخل اسم القسـم بالعربيه"  name="name_ar"  required >{{ $section->name_ar }}</textarea>

                            @error('name_ar')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name_en"  class="mr-sm-2">اسم القسم بالانجليزية:</label>
                            <!-- <input id="site_name_en" type="text" name="site_name_en"class="form-control" value="{{ $section->site_name_en}}" required> -->
                            <textarea class="form-control" rows="4" aria-describedby="emailHelp" placeholder="ادخل اسم القسـم بالانجليزية"  name="name_en"  required >{{ $section->name_en}}</textarea>



                            @error('name_en')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="image">صورة القسم</label>
                            
                            @if(($section->getFirstMediaUrl('sections','edit')))
                                <center><img id="previewImg"src="{{$section->getFirstMediaUrl('sections','edit')}}" class="uploaded-img"> </center>
                                <input type="hidden" name="media_url" value="{{$section->getFirstMediaUrl('sections')}}">
                            @else
                                <center> <img src="{{ asset('images/logo2.jpg') }}" class="img-thumbnail img-preview" style="width:30%;" alt="" id="previewImg"></center>
                                <input type="hidden" name="deleted_image"/>
                            @endif
                            <br>

                                <br>
                                <center><button type="button" id="btn_image" class="btn btn-primary" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                                <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                                    <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"></path>
                                </svg>
                                تعديل الصورة
                                </button></center>
                            <input type="file" class="form-control" name="image" id="my_file" accept="image/*" style="display: none;" onchange="readURL(this);" >
                            @error('image')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="priority">الترتيب</label>
                            <input type="number" class="form-control" id="sort" aria-describedby="priority" placeholder="Enter priority" name="sort"  value="{{ $section->sort}}" required>
                            @error('sort')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">الحالة</label>
                            <select class="form-control" name="status">
                                    <option value="1" <?php if($section->status==1){echo'selected';}?> >مُفعل</option>
                                    <option value="0" <?php if($section->status==0){echo'selected';}?> >غير مُفعل</option>
                            </select>
                        </div>
                        
                        <input type="hidden" name="id" value="{{encrypt($section->id)}}">
                        <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">تعديل</button>
                        </div>
                        
                    </form>
                </div>

                </div>
            </div>
        </div>
    </div>
</section>
</template>

<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>

<!-- edit script for edit_upload_image-->
<script src="{{ URL::asset('/js/edit_upload_image/edit_upload_image_script.js') }}"></script>
<script src="{{ URL::asset('/js/imagePreview.js') }}"></script>
@endsection
