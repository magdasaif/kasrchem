@extends('layouts.master')
@section('css')

@section('title')
تعديل التصنيفات الفرعية

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
        
        </div>
        <div class="modal-body">
            
            <form method="POST" action="{{route('categories3.update',$sub3->id)}}" enctype="multipart/form-data">
                {{method_field('PATCH')}}

                @csrf
                   <div class="form-group">
                   <label   for="exampleInputEmail1">اسم التصنيف الفرعي</label>
                   <input type="text" class="form-control" name="sub_id2" id="sub_id2" value="{{ $sub3->sub2_id}}" hidden>
                   <input type="text" class="form-control" name="sub2_name" id="sub2_name" value="{{ $sub3->Sub_Category3->subname2_ar}}" disabled="disabled" >
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم التصنيف بالعربيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname_ar" value="{{$sub3->subname_ar}}" required>
                    @error('subname_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم التصنيف بالانجليزيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname_en" value="{{$sub3->subname_en}}" required>
                    @error('subname_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>



                
                <div class="form-group">
                    <label for="exampleInputEmail1">صوره</label><br>
                    <img data-v-20a423fa="" width="50%" src="<?php echo asset("storage/categories/thired/$sub3->image")?>" class="uploaded-img"> 

                    <input type="file" class="form-control" name="image" accept="image/*">

                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <select class="form-control" name="status">
                            <option value="1" <?php if($sub3->status==1){echo'selected';}?> >مُفعل</option>
                            <option value="0" <?php if($sub3->status==0){echo'selected';}?> >غير مُفعل</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$sub3->id}}">
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
