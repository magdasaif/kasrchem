@extends('layouts.master')
@section('css')

@section('title')
اقسام الموقع
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
            <h5 class="modal-title">تعديل قسم الموقع</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            {{-- 
           --}}
            <form method="POST"  action="{{route('site_section.update',$section->id)}}" enctype="multipart/form-data">
                {{-- {{method_field('PATCH')}} --}}
                <input type="hidden"  name="_token" value="{{ csrf_token() }}">
                {{method_field('PATCH')}}
                {{-- @csrf --}}
               

                
                
                <div class="form-group">
                    <label for="Name"  class="mr-sm-2">اسم القسم بالعربية:</label>
                    <input id="site_name_ar" type="text" name="site_name_ar"class="form-control" value="{{ $section->site_name_ar }}" required>
                  
                    @error('site_name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            


          
            
            
            <div class="form-group">
                <label for="Name"  class="mr-sm-2">اسم القسم بالانجليزية:</label>
                <input id="site_name_en" type="text" name="site_name_en"class="form-control" value="{{ $section->site_name_en}}" required>
              
              
                @error('site_name_en')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
                </div>

                
                <div class="form-group">
                    <label for="image">صورة القسم</label>
                    <input type="file" class="form-control" name="image">
                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="image">الحالة</label>
                    <select class="form-control" name="status">
                            <option value="1" <?php if($section->statues==1){echo'selected';}?> >مُفعل</option>
                            <option value="0" <?php if($section->statues==0){echo'selected';}?> >غير مُفعل</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$section->id}}">
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
