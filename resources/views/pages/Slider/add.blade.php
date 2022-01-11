@extends('layouts.master')
@section('css')

@section('title')

اضافة صورة
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
            <h5 class="modal-title"  style="color: #2569b1;"> اضافة صورة</h5>
            
        </div>
        <div class="modal-body">

            <form method="POST" action="{{route('slider.store')}}" enctype="multipart/form-data">

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}



           

                <div class="form-group">
                    <label for="priority">الأولوية</label>
                    <input type="number" class="form-control" id="priority" aria-describedby="priority" placeholder="ادخل الأولوية" name="priority" required>
                    @error('priority')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">صوره</label>
                    <input type="file" class="form-control" name="image" required>
                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="image">الحالـة</label>
                    <select class="form-control" name="status" >
                            <option value="1">مُفعل</option>
                            <option value="0">غير مُفعل</option>
                    </select>
                </div>

                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">اضافه</button>
                </div>
                </form>
        </div>
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection
