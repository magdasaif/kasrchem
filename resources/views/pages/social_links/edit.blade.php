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
            
            <form method="POST" action="{{route('social.update',$social->id)}}" enctype="multipart/form-data">
            {{method_field('PATCH')}}

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}
                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم رابط التواصل</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="name" value="{{$social->name}}" required>
                    @error('name')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                
                <div class="form-group">
                    <label for="exampleInputEmail1"> رابط التواصل</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter link" name="link" value="{{$social->link}}" required>
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
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter icon" name="icon" value="{{$social->icon}}" required>

                    <!-- Button tag -->
                    <!-- <button class="btn btn-secondary" role="iconpicker"></button> -->
                    <!-- Div tag -->
                    <div role="iconpicker"></div>
                </div>

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
<script>
    var field = document.getElementsByClassName("form-control search-control");
field.setAttribute("name", "icon");
//   var x=  document.getElementsByClassName('search-control').value;
//     alert(x);
//     $('.search-control').attr('name', 'other_amount');
</script>

@endsection
