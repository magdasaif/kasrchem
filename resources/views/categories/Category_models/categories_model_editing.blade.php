<div class="container">
 
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
                   <input type="hidden" name="model1_edit" value="1">
                  
                <div class="form-group">
                     <label> التصنيف الرئيسى</label>
                     <input type="text" class="form-control" name="test" id="test" value="" disabled>
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
                    <label >صوره</label>

                    <input type="file" class="form-control" name="image" accept="image/*">

                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
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

  <!------------------------------------------------ [ Modal #2 ]--------------------------------------------------------->
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
            <input type="hidden" name="model2_edit" value="1">
                
            <div class="form-group">
               
                <label for="exampleInputEmail1">اسم التصنيف الفرعي</label>
                <input type="text" class="form-control" name="sub2_name" id="sub2_name" value="" disabled>
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

                <input type="file" class="form-control" name="image" accept="image/*">

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

  <!--------------------------------------------- [ Modal #3 ]--------------------------------- -->
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
            <input type="hidden" name="model3_edit" value="1">
                   

            <div class="form-group">
            <label for="exampleInputEmail1">اسم النوع الرئيسى</label>
            <input type="text" class="form-control" name="sub3_name" id="sub3_name" value="" disabled="disabled" >

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
  </div>
  
