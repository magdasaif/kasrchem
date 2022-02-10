<div class="modal fade" id="exampleModal4" tabindex="2" role="dialog" aria-labelledby="exampleModalLabel4"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="text-align: right;">
        <div class="modal-content">
            <div class="card-header" >
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel4">
                اضافه نوع  فرعى           
               </h5>
               
            </div>
            <div class="modal-body" style="margin-right: 1px;width: 100%;">
               
            
            <form method="POST" action="{{route('categories4.store')}}" enctype="multipart/form-data">
            
            @csrf
            {{-- <input name="_token" value="{{csrf_token()}}"> --}}
           
            <div class="form-group">
            <label for="exampleInputEmail1">اسم النوع الرئيسى</label>
            <input type="text" class="form-control" name="sub3_name" id="sub3_name" value="" disabled="disabled" >

                <input type="hidden" class="form-control" name="sub3_id" id="sub3_id" value="" >
            </div>
           
            
            <div class="form-group">
                <label for="exampleInputEmail1">اسم النوع الفرعى  بالعربيه</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="subname_ar" required>
                @error('subname_ar')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
        
            <div class="form-group">
                <label for="exampleInputEmail1">اسم النوع الفرعى بالانجليزيه</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="subname_en" required>
                @error('subname_en')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>



            <div class="form-group">
            <label for="exampleInputEmail1">الحالة</label>
                <select class="form-control" name="status">
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