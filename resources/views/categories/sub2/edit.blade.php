@extends('layouts.master')
@section('css')

@section('title')
التصنيفات الفرعيه
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
            
            <form method="POST" action="{{route('categories2.update',$sub_categories->id)}}" enctype="multipart/form-data">
                {{method_field('PATCH')}}

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}

                <div class="form-group">
                    <select class="form-control" name="cate_id">
                        <option value="{{ $sub_categories->relation_sub2_with_main->id }}">{{ $sub_categories->relation_sub2_with_main->subname_ar }}</option>

                        @foreach ($main_categories as $main_category)
                            <option value="{{ $main_category->id }}">{{ $main_category->subname_ar }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم التصنيف بالعربيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname2_ar" value="{{$sub_categories->subname2_ar}}" required>
                    @error('subname2_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم التصنيف بالانجليزيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname2_en" value="{{$sub_categories->subname2_en}}" required>
                    @error('subname2_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>



                
                <div class="form-group">
                    <label for="exampleInputEmail1">صوره</label><br>
                    <img data-v-20a423fa="" width="50%" src="<?php echo asset("storage/categories/second/$sub_categories->image2")?>" class="uploaded-img"> 

                    <input type="file" class="form-control" name="image" accept="image/*">

                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <select class="form-control" name="status">
                            <option value="1" <?php if($sub_categories->status==1){echo'selected';}?> >مُفعل</option>
                            <option value="0" <?php if($sub_categories->status==0){echo'selected';}?> >غير مُفعل</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$sub_categories->id}}">
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
