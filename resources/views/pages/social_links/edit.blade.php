@extends('layouts.master')
@section('title')
<title>لوحة التحكم : {{$title}}</title>
 @endsection
<!--------------------------------------------------------------------------------->
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="{{ URL::asset('assets/fontawesome-icon-browser-picker/fontawesome-browser.css') }}">
<!--------------------------------------------------------------------------------->

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
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
          <div class="col-12">
        
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
              </div>
 <!--#############################################################-->
        <div class="modal-body">
            
            <form method="POST" action="{{route('social.update',$social->id)}}" enctype="multipart/form-data">
            {{method_field('PATCH')}}

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}
                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم رابط التواصل</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="name" value="{{$social->name}}" required  oninvalid="this.setCustomValidity('قم بادخال  اسم رابط التواصل')">
                    @error('name')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                
                <div class="form-group">
                    <label for="exampleInputEmail1"> رابط التواصل</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter link" name="link" value="{{$social->link}}" required  oninvalid="this.setCustomValidity('قم بادخال رابط التواصل')"  oninput="this.setCustomValidity('')">
                    @error('link')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <input type="hidden" name="id" value="{{$social->id}}">
                
                <div class="form-group">
                    <label for="exampleInputEmail1">الحالة</label>
                    <select class="form-control" name="status">
                            <option value="1" {{ $social->status == '1' ? "selected" : "" }}>مُفعل</option>
                            <option value="0" {{ $social->status == '0' ? "selected" : "" }}>غير مُفعل</option>
                    </select>
                </div>

                <hr>

                <div class="form-group">
                    <label for="exampleInputEmail1">  الايقون</label>
                    <i class="{{$social->icon}}" style="margin-right: 25px;"></i>
                    <!-- <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter icon" name="icon" value="{{$social->icon}}" required oninvalid="this.setCustomValidity('قم بادخال الايقونة')"  oninput="this.setCustomValidity('')"> -->
                    <input type="text" class="form-control" name="icon"  required value="{{ $social->icon}}" required  oninvalid="this.setCustomValidity('قم بادخال الايقونة')"  oninput="this.setCustomValidity('')" placeholder="Select icon" data-fa-browser />

                    <!-- Button tag -->
                    <!-- <button class="btn btn-secondary" role="iconpicker"></button> -->
                    <!-- Div tag -->
                    <!-- <div role="iconpicker"></div> -->
                </div>

                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >تعديل</button>
                </div>
                </form>
                </div>
 <!--#############################################################-->

 		</div>
            </div>
        </div>
    </div>
</section>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
<script src="{{ URL::asset('assets/fontawesome-icon-browser-picker/fontawesome-browser.js') }}"></script>
<script>
  $(function($) {
    $.fabrowser();
});
</script>