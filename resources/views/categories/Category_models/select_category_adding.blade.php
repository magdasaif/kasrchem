
<div class="form-group">
                 <label>التصنيف الرئيسى</label>
                 <select class="form-control " name="main_category" id="main_category_id" required  oninvalid="this.setCustomValidity('قم بادخال التصنيف الرئيسي')"  oninput="this.setCustomValidity('')">
                    
                <option value="" disabled="true" selected="true">اختر التصنيف الرئيسي</option>
                   <?php 
                        foreach($Main_Cat as $Main_Category)
                        {
                            // if ($Main_Category->sub_cate2_count>0) 
                            // { 
                    ?>
                              <option  value="{{$Main_Category->id}}">{{$Main_Category->subname_ar}}</option>
                   <?php   
                            // }
                       }
                    ?>
                 </select> 
                 <div  id="main_error" style="color: red;display: none;">قم بادخال التصنيف الرئيسي</div>
                 @error('main_category')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

            <!----------------------------------------------------->
            <input type="hidden" value="" id="selected_main">
        <div  style="display: block">    
                <div class="form-group"  id="sub2_div"   >    
                    <label>   التصنيف الفرعي </label>
                    <select  class="form-control sub2"  id="sub2_sel" name="sub2" required  oninvalid="this.setCustomValidity('قم بادخال التصنيف الفرعى')"  oninput="this.setCustomValidity('')">
                     </select>
                     <div class="form-control" id="sub2_requi" style="display:none;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد تصنيف فرعى للتصنيف الرئيسي المختار من فضلك قم باضافته اولا</span>
                    
                     <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal" style="margin-right: 23px;font-weight: bold;"></i>
                      </div>
                 </div>
             <!----------------------------------------------------- -->
             
             <div class="form-group"  id="sub3_div" >
                <label>النوع</label>
                 <select  class="form-control sub3"  id="sub3_sel" name="sub3" required  oninvalid="this.setCustomValidity('قم بادخال النوع الرئيسي')"  oninput="this.setCustomValidity('')">
                 </select> 
                 <div class="form-control" id="sub3_requi" style="display:none;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد نوع رئيسي للتصنيف الفرعى المختار من فضلك قم باضافته اولا</span>
                    
                    <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal3" style="margin-right: 23px;font-weight: bold;"></i>
                </div>

                <!----------------------------------------------------- -->
                <div class="form-group"  id="sub4_div" > 
                <label>النوع الفرعى</label>
                    <select  class="form-control sub4"  id="sub4_sel" name="sub4" required  oninvalid="this.setCustomValidity('قم بادخال النوع الفرعى')"  oninput="this.setCustomValidity('')"  >
     
                    </select>
                    <div class="form-control" id="sub4_requi" style="display:none;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد نوع فرعى للنوع الرئيسي المختار من فضلك قم باضافته اولا</span>
                    
                    <i  class="nav-icon fas fa-plus green" type="button"  data-toggle="modal" data-target="#exampleModal4" style="margin-right: 23px;font-weight: bold;"></i>
                    </div>
            </div>
               