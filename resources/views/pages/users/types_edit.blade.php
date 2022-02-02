@extends('layouts.master')
@section('css')

@section('title')
{{$title}}
@stop
@endsection
@section('page-header')


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

<div>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" style="color: #2569b1;">{{$title}}</h5>
           
        </div>
        <div class="modal-body">
            
            <form method="POST" action="{{route('user_type.update',$type->id)}}" enctype="multipart/form-data">
            {{method_field('PATCH ')}}
                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}


                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم بالعربيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="name_ar" value="{{$type->name_ar}}" required>
                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم بالانجليزيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="name_en" value="{{$type->name_en}}" required>
                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            
                

                <div class="form-group">
                    <select class="form-control" name="status">
                            <option value="1"<?php if($type->status==1){echo'selected';}?>>مُفعل</option>
                            <option value="0"<?php if($type->status==0){echo'selected';}?>>غير مُفعل</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$type->id}}">
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
