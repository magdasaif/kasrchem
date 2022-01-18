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
        <h5 class="modal-title" style="color: #2569b1;">تعديل نوع فرعى</h5> 
        </div>
        <div class="modal-body">
            
            <form method="POST" action="{{route('categories4.update',$sub4->id)}}" enctype="multipart/form-data">
                {{method_field('PATCH')}}

                @csrf
                   <div class="form-group">
                   <label   for="exampleInputEmail1">اسم النوع الرئيسى</label>
                   <input type="text" class="form-control" name="sub3_id" id="sub3_id" value="{{ $sub4->sub3_id}}" hidden>
                   <input type="text" class="form-control" name="sub3_name" id="sub3_name" value="{{ $sub4->Sub_Category4->subname_ar}}" disabled="disabled" >
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم التصنيف بالعربيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname_ar" value="{{$sub4->subname_ar}}" required>
                    @error('subname_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم التصنيف بالانجليزيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname_en" value="{{$sub4->subname_en}}" required>
                    @error('subname_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <select class="form-control" name="status">
                            <option value="1" <?php if($sub4->status==1){echo'selected';}?> >مُفعل</option>
                            <option value="0" <?php if($sub4->status==0){echo'selected';}?> >غير مُفعل</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$sub4->id}}">
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
