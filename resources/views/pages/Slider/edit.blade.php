@extends('layouts.master')

@section('content')
<template>
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
              <div class="card-header"  style="background-color: rgb(96 211 145);">
                <h3 class="card-title">تعديل صورة</h3>
              </div>
 <!--#############################################################-->
 <div class="modal-body" style=" width: 68%; margin-right: 128px;">
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
                   <center> <img data-v-20a423fa="" style="width:30%;" src="<?php echo asset("storage/slider/{$Slider->image}")?>" class="uploaded-img"></center>
                    <input type="file" class="form-control" name="image" >
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
 <!--#############################################################-->

 		</div>
            </div>
        </div>
    </div>
</section>
</template>
@endsection
