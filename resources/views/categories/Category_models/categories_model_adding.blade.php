<div class="container">
 
  <!-------------------------------- [ Modal #0 ]------------------------------------------------------- -->
  <div class="modal fade" id="exampleModal0" tabindex="-1">
    <div class="modal-dialog">
     <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal"><i class="icon-xs-o-md"></i></button>
      <div class="card-header">
        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModal0Label">
        اضافة تصنيف رئيسي
               </h5>
      </div>
      <div class="modal-body" style="margin-right: 1px;width: 100%;">
        <!--==========================================================-->
		  <form method="POST" action="{{route('categories.store')}}" enctype="multipart/form-data">
            
            @csrf
                 <input type="hidden" name="model0" value="1">
                <div class="form-group">
                     <label> القسم </label>
                     <input type="text" class="form-control" name="new_main_name" id="new_main_name" value="" disabled>
                    <input type="hidden" class="form-control" name="section_id" id="section_id" value="">
                </div>

            
            <div class="form-group">
                <label for="exampleInputEmail1">اسم التصنيف بالعربيه</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname_ar" required>
                @error('subname_ar')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
        
            <div class="form-group">
                <label for="exampleInputEmail1">اسم التصنيف بالانجليزيه</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname_en" required>
                @error('subname_en')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            
            <div class="form-group">
                <label for="exampleInputEmail1">صوره *</label>

                <input type="file" class="form-control" name="image" accept="image/*" required>

                @error('image')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>


            <div class="form-group">
                <label>الحاله</label>
                <select class="form-control" name="status">
                        <option value="1">مُفعل</option>
                        <option value="0">غير مُفعل</option>
                </select>
            </div>
            
            <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">اضافه</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">الغاء</button>
                </div>
            </form>
		
		
		<!--==========================================================-->
		
		
      </div>
     
     </div>
    </div>
  </div>
  <!-------------------------------- [ Modal #1 ]------------------------------------------------------- -->
  <div class="modal fade" id="exampleModal" tabindex="-1">
    <div class="modal-dialog">
     <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal"><i class="icon-xs-o-md"></i></button>
      <div class="card-header">
        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
        اضافة تصنيف فرعى
               </h5>
      </div>
      <div class="modal-body" style="margin-right: 1px;width: 100%;">
        <!--==========================================================-->
		 
                <form method="POST" action="{{route('categories2.store')}}" enctype="multipart/form-data">
            
                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}
                   <input type="hidden" name="model1" value="1">
                <div class="form-group">
                     <label> التصنيف الرئيسى</label>
                     <input type="text" class="form-control" name="test" id="test" value="" disabled>
                     <input type="hidden" class="form-control" name="section_id" id="section_id1" value="">
                     <input type="hidden" class="form-control" name="cate_id" id="cate_id" value="">
                </div>

                
                <div class="form-group">
                    <label >اسم التصنيف بالعربيه</label>
                    <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter name" name="subname2_ar" required>
                    @error('subname2_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label >اسم التصنيف بالانجليزيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname2_en" required>
                    @error('subname2_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                
                <div class="form-group">
                    <label >صوره *</label>

                    <input type="file" class="form-control" name="image" accept="image/*" required>

                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                <label >الحاله</label>
                    <select class="form-control" name="status">
                            <option value="1">مُفعل</option>
                            <option value="0">غير مُفعل</option>
                    </select>
                </div>
                
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">اضافه</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">الغاء</button>
                </div>
         </form>
		
		
		<!--==========================================================-->
		
		
      </div>
     
     </div>
    </div>
  </div>

  <!------------------------------------------------ [ Modal #3 ]--------------------------------------------------------->
  <div class="modal fade" id="exampleModal3" tabindex="-1">
    <div class="modal-dialog">
     <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal"><i class="icon-xs-o-md"></i></button>
      <div class="card-header">
        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                اضافه نوع             
               </h5>
      </div>
      <div class="modal-body" style="margin-right: 1px;width: 100%;">
     <!--==========================================================-->
                <form method="POST" action="{{route('categories3.store')}}" enctype="multipart/form-data">
            
            @csrf
            {{-- <input name="_token" value="{{csrf_token()}}"> --}}
            <input type="hidden" name="model2" value="1">
            <div class="form-group">
               
                <label for="exampleInputEmail1">اسم التصنيف الفرعي</label>
                <input type="text" class="form-control" name="sub2_name" id="sub2_name" value="" disabled>
                
                <input type="hidden" class="form-control" name="section_id" id="section_id2" value="">
                <input type="hidden" class="form-control" name="cate_id" id="cate_id2" value="">
                <input type="hidden" class="form-control" name="sub2_id" id="sub2_id" value="">

               
            </div>
           
            
            <div class="form-group">
                <label for="exampleInputEmail1">اسم النوع بالعربيه</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ادخل اسم الفرع بالعربية" name="subname_ar" required>
                @error('subname_ar')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
        
            <div class="form-group">
                <label for="exampleInputEmail1">اسم النوع بالانجليزيه</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ادخل اسم الفرع بالانجليزية" name="subname_en" required>
                @error('subname_en')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            
            <div class="form-group">
                <label for="exampleInputEmail1">صوره</label>

                <input type="file" class="form-control" name="image" accept="image/*" required>

                @error('image')
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
                    <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء</button>

            </div>
            </form>
		
		
		<!--==========================================================-->
	
	
	
      </div>
      
     </div>
    </div>
  </div>

  <!--------------------------------------------- [ Modal #4 ]--------------------------------- -->
  <div class="modal fade" id="exampleModal4" tabindex="-1">
    <div class="modal-dialog">
     <div class="modal-content">
      <div class="card-header">
        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
        اضافه نوع  فرعى                </h5>
            

      </div>
      <div class="modal-body" style="margin-right: 1px;width: 100%;">
        
		<!--==========================================================-->
        <form method="POST" action="{{route('categories4.store')}}" enctype="multipart/form-data">
            
            @csrf
            {{-- <input name="_token" value="{{csrf_token()}}"> --}}
            <input type="hidden" name="model3" value="1">
            <div class="form-group">
            <label for="exampleInputEmail1">اسم النوع الرئيسى</label>

                <input type="text" class="form-control" name="sub3_name" id="sub3_name" value="" disabled="disabled" >

                <input type="hidden" class="form-control" name="section_id" id="section_id22" value="">
                <input type="hidden" class="form-control" name="cate_id" id="cate_id22" value="">
                <input type="hidden" class="form-control" name="sub2_id" id="sub2_id2" value="">

                <input type="text" class="form-control" name="sub3_id" id="sub3_id" value="" hidden>

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
		
		
		<!--==========================================================-->
	
		
		
      </div>
      
           
           
        
     </div>
    </div>
  </div>


  <!--------------------------------------------- [ Modal #SupplierModel ]--------------------------------- -->
    <div class="modal fade" id="SupplierModel" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="card-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    اضافه مورد
                    </h5>
                </div>
                <div class="modal-body" style="margin-right: 1px;width: 100%;">
                    
                    <!--==========================================================-->
                    <form method="POST" action="{{route('supplier.store')}}" enctype="multipart/form-data">
                        @csrf
                        <!----------------------------------------------------->
                            <input type="hidden" name="supplier_model" value="1">
                            <input type="hidden" class="form-control" name="section_id" id="section_id222" value="">
                            <input type="hidden" class="form-control" name="cate_id" id="cate_id222" value="">
                            <input type="hidden" class="form-control" name="sub2_id" id="sub2_id22" value="">
                            <input type="text" class="form-control" name="sub3_id" id="sub3_id2" value="" hidden>
                            <input type="text" class="form-control" name="sub4_id" id="sub4_id" value="" hidden>

                        <div class="form-group">
                            <label for="name_ar"> اسم المورد </label>
                            <input type="text" class="form-control" id="name_ar" aria-describedby="name_ar" placeholder="ادخل اسم المورد" name="name_ar"  value="{{ old('name_ar') }}" required  oninvalid="this.setCustomValidity('قم بادخال المورد بالعربية')"  oninput="this.setCustomValidity('')">
                            @error('name_ar')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <!----------------------------------------------------->
                        <div class="form-group">
                            <label for="name_en">اسم المورد بالانجليزية</label>
                            <input type="text" class="form-control" id="name_en" aria-describedby="name_en" placeholder="ادخل اسم المورد بالانجليزية"  value="{{ old('name_en') }}" name="name_en" required  oninvalid="this.setCustomValidity('قم بادخال اسم المورد بالانجليزية')"  oninput="this.setCustomValidity('')">
                            @error('name_en')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <!----------------------------------------------------->
                        <div class="form-group">
                            <label for="logo">اللوجــو</label>
                            <input type="file" class="form-control" name="logo" accept="image/*" required  oninvalid="this.setCustomValidity('قم بادخال الصورة')"  oninput="this.setCustomValidity('')">
                            @error('logo')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <!----------------------------------------------------->

                        <div class="form-group">
                            <label for="description_ar">وصف المورد بالعربية  </label>
                            <textarea  class="form-control tinymce-editor" name="description_ar" id="description_ar" placeholder="ادخل  وصف المورد بالعربية "  >{!! old('description_ar')!!}</textarea>
                            @error('description_ar')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <!----------------------------------------------------->
                        <div class="form-group">
                            <label for="description_en">وصف المورد بالانجليزية  </label>
                            <textarea  class="form-control tinymce-editor" name="description_en" id="description_en" placeholder="ادخل  وصف المورد بالانجليزية "  >{!! old('description_en')!!}</textarea>
                            @error('description_en')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <!----------------------------------------------------->
                        <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">اضافه</button>
                        </div>
                        </form>

                    <!--==========================================================-->
                </div>
            
            </div>
        </div>
    </div>
    
  </div>
  
