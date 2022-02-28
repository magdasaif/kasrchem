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
                <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter name" name="subname_ar" id="regax_name_ar_model0" onkeyup="check_regax_name_ar_model(0);" onkeypress="return CheckArabicCharactersOnly_model(event,0);"   required oninvalid="this.setCustomValidity('يجب ان يكون اسم التصنيف باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">

                <span style="color:red;display:none;font-weight: bold;" id="error_name_model0"> يجب ان يكون اسم التصنيف باللغة العربية وايضا لا يكون ارقام فقط</span>
               @error('subname_ar')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
        
            <div class="form-group">
                <label for="exampleInputEmail1">اسم التصنيف بالانجليزيه</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname_en" required onkeypress="return CheckEnglishCharactersOnly_model(event,0);"  pattern="^(?=.*[a-zA-Z\s])[a-zA-Z0-9\s]+$" oninvalid="this.setCustomValidity('يجب ان يكون اسم التصنيف باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                <span style="color:red;display:none;font-weight: bold;" id="error_name_en_model0"> يجب ان يكون اسم التصنيف باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

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
                    <label >اسم التصنيف الفرعى بالعربيه</label>
                    <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter name" name="subname2_ar" id="regax_name_ar_model1" onkeyup="check_regax_name_ar_model(1);" onkeypress="return CheckArabicCharactersOnly_model(event,1);"   required oninvalid="this.setCustomValidity('يجب ان يكون اسم التصنيف الفرعى باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name_model1"> يجب ان يكون اسم التصنيف الفرعى باللغة العربية وايضا لا يكون ارقام فقط</span>
                    @error('subname2_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label >اسم التصنيف الفرعى بالانجليزيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="subname2_en" required onkeypress="return CheckEnglishCharactersOnly_model(event,1);"  pattern="^(?=.*[a-zA-Z\s])[a-zA-Z0-9\s]+$"oninvalid="this.setCustomValidity('يجب ان يكون اسم التصنيف الفرعى باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en_model1"> يجب ان يكون اسم التصنيف الفرعى باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

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
                <input type="text" class="form-control" aria-describedby="emailHelp"  placeholder="ادخل اسم النوع بالعربية" name="subname_ar" id="regax_name_ar_model3" onkeyup="check_regax_name_ar_model(3);" onkeypress="return CheckArabicCharactersOnly_model(event,3);"   required oninvalid="this.setCustomValidity('يجب ان يكون اسم النوع باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                <span style="color:red;display:none;font-weight: bold;" id="error_name_model3"> يجب ان يكون اسم النوع باللغة العربية وايضا لا يكون ارقام فقط</span>

                @error('subname_ar')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
        
            <div class="form-group">
                <label for="exampleInputEmail1">اسم النوع بالانجليزيه</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  placeholder="ادخل اسم النوع بالانجليزية" name="subname_en" required onkeypress="return CheckEnglishCharactersOnly_model(event,3);"  pattern="^(?=.*[a-zA-Z\s])[a-zA-Z0-9\s]+$"oninvalid="this.setCustomValidity('يجب ان يكون اسم النوع باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">  
                <span style="color:red;display:none;font-weight: bold;" id="error_name_en_model3"> يجب ان يكون اسم النوع باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

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
        اضافه نوع  فرعى</h5>
            

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
                <input type="text" class="form-control"  aria-describedby="emailHelp"  name="subname_ar"  id="regax_name_ar_model4" onkeyup="check_regax_name_ar_model(4);" onkeypress="return CheckArabicCharactersOnly_model(event,4);"   required oninvalid="this.setCustomValidity('يجب ان يكون اسم النوع الفرعى باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                <span style="color:red;display:none;font-weight: bold;" id="error_name_model4"> يجب ان يكون اسم النوع الفرعى باللغة العربية وايضا لا يكون ارقام فقط</span>
                @error('subname_ar')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
        
            <div class="form-group">
                <label for="exampleInputEmail1">اسم النوع الفرعى بالانجليزيه</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="subname_en" required onkeypress="return CheckEnglishCharactersOnly_model(event,4);"  pattern="^(?=.*[a-zA-Z\s])[a-zA-Z0-9\s]+$"oninvalid="this.setCustomValidity('يجب ان يكون اسم النوع الفرعى باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                <span style="color:red;display:none;font-weight: bold;" id="error_name_en_model4"> يجب ان يكون اسم النوع الفرعى باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

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

                            <!--------0--supplier , another--sub_supplier------------------>
               <div class="form-group">
                   <label for="supplier_or_sub">نوع المـــــــورد</label>
                   
                   <select class="form-control" name="supplier_or_sub" style="height: 50px;" required oninvalid="this.setCustomValidity('اختر نوع المورد')"  oninput="this.setCustomValidity('')">
                   <option value="0" selected > مورد رئيسي</option>

                   @foreach($suppliers as $supplier)
                        <?php
                            $style_right="0";
                            $color="#c20620";
                            $size="15";
                            $type="supplier";
                        ?>
                            <option style="margin-right:{{$style_right}}px;color: {{$color}};font-size: {{$size}}px;"  value="{{$supplier->id}}"  {{ old('supplier_or_sub') == '0' ? "selected" : "" }}> {{$supplier->name_ar}}</option>
                            @if(count($supplier->childs))
                                @include('pages.products.manageChild',['childs' => $supplier->childs,'style_right'=>$style_right+30,'color'=>'#209c41','$size'=>$size-1,'type'=>$type])
                            @endif
                        @endforeach
                    </select>
                </div>
                <!----------------------------------------------------->
                        <div class="form-group">
                            <label for="name_ar"> اسم المورد </label>
                            <input type="text" class="form-control"  aria-describedby="name_ar" placeholder="ادخل اسم المورد" name="name_ar"  value="{{ old('name_ar') }}" required  id="regax_name_ar_model5" onkeyup="check_regax_name_ar_model(5);" onkeypress="return CheckArabicCharactersOnly_model(event,5);"    oninvalid="this.setCustomValidity('يجب ان يكون اسم المورد باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                            <span style="color:red;display:none;font-weight: bold;" id="error_name_model5"> يجب ان يكون اسم المورد باللغة العربية وايضا لا يكون ارقام فقط</span>

                            @error('name_ar')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <!----------------------------------------------------->
                        <div class="form-group">
                            <label for="name_en">اسم المورد بالانجليزية</label>
                            <input type="text" class="form-control" id="name_en" aria-describedby="name_en"  placeholder="ادخل اسم المورد بالانجليزية"  value="{{ old('name_en') }}" name="name_en" required onkeypress="return CheckEnglishCharactersOnly_model(event,5);"  pattern="^(?=.*[a-zA-Z\s])[a-zA-Z0-9\s]+$"oninvalid="this.setCustomValidity('يجب ان يكون اسم المورد باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                            <span style="color:red;display:none;font-weight: bold;" id="error_name_en_model5"> يجب ان يكون اسم المورد باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

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
  
