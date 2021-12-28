@extends('layouts.master')
@section('css')

@section('title')
التصنيفات الرئيسيه
@stop
@endsection
@section('page-header')


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

<div>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">تعديل تصنيف</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            
            <form method="POST" action="{{route('categories.update',$categories->id)}}" enctype="multipart/form-data">
                {{method_field('PATCH')}}

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}

                <div class="form-group">
                    <select class="form-control" name="section_id">
                        <option value="{{ $categories->Sections->id }}">{{ $categories->Sections->site_name_ar }}</option>

                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->site_name_ar }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم التصنيف بالعربيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname_ar" value="{{$categories->subname_ar}}" required>
                    @error('subname_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم التصنيف بالانجليزيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname_en" value="{{$categories->subname_en}}" required>
                    @error('subname_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                
                <div class="control">
                    <div data-v-20a423fa="" class="uploader-block">
                        <div data-v-20a423fa="" class="uploader">
                            <img data-v-20a423fa="" width="50%" src="<?php echo asset("storage/categories/first/$categories->image")?>" class="uploaded-img"> 
                            <input data-v-20a423fa="" type="file" id="image" name="image" accept="image/*" style="display: none;"> 
                            <button data-v-20a423fa="" type="button" class="button add-btn" style="display: none;"><i data-v-20a423fa="" class="fa fa-upload"></i> صورة التصنيف</button> 
                            <button data-v-20a423fa="" type="button" class="button delete-btn"><i data-v-20a423fa="" class="fa fa-trash"></i> مسح</button>
                        </div> 
                        <!---->
                    </div>
                </div>

                
                <div class="form-group">
                    <label for="exampleInputEmail1">صوره</label>
                    <input type="file" class="form-control" name="image">
                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <select class="form-control" name="status">
                            <option value="1" <?php if($categories->status==1){echo'selected';}?> >مُفعل</option>
                            <option value="0" <?php if($categories->status==0){echo'selected';}?> >غير مُفعل</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$categories->id}}">
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تعديل</button>
                </div>
                </form>
        </div>
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection
