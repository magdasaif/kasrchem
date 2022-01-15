<div>
<!-------------------------------------------------------------------------->
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

<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">


        <div class="modal-header">
            <h5 class="modal-title">اضافه منتج</h5>
         
        </div>
        <div class="modal-body">
            
            <form wire:submit.prevent="store_product" enctype="multipart/form-data">

                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}

                <div class="form-group">
                    <label for="exampleInputEmail1">اسم التصنيف الرئيسي</label>
                    <select class="form-control" wire:model="main_cate_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->subname_ar }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">كود المنتج</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter code" wire:model="code" >
                    @error('code')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم المنتج بالعربيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" wire:model="name_ar" required>
                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم المنتج بالانجليزيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" wire:model="name_en" required>
                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">وصف المنتج بالعربيه</label>
                    <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter descrption" wire:model="desc_ar" required></textarea>
                    @error('desc_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">وصف المنتج بالانجليزيه</label>
                    <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter descrption" wire:model="desc_en" required></textarea>
                    @error('desc_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror

                   

                </div>

                <hr>

                <div class="form-group">
                    <label for="exampleInputEmail1">سعر المنتج</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" wire:model="price" required>
                    @error('price')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">الضريبه %</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" wire:model="tax" value="0">
                    @error('tax')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">سعر العرض ان وُجد</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" wire:model="offer_price" value="0">
                    @error('offer_price')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">الكمية المتاحة</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" wire:model="amount" value="1" required>
                    @error('amount')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                

                <div class="form-group">
                    <label for="exampleInputEmail1">الحد الادني</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" wire:model="min_amount" value="1" required>
                    @error('min_amount')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">الحد الاقصي</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" wire:model="max_amount" value="1" required>
                    @error('max_amount')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <hr>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">صورة المنتج الاساسية</label>

                    <input type="file" class="form-control" wire:model="image" accept="image/*" required>

                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">صور المنتج الفرعيه</label>

                    <input type="file" class="form-control" wire:model="photos" accept="image/*" multiple required>

                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">ملفات المنتج</label>

                    <input type="file" class="form-control" wire:model="files" accept=".pdf" multiple required>

                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">رابط فيديو للمنتج</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" wire:model="video_link">
                    @error('video_link')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <hr>

                <div class="form-group">
                    <label for="exampleInputEmail1">البيع من خلال</label>
                    <select class="form-control" wire:model="sell_through">
                            <option value="1">الموقع والفروع</option>
                            <option value="2">الموقع فقط</option>
                            <option value="3">الفروع فقط</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">الوزن القائم عند الشحن بالكيلو جرام</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" wire:model="shipped_weight" value="0" required>
                    @error('shipped_weight')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
               
                <div class="form-group">
                    <label for="exampleInputEmail1">ترتيب المنتج</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" wire:model="sort" value="0">
                    @error('sort')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <hr>

                <div class="form-group">
                    <label for="exampleInputEmail1">الحالة</label>
                    <select class="form-control" wire:model="status">
                            <option value="1">مُفعل</option>
                            <option value="0">غير مُفعل</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">الاتاحة</label>
                    <select class="form-control" wire:model="availabe_or_no">
                            <option value="1">متاح</option>
                            <option value="0">غير متاح</option>
                    </select>
                </div>
                <hr>
   
                <!-------------------------------------------------------------------------->
                <label for="exampleInputEmail1">اضافه خصائص المنتج</label>
                <div class=" add-input">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="الخاصيه مثال : الوزن" wire:model="weight_ar.0">
                                @error('weight_ar.0') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col">
                            <input class="form-control" type="text" wire:model="value_ar.0" placeholder="القيمة (مثال : 10كجم)"/>
                            @error('value_ar.0') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>

                        <div class="col">
                            <input class="form-control" type="text" wire:model="weight_en.0" placeholder="الخاصية بالانجليزية (مثال : weight)"/>
                            @error('weight_en.0') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>

                        <div class="col">
                            <input class="form-control" type="text" wire:model="value_en.0" placeholder="القيمة بالانجليزيه (مثال : 10كجم)"/>
                            @error('value_en.0') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        
                        <div class="col-md-2">
                            <button type="button" class="btn text-white btn-info btn-sm" wire:click.prevent="add({{$i}})">اضافه</button>
                        </div>
                    </div>
                </div>

                @foreach($inputs as $key => $value)
                    <div class=" add-input">
                        <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="الخاصيه مثال : الوزن" wire:model="weight_ar.{{$value}}">
                                @error('weight_ar.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col">
                            <input class="form-control" type="text" wire:model="value_ar.{{$value}}" placeholder="القيمة (مثال : 10كجم)"/>
                            @error('value_ar.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>

                        <div class="col">
                            <input class="form-control" type="text" wire:model="weight_en.{{$value}}" placeholder="الخاصية بالانجليزية (مثال : weight)"/>
                            @error('weight_en.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>

                        <div class="col">
                            <input class="form-control" type="text" wire:model="value_en.{{$value}}" placeholder="القيمة بالانجليزيه (مثال : 10كجم)"/>
                            @error('value_en.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                            <div class="col-md-2">
                                <button class="btn btn-danger btn-sm" wire:click.prevent="remove({{$key}})">حذف</button>
                            </div>
                        </div>
                    </div>
                @endforeach
        
                <!-------------------------------------------------------------------------->
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">اضافه</button>
                </div>
                </form>
        </div>
      
        </div>
        </div>
    </div>
</div>


<!-------------------------------------------------------------------------->
</div>
