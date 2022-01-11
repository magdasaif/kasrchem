@extends('layouts.master')
@section('css')

@section('title')
تعديل الصورة
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
            <h5 class="modal-title" style="color: #2569b1;">تعديل الصورة</h5>
           
        </div>
        <div class="modal-body">
            
            <form method="POST"  action="{{route('slider.update',$Slider->id)}}" enctype="multipart/form-data">
                {{method_field('PATCH ')}}

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}

                <div class="form-group">
                    <label for="priority">الأولوية</label>
                    <input type="text" class="form-control" id="priority" aria-describedby="priority" placeholder="Enter priority" name="priority"  value="{{ $Slider->priority}}" required>
                    @error('priority')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">الصورة</label>
                    <input type="file" class="form-control" name="image" >
                    <img  style="width: 200px;height: 200px;" src=<?php echo asset("storage/slider/{$Slider->image}")?> alt="" required>
                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

               

                <div class="form-group">
                    <label for="image">الحالة</label>
                    <select class="form-control" name="status">
                            <option value="1" <?php if($Slider->status==1){echo'selected';}?> >مُفعل</option>
                            <option value="0" <?php if($Slider->status==0){echo'selected';}?> >غير مُفعل</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$Slider->id}}">
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
