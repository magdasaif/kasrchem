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


@if(Session::has('error'))
     <div class="alert alert-danger">
         {{Session::get('error')}}
     </div>
@endif

<div>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" style="color: #2569b1;">{{$title}}</h5>
           
        </div>
        <div class="modal-body">
            
            <form method="POST" action="{{route('partner.update',$partner->id)}}" enctype="multipart/form-data">
            {{method_field('PATCH ')}}
                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}


                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم الشريك بالعربيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="name_ar" value="{{$partner->name_ar}}" required>
                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم الشريك بالانجليزيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="name_en" value="{{$partner->name_en}}" required>
                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            
                
                <div class="form-group">
                    <label for="exampleInputEmail1">صوره</label>
                    <img data-v-20a423fa="" width="20%" src="<?php echo asset("storage/partners/$partner->image")?>" class="uploaded-img"> 
                    <input type="file" class="form-control" name="image" accept="image/*">

                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">لينك خارجى</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter link" value="{{$partner->external_link}}" name="external_link">
                    @error('external_link')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <select class="form-control" name="status">
                            <option value="1"<?php if($partner->status==1){echo'selected';}?>>مُفعل</option>
                            <option value="0"<?php if($partner->status==0){echo'selected';}?>>غير مُفعل</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$partner->id}}">
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
