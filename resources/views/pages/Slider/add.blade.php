@extends('layouts.master')
@section('title')
<title>لوحة التحكم :اضافة صورة</title>
 @endsection
@section('content')
<template>
<section class="content">
    <div class="container-fluid">
        <div class="row">    
          <div class="col-12">
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
       
        
            <div class="card">
              <div class="card-header" >
                <h3 class="card-title">اضافة صورة</h3>
              </div>
 <!--#############################################################-->
 <div class="modal-body" >
   <form method="POST" action="{{route('slider.store')}}" enctype="multipart/form-data">

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}

                <div class="form-group">
                    <label for="priority">الأولوية</label>
                    <input type="number" class="form-control" id="priority" aria-describedby="priority" placeholder="ادخل الأولوية" name="priority"  value="{{ old('priority') }}" required  oninvalid="this.setCustomValidity('قم بادخال الاولوية')"  oninput="this.setCustomValidity('')">
                    @error('priority')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">صوره</label>
                    <input type="file" class="form-control" name="image"  accept="image/*" required  oninvalid="this.setCustomValidity('قم بادخال الصورة')"  oninput="this.setCustomValidity('')">
                    <!-- <span style="color:red">dimensions [width must be between (850 and 1200)  , height must be between (315 and 600)]</span> -->
                    <span style="color:red">الأبعاد [يجب أن يكون العرض بين (850 و 1200) ، ويجب أن يكون الارتفاع بين (315 و 600)]</span>
                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="image">الحالـة</label>
                    <select class="form-control" name="status" >
                       <option value="1" {{ old('status') == '1' ? "selected" : "" }}>مُفعل</option>
                       <option value="0" {{ old('status') == '0' ? "selected" : "" }}>غير مُفعل</option>
                    </select>
                </div>

                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">اضافة</button>
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
