@extends('layouts.master')
@section('css')

@section('title')
تعديل  المدينة
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
            <h5 class="modal-title" style="color: #2569b1;">تعديل  المدينة</h5>
           
        </div>
        <div class="modal-body">
            
            <form method="POST"  action="{{route('city.update',$City->id)}}">
                {{method_field('PATCH ')}}

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}
              <!----------------------------------------------------->
              
               <div class="form-group">
                    <label for="title_ar">اسم المدينة </label>
                    <input type="text" class="form-control" id="title_ar" aria-describedby="title_ar" placeholder="ادخل سم المدينة " name="title_ar" value="{{$City->title_ar}}" required>
                    @error('title_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

               <!----------------------------------------------------->
               <div class="form-group">
                    <label for="title_en">اسم المدينة بالانجليزية</label>
                    <input type="text" class="form-control" id="title_en" aria-describedby="title_en" placeholder="ادخل اسم المدينة بالانجليزية" name="title_en"  value="{{$City->title_en}}" required>
                    @error('title_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <!----------------------------------------------------->
                <div class="form-group">
                    <label for="charge_spend">مصاريف الشحن</label>
                    <input type="" class="form-control" id="charge_spend" aria-describedby="charge_spend" placeholder="ادخل مصاريف الشحن" name="charge_spend"  value="{{$City->charge_spend}}" required>
                    @error('charge_spend')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <!----------------------------------------------------->
                <div class="form-group">
                    <label for="image">الحالة</label>
                    <select class="form-control" name="status">
                            <option value="1" <?php if($City->status==1){echo'selected';}?> >مُفعل</option>
                            <option value="0" <?php if($City->status==0){echo'selected';}?> >غير مُفعل</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$City->id}}">
               
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
